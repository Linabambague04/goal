<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'number', 
        'team_id', 
        'photo', 
        'position'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function assistsGoals()
    {
        return $this->hasMany(Goal::class, 'assist_player_id');
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
