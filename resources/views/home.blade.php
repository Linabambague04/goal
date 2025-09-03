@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<!-- Hero Section -->
<section class="text-center py-5 hero-section text-light">
    <h1 class="display-3 fw-bold mb-3">Bienvenido a Flox</h1>
    <p class="lead mb-4">Gestiona equipos, jugadores, partidos, goles y tarjetas de forma sencilla.</p>
    <a href="{{ route('teams.index') }}" class="btn btn-primary btn-lg me-2 hero-btn">Comenzar</a>
    <a href="{{ route('players.index') }}" class="btn btn-outline-light btn-lg hero-btn">Explorar Jugadores</a>
</section>

<!-- Features Section -->
<section class="container py-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="p-4 bg-transparent border border-secondary rounded-3 hover-effect">
                <i class="bi bi-people-fill display-4 mb-3"></i>
                <h3>Equipos</h3>
                <p>Visualiza y administra todos tus equipos en un solo lugar.</p>
                <a href="{{ route('teams.index') }}" class="btn btn-outline-light btn-sm mt-2">Ir</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-transparent border border-secondary rounded-3 hover-effect">
                <i class="bi bi-person-badge-fill display-4 mb-3"></i>
                <h3>Jugadores</h3>
                <p>Consulta estadísticas, perfiles y rendimiento de cada jugador.</p>
                <a href="{{ route('players.index') }}" class="btn btn-outline-light btn-sm mt-2">Ir</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-transparent border border-secondary rounded-3 hover-effect">
                <i class="bi bi-trophy-fill display-4 mb-3"></i>
                <h3>Partidos</h3>
                <p>Lleva el control de todos los partidos, resultados y horarios.</p>
                <a href="{{ route('games.index') }}" class="btn btn-outline-light btn-sm mt-2">Ir</a>
            </div>
        </div>
    </div>

    <div class="row text-center g-4 mt-3">
        <div class="col-md-6">
            <div class="p-4 bg-transparent border border-secondary rounded-3 hover-effect">
                <i class="bi bi-flag-fill display-4 mb-3"></i>
                <h3>Goles</h3>
                <p>Analiza y administra todos los goles anotados en tus partidos.</p>
                <a href="{{ route('goals.index') }}" class="btn btn-outline-light btn-sm mt-2">Ir</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 bg-transparent border border-secondary rounded-3 hover-effect">
                <i class="bi bi-card-text display-4 mb-3"></i>
                <h3>Tarjetas</h3>
                <p>Lleva un registro de tarjetas amarillas y rojas de los jugadores.</p>
                <a href="{{ route('cards.index') }}" class="btn btn-outline-light btn-sm mt-2">Ir</a>
            </div>
        </div>
    </div>
</section>

<!-- Call To Action Section -->
<section class="text-center py-5 bg-secondary bg-opacity-10 rounded-3 my-5">
    <h2 class="fw-bold mb-3">¿Listo para gestionar tu liga?</h2>
    <a href="{{ route('teams.index') }}" class="btn btn-primary btn-lg">Comenzar Ahora</a>
</section>

<!-- Hover Effect -->
<style>
.hero-section {
    background: linear-gradient(135deg, #111, #222);
    padding: 100px 0;
}
.hero-btn {
    transition: transform 0.3s, box-shadow 0.3s;
}
.hero-btn:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 6px 15px rgba(255,255,255,0.3);
}
.hover-effect {
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}
.hover-effect:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 20px rgba(255,255,255,0.2);
    border-color: #fff;
}
</style>
@endsection
