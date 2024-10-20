<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|nullable|string|max:255', // Прізвище
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $this->id,
            'phone_number' => 'sometimes|nullable|string|max:20', // Номер телефону
            'date_of_birth' => 'sometimes|nullable|date', // Дата народження
            'address' => 'sometimes|nullable|string|max:255', // Адреса
            'city' => 'sometimes|nullable|string|max:255', // Місто
            'postal_code' => 'sometimes|nullable|string|max:20', // Поштовий індекс
            'country' => 'sometimes|nullable|string|max:255', // Країна
            'is_admin' => 'sometimes|nullable|boolean', // Чи є користувач адміністратором
            'password' => 'sometimes|nullable|string|min:8',
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
