@extends('layouts.app')

@section('title', 'Agregar Tarjeta')

@section('content')
<div class="container">
    <h1>Agregar Tarjeta</h1>
    <form action="{{ route('cards.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Partido</label>
            <select name="game_id" class="form-control" required>
                @foreach($games as $game)
                    <option value="{{ $game->id }}">
                        {{ $game->localTeam?->name ?? 'N/A' }} vs {{ $game->visitingTeam?->name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jugador</label>
            <select name="player_id" class="form-control" required>
                @foreach($players as $player)
                    <option value="{{ $player->id }}">
                        {{ $player->name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipo de Tarjeta</label>
            <select name="type" class="form-control" required>
                <option value="yellow">Amarilla</option>
                <option value="red">Roja</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Minuto</label>
            <input type="number" name="minute" class="form-control" min="0" required>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
