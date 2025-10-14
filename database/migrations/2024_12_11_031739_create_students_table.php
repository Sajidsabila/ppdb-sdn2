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
        Schema::create('students', function (Blueprint $table) {
            $table->char('id')->primary();
            $table->unsignedBigInteger('academic_year_id');
            $table->uuid('user_id');
            $table->string('name');
            $table->enum('gender', ['Laki - laki', 'Perempuan']);
            $table->string('religion');
            $table->string('place_of_dirth');
            $table->date('date_of_birth');
            $table->enum('citizenship', ['WNI', 'WNA']);
            $table->integer('number_of_siblings');
            $table->integer('child_order');
            $table->string('nik');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address');
            $table->string("longitude")->nullable();
            $table->string("latitude")->nullable();
            $table->enum('status', [

                'pending',
                'verified',
                'accepted',
                'rejected'
            ])->default('pending');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();


            $table->timestamps();
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
