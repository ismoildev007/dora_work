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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('activity_type');
            $table->string('activity_date');
            $table->unsignedBigInteger('user_id')->nullable();
//            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->timestamps(); // created_at and updated_at

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
//            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
