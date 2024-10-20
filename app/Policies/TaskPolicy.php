<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    public function showAll(User $user): bool
    {
        // Адміністратор має доступ до всіх задач
        if ($user->is_admin) {
            return true;
        }

        // Звичайний користувач має доступ лише до задач, де він залучений
        return false; // Зазвичай повертаємо false, оскільки це глобальна перевірка
    }

    public function view(User $user, Task $task): bool
    {
        // Адміністратор має доступ до всіх задач
        if ($user->is_admin) {
            return true;
        }

        // Перевіряємо, чи належить задача до проєкту, в якому користувач бере участь
        return $user->projects()->where('projects.id', $task->project_id)->exists();
    }



    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->is_admin;
    }
}
