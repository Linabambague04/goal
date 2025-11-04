@extends('layouts.app')

@section('title', 'Editar Partido')

@section('content')
<div class="container">
    <h1>Editar Partido</h1>
    <form action="{{ route('games.update', $game) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Equipo Local</label>
            <select name="local_team_id" class="form-control" required>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $game->local_team_id == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Equipo Visitante</label>
            <select name="visiting_team_id" class="form-control" required>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $game->visiting_team_id == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha</label>
            <input type="datetime-local" name="date" class="form-control" 
                   value="{{ date('Y-m-d\TH:i', strtotime($game->date)) }}" required>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="state" class="form-control" required>
                <option value="pending" {{ $game->state == 'pending' ? 'selected' : '' }}>Pendiente</option>
                <option value="in_progress" {{ $game->state == 'in_progress' ? 'selected' : '' }}>En juego</option>
                <option value="finished" {{ $game->state == 'finished' ? 'selected' : '' }}>Finalizado</option>
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
