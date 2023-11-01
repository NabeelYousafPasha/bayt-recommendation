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
        Schema::create('model_ratings', function (Blueprint $table) {
            $table->id();
            $table->morphs('rateable');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedSmallInteger('value');
            $table->longText('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_ratings');
    }
};
