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
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority', [1, 2, 3])->default(1);
            $table->boolean('completed')->default(false);
            $table->unsignedInteger('progress')->default(0);
            $table->string('token')->unique();
            $table->foreignId('user_id')->constrained('users', 'id');
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
