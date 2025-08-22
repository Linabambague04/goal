@extends('layouts.app')

@section('title', 'Goles')

@section('content')
<div class="container">
    <h1>Lista de Goles</h1>

    {{-- Botón "Agregar Gol" solo para admin o referee --}}
    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('goals.create') }}" class="btn btn-primary mb-3">Agregar Gol</a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Partido</th>
                <th>Jugador</th>
                <th>Minuto</th>
                <th>Tipo</th>
                <th>Asistencia</th>

                {{-- Columna Acciones solo si es admin o referee --}}
                @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                    <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($goals as $goal)
                <tr>
                    <td>
                        {{ $goal->game->localTeam->name }} 
                        vs 
                        {{ $goal->game->visitingTeam->name }}
                        <br>
                        <small>
                            {{ \Carbon\Carbon::parse($goal->game->date)->format('d/m/Y H:i') }}
                        </small>
                    </td>

                    <td>
                        {{ $goal->player->name }}
                        <span class="badge bg-primary">
                            {{ $goal->player->team->name }}
                        </span>
                    </td>

                    <td>{{ $goal->player->name }}</td>
                    <td>{{ $goal->minute }}</td>
                    <td>{{ ucfirst($goal->type) }}</td>
                    <td>{{ $goal->assistPlayer ? $goal->assistPlayer->name : 'Sin asistencia' }}</td>

                    {{-- Acciones solo para admin o referee --}}
                    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                        <td>
                            <a href="{{ route('goals.edit', $goal) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('goals.destroy', $goal) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar gol?')">Eliminar</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay goles registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
