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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Назва компанії
            $table->text('address')->nullable(); // Адреса компанії
            $table->string('phone', 20)->nullable(); // Телефон компанії
            $table->string('email')->nullable(); // Електронна пошта компанії
            $table->string('website')->nullable(); // Сайт компанії
            $table->string('tax_id', 50)->nullable(); // Податковий ідентифікатор компанії
            $table->string('registration_number', 50)->nullable(); // Реєстраційний номер компанії
            $table->string('country')->nullable(); // Країна
            $table->string('city')->nullable(); // Місто
            $table->string('postal_code', 20)->nullable(); // Поштовий індекс
            $table->string('industry')->nullable(); // Галузь діяльності компанії
            $table->text('description')->nullable(); // Опис компанії

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
