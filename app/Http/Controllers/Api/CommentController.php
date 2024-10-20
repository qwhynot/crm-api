<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\StoreCommentRequest;
use App\Http\Requests\Api\Comment\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Перегляд усіх коментарів
    public function index(Request $request)
    {
        $query = Comment::query();

        // Фільтрація по задачі
        if ($request->has('task_id')) {
            $query->where('task_id', $request->input('task_id'));
        }

        $perPage = $request->input('per_page', 10);

        // Перевірка, що per_page - це позитивне число
        if (!is_numeric($perPage) || $perPage <= 0) {
            $perPage = 10; // Якщо не дійсне - повертаємо до значення за замовчуванням
        }

        $comments = $query->paginate($perPage);

        return response()->json([
            'data' => CommentResource::collection($comments),
            'meta' => [
                'current_page' => $comments->currentPage(),
                'last_page' => $comments->lastPage(),
                'per_page' => $comments->perPage(),
                'total' => $comments->total(),
            ],
        ]);
    }

    // Перегляд одного коментаря
    public function show($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            return new CommentResource($comment);
        }

        return response()->json(['message' => 'Comment not found'], 404);
    }

    // Створення коментаря
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();

        $comment = Comment::create($validated);

        return response()->json(new CommentResource($comment), 201); // 201 статус - ресурс створено
    }

    // Оновлення коментаря
    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $validated = $request->validated();

            $comment->update($validated);

            return response()->json(new CommentResource($comment), 200); // 200 статус - успішне оновлення
        }

        return response()->json(['message' => 'Comment not found'], 404);
    }

    // Видалення коментаря
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->delete();

            return response()->json(null, 204); // 204 статус - без контенту
        }

        return response()->json(['message' => 'Comment not found'], 404);
    }
}
