@extends('layouts.app')

@section('title', 'Edit Player')

@section('content')
<h1>Edit Player</h1>

<form action="{{ route('players.update', $player) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $player->name }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Number</label>
        <input type="number" name="number" class="form-control" value="{{ $player->number }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Position</label>
        <input type="text" name="position" class="form-control" value="{{ $player->position }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Team</label>
        <select name="team_id" class="form-select">
            @foreach($teams as $team)
                <option value="{{ $team->id }}" @if($team->id == $player->team_id) selected @endif>
                    {{ $team->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
