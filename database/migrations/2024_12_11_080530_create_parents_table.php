<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->char('student_id');
            $table->string('father_name');
            $table->string('father_education_level');
            $table->string('father_occupation');
            $table->string('mother_name');
            $table->string('mother_education_level');
            $table->string('mother_occupation');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
