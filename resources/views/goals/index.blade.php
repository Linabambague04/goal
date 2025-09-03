@extends('layouts.app')

@section('title', 'Goles')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-white fw-bold" style="border-bottom:2px solid #555; padding-bottom:5px;">Lista de Goles</h1>

    {{-- Botón "Agregar Gol" solo para admin o referee --}}
    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('goals.create') }}" class="btn btn-light mb-3 btn-add-goal">
            <i class="bi bi-plus-circle me-1"></i>  Agregar
        </a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>Partido</th>
                    <th>Jugador</th>
                    <th>Minuto</th>
                    <th>Tipo</th>
                    <th>Asistencia</th>
                    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                        <th>Opciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($goals as $goal)
                    <tr>
                        <td>
                            {{ $goal->game->localTeam->name }} vs {{ $goal->game->visitingTeam->name }}<br>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($goal->game->date)->format('d/m/Y H:i') }}</small>
                        </td>
                        <td>
                            {{ $goal->player->name }}
                            <span class="badge bg-primary">{{ $goal->player->team->name }}</span>
                        </td>
                        <td>{{ $goal->minute }}'</td>
                        <td>{{ ucfirst($goal->type) }}</td>
                        <td>{{ $goal->assistPlayer ? $goal->assistPlayer->name : 'Sin asistencia' }}</td>
                        @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                        <td>
                            <a href="{{ route('goals.edit', $goal) }}" class="btn btn-outline-warning btn-sm me-1" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('goals.destroy', $goal) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar gol?')" title="Eliminar">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay goles registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.table-dark {
    background-color: #000 !important;
    color: #e0e0e0 !important;
}
.table-dark th, .table-dark td {
    border-color: #222 !important;
}
.table-dark tbody tr:hover {
    background-color: #1a0000 !important; /* hover rojo oscuro */
}
.badge.bg-primary {
    background-color: #007bff !important;
    color: #fff !important;
}

/* Botón "Agregar Gol" blanco con hover rojo */
.btn-add-goal {
    background-color: #fff;
    color: #000;
    border: 1px solid #fff;
    transition: 0.3s;
}
.btn-add-goal:hover {
    background-color: #ff4d4d;
    color: #fff;
    border-color: #ff4d4d;
}

/* Botones de acción solo iconos */
.btn-outline-warning {
    color: #ff9900;
    border-color: #ff9900;
}
.btn-outline-warning:hover {
    background-color: #ff9900;
    color: #000;
    border-color: #ff9900;
}
.btn-outline-danger {
    color: #cc0000;
    border-color: #cc0000;
}
.btn-outline-danger:hover {
    background-color: #cc0000;
    color: #fff;
    border-color: #cc0000;
}
</style>
@endsection
