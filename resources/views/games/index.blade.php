@extends('layouts.app')

@section('title', 'Partidos')

@section('content')
<div class="container">
    <h1>Lista de Partidos</h1>

    {{-- Botón solo visible para admin y referee --}}
    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('games.create') }}" class="btn btn-primary mb-3">Agregar Partido</a>
    @endif

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Equipo Local</th>
                <th>Equipo Visitante</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Goles</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($games as $game)
                <tr>
                    <td>{{ $game->localTeam->name }}</td>
                    <td>{{ $game->visitingTeam->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($game->date)->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($game->state === 'finished')
                            <span class="badge bg-success">Finalizado</span>
                        @else
                            <span class="badge bg-warning">En juego</span>
                        @endif
                    </td>
                    <td>
                    @if($game->goals->isEmpty())
                        <span class="text-muted">Sin goles</span>
                    @else
                        <ul class="list-unstyled">
                            @foreach($game->goals as $goal)
                                <li>
                                    ⚽ {{ $goal->player->name }}
                                    <span class="badge bg-primary">
                                        {{ $goal->player->team->name }}
                                    </span>
                                    ({{ $goal->minute }}')
                                    @if($goal->assistPlayer)
                                        - Asist: {{ $goal->assistPlayer->name }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </td>

                    <td>
                        {{-- Acciones solo admin/referee --}}
                        @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                            <a href="{{ route('games.edit', $game) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('games.destroy', $game) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar partido?')">Eliminar</button>
                            </form>

                            {{-- Botón Finalizar solo referee --}}
                            @if(auth()->user()->role === 'referee' && $game->state !== 'finished')
                                <form action="{{ route('games.finish', $game) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">Finalizar</button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay partidos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
