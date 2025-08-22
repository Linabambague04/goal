@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Register</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        {{-- Solo si es admin se muestra el selector de rol --}}
        <div class="mb-3">
            <label class="form-label">Rol</label>
            <select name="role" class="form-select">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <option value="fan">Fan</option>
                    <option value="referee">Referee</option>
                    <option value="admin">Admin</option>
                @else
                    <option value="fan">Fan</option>
                    <option value="referee">Referee</option>
                @endif
            </select>
        </div>


        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
</div>
@endsection
