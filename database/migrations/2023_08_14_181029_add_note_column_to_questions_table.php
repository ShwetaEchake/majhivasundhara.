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
        Schema::table('questions', function (Blueprint $table) {
            $table->text('link')->after('marks')->nullable();
            $table->unsignedTinyInteger('link_type')->default(0)->comment('0 = image, 1 = video')->after('marks');
            $table->text('note')->nullable()->after('marks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('note');
            $table->dropColumn('marks');
            $table->dropColumn('link_type');
        });
    }
};
