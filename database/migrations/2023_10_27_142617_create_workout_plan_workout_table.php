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
        Schema::create('workout_plan_workout', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_plan_id');
            $table->unsignedBigInteger('workout_id');

            $table->timestamps();

            $table->foreign('workout_plan_id')->references('id')->on('workout_plans')->onDelete('cascade');
            $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_plan_workout');
    }
};
