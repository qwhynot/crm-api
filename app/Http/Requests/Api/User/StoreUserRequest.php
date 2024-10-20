<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255', // Прізвище
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'nullable|string|max:20', // Номер телефону
            'date_of_birth' => 'nullable|date', // Дата народження
            'address' => 'nullable|string|max:255', // Адреса
            'city' => 'nullable|string|max:255', // Місто
            'postal_code' => 'nullable|string|max:20', // Поштовий індекс
            'country' => 'nullable|string|max:255', // Країна
            'is_admin' => 'nullable|boolean', // Чи є користувач адміністратором
            'password' => 'required|string|min:8',
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
