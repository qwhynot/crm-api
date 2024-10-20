<?php

namespace App\Http\Requests\Api\Task;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'sometimes|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:pending,in_progress,completed,on_hold', // Додано статус "on_hold"
            'due_date' => 'sometimes|nullable|date',
            'priority' => 'sometimes|required|in:low,medium,high', // Пріоритет завдання
            'completed_at' => 'sometimes|nullable|date_format:Y-m-d H:i:s', // Дата та час завершення завдання
            'created_by' => 'sometimes|nullable|exists:users,id', // Користувач, який створив завдання
            'updated_by' => 'sometimes|nullable|exists:users,id', // Користувач, який останнім редагував завдання
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422)); // 422 статус - невірний запит
    }
}
