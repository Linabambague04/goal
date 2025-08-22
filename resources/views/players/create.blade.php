@extends('layouts.app')

@section('title', 'Add Player')

@section('content')
<h1>Add Player</h1>

<form action="{{ route('players.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Number</label>
        <input type="number" name="number" class="form-control" value="{{ old('number') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Position</label>
        <input type="text" name="position" class="form-control" value="{{ old('position') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Team</label>
        <select name="team_id" class="form-select">
            @foreach($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success">Save</button>
</form>
@endsection
