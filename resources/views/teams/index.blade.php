@extends('layouts.app')

@section('title', 'Equipos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Equipos</h1>

    {{-- Solo admin o referee pueden crear equipos --}}
    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('teams.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Añadir equipo
        </a>
    @endif
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($teams->count())
    <div class="list-group">
        @foreach($teams as $team)
        <div class="list-group-item bg-dark border-secondary rounded-3 mb-3 p-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                {{-- Escudo --}}
                @if($team->shield)
                    <img src="{{ asset('storage/'.$team->shield) }}" alt="Escudo" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: contain; background: #222; padding: 4px;">
                @else
                    <div class="me-3 text-muted fst-italic" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; background: #222; border-radius: 4px;">
                        Sin escudo
                    </div>
                @endif

                {{-- Info del equipo --}}
                <div class="text-light">
                    <h5 class="mb-1">{{ $team->name }}</h5>
                    <div class="small text-light"> {{-- CAMBIADO DE text-muted a text-light --}}
                        <span class="me-3"><strong>Puntos:</strong> {{ $team->points }}</span>
                        <span class="me-3"><strong>Jugados:</strong> {{ $team->games_played }}</span>
                        <span class="me-3"><strong>G:</strong> {{ $team->matches_won }}</span>
                        <span class="me-3"><strong>E:</strong> {{ $team->tied_matches }}</span>
                        <span class="me-3"><strong>P:</strong> {{ $team->lost_matches }}</span>
                        <span><strong>Goles:</strong> {{ $team->goals_scored }}</span>
                    </div>
                </div>

            </div>

            {{-- Acciones --}}
            @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
            <div class="text-end">
                <a href="{{ route('teams.edit', $team) }}" class="btn btn-sm btn-warning me-1">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('teams.destroy', $team) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este equipo?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $teams->links() }}
    </div>
@else
    <div class="text-center text-muted py-5">
        <h4>No hay equipos registrados.</h4>
    </div>
@endif
@endsection
