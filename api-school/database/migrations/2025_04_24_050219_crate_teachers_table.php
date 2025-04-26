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
        Schema::create('teachers', function (Blueprint $table) 
        {
            $table->id();
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->string('email', 150)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('employee_id', 50)->unique()->comment('Teacher employee identification');
            $table->string('specialization', 100)->nullable()->comment('Teacher specialization area');
            $table->enum('status', ['active', 'inactive', 'on_leave'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            // Indices para campos de busqueda frecuente.
            $table->index(['name', 'surname']);
            $table->index(['employee_id']);
            $table->index(['specialization']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
