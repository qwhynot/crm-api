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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade'); // Зв'язок з таблицею tasks
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Зв'язок з таблицею users
            $table->text('body'); // Текст коментаря

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
