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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('visiting_team_id')->constrained('teams')->onDelete('cascade');
            $table->dateTime('date');
            $table->enum('state', ['pending', 'in_progress', 'finished'])->default('pending');
            $table->foreignId('referee_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
