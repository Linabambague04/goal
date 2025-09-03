@extends('layouts.app')

@section('title', 'Añadir Jugador')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-uppercase" style="font-family: 'Oswald', sans-serif; color:#fff; border-bottom:2px solid #555; padding-bottom:5px;">
        Añadir Jugador
    </h1>

    <div class="card bg-black text-light shadow-sm rounded p-4 border-secondary">
        <form action="{{ route('players.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Nombre</label>
                <input type="text" name="name" class="form-control bg-dark text-light border border-secondary" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Número</label>
                <input type="number" name="number" class="form-control bg-dark text-light border border-secondary" value="{{ old('number') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Posición</label>
                <input type="text" name="position" class="form-control bg-dark text-light border border-secondary" value="{{ old('position') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Equipo</label>
                <select name="team_id" class="form-select bg-dark text-light border border-secondary" required>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-outline-warning">
                    <i class="bi bi-save me-1"></i> Guardar
                </button>
                <a href="{{ route('players.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.form-control, .form-select {
    background-color: #111 !important;
    color: #e0e0e0 !important;
    border: 1px solid #333 !important;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #ff4d4d !important;
    box-shadow: 0 0 5px rgba(255,77,77,0.5);
    background-color: #111 !important;
    color: #fff;
}

.btn-warning:hover {
    background-color: #ff4d4d;
    border-color: #ff4d4d;
    color: #fff;
    transform: scale(1.05);
}

.card.bg-black {
    background-color: #000 !important;
    border: 1px solid #222;
}
</style>
@endsection
