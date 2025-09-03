@extends('layouts.app')

@section('title', 'Agregar Tarjeta')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Agregar Tarjeta</h1>

    <div class="card shadow-sm p-4" style="background-color:#000; color:#fff; border-radius:12px;">
        <form action="{{ route('cards.store') }}" method="POST">
            @csrf

            {{-- Selección de Partido --}}
            <div class="mb-3">
                <label class="form-label">Partido</label>
                <select name="game_id" class="form-select" required>
                    <option value="" disabled selected>Seleccione un partido</option>
                    @foreach($games as $game)
                        <option value="{{ $game->id }}">
                            {{ $game->localTeam?->name ?? 'N/A' }} vs {{ $game->visitingTeam?->name ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Selección de Jugador --}}
            <div class="mb-3">
                <label class="form-label">Jugador</label>
                <select name="player_id" class="form-select" required>
                    <option value="" disabled selected>Seleccione un jugador</option>
                    @foreach($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
    <label class="form-label d-block">Tipo de Tarjeta</label>
    <div class="d-flex gap-3">
        <label class="card-option text-center p-3" style="cursor:pointer; border-radius:12px; width:100px; border:2px solid #ffcc00;">
            <input type="radio" name="type" value="yellow" class="d-none" required>
            <div class="card-content">
                <div style="font-size:2rem; color:#ffcc00;">🟨</div>
                <div>Amarilla</div>
            </div>
        </label>

        <label class="card-option text-center p-3" style="cursor:pointer; border-radius:12px; width:100px; border:2px solid #ff4d4d;">
            <input type="radio" name="type" value="red" class="d-none">
            <div class="card-content">
                <div style="font-size:2rem; color:#ff4d4d;">🟥</div>
                <div>Roja</div>
            </div>
        </label>
    </div>
</div>

            {{-- Minuto --}}
            <div class="mb-3">
                <label class="form-label">Minuto</label>
                <input type="number" name="minute" class="form-control" min="0" required>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-outline-danger">Guardar</button>
                <a href="{{ route('cards.index') }}" class="btn btn-outline-light">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<style>
.card-option {
    background-color: #111;
    color: #fff;
    transition: transform 0.2s, box-shadow 0.2s, border 0.2s;
}

/* Hover */
.card-option:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(255,0,0,0.4);
}

/* Cuando está seleccionado */
.card-option input:checked + .card-content {
    background-color: rgba(255,255,255,0.1);
    border-radius: 12px;
    box-shadow: 0 0 0 3px #fff inset;
}
</style>
@endsection
