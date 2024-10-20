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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['planned', 'in_progress', 'completed', 'on_hold'])->default('planned'); // Статуси
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('budget')->nullable(); // Бюджет проекту

            // Поля для управління проектом
            $table->unsignedBigInteger('created_by')->nullable(); // ID користувача, який створив проект
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null'); // Зовнішній ключ до таблиці users
            $table->unsignedBigInteger('updated_by')->nullable(); // ID користувача, який останнім редагував проект
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null'); // Зовнішній ключ до таблиці users

            // Поля для зберігання додаткової інформації
            $table->text('notes')->nullable(); // Додаткові нотатки про проект
            $table->json('tags')->nullable(); // Теги для проекту (може бути корисним для фільтрації)


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
