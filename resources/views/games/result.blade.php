@extends('layouts.app')

@section('title', 'Resultado del Partido')

@section('content')
<div class="container text-center">
    <h1 class="mb-4">⚽ Resultado Final</h1>

    <div class="d-flex justify-content-center align-items-center gap-5 mb-3">
        {{-- Equipo Local --}}
        <div>
            @if($game->localTeam->shield)
                <img src="{{ asset('storage/'.$game->localTeam->shield) }}" alt="Escudo" width="80">
            @endif
            <h3>{{ $game->localTeam->name }}</h3>
            <h2>{{ $game->local_goals }}</h2>
        </div>

        <h2> - </h2>

        {{-- Equipo Visitante --}}
        <div>
            @if($game->visitingTeam->shield)
                <img src="{{ asset('storage/'.$game->visitingTeam->shield) }}" alt="Escudo" width="80">
            @endif
            <h3>{{ $game->visitingTeam->name }}</h3>
            <h2>{{ $game->visiting_goals }}</h2>
        </div>
    </div>

    <p class="text-muted">Hoy · Fin del partido</p>

    <a href="{{ route('games.index') }}" class="btn btn-primary mt-3">Volver a Partidos</a>
</div>
@endsection
