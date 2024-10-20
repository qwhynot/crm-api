<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskFileController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('login');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    //////PROJECTS///////
    Route::apiResource('projects', ProjectController::class);

    //////TASKS///////
    Route::apiResource('tasks', TaskController::class);

    //////TASK FILES///////
    Route::get('tasks/{task}/files', [TaskFileController::class, 'index']);
    Route::post('tasks/{task}/files', [TaskFileController::class, 'store']);
    Route::delete('tasks/{task}/files/{taskFile}', [TaskFileController::class, 'destroy']);

    //////COMMENTS///////
    Route::apiResource('comments', CommentController::class);

    //////USERS///////
    Route::apiResource('users', UserController::class);

    Route::get('/profile', [ProfileController::class, 'showProfile']); // Отримати інформацію про користувача
    Route::get('/profile/tasks', [ProfileController::class, 'showProfileTasks']); // Отримати інформацію про користувача
    Route::put('/profile', [ProfileController::class, 'updateProfile']); // Оновити інформацію про користувача
    Route::delete('/profile', [ProfileController::class, 'deleteProfile']); // Видалити обліковий запис

    //////MULTI ACTIONS///////
    Route::delete('multi-delete/projects', [ProjectController::class, 'multiDelete']);
    Route::delete('multi-delete/tasks', [TaskController::class, 'multiDelete']);
    Route::delete('multi-delete/files', [TaskFileController::class, 'multiDelete']);
});
