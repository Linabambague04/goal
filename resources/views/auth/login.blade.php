@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <h2 class="mb-4 text-center text-white">Iniciar Sesión</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

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

        {{-- Botón --}}
        <button type="submit" class="btn btn-outline-danger w-100">Iniciar Sesión</button>
    </form>

    <p class="mt-3 text-center text-muted">
        ¿No tienes cuenta? <a href="{{ route('register.form') }}" class="text-decoration-none text-white">Regístrate</a>
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
