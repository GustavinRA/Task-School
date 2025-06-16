<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('priority', ['high', 'medium', 'low'])->default('medium');
            $table->text('description')->nullable(); // Adicionada coluna 'description'
            $table->enum('status', ['pending', 'in_progress', 'testing', 'completed'])->default('pending'); // Mantido em inglês
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};