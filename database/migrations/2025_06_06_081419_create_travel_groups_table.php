<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Travel_group;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('travel_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name',60);
            $table->timestamps();
            $table->softDeletes();
        });

        Travel_group::create(['name' => 'nav grupa']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_groups');
    }
};
