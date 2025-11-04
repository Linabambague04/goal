<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id', 
        'game_id', 
        'minute', 
        'type', 
        'assist_player_id'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function assistPlayer()
    {
        return $this->belongsTo(Player::class, 'assist_player_id');
    }

    protected static function booted()
    {
        static::created(function ($goal) {
            $player = $goal->player;
            $team = $player->team;
            $game = $goal->game;

            // Actualizar goles al equipo
            $team->increment('goals_scored');

            // Actualizar goles en el partido
            if ($game->local_team_id == $team->id) {
                $game->increment('local_goals');
            } elseif ($game->visiting_team_id == $team->id) {
                $game->increment('visiting_goals');
            }
        });
    }
}
