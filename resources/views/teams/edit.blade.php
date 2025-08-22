@extends('layouts.app')

@section('title', 'Edit Team')

@section('content')
<h1>Edit Team</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('teams.update', $team) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Team Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $team->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="shield" class="form-label">Shield</label>
        @if($team->shield)
            <div class="mb-2">
                <img src="{{ asset('storage/'.$team->shield) }}" alt="Shield" width="70">
            </div>
        @endif
        <input type="file" name="shield" class="form-control">
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('teams.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
