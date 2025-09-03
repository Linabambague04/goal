@extends('layouts.app')

@section('title', 'Resultado del Partido')

@section('content')
<div class="container py-4">
    {{-- Título dinámico según estado --}}
    <h1 class="mb-4 text-center">
        @if($game->state === 'finished') Resultado Final
        @elseif($game->state === 'in_progress') Partido en Juego
        @else Partido Pendiente
        @endif
    </h1>

    @if($game->state !== 'pending')
    <div class="card shadow-sm p-4 mb-3" style="background-color:#000; color:#fff; border-radius:12px;">
        <div class="d-flex justify-content-center align-items-start gap-5">
            
            {{-- Equipo Local --}}
            <div class="d-flex flex-column align-items-center" style="flex:1;">
                @if($game->localTeam->shield)
                    <img src="{{ asset('storage/'.$game->localTeam->shield) }}" alt="Escudo" width="70" class="mb-2">
                @endif
                <h5 class="mb-1">{{ $game->localTeam->name }}</h5>

                {{-- Marcador dinámico --}}
                @php
                    $localGoals = $game->goals->where('player.team_id', $game->localTeam->id);
                @endphp
                <h2 class="mb-2">{{ $localGoals->count() }}</h2>

                {{-- Goles del equipo local centrados --}}
                <div class="d-flex flex-column align-items-center mt-2">
                    @if($localGoals->isEmpty())
                        <span class="text-muted">Sin goles</span>
                    @else
                        <ul class="list-unstyled mb-0 text-center">
                            @foreach($localGoals as $goal)
                                <li class="d-flex flex-column align-items-center gap-1 mb-1">
                                    <i class="bi bi-ball" style="color:#ffdd00;"></i>
                                    <strong>{{ $goal->player->name }}
                                        <small class="text-muted">({{ $goal->minute }}')
                                            </small>
                                            @if($goal->assistPlayer)- Asist: {{ $goal->assistPlayer->name }}</small>
                                            @endif
                                    </strong>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            {{-- VS --}}
            <div class="d-flex align-items-center justify-content-center">
                <div class="fs-2 fw-bold px-3" style="color:#ff4d4d;">VS</div>
            </div>

            {{-- Equipo Visitante --}}
            <div class="d-flex flex-column align-items-center" style="flex:1;">
                @if($game->visitingTeam->shield)
                    <img src="{{ asset('storage/'.$game->visitingTeam->shield) }}" alt="Escudo" width="70" class="mb-2">
                @endif
                <h5 class="mb-1">{{ $game->visitingTeam->name }}</h5>

                {{-- Marcador dinámico --}}
                @php
                    $visitingGoals = $game->goals->where('player.team_id', $game->visitingTeam->id);
                @endphp
                <h2 class="mb-2">{{ $visitingGoals->count() }}</h2>

                {{-- Goles del equipo visitante centrados --}}
                <div class="d-flex flex-column align-items-center mt-2">
                    @if($visitingGoals->isEmpty())
                        <span class="text-muted">Sin goles</span>
                    @else
                        <ul class="list-unstyled mb-0 text-center">
                            @foreach($visitingGoals as $goal)
                                <li class="d-flex flex-column align-items-center gap-1 mb-1">
                                    <i class="bi bi-ball" style="color:#ffdd00;"></i>
                                    <strong>{{ $goal->player->name }}
                                        <small class="text-muted">({{ $goal->minute }}')
                                            </small>
                                            @if($goal->assistPlayer)- Asist: {{ $goal->assistPlayer->name }}</small>
                                            @endif
                                    </strong>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
    @endif

    {{-- Estado del partido --}}
    <p class="text-muted text-center">
        @if($game->state === 'finished') Fin del partido
        @elseif($game->state === 'in_progress') Partido en curso
        @else Partido pendiente
        @endif
    </p>

    <div class="text-center">
        <a href="{{ route('games.index') }}" class="btn btn-primary mt-2">Volver a Partidos</a>
    </div>
</div>
@endsection
