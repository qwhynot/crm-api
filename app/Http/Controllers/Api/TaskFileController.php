<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskFile\StoreTaskFileRequest;
use App\Http\Resources\TaskFileResource;
use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskFileController extends Controller
{
    // Перегляд усіх файлів для конкретної задачі
    public function index($taskId)
    {
        $files = TaskFile::where('task_id', $taskId)->get();

        return TaskFileResource::collection($files);
    }

    // Завантаження файлу для задачі
    public function store(StoreTaskFileRequest $request, $taskId)
    {
        $task = Task::find($taskId);

        if ($task) {
            $file = $request->file('file');

            // Збереження файлу у приватній директорії
            $path = $file->store('task_files', 'private');

            // Збереження інформації про файл у БД
            $taskFile = TaskFile::create([
                'task_id' => $taskId,
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'description' => $request->description,
            ]);

            return new TaskFileResource($taskFile);
        }

        return response()->json(['message' => 'Incorrect task id'], 404);
    }

    // Видалення файлу
    public function destroy($taskId, $fileId)
    {
        $task = Task::find($taskId);
        $file = TaskFile::find($fileId);

        if ($task && $file) {
            // Видалення файлу з диску
            Storage::disk('private')->delete($file->file_path);

            // Видалення запису з БД
            $file->delete();

            return response()->json(null, 204); // 204 статус - без контенту
        }

        if (!$task)
            return response()->json(['message' => 'Incorrect task id'], 404);

        return response()->json(['message' => 'Incorrect file id'], 404);
    }

    public function multiDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            return response()->json(['message' => 'Invalid input. Expected an array of IDs.'], 400);
        }

        $request->validate([
            'ids' => 'required|array',
        ]);

        // Отримуємо існуючі записи
        $existingFiles = TaskFile::whereIn('id', $ids)->get();

        // Перевіряємо, які ідентифікатори не існують
        $existingIds = $existingFiles->pluck('id')->toArray();
        $nonExistentIds = array_diff($ids, $existingIds);

        // Якщо є неіснуючі ідентифікатори, ми можемо про них повідомити
        if (!empty($nonExistentIds)) {
            return response()->json([
                'message' => 'Some files were not found.',
                'non_existent_ids' => $nonExistentIds,
            ], 404);
        }

        // Видалення існуючих файлів
        $existingFiles->each(function ($file) {
            // Видаляємо файл з файлової системи
            Storage::disk('private')->delete($file->file_path);
            // Видаляємо запис з бази даних
            $file->delete();
        });

        return response()->json(['message' => 'Files deleted successfully.'], 200);
    }

}
