@extends('layouts.app')

@section('title', 'Editar Equipo')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-uppercase" style="font-family: 'Oswald', sans-serif; color:#e0e0e0; border-bottom:2px solid #555; padding-bottom:5px;">
        Editar Equipo
    </h1>

    @if ($errors->any())
    <div class="alert alert-danger bg-dark text-light border-0">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card bg-black text-light shadow-sm rounded p-4 border border-secondary">
        <form action="{{ route('teams.update', $team) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-bold text-light">Nombre del Equipo</label>
                <input type="text" name="name" class="form-control bg-dark text-light border-secondary" value="{{ old('name', $team->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="shield" class="form-label fw-bold text-light">Escudo</label>
                @if($team->shield && file_exists(public_path('storage/'.$team->shield)))
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$team->shield) }}" alt="Escudo" 
                             class="rounded" style="width:100px; height:100px; object-fit:contain; border:1px solid #555; background:#111; padding:5px;">
                    </div>
                @endif
                <input type="file" name="shield" class="form-control bg-dark text-light border-secondary">
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-warning fw-bold">
                    <i class="bi bi-save me-1"></i> Actualizar
                </button>
                <a href="{{ route('teams.index') }}" class="btn btn-secondary fw-bold">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
