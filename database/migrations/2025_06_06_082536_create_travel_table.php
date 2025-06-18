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
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->default(1);
            $table->foreign('group_id')->references('id')->on('travel_groups')->nullable();
            $table->string('name');
            $table->string('road_marks');
            $table->string('city',70);
            $table->string('image');
            $table->text('description');
            $table->float('price');
            $table->unsignedBigInteger('seazon_id');
            $table->foreign('seazon_id')->references('id')->on('seazon_groups');
            $table->integer('spot_count')->nullable();
            $table->dateTime('time_term');
            $table->unsignedBigInteger('status_id')->default(6);
            $table->foreign('status_id')->references('id')->on('action_statuses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel');
    }
};
