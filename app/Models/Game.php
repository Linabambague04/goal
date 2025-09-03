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

    protected $attributes = [
        'state' => 'pending',
    ];

    // Relaciones
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

    // Evento automático al actualizar el partido
    public static function booted()
    {
        static::updated(function ($game) {
            // Solo si cambia a 'finished' y antes no estaba finalizado
            if ($game->state === 'finished' && $game->getOriginal('state') !== 'finished') {
                $game->updateTeamStats();
            }
        });
    }

    // Actualiza estadísticas de los equipos basado en goles de la tabla goals
    public function updateTeamStats()
    {
        $local = $this->localTeam;
        $visiting = $this->visitingTeam;

        // Contar goles anotados por cada equipo
        $localGoals = $this->goals()
            ->whereHas('player', fn($q) => $q->where('team_id', $this->local_team_id))
            ->count();

        $visitingGoals = $this->goals()
            ->whereHas('player', fn($q) => $q->where('team_id', $this->visiting_team_id))
            ->count();

        // Actualizar partidos jugados
        $local->games_played++;
        $visiting->games_played++;

        // Actualizar goles a favor y en contra
        $local->goals_scored += $localGoals;
        $visiting->goals_scored += $visitingGoals;

        $local->goals_against += $visitingGoals;
        $visiting->goals_against += $localGoals;

        // Determinar resultados
        if ($localGoals > $visitingGoals) {
            $local->matches_won++;
            $local->points += 3;
            $visiting->lost_matches++;
        } elseif ($localGoals < $visitingGoals) {
            $visiting->matches_won++;
            $visiting->points += 3;
            $local->lost_matches++;
        } else {
            $local->tied_matches++;
            $visiting->tied_matches++;
            $local->points++;
            $visiting->points++;
        }

        // Diferencia de goles
        $local->goal_difference = $local->goals_scored - $local->goals_against;
        $visiting->goal_difference = $visiting->goals_scored - $visiting->goals_against;

        // Guardar cambios
        $local->save();
        $visiting->save();
    }
}
