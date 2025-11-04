@extends('layouts.app')

@section('title', 'Partidos')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-uppercase" style="color:#fff; border-bottom:2px solid #555; padding-bottom:5px;">Partidos</h1>

    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('games.create') }}" class="btn btn-primary mb-4">
            <i class="bi bi-plus-circle me-1"></i> Agregar Partido
        </a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
@forelse($games as $game)
<div class="col-12 col-md-6">
    <div class="game-card p-3 text-center position-relative">
        {{-- Bloque de equipos --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            {{-- Equipo Local --}}
            <div class="d-flex flex-column align-items-center" style="flex:1;">
                @if($game->localTeam->shield)
                    <img src="{{ asset('storage/'.$game->localTeam->shield) }}" width="60" class="mb-1">
                @endif
                <strong>{{ $game->localTeam->name }}</strong>
            </div>

            {{-- VS --}}
            <div class="vs-badge mx-3">VS</div>

            {{-- Equipo Visitante --}}
            <div class="d-flex flex-column align-items-center" style="flex:1;">
                @if($game->visitingTeam->shield)
                    <img src="{{ asset('storage/'.$game->visitingTeam->shield) }}" width="60" class="mb-1">
                @endif
                <strong>{{ $game->visitingTeam->name }}</strong>
            </div>
        </div>

        {{-- Marcador --}}
        <div class="score d-flex justify-content-center align-items-center gap-4 mb-2">
            <span class="score-number">{{ $game->local_goals }}</span>
            <span class="fs-3 fw-bold text-danger">-</span>
            <span class="score-number">{{ $game->visiting_goals }}</span>
        </div>

        {{-- Fecha y estado --}}
        <p class="mb-1 text-muted small">{{ \Carbon\Carbon::parse($game->date)->format('d/m/Y H:i') }}</p>
        <p class="mb-2">
            @if($game->state === 'finished')
                <span class="badge bg-success">Finalizado</span>
            @elseif($game->state === 'in_progress')
                <span class="badge bg-warning">En juego</span>
            @else
                <span class="badge bg-secondary">Pendiente</span>
            @endif
        </p>

        <a href="{{ route('games.show', $game) }}" class="btn btn-outline-info">
                <i class="bi bi-eye"></i> Ver
            </a>

        {{-- Botones de acción --}}
        @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <div class="d-flex justify-content-center gap-2 flex-wrap mt-2">
            <a href="{{ route('games.edit', $game) }}" class="btn btn-outline-warning">
                <i class="bi bi-pencil-square"></i> Editar
            </a>
            
            <form action="{{ route('games.destroy', $game) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger" onclick="return confirm('¿Eliminar partido?')">Eliminar</button>
            </form>
            @if(auth()->user()->role === 'referee' && $game->state !== 'finished')
            <form action="{{ route('games.finish', $game) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button class="btn btn-success btn-sm">Finalizar</button>
            </form>
            @endif
        </div>
        @endif
    </div>
</div>
@empty
<div class="col-12 text-center text-muted py-5">
    <h4>No hay partidos registrados.</h4>
</div>
@endforelse
</div>

</div>

<style>
.game-card {
    background-color: #000;
    border-radius: 15px;
    border: 1px solid #222;
    color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 20px;
}

.game-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(255,77,77,0.4);
    border-color: #ff4d4d;
}

.vs-badge {
    background: #ff4d4d;
    color: #fff;
    font-weight: bold;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 1rem;
}

.score-number {
    font-size: 1.5rem;
    font-weight: bold;
}

.badge.bg-warning { background-color: #ff9900 !important; color:#fff !important; }
.badge.bg-secondary { background-color: #555 !important; color:#fff !important; }

/* Botones */
.btn-warning { background-color: #ff9900; color:#000; border-color:#ff9900; }
.btn-warning:hover { background-color:#ff4d4d; color:#fff; border-color:#ff4d4d; }

.btn-danger { background-color:#cc0000; color:#fff; border-color:#cc0000; }
.btn-danger:hover { background-color:#ff0000; border-color:#ff0000; }

.btn-success { background-color:#28a745; color:#fff; border-color:#28a745; }
.btn-success:hover { background-color:#1a8f1a; border-color:#1a8f1a; }

</style>

@endsection
