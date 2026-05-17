<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Badgeables extends Migration
{


    public function up(): void
    {

        if (!Schema::hasTable('badgeables'))
        Schema::create('badgeables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('badge_id');
            $table->morphs('badgeable'); // badgeable_id + badgeable_type
            $table->timestamps();
            
        });

    }


    public function down(): void
    {   

        if (Schema::hasTable('badgeables'))
        Schema::dropIfExists('badgeables');
    }

}
