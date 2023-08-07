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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('session');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('subdepartment_id');
            $table->string('shift');
            $table->timestamps();

            $table->foreign('subdepartment_id')->references('id')->on('subdepartments')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
