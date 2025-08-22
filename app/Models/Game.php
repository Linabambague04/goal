<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_team_id', 
        'visiting_team_id', 
        'date', 
        'state', 
        'referee_id'
    ];

    public function localTeam()
    {
        return $this->belongsTo(Team::class, 'local_team_id');
    }

    public function visitingTeam()
    {
        return $this->belongsTo(Team::class, 'visiting_team_id');
    }
    
    public function referee()
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
    
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
