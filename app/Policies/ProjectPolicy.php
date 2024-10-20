<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function showAll(User $user, Project $project = null): bool
    {
        // Адміністратор має доступ до всіх проєктів
        if ($user->is_admin) {
            return true;
        }

        // Якщо користувач не адміністратор, він може бачити тільки свої проєкти
        return false; // У цьому випадку не надається доступ до всіх проєктів
    }



    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        // Адміністратор має доступ до всіх проєктів
        if ($user->is_admin) {
            return true;
        }

        // Якщо це звичайний користувач, перевіряємо, чи він учасник проєкту
        return $user->projects()->where('project_id', $project->id)->exists();
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
    public function update(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->is_admin;
    }
}
