@extends('layouts.app')

@section('title', 'Player Details')

@section('content')
<h1>{{ $player->name }}</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>Number:</strong> {{ $player->number }}</li>
    <li class="list-group-item"><strong>Position:</strong> {{ $player->position }}</li>
    <li class="list-group-item"><strong>Team:</strong> {{ $player->team->name }}</li>
</ul>

<a href="{{ route('players.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
