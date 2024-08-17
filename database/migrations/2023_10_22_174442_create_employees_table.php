<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name', 20); // Employee name
            $table->unsignedBigInteger('department_id'); // Foreign key for departments
            $table->unsignedBigInteger('designation_id'); // Foreign key for designations
            $table->unsignedBigInteger('salary_structure_id'); // Foreign key for salary structures
            $table->date('date_of_birth')->nullable(); // Date of birth
            $table->date('hire_date'); // Hire date
            $table->string('email', 30); // Email address
            $table->string('phone', 15); // Phone number
            $table->string('location', 30); // Location
            $table->string('employee_image')->nullable(); // Employee image
            $table->string('joining_mode', 30)->nullable(); // Joining mode
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key for users
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
