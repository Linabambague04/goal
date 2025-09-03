@extends('layouts.app')

@section('title', 'Agregar Partido')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-white fw-bold" style="font-family: 'Oswald', sans-serif;">Agregar Partido</h1>

    <div class="card shadow-sm p-4" style="background-color:#111; color:#fff; border-radius:12px; border: 1px solid #444;">
        <form action="{{ route('games.store') }}" method="POST">
            @csrf

            {{-- Equipo Local --}}
            <div class="mb-3">
                <label class="form-label">Equipo Local</label>
                <select name="local_team_id" class="form-select bg-dark text-white border border-secondary" required>
                    <option value="" selected disabled>Seleccione el equipo local</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Equipo Visitante --}}
            <div class="mb-3">
                <label class="form-label">Equipo Visitante</label>
                <select name="visiting_team_id" class="form-select bg-dark text-white border border-secondary" required>
                    <option value="" selected disabled>Seleccione el equipo visitante</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Fecha del partido --}}
            <div class="mb-3">
                <label class="form-label">Fecha y Hora</label>
                <input type="datetime-local" name="date" class="form-control bg-dark text-white border border-secondary" required>
            </div>

            {{-- Estado --}}
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="state" class="form-select bg-dark text-white border border-secondary" required>
                    <option value="pending">Pendiente</option>
                    <option value="in_progress">En juego</option>
                    <option value="finished">Finalizado</option>
                </select>
            </div>

            {{-- Botón Guardar --}}
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-danger">
                    Guardar Partido
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.form-select:focus, .form-control:focus {
    border-color: #ff4d4d;
    box-shadow: 0 0 0 0.2rem rgba(255,77,77,.25);
    background-color: #111;
    color: #fff;
}
.btn-success:hover {
    background-color: #ff4d4d;
    border-color: #ff4d4d;
    color: #fff;
}
</style>
@endsection
