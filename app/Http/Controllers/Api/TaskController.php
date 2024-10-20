<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\StoreTaskRequest;
use App\Http\Requests\Api\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    // Перегляд усіх задач з можливістю фільтрації
    public function index(Request $request)
    {
        $query = Task::query();

        // Якщо користувач не адміністратор, показуємо лише задачі, де він призначений
        if (Gate::denies('showAll', Task::class)) {
            $userProjectsIds = $request->user()->projects()->pluck('projects.id')->toArray();
            $query->whereIn('project_id', $userProjectsIds);
        }

        // Фільтрація по проекту
        if ($request->has('project_id')) {
            $query->where('project_id', $request->input('project_id'));
        }

        // Пошук по заголовку
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        // Фільтрація по статусу
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        // Фільтрація по дати виконання
        if ($request->has('due_date')) {
            $query->where('due_date', $request->input('due_date'));
        }

        // Кількість записів на сторінку
        $perPage = $request->input('per_page', 10);

        // Перевірка, що per_page - це позитивне число
        if (!is_numeric($perPage) || $perPage <= 0) {
            $perPage = 10; // Якщо не дійсне - повертаємо до значення за замовчуванням
        }

        // Пагінація
        $tasks = $query->paginate($perPage);

        // Повернення з пагінацією та мета-даними
        return response()->json([
            'data' => TaskResource::collection($tasks),
            'meta' => [
                'current_page' => $tasks->currentPage(),
                'last_page' => $tasks->lastPage(),
                'per_page' => $tasks->perPage(),
                'total' => $tasks->total(),
            ],
        ]);
    }

    // Перегляд однієї задачі
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Перевірка прав доступу до задачі
        if (Gate::denies('view', $task)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        return new TaskResource($task);
    }

    // Створення задачі
    public function store(StoreTaskRequest $request)
    {
        if (Gate::denies('create', Task::class)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $validated = $request->validated();

        $task = Task::create($validated);

        return response()->json(new TaskResource($task), 201); // 201 статус - ресурс створено
    }

    // Оновлення задачі
    public function update(UpdateTaskRequest $request, $id)
    {
        if (Gate::denies('update', Task::class)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $task = Task::find($id);

        if ($task) {
            $validated = $request->validated();

            $task->update($validated);

            return response()->json(new TaskResource($task), 200); // 200 статус - успішне оновлення
        }

        return response()->json(['message' => 'Task not found'], 404);
    }

    // Видалення задачі
    public function destroy($id)
    {
        if (Gate::denies('delete', Task::class)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $task = Task::find($id);

        if ($task) {
            $task->delete();

            return response()->json(null, 204); // 204 статус - без контенту
        }

        return response()->json(['message' => 'Task not found'], 404);
    }

    public function multiDelete(Request $request)
    {
        if (Gate::denies('delete', Task::class)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $ids = $request->input('ids');

        // Перевірка, чи це масив
        if (!is_array($ids)) {
            return response()->json(['message' => 'Invalid input. Expected an array of IDs.'], 400);
        }

        $request->validate([
            'ids' => 'required|array',
        ]);

        // Отримуємо існуючі задачі
        $existingTasks = Task::whereIn('id', $ids)->get();

        // Отримуємо існуючі ID задач
        $existingIds = $existingTasks->pluck('id')->toArray();

        // Перевіряємо, які ідентифікатори не існують
        $nonExistentIds = array_diff($ids, $existingIds);

        // Якщо є неіснуючі ідентифікатори, ми можемо про них повідомити
        if (!empty($nonExistentIds)) {
            return response()->json([
                'message' => 'Some tasks were not found.',
                'non_existent_ids' => $nonExistentIds,
            ], 404);
        }

        // Видалення існуючих задач
        Task::whereIn('id', $existingIds)->delete();

        return response()->json(['message' => 'Tasks deleted successfully.'], 200);
    }

}
