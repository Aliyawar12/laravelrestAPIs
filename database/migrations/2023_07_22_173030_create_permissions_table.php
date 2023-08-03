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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('component_id');
            $table->boolean('is_created')->default(false);
            $table->boolean('is_updated')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();

            // Foreign key constraint to reference the components table
            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
