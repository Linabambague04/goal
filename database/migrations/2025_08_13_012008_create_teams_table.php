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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('shield')->nullable();
            $table->integer('points')->default('0');
            $table->integer('games_played')->default('0');
            $table->integer('matches_won')->default('0');
            $table->integer('tied_matches')->default('0');
            $table->integer('lost_matches')->default('0');
            $table->integer('goals_scored')->default('0');
            $table->integer('goals_against')->default('0');
            $table->integer('goal_difference')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
