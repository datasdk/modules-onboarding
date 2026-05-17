<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Badges extends Migration
{
    public function up(): void
    {

        if (!Schema::hasTable('badges'))
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // fx "Superbruger"
            $table->string('slug')->unique(); // tilføjet slug
            $table->text('description')->nullable();
            $table->string('icon')->nullable(); // fx "mdi-star"
            $table->timestamps();
        });
    }

    public function down(): void
    {

        if (Schema::hasTable('badges'))
        Schema::dropIfExists('badges');
    }
}
