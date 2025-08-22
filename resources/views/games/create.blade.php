@extends('layouts.app')

@section('title', 'Agregar Partido')

@section('content')
<div class="container">
    <h1>Agregar Partido</h1>
    <form action="{{ route('games.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Equipo Local</label>
            <select name="local_team_id" class="form-control" required>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Equipo Visitante</label>
            <select name="visiting_team_id" class="form-control" required>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha</label>
            <input type="datetime-local" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="state" class="form-control" required>
                <option value="pending">Pendiente</option>
                <option value="in_progress">En juego</option>
                <option value="finished">Finalizado</option>
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
