<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Flox')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        font-family: 'Segoe UI', sans-serif;
        background: #000;
        color: #e0e0e0;
    }
    main {
        flex: 1;
    }

    /* Navbar */
    .navbar {
        background: #111;
        border-bottom: 1px solid #222;
    }
    .navbar-brand {
        font-weight: bold;
        font-size: 1.4rem;
        color: #e0e0e0 !important;
        transition: color 0.3s ease;
    }
    .navbar-brand:hover {
        color: #fff !important;
    }

    .nav-link {
        position: relative;
        color: #aaa !important;
        transition: color 0.3s ease;
        text-align: center;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0; /* pegado al texto */
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: #fff;
        transition: width 0.3s ease;
    }
    .nav-link:hover {
        color: #fff !important;
    }
    .nav-link:hover::after {
        width: 60%;
    }

    /* Quitar flecha del dropdown */
    .navbar .dropdown-toggle::after {
        display: none;
    }

    /* Cards */
    .card-custom {
        background: #111;
        border: 1px solid #222;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.8);
        transition: transform 0.2s ease, box-shadow 0.3s ease, border 0.3s ease;
    }
    .card-custom:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0,0,0,1);
        border-color: #fff;
    }

    /* Botones */
    .btn-primary {
        background: #222;
        border: 1px solid #444;
        font-weight: bold;
        color: #e0e0e0;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: #fff;
        color: #000;
        border-color: #fff;
        transform: scale(1.05);
    }

    /* Tablas */
    .table-dark-custom {
        background: #111;
        color: #e0e0e0;
    }
    .table-dark-custom th {
        background: #222;
        color: #fff;
    }
    .table-dark-custom tbody tr:hover {
        background: #1c1c1c;
    }

    /* Badges */
    .badge-custom {
        background: #333;
        color: #e0e0e0;
        border-radius: 8px;
        padding: 4px 8px;
        font-size: 0.75rem;
        font-weight: bold;
        transition: background 0.3s ease, color 0.3s ease;
    }
    .badge-custom:hover {
        background: #fff;
        color: #000;
    }

    /* Footer */
    footer {
        background: #111;
        color: #888;
        font-size: 0.9rem;
        border-top: 1px solid #222;
        transition: color 0.3s ease;
    }
    footer:hover {
        color: #fff;
    }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">Flox</a>

            <!-- Botón responsive -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- Menú izquierda (solo si está logueado) -->
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('teams.index') }}">Equipos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('players.index') }}">Jugadores</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('games.index') }}">Partidos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('goals.index') }}">Goles</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('cards.index') }}">Tarjetas</a></li>
                    </ul>
                @endauth

                <!-- Menú derecha -->
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notifications.index') }}">
                                Notificaciones 
                                <span class="badge-custom">{{ auth()->user()->notifications()->where('read', false)->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.edit') }}">Editar Perfil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Iniciar Sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register.form') }}">Registrarse</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container my-5">
        @yield('content')
    </main>


    <!-- Footer -->
    <footer class="text-center py-3 mt-auto">
        <p><i class="bi bi-c-circle me-1"></i>{{ date('Y') }} Flox | Todos los derechos reservados</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
