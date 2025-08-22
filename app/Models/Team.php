<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'shield', 
        'points',
        'games_played', 
        'matches_won',
        'tied_matches', 
        'lost_matches', 
        'goals_scored', 
        'goals_against', 
        'goal_difference'
    ];

    public function players()
    {
        return $this->hasMany(Player::class);
    }
    
    public function localGames()
    {
        return $this->hasMany(Game::class, 'local_team_id');
    }

    public function visitingGames()
    {
        return $this->hasMany(Game::class, 'visiting_team_id');
    }
}
