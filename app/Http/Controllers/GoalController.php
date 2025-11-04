<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::with(['game', 'player', 'assistPlayer'])->latest()->get();
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        $games = Game::all();
        $players = Player::all();
        return view('goals.create', compact('games', 'players'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'player_id' => 'required|exists:players,id',
            'minute' => 'required|integer|min:1|max:120',
            'type' => 'required|string',
            'assist_player_id' => 'nullable|exists:players,id',
        ]);

        // Guardar gol
        $goal = Goal::create($validated);

        // Buscar jugador y su equipo
        $player = Player::find($request->player_id);
        $team = $player->team;

        // Buscar partido
        $game = Game::find($request->game_id);

        // Actualizar goles del EQUIPO
        $team->increment('goals_scored');

        // Actualizar goles del PARTIDO
        if ($game->local_team_id == $team->id) {
            $game->increment('local_goals');
        } elseif ($game->visiting_team_id == $team->id) {
            $game->increment('visiting_goals');
        }

        return redirect()->route('goals.index')->with('success', 'Gol registrado correctamente');
    }



    public function edit(Goal $goal)
    {
        $games = Game::all();
        $players = Player::all();
        return view('goals.edit', compact('goal', 'games', 'players'));
    }

    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'player_id' => 'required|exists:players,id',
            'minute' => 'required|integer|min:1|max:120',
            'type' => 'required|in:regular,penalty,own_goal',
            'assist_player_id' => 'nullable|exists:players,id',
        ]);

        $goal->update($request->all());

        return redirect()->route('goals.index')->with('success', 'Gol actualizado correctamente.');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->route('goals.index')->with('success', 'Gol eliminado correctamente.');
    }
}
