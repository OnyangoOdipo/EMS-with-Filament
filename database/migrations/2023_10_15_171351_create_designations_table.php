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
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('designation_name', 30); // Designation name
            $table->string('designation_id', 10); // Unique designation ID
            $table->unsignedBigInteger('salary_structure_id'); // Foreign key for salary structures
            $table->unsignedBigInteger('department_id'); // Foreign key for departments
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('salary_structure_id')
                  ->references('id')
                  ->on('salary_structures')
                  ->onDelete('cascade');

            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('cascade');

            // Indexes
            $table->index('salary_structure_id');
            $table->index('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designations');
    }
};
