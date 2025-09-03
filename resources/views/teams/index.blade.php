@extends('layouts.app')

@section('title', 'Equipos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-4 fw-bold text-uppercase" style="font-family: 'Oswald', sans-serif; color:#fff; border-bottom:2px solid #555; padding-bottom:5px;">
        Equipos y posiciones
    </h1>

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
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-dark table-striped table-hover text-center align-middle mb-0">
            <thead class="table-secondary text-dark text-uppercase">
                <tr>
                    <th class="text-start">Equipo</th>
                    <th>J</th>
                    <th>G</th>
                    <th>E</th>
                    <th>P</th>
                    <th>GF</th>
                    <th>GC</th>
                    <th>DIF</th>
                    <th>PTS</th>
                    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                        <th>Opciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $team)
                <tr class="align-middle">
                    <td class="text-start d-flex align-items-center">
                        @if($team->shield && file_exists(public_path('storage/'.$team->shield)))
                            <img src="{{ asset('storage/'.$team->shield) }}" alt="Escudo" 
                                 class="me-3 rounded" style="width:50px; height:50px; object-fit:contain; background:#222; padding:3px; border:1px solid #555;">
                        @else
                            <div class="me-3 text-muted fst-italic d-flex align-items-center justify-content-center" 
                                 style="width:50px; height:50px; background:#222; border-radius:4px; border:1px solid #555;">
                                Sin escudo
                            </div>
                        @endif
                        <span class="fw-bold">{{ $team->name }}</span>
                    </td>
                    <td>{{ $team->games_played }}</td>
                    <td>{{ $team->matches_won }}</td>
                    <td>{{ $team->tied_matches }}</td>
                    <td>{{ $team->lost_matches }}</td>
                    <td>{{ $team->goals_scored }}</td>
                    <td>{{ $team->goals_against }}</td>
                    <td>{{ $team->goal_difference }}</td>
                    <td>{{ $team->points }}</td>
                    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                    <td>
                        <a href="{{ route('teams.edit', $team) }}" class="btn btn-sm btn-outline-warning me-2" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('teams.destroy', $team) }}" method="POST" class="d-inline" title="Eliminar" onsubmit="return confirm('¿Eliminar este equipo?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $teams->links() }}
    </div>
@else
    <div class="text-center text-muted py-5">
        <h4>No hay equipos registrados.</h4>
    </div>
@endif
@endsection
