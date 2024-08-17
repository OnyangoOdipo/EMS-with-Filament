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
        Schema::table('salary_structures', function (Blueprint $table) {
            $table->decimal('total_salary', 10, 2)->nullable()->after('salary_class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salary_structures', function (Blueprint $table) {
            $table->dropColumn('total_salary');
        });
    }
};
