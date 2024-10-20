<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Project\StoreProjectRequest;
use App\Http\Requests\Api\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    // Перегляд усіх проєктів
    public function index(Request $request)
    {
        $user = $request->user();

        // Перевіряємо доступ для перегляду всіх проєктів
        if (Gate::denies('showAll', Project::class)) {
            // Якщо користувач не адміністратор, відобразимо тільки ті проєкти, до яких він долучений
            $projects = $user->projects();
        } else {
            // Адміністратор може бачити всі проєкти
            $projects = Project::query();
        }

        // Пагінація
        $perPage = $request->input('per_page', 10);
        $projects = $projects->paginate($perPage);

        return response()->json([
            'data' => ProjectResource::collection($projects),
            'meta' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
            ],
        ]);
    }


    public function show($id)
    {
        $project = Project::find($id);

        // Перевірка наявності проєкту
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        // Перевірка прав доступу до проєкту
        if (Gate::denies('view', $project)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        // Якщо доступ дозволений, повертаємо ресурс проєкту
        return new ProjectResource($project);
    }


    // Створення проєкту
    public function store(StoreProjectRequest $request)
    {
        if (Gate::denies('create', Project::class)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $data = $request->validated();

        if (isset($data['tags']) && is_array($data['tags'])) {
            $data['tags'] = json_encode($data['tags']);
        }

        $project = Project::create($data);

        return response()->json(new ProjectResource($project), 201); // 201 статус - ресурс створено
    }

    // Оновлення проєкту
    public function update(UpdateProjectRequest $request, $id)
    {
        if (Gate::denies('update', Project::class)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $project = Project::find($id);

        if ($project) {
            $data = $request->validated();

            if (isset($data['tags']) && is_array($data['tags'])) {
                $data['tags'] = json_encode($data['tags']);
            }

            $project->update($data);

            return response()->json(new ProjectResource($project), 200); // 200 статус - успішне оновлення
        }

        return response()->json(['message' => 'Project not found'], 404);
    }

    // Видалення проєкту
    public function destroy($id)
    {
        if (Gate::denies('delete', Project::class)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $project = Project::find($id);

        if ($project) {
            $project->delete();

            return response()->json(null, 204); // 204 статус - без контенту
        }

        return response()->json(['message' => 'Project not found'], 404);
    }

    public function multiDelete(Request $request)
    {
        if (Gate::denies('delete', Project::class)) {
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

        // Отримуємо існуючі проекти
        $existingTasks = Project::whereIn('id', $ids)->get();

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

        // Видалення проектів
        Project::whereIn('id', $existingIds)->delete();

        return response()->json(['message' => 'Projects deleted successfully.'], 200);
    }
}
