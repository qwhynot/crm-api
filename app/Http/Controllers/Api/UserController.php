<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    // Перегляд усіх користувачів
    public function index(Request $request)
    {
        if (Gate::denies('showAll', User::class)) {
            // Обробка помилки доступу
            return response()->json(['error' => 'Access denied'], 403);
        }

        $perPage = $request->input('per_page', 10);

        // Перевірка, що per_page - це позитивне число
        if (!is_numeric($perPage) || $perPage <= 0) {
            $perPage = 10; // Якщо не дійсне - повертаємо до значення за замовчуванням
        }

        $users = User::paginate($perPage);

        return response()->json([
            'data' => UserResource::collection($users),
            'meta' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
            ],
        ]);
    }

    // Перегляд одного користувача
    public function show($id)
    {
        if (Gate::denies('view', User::class)) {
            // Обробка помилки доступу
            return response()->json(['error' => 'Access denied'], 403);
        }

        $user = User::find($id);

        if ($user) {
            return new UserResource($user);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    // Створення користувача
    public function store(StoreUserRequest $request)
    {
        if (Gate::denies('create', User::class)) {
            // Обробка помилки доступу
            return response()->json(['error' => 'Access denied'], 403);
        }

        $validated = $request->validated();

        $user = User::create($validated);

        return response()->json(new UserResource($user), 201); // 201 статус - ресурс створено
    }

    // Оновлення користувача
    public function update(UpdateUserRequest $request, $id)
    {
        if (Gate::denies('update', User::class)) {
            // Обробка помилки доступу
            return response()->json(['error' => 'Access denied'], 403);
        }

        $user = User::find($id);

        if ($user) {
            $validated = $request->validated();

            $user->update($validated);

            return response()->json(new UserResource($user), 200); // 200 статус - успішне оновлення
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    // Видалення користувача
    public function destroy($id)
    {
        if (Gate::denies('delete', User::class)) {
            // Обробка помилки доступу
            return response()->json(['error' => 'Access denied'], 403);
        }

        $user = User::find($id);

        if ($user) {
            $user->delete();

            return response()->json(null, 204); // 204 статус - без контенту
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
