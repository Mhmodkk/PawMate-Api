<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('shelter_id')->constrained('shelters')->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->string('gender');
            $table->integer('age');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('is_adopted');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
