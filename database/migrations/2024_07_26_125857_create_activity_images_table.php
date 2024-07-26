<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('activity_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->string('image')->nullable();
            $table->timestamps(); // created_at and updated_at
        
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('activity_images');
    }
};