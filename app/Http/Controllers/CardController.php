<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::with(['game', 'player'])->latest()->get();
        return view('cards.index', compact('cards'));
    }

    public function create()
    {
        $games = Game::all();
        $players = Player::all();
        return view('cards.create', compact('games', 'players'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'player_id' => 'required|exists:players,id',
            'type' => 'required|in:yellow,red',
            'minute' => 'required|integer|min:0'
        ]);

        Card::create($request->all());

        return redirect()->route('cards.index')->with('success', 'Tarjeta registrada correctamente.');
    }

    public function edit(Card $card)
    {
        $games = Game::all();
        $players = Player::all();
        return view('cards.edit', compact('card', 'games', 'players'));
    }

    public function update(Request $request, Card $card)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'player_id' => 'required|exists:players,id',
            'type' => 'required|in:yellow,red',
            'minute' => 'required|integer|min:0'
        ]);

        $card->update($request->all());

        return redirect()->route('cards.index')->with('success', 'Tarjeta actualizada correctamente.');
    }

    public function destroy(Card $card)
    {
        $card->delete();
        return redirect()->route('cards.index')->with('success', 'Tarjeta eliminada correctamente.');
    }
}
