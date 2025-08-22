@extends('layouts.app')

@section('title', 'Editar Tarjeta')

@section('content')
<div class="container">
    <h1>Editar Tarjeta</h1>
    <form action="{{ route('cards.update', $card) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Partido</label>
            <select name="game_id" class="form-control" required>
                @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ $card->game_id == $game->id ? 'selected' : '' }}>
                        {{ $game->localTeam?->name ?? 'N/A' }} vs {{ $game->visitingTeam?->name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jugador</label>
            <select name="player_id" class="form-control" required>
                @foreach($players as $player)
                    <option value="{{ $player->id }}" {{ $card->player_id == $player->id ? 'selected' : '' }}>
                        {{ $player->name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipo de Tarjeta</label>
            <select name="type" class="form-control" required>
                <option value="yellow" {{ $card->type == 'yellow' ? 'selected' : '' }}>Amarilla</option>
                <option value="red" {{ $card->type == 'red' ? 'selected' : '' }}>Roja</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Minuto</label>
            <input type="number" name="minute" class="form-control" min="0" value="{{ $card->minute ?? '' }}" required>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
