<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Onboardings extends Migration
{
    public function up(): void
    {

        if (!Schema::hasTable('onboardings'))
        Schema::create('onboardings', function (Blueprint $table) {
            
            $table->id();
            
            $table->unsignedBigInteger('user_id');      // link til bruger
            $table->unsignedBigInteger('company_id')->nullable(); // link til virksomhed, optional
            
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

        });
    }

    public function down(): void
    {

        if (Schema::hasTable('onboardings'))
        Schema::dropIfExists('onboardings');
    }
}
