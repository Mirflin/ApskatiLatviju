<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Seazon_group;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seazon_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Seazon_group::create(['name' => 'nav sezons']);
        Seazon_group::create(['name' => 'Vasara']);
        Seazon_group::create(['name' => 'Rudens']);
        Seazon_group::create(['name' => 'Ziema']);
        Seazon_group::create(['name' => 'Pavasāris']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seazon_groups');
    }
};
