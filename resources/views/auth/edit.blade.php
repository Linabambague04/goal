@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Edit Profile</h2>

    <form method="POST" action="{{ route('user.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        @if($user->role === 'admin')
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="fan" {{ $user->role === 'fan' ? 'selected' : '' }}>Fan</option>
                    <option value="referee" {{ $user->role === 'referee' ? 'selected' : '' }}>Referee</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
        @endif

        <button type="submit" class="btn btn-warning w-100">Update Profile</button>
    </form>
</div>
@endsection
