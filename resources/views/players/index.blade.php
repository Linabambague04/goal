@extends('layouts.app')

@section('title', 'Jugadores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Jugadores</h1>

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
<div class="row">
    @foreach($players as $player)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card bg-dark border-secondary shadow-sm h-100">
            <div class="card-body text-light d-flex flex-column justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    {{-- Si tienes una imagen de jugador: --}}
                    {{-- 
                    <img src="{{ asset('storage/'.$player->photo) }}" alt="Foto" class="me-3 rounded-circle" style="width: 50px; height: 50px; object-fit: cover;"> 
                    --}}
                    {{-- Si no hay imagen, usar ícono/avatar --}}
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-person text-white-50 fs-4"></i>
                    </div>

                    <div>
                        <h5 class="card-title mb-0">{{ $player->name }}</h5>
                        <small class="text-white-50">#{{ $player->number }} • {{ ucfirst($player->position) }}</small>
                    </div>
                </div>

                <p class="mb-2"><strong>Equipo:</strong> {{ $player->team->name }}</p>

                <div class="mt-auto d-flex justify-content-between">
                <a href="{{ route('players.show', $player) }}" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-eye me-1"></i> Ver
                </a>

                @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                    <div class="d-flex">
                        <a href="{{ route('players.edit', $player) }}" class="btn btn-sm btn-outline-warning me-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('players.destroy', $player) }}" method="POST" onsubmit="return confirm('¿Eliminar este jugador?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            </div>
        </div>
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
@endsection
