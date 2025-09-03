@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<!-- Hero Section -->
<section class="text-center py-5 hero-section text-light animate-fade-up">
    <h1 class="display-3 fw-bold mb-3">Bienvenido a Flox</h1>
    <p class="lead mb-4">Gestiona equipos, jugadores, partidos, goles y tarjetas de forma sencilla.</p>
    <a href="{{ route('teams.index') }}" class="btn btn-primary btn-lg me-2 hero-btn">Comenzar</a>
    <a href="{{ route('players.index') }}" class="btn btn-outline-light btn-lg hero-btn">Explorar Jugadores</a>
</section>

<!-- Features Section -->
<section class="container py-5">
    <div class="row text-center g-4">
        <div class="col-md-4 animate-fade-up delay-1">
            <div class="p-4 bg-transparent border border-secondary rounded-3 hover-effect">
                <i class="bi bi-people-fill display-4 mb-3"></i>
                <h3>Equipos</h3>
                <p>Visualiza y administra todos tus equipos en un solo lugar.</p>
                <a href="{{ route('teams.index') }}" class="btn btn-outline-light btn-sm mt-2">Ir</a>
            </div>
        </div>
        <div class="col-md-4 animate-fade-up delay-2">
            <div class="p-4 bg-transparent border border-secondary rounded-3 hover-effect">
                <i class="bi bi-person-badge-fill display-4 mb-3"></i>
                <h3>Jugadores</h3>
                <p>Consulta estadísticas, perfiles y rendimiento de cada jugador.</p>
                <a href="{{ route('players.index') }}" class="btn btn-outline-light btn-sm mt-2">Ir</a>
            </div>
        </div>
        <div class="col-md-4 animate-fade-up delay-3">
            <div class="p-4 bg-transparent border border-secondary rounded-3 hover-effect">
                <i class="bi bi-trophy-fill display-4 mb-3"></i>
                <h3>Partidos</h3>
                <p>Lleva el control de todos los partidos, resultados y horarios.</p>
                <a href="{{ route('games.index') }}" class="btn btn-outline-light btn-sm mt-2">Ir</a>
            </div>
        </div>
    </div>

    <div class="row text-center g-4 mt-3">
        <div class="col-md-6 animate-fade-up delay-4">
            <div class="p-4 bg-transparent border border-secondary rounded-3 hover-effect">
                <i class="bi bi-flag-fill display-4 mb-3"></i>
                <h3>Goles</h3>
                <p>Analiza y administra todos los goles anotados en tus partidos.</p>
                <a href="{{ route('goals.index') }}" class="btn btn-outline-light btn-sm mt-2">Ir</a>
            </div>
        </div>
        <div class="col-md-6 animate-fade-up delay-5">
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
<section class="text-center py-5 bg-secondary bg-opacity-10 rounded-3 my-5 animate-fade-up delay-6">
    <h2 class="fw-bold mb-3">¿Listo para gestionar tu liga?</h2>
    <a href="{{ route('teams.index') }}" class="btn btn-primary btn-lg">Comenzar Ahora</a>
</section>

<!-- Hover Effect & Animations -->
<style>
.hero-section {
    background: linear-gradient(135deg, #111, #000);
    padding: 100px 0;
    color: #e0e0e0;
}

.hero-btn {
    transition: transform 0.3s, box-shadow 0.3s, background 0.3s, color 0.3s;
}
.hero-btn.btn-primary:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 6px 15px rgba(255, 77, 77, 0.4);
    background: #ff4d4d;
    color: #fff;
}
.hero-btn.btn-outline-light:hover {
    background: #ff4d4d;
    color: #fff;
    border-color: #ff4d4d;
}

.hover-effect {
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    background: #111;
    border: 1px solid #222;
    color: #e0e0e0;
}
.hover-effect:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 20px rgba(255,77,77,0.2);
    border-color: #ff4d4d;
}
.hover-effect h3, .hover-effect i {
    transition: color 0.3s ease;
}
.hover-effect:hover h3,
.hover-effect:hover i {
    color: #ff4d4d;
}

/* Call To Action Section */
section.bg-secondary {
    background: #111;
    border: 1px solid #222;
    color: #e0e0e0;
    transition: all 0.3s ease;
}
section.bg-secondary:hover {
    border-color: #ff4d4d;
    box-shadow: 0 10px 20px rgba(255,77,77,0.3);
}
section.bg-secondary .btn-primary:hover {
    background: #ff4d4d;
    color: #fff;
    border-color: #ff4d4d;
}

/* Animations */
@keyframes fadeUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-up {
    animation: fadeUp 0.8s forwards;
}
.delay-1 { animation-delay: 0.2s; }
.delay-2 { animation-delay: 0.4s; }
.delay-3 { animation-delay: 0.6s; }
.delay-4 { animation-delay: 0.8s; }
.delay-5 { animation-delay: 1s; }
.delay-6 { animation-delay: 1.2s; }
</style>

@endsection
