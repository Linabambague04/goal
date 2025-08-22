<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Models\Team;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['localTeam', 'visitingTeam', 'goals.player'])->paginate(10);
        return view('games.index', compact('games'));
    }


    public function create()
    {
        $teams = Team::all();
        return view('games.create', compact('teams'));
    }

    public function store(Request $request)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'local_team_id'    => 'required|exists:teams,id',
            'visiting_team_id' => 'required|exists:teams,id|different:local_team_id',
            'date'             => 'required|date',
            'state'            => 'required|in:pending,in_progress,finished',
        ]);

        // Crear el partido
        Game::create([
            'local_team_id'    => $request->local_team_id,
            'visiting_team_id' => $request->visiting_team_id,
            'date'             => $request->date,
            'state'            => $request->state,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('games.index')->with('success', 'Partido creado correctamente.');
    }

    public function edit(Game $game)
    {
        $teams = Team::all();
        return view('games.edit', compact('game', 'teams'));
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'local_team_id'    => 'required|exists:teams,id|different:visiting_team_id',
            'visiting_team_id' => 'required|exists:teams,id',
            'date'             => 'required|date',
            'state'            => 'required|in:pending,in_progress,finished',
        ]);

        $game->update([
            'local_team_id'    => $request->local_team_id,
            'visiting_team_id' => $request->visiting_team_id,
            'date'             => $request->date,
            'state'            => $request->state,
        ]);

        return redirect()->route('games.index')->with('success', 'Partido actualizado correctamente.');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Partido eliminado correctamente.');
    }

    public function finish(Game $game)
    {
        // Equipos participantes
        $local = $game->localTeam;
        $visiting = $game->visitingTeam;

        // Actualizar partidos jugados
        $local->increment('games_played');
        $visiting->increment('games_played');

        // Actualizar goles anotados
        $local->increment('goals_scored', $game->local_goals);
        $visiting->increment('goals_scored', $game->visiting_goals);

        // Determinar resultado
        if ($game->local_goals > $game->visiting_goals) {
            // Local ganó
            $local->increment('matches_won');
            $local->increment('points', 3);

            $visiting->increment('lost_matches');

        } elseif ($game->local_goals < $game->visiting_goals) {
            // Visitante ganó
            $visiting->increment('matches_won');
            $visiting->increment('points', 3);

            $local->increment('lost_matches');

        } else {
            // Empate
            $local->increment('tied_matches');
            $visiting->increment('tied_matches');

            $local->increment('points', 1);
            $visiting->increment('points', 1);
        }

        // Marcar partido como finalizado
        $game->state = 'finished';
        $game->save();

        return redirect()->route('games.index')->with('success', 'Partido finalizado y estadísticas actualizadas.');
    }

}
