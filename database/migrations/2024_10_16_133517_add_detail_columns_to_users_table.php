<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('name'); // Прізвище
            $table->string('phone_number')->nullable()->after('email'); // Номер телефону
            $table->date('date_of_birth')->nullable()->after('phone_number'); // Дата народження
            $table->string('address')->nullable()->after('date_of_birth'); // Адреса
            $table->string('city')->nullable()->after('address'); // Місто
            $table->string('postal_code')->nullable()->after('city'); // Поштовий індекс
            $table->string('country')->nullable()->after('postal_code'); // Країна
            $table->boolean('is_admin')->default(false)->after('postal_code'); // Чи є користувач адміністратором
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Видаляємо додані поля
            $table->dropColumn([
                'last_name',
                'phone_number',
                'date_of_birth',
                'address',
                'city',
                'postal_code',
                'country',
                'is_admin',
            ]);
        });
    }
};
