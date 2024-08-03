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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('company_inn');
            $table->string('company_name');
            $table->string('company_person');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('project_status', ['completed', 'in_progress', 'on_hold', 'cancelled']);
            $table->enum('payment_status', ['paid', 'partially_paid', 'unpaid']);
            $table->foreignId('client_id')->nullable()->constrained('clients');
            $table->foreignId('manager_id')->nullable()->constrained('users');
            $table->foreignId('agreement_id')->nullable()->constrained('agreements');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
