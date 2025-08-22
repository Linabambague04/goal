@extends('layouts.app')

@section('title', 'Agregar Gol')

@section('content')
<div class="container">
    <h1>Agregar Gol</h1>
    <form action="{{ route('goals.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Partido</label>
            <select name="game_id" class="form-control" required>
                @foreach($games as $game)
                    <option value="{{ $game->id }}">{{ $game->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jugador</label>
            <select name="player_id" class="form-control" required>
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Minuto</label>
            <input type="number" name="minute" class="form-control" required min="1" max="120">
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <select name="type" class="form-control" required>
                <option value="regular">Gol normal</option>
                <option value="penalty">Penalti</option>
                <option value="own_goal">Autogol</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Asistencia</label>
            <select name="assist_player_id" class="form-control">
                <option value="">Ninguno</option>
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
