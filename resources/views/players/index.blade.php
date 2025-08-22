@extends('layouts.app')

@section('title', 'Players')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Players</h1>

    {{-- Solo admin o referee pueden agregar jugadores --}}
    @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
        <a href="{{ route('players.create') }}" class="btn btn-primary">Add Player</a>
    @endif
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Position</th>
            <th>Team</th>
            
            {{-- Acciones solo si es admin o referee --}}
            @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                <th>Actions</th>
            @else
                <th>View</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($players as $player)
        <tr>
            <td>{{ $player->name }}</td>
            <td>{{ $player->number }}</td>
            <td>{{ $player->position }}</td>
            <td>{{ $player->team->name }}</td>

            <td>
                {{-- Todos (fan, referee, admin) pueden ver --}}
                <a href="{{ route('players.show', $player) }}" class="btn btn-info btn-sm">View</a>

                {{-- Editar y eliminar solo admin o referee --}}
                @if(auth()->check() && in_array(auth()->user()->role, ['admin','referee']))
                    <a href="{{ route('players.edit', $player) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('players.destroy', $player) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $players->links() }}
@endsection

