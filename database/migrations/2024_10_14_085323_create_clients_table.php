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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            // Зовнішній ключ до таблиці companies
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            // Основні поля клієнта
            $table->string('name'); // Ім'я клієнта
            $table->string('email')->nullable(); // Електронна пошта клієнта
            $table->string('phone', 20)->nullable(); // Телефон клієнта
            $table->text('address')->nullable(); // Адреса клієнта

            // Додаткові поля
            $table->string('website')->nullable(); // Веб-сайт клієнта
            $table->string('tax_id', 50)->nullable(); // Податковий ідентифікатор
            $table->string('registration_number', 50)->nullable(); // Реєстраційний номер
            $table->string('city')->nullable(); // Місто
            $table->string('postal_code', 20)->nullable(); // Поштовий індекс
            $table->text('notes')->nullable(); // Примітки до клієнта

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
