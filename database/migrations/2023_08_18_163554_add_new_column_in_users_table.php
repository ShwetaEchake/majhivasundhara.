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
        Schema::table('users', function (Blueprint $table) {
            $table->string('household_no')->after('society_name')->nullable();
            $table->string('tmc_total_students')->after('society_name')->nullable();
            $table->string('total_stud_in_private_school')->after('society_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('household_no');
            $table->dropColumn('tmc_total_students');
            $table->dropColumn('total_stud_in_private_school');
        });
    }
};
