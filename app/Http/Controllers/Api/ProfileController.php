<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json(new UserResource($user));
        }

        return response()->json(['message' => 'Profile not found']);
    }

    public function showProfileTasks()
    {
        $user = Auth::user();

        if ($user) {
            if (count($user->tasks))
                return response()->json(TaskResource::collection($user->tasks));

            return response()->json(['message' => 'Profile tasks found']);
        }

        return response()->json(['message' => 'Profile not found']);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        if ($user) {
            $validated = $request->validated();

            $user->update($validated);

            return response()->json(new UserResource($user), 200); // 200 статус - успішне оновлення
        }

        return response()->json(['message' => 'Profile not found']);
    }

    public function deleteProfile()
    {
        $user = Auth::user();

        if ($user) {
            $user->delete();

            return response()->json(null, 204); // 204 статус - без контенту
        }

        return response()->json(['message' => 'Profile not found']);
    }
}
