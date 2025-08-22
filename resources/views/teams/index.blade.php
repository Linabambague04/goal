@extends('layouts.app')

@section('title', 'Teams')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Teams</h1>

    {{-- Solo admin o referee pueden crear equipos --}}
    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('teams.create') }}" class="btn btn-primary">Add Team</a>
    @endif
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Shield</th>
            <th>Points</th>
            <th>Games Played</th>
            <th>Won</th>
            <th>Tied</th>
            <th>Lost</th>
            <th>Goals Scored</th>

            {{-- Acciones solo para admin y referee --}}
            @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                <th>Actions</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse($teams as $team)
        <tr>
            <td>{{ $team->name }}</td>
            <td>
                @if($team->shield)
                    <img src="{{ asset('storage/'.$team->shield) }}" alt="Shield" width="50">
                @else
                    <span class="text-muted">No image</span>
                @endif
            </td>
            <td>{{ $team->points }}</td>
            <td>{{ $team->games_played }}</td>
            <td>{{ $team->matches_won }}</td>
            <td>{{ $team->tied_matches }}</td>
            <td>{{ $team->lost_matches }}</td>
            <td>{{ $team->goals_scored }}</td>

            @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                <td>
                    <a href="{{ route('teams.edit', $team) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('teams.destroy', $team) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this team?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            @endif
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center">No teams available.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $teams->links() }}
@endsection
