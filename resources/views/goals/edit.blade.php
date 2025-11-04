@extends('layouts.app')

@section('title', 'Editar Gol')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-white fw-bold" style="border-bottom:2px solid #555; padding-bottom:5px;">Editar Gol</h1>

    <div class="card shadow-sm p-4" style="background-color:#000; color:#fff; border-radius:12px;">
        <form action="{{ route('goals.update', $goal) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Partido</label>
                <select name="game_id" class="form-select" required>
                    @foreach($games as $game)
                        <option value="{{ $game->id }}" {{ $goal->game_id == $game->id ? 'selected' : '' }}>
                            {{ $game->localTeam->name }} vs {{ $game->visitingTeam->name }} ({{ \Carbon\Carbon::parse($game->date)->format('d/m/Y H:i') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jugador</label>
                <select name="player_id" class="form-select" required>
                    @foreach($players as $player)
                        <option value="{{ $player->id }}" {{ $goal->player_id == $player->id ? 'selected' : '' }}>
                            {{ $player->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Minuto</label>
                <input type="number" name="minute" class="form-control" value="{{ $goal->minute }}" required min="1" max="120">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="type" class="form-select" required>
                    <option value="regular" {{ $goal->type == 'regular' ? 'selected' : '' }}>Gol normal</option>
                    <option value="penalty" {{ $goal->type == 'penalty' ? 'selected' : '' }}>Penalti</option>
                    <option value="own_goal" {{ $goal->type == 'own_goal' ? 'selected' : '' }}>Autogol</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Asistencia</label>
                <select name="assist_player_id" class="form-select">
                    <option value="">Ninguno</option>
                    @foreach($players as $player)
                        <option value="{{ $player->id }}" {{ $goal->assist_player_id == $player->id ? 'selected' : '' }}>
                            {{ $player->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-center d-flex justify-content-center gap-3">
                <button type="submit" class="btn btn-light btn-update-goal px-4">
                    <i class="bi bi-save me-1"></i> Actualizar
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

.btn-update-goal {
    background-color: #fff;
    color: #000;
    border: 1px solid #fff;
    transition: 0.3s;
}

.btn-update-goal:hover {
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
