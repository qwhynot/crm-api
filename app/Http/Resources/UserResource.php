<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name, // Прізвище
            'email' => $this->email,
            'phone_number' => $this->phone_number, // Номер телефону
            'date_of_birth' => $this->date_of_birth, // Дата народження
            'address' => $this->address, // Адреса
            'city' => $this->city, // Місто
            'postal_code' => $this->postal_code, // Поштовий індекс
            'country' => $this->country, // Країна
            'is_admin' => $this->is_admin, // Чи є користувач адміністратором
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
