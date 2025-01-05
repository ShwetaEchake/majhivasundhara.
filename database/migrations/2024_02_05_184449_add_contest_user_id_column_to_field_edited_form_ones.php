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
        Schema::table('field_edited_form_ones', function (Blueprint $table) {
            $table->foreignId('contestant_user_id')->after('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('field_edited_form_twos', function (Blueprint $table) {
            $table->foreignId('contestant_user_id')->after('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('field_edited_form_ones', function (Blueprint $table) {
            $table->dropForeign('field_edited_form_ones_contestant_user_id_foreign');
            $table->dropColumn('contestant_user_id');
        });

        Schema::table('field_edited_form_twos', function (Blueprint $table) {
            $table->dropForeign('field_edited_form_twos_contestant_user_id_foreign');
            $table->dropColumn('contestant_user_id');
        });
    }
};
