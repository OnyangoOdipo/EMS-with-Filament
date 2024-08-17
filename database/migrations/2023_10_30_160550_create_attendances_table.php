<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // Foreign key for employees
            $table->unsignedBigInteger('department_id'); // Foreign key for departments
            $table->unsignedBigInteger('designation_id'); // Foreign key for designations
            $table->date('select_date');
            $table->string('month');
            $table->time('check_in')->nullable();
            $table->string('late')->nullable();
            $table->time('check_out')->nullable();
            $table->string('overtime')->nullable();
            $table->integer('duration_minutes')->nullable(); // Moved duration_minutes column
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade');

            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('cascade');

            $table->foreign('designation_id')
                  ->references('id')
                  ->on('designations')
                  ->onDelete('cascade');
        });

        // Manually change column position after creating the table
        DB::statement('ALTER TABLE `attendances` MODIFY COLUMN `duration_minutes` int AFTER `check_out`');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
