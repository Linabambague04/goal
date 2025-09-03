@extends('layouts.app')

@section('title', 'Registrar')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center text-white">Registrarse</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nombre --}}
        <div class="mb-3">
            <label class="form-label text-white">Nombre</label>
            <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Correo electrónico --}}
        <div class="mb-3">
            <label class="form-label text-white">Correo electrónico</label>
            <input type="email" name="email" class="form-control bg-dark text-white border-secondary" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Contraseña --}}
        <div class="mb-3">
            <label class="form-label text-white">Contraseña</label>
            <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div class="mb-3">
            <label class="form-label text-white">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control bg-dark text-white border-secondary" required>
        </div>

        {{-- Selector de rol --}}
        <div class="mb-3">
            <label class="form-label text-white">Rol</label>
            <select name="role" class="form-select bg-dark text-white border-secondary">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <option value="fan">Fan</option>
                    <option value="referee">Árbitro</option>
                    <option value="admin">Admin</option>
                @else
                    <option value="fan">Fan</option>
                    <option value="referee">Árbitro</option>
                @endif
            </select>
        </div>

        {{-- Botón Registrar --}}
        <button type="submit" class="btn btn-outline-danger w-100">Registrarse</button>
    </form>

    <p class="mt-3 text-center text-muted">
        ¿Ya tienes cuenta? <a href="{{ route('login.form') }}" class="text-decoration-none text-white">Inicia sesión</a>
    </p>
</div>

<style>
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
