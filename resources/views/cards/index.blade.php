@extends('layouts.app')

@section('title', 'Tarjetas')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-white fw-bold" style="border-bottom:2px solid #555; padding-bottom:5px;">Lista de Tarjetas</h1>

    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('cards.create') }}" class="btn btn-primary mb-4">
            <i class="bi bi-plus-circle me-1"></i> Agregar Tarjeta
        </a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3">
        @forelse($cards as $card)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm p-3 card-border-{{ $card->type }}" style="background-color:#000; color:#fff; border-radius:12px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">
                            {{ $card->game?->localTeam?->name ?? 'N/A' }} 
                            vs 
                            {{ $card->game?->visitingTeam?->name ?? 'N/A' }}
                        </h5>
                        <p class="mb-1 text-muted">Jugador: {{ $card->player?->name ?? 'N/A' }}</p>
                        <p class="mb-0 text-muted">Minuto: {{ $card->minute ?? 'N/A' }}</p>
                    </div>
                    <div class="text-center">
                        @if($card->type === 'yellow')
                            <i class="bi bi-square-fill text-warning" style="font-size:2rem;"></i>
                        @elseif($card->type === 'red')
                            <i class="bi bi-square-fill text-danger" style="font-size:2rem;"></i>
                        @endif
                    </div>
                </div>

                @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                    <div class="mt-3 d-flex gap-2 justify-content-end">
                        <a href="{{ route('cards.edit', $card) }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('cards.destroy', $card) }}" method="POST" class="d-inline">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar tarjeta?')">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-5">
            <h4>No hay tarjetas registradas.</h4>
        </div>
        @endforelse
    </div>
</div>

<style>
.card-border-yellow {
    border: 2px solid #ffc107 !important; /* amarillo */
}
.card-border-red {
    border: 2px solid #dc3545 !important; /* rojo */
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(255,0,0,0.3);
    transition: 0.3s;
}
</style>
@endsection
