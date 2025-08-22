@extends('layouts.app')

@section('title', 'Editar Gol')

@section('content')
<div class="container">
    <h1>Editar Gol</h1>
    <form action="{{ route('goals.update', $goal) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Partido</label>
            <select name="game_id" class="form-control" required>
                @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ $goal->game_id == $game->id ? 'selected' : '' }}>
                        {{ $game->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jugador</label>
            <select name="player_id" class="form-control" required>
                @foreach($players as $player)
                    <option value="{{ $player->id }}" {{ $goal->player_id == $player->id ? 'selected' : '' }}>
                        {{ $player->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Minuto</label>
            <input type="number" name="minute" class="form-control" value="{{ $goal->minute }}" required min="1" max="120">
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <select name="type" class="form-control" required>
                <option value="regular" {{ $goal->type == 'regular' ? 'selected' : '' }}>Gol normal</option>
                <option value="penalty" {{ $goal->type == 'penalty' ? 'selected' : '' }}>Penalti</option>
                <option value="own_goal" {{ $goal->type == 'own_goal' ? 'selected' : '' }}>Autogol</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Asistencia</label>
            <select name="assist_player_id" class="form-control">
                <option value="">Ninguno</option>
                @foreach($players as $player)
                    <option value="{{ $player->id }}" {{ $goal->assist_player_id == $player->id ? 'selected' : '' }}>
                        {{ $player->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
