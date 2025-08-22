@extends('layouts.app')

@section('title', 'Tarjetas')

@section('content')
<div class="container">
    <h1>Lista de Tarjetas</h1>

    {{-- Botón "Agregar" solo para admin o referee --}}
    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('cards.create') }}" class="btn btn-primary mb-3">Agregar Tarjeta</a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Partido</th>
                <th>Jugador</th>
                <th>Tipo</th>
                <th>Minuto</th>
                
                {{-- Acciones solo para admin o referee --}}
                @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                    <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($cards as $card)
                <tr>
                    <td>
                        {{ $card->game?->localTeam?->name ?? 'N/A' }} 
                        vs 
                        {{ $card->game?->visitingTeam?->name ?? 'N/A' }}
                    </td>
                    <td>{{ $card->player?->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($card->type ?? '') }}</td>
                    <td>{{ $card->minute ?? 'N/A' }}</td>

                    {{-- Acciones solo visibles para admin/referee --}}
                    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                        <td>
                            <a href="{{ route('cards.edit', $card) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('cards.destroy', $card) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar tarjeta?')">Eliminar</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay tarjetas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
