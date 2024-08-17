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
        // Dropping the 'total_salary' column from the 'salary_structures' table
        Schema::table('salary_structures', function (Blueprint $table) {
            $table->dropColumn('total_salary');
        });

        // Dropping the 'designation_id' column from the 'designations' table
        Schema::table('designations', function (Blueprint $table) {
            $table->dropColumn('designation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Adding the 'total_salary' column back to the 'salary_structures' table
        Schema::table('salary_structures', function (Blueprint $table) {
            $table->decimal('total_salary', 10, 2)->nullable();
        });

        // Adding the 'designation_id' column back to the 'designations' table
        Schema::table('designations', function (Blueprint $table) {
            $table->string('designation_id', 10)->nullable();
        });
    }
};
