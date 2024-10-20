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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'on_hold'])->default('pending');
            $table->date('due_date')->nullable();

            // Нові поля
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Пріоритет завдання
            $table->dateTime('completed_at')->nullable(); // Дата та час завершення завдання
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // Користувач, який створив завдання
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null'); // Користувач, який останнім редагував завдання


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
