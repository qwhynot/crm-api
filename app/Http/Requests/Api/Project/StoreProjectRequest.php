<?php

namespace App\Http\Requests\Api\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProjectRequest extends FormRequest
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
            'name' => 'required|string|max:255', // Назва проекту
            'description' => 'nullable|string', // Опис проекту
            'status' => 'required|in:planned,in_progress,completed,on_hold', // Статус проекту
            'start_date' => 'nullable|date', // Дата початку
            'end_date' => 'nullable|date|after_or_equal:start_date', // Дата закінчення (після дати початку)
            'budget' => 'nullable|numeric|min:0', // Бюджет проекту, число більше або рівне 0
            'created_by' => 'nullable|exists:users,id', // Користувач, який створив проект
            'updated_by' => 'nullable|exists:users,id', // Користувач, який редагував проект
            'notes' => 'nullable|string', // Додаткові нотатки
            'tags' => 'nullable|array', // Масив тегів
            'tags.*' => 'string|max:50', // Валідація кожного тега (макс. 50 символів)
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
