@extends('layouts.app')

@section('title', 'Jugadores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-4 fw-bold text-uppercase" style="font-family: 'Oswald', sans-serif; color:#fff; border-bottom:2px solid #555; padding-bottom:5px;">
        Jugadores
    </h1>
    
    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('players.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Añadir Jugador
        </a>
    @endif
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($players->count())
<div class="list-group">
    @foreach($players as $player)
    <div class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center mb-2 rounded-2 border-secondary player-list-item">
        <div>
            <h6 class="mb-0">{{ $player->name }} <small class="text-white-50">#{{ $player->number }} • {{ ucfirst($player->position) }}</small></h6>
            <p class="mb-0"><strong>Equipo:</strong> {{ $player->team->name }}</p>
        </div>

        @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <div class="d-flex">
            <a href="{{ route('players.edit', $player) }}" class="btn btn-sm btn-outline-warning me-2" title="Editar">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form action="{{ route('players.destroy', $player) }}" method="POST" title="Eliminar" onsubmit="return confirm('¿Eliminar este jugador?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash3"></i>
                </button>
            </form>
        </div>
        @endif
    </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $players->links() }}
</div>
@else
<div class="text-center text-muted py-5">
    <h4>No hay jugadores registrados.</h4>
</div>
@endif

<style>
.list-group-item-dark {
    background-color: #111;
    color: #e0e0e0;
    border: 1px solid #222;
    transition: background 0.3s, border-color 0.3s, transform 0.2s, box-shadow 0.3s;
    padding: 0.5rem 1rem; /* más delgada */
}
.list-group-item-dark:hover {
    background-color: #1c0000; /* sutil rojo oscuro */
    border-color: #ff4d4d;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(255,77,77,0.3);
}

.player-list-item h6 {
    margin-bottom: 0.25rem; /* menos espacio debajo del título */
}

.player-list-item p {
    margin-bottom: 0; /* eliminar margen para compactar */
}
</style>

@endsection
