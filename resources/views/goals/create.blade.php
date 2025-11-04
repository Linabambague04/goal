@extends('layouts.app')

@section('title', 'Agregar Gol')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-white fw-bold" style="border-bottom:2px solid #555; padding-bottom:5px;">Agregar Gol</h1>

    <div class="card shadow-sm p-4" style="background-color:#000; color:#fff; border-radius:12px;">
        <form action="{{ route('goals.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Partido</label>
                <select name="game_id" class="form-select" required>
                    <option value="" disabled selected>Seleccione un partido</option>
                    @foreach($games as $game)
                        <option value="{{ $game->id }}">
                            {{ $game->localTeam->name }} vs {{ $game->visitingTeam->name }} ({{ \Carbon\Carbon::parse($game->date)->format('d/m/Y H:i') }})
                        </option>
                    @endforeach
                </select>
            </div>

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
                <label class="form-label">Minuto</label>
                <input type="number" name="minute" class="form-control" required min="1" max="120">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="type" class="form-select" required>
                    <option value="regular">Gol normal</option>
                    <option value="penalty">Penalti</option>
                    <option value="own_goal">Autogol</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Asistencia</label>
                <select name="assist_player_id" class="form-select">
                    <option value="">Ninguno</option>
                    @foreach($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-center d-flex justify-content-center gap-3">
                <button type="submit" class="btn btn-light btn-save-goal px-4">
                    <i class="bi bi-save me-1"></i> Guardar
                </button>
                <a href="{{ route('goals.index') }}" class="btn btn-outline-danger px-4">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.card {
    background-color: #000 !important;
    color: #fff !important;
}

.btn-save-goal {
    background-color: #fff;
    color: #000;
    border: 1px solid #fff;
    transition: 0.3s;
}

.btn-save-goal:hover {
    background-color: #ff4d4d;
    color: #fff;
    border-color: #ff4d4d;
}

.btn-outline-danger {
    color: #fff;
    border-color: #fff;
    transition: 0.3s;
}

.btn-outline-danger:hover {
    background-color: #ff4d4d;
    color: #fff;
    border-color: #ff4d4d;
}
</style>
@endsection
