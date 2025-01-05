<?php

use Carbon\Carbon;
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
        Schema::create('competition_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('competition_types')->insert(['name'=> 'पर्यावरण संवर्धन कृती स्पर्धा', 'created_at'=> Carbon::now()->toDateTimeString() ]);
        DB::table('competition_types')->insert(['name'=> 'जनजागृती स्पर्धा', 'created_at'=> Carbon::now()->toDateTimeString() ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_types');
    }
};
