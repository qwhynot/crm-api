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
        Schema::create('task_files', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')->constrained()->onDelete('cascade'); // Зв'язок з таблицею tasks
            $table->string('file_path'); // Шлях до файлу
            $table->string('file_name'); // Ім'я файлу
            $table->string('mime_type'); // MIME тип файлу
            $table->unsignedBigInteger('file_size'); // Розмір файлу
            $table->string('description')->nullable(); // Опис файлу

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_files');
    }
};
