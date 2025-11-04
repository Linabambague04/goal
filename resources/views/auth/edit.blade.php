@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Editar Perfil</h2>

    <form method="POST" action="{{ route('user.update') }}">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Role solo si es admin --}}
        @if($user->role === 'admin')
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="role" class="form-select">
                    <option value="fan" {{ $user->role === 'fan' ? 'selected' : '' }}>Fan</option>
                    <option value="referee" {{ $user->role === 'referee' ? 'selected' : '' }}>Referee</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
        @endif

        {{-- Botones --}}
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-danger flex-grow-1 me-2">
                Cancelar
            </a>
            <button type="submit" class="btn btn-warning flex-grow-1 ms-2">
                Actualizar
            </button>
        </div>
    </form>
</div>

<style>
.btn-warning {
    background-color: #ff9900;
    color: #000;
    border-color: #ff9900;
}

.btn-warning:hover {
    background-color: #ff4d4d;
    color: #fff;
    border-color: #ff4d4d;
}

.btn-outline-danger {
    border: 2px solid #cc0000;
    color: #cc0000;
    transition: all 0.2s;
}

.btn-outline-danger:hover {
    background-color: #cc0000;
    color: #fff;
}
</style>
@endsection
