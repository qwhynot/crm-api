<?php

namespace App\Http\Requests\Api\Project;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProjectRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255', // Ім'я проекту може бути змінене
            'description' => 'nullable|string', // Опис може бути оновленим
            'status' => 'sometimes|in:planned,in_progress,completed,on_hold', // Оновлення статусу
            'start_date' => 'nullable|date', // Дата початку
            'end_date' => 'nullable|date|after_or_equal:start_date', // Дата завершення
            'budget' => 'nullable|numeric|min:0', // Оновлення бюджету
            'created_by' => 'nullable|exists:users,id', // Користувач, який створив проект
            'updated_by' => 'nullable|exists:users,id', // Користувач, який редагує проект
            'notes' => 'nullable|string', // Оновлення нотаток
            'tags' => 'nullable|array', // Оновлення тегів як масиву
            'tags.*' => 'string|max:50', // Валідація кожного тега
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
