<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('message');
            $table->string('home_type');
            $table->string('yard_size');
            $table->text('experience');
            $table->string('reason_for_adoption');
            $table->string('status')->default('Pending');
            $table->timestamps();
            $table->unique(['pet_id','user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoption_requests');
    }
};
