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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');   
            $table->unsignedBigInteger('room_id');   
            $table->unsignedBigInteger('class_id');   
            $table->unsignedBigInteger('subject_id'); 
            $table->unsignedBigInteger('day_id');     
            $table->unsignedBigInteger('timing_id');  
            $table->timestamps();

            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('day_id')->references('id')->on('days');
            $table->foreign('timing_id')->references('id')->on('timings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
