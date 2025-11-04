@extends('layouts.app')

@section('title', 'Add Team')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Add Team</h1>
    <a href="{{ route('teams.index') }}" class="btn btn-secondary">Back to Teams</a>
</div>

<form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Team Name</label>
        <input type="text" name="name" class="form-control" id="name" required>
    </div>
    <div class="mb-3">
        <label for="shield" class="form-label">Shield</label>
        <input type="file" name="shield" class="form-control" id="shield">
    </div>
    <button type="submit" class="btn btn-primary">Create Team</button>
</form>
@endsection
