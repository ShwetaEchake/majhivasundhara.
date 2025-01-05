<?php

use App\Models\Category;
use App\Models\CompetitionType;
use App\Models\Tenant;
use App\Models\Ward;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(CompetitionType::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('username');
            $table->string('password');
            $table->foreignIdFor(Category::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('society_name')->nullable();
            $table->string('society_telephone');
            $table->string('nodal_person_name')->nullable();
            $table->string('nodal_person_contact')->nullable();
            $table->string('nodal_person_email')->nullable();
            $table->string('building_name')->nullable();
            $table->string('area_name')->nullable();
            $table->string('city')->nullable();
            $table->string('landmark')->nullable();
            $table->string('pincode', 20)->nullable();
            $table->foreignIdFor(Ward::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('other_address', 255)->nullable();
            $table->rememberToken();
            $table->enum('active_status', ['0', '1'])->default('1')->comment('0 = inactive, 1 = active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_users');
    }
};
