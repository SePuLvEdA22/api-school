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
        Schema::create('students', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 100)->comment('Student first name');
            $table->string('surname', 100)->comment('Student last name');
            $table->string('email', 150)->unique()->comment('Student email address');
            $table->string('phone', 20)->nullable()->comment('Student contact number');
            $table->string('student_id', 50)->unique()->comment('Student identification number');
            $table->enum('status', ['active', 'inactive', 'graduated', 'suspended'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            // Indices para campos de busqueda frecuente.
            $table->index(['name', 'surname']);
            $table->index(['student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
