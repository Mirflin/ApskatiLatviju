<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Action_status;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('action_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Action_status::create(["name" => 'Canceled']);
        Action_status::create(["name" => 'Success']);
        Action_status::create(["name" => 'Pending']);
        Action_status::create(["name" => 'Failed']);
        Action_status::create(["name" => 'Unknown']);
        Action_status::create(["name" => 'Active']);
        Action_status::create(["name" => 'Suspended']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_statuses');
    }
};
