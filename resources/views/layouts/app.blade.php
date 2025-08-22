<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Football App')</title>

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
            background: #121212;
            color: #e0e0e0;
        }
        main {
            flex: 1;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #2a003f, #5a189a);
            box-shadow: 0 4px 10px rgba(0,0,0,0.6);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
            color: #ff8800 !important;
        }
        .nav-link {
            color: #d1d1d1 !important;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: #ff8800 !important;
        }

        /* Cards */
        .card-custom {
            background: #1e1e2f;
            border: 1px solid #5a189a;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.6);
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }
        .card-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.8);
        }

        /* Botones */
        .btn-primary {
            background: linear-gradient(90deg, #ff6a00, #ff8800);
            border: none;
            font-weight: bold;
            color: #fff;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(255, 136, 0, 0.6);
        }

        /* Tablas */
        .table-dark-custom {
            background: #1a1a27;
            color: #e0e0e0;
        }
        .table-dark-custom th {
            background: #2d1b4e;
            color: #ff8800;
        }
        .table-dark-custom tbody tr:hover {
            background: rgba(255, 136, 0, 0.1);
        }

        /* Badges */
        .badge-custom {
            background: linear-gradient(90deg, #ff6a00, #ff8800);
            color: #fff;
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        /* Footer */
        footer {
            background: linear-gradient(90deg, #2a003f, #5a189a);
            color: #f8f9fa;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-trophy-fill me-2"></i>Football App
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('teams.index') }}"><i class="bi bi-people-fill me-1"></i>Teams</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('players.index') }}"><i class="bi bi-person-badge-fill me-1"></i>Players</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('games.index') }}"><i class="bi bi-controller me-1"></i>Games</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('goals.index') }}"><i class="bi bi-bullseye me-1"></i>Goals</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cards.index') }}"><i class="bi bi-card-text me-1"></i>Cards</a></li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notifications.index') }}">
                                <i class="bi bi-bell-fill"></i> 
                                <span class="badge-custom">{{ auth()->user()->notifications()->where('read', false)->count() }}</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.edit') }}"><i class="bi bi-gear me-1"></i>Editar perfil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit"><i class="bi bi-box-arrow-right me-1"></i>Cerrar sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register.form') }}"><i class="bi bi-pencil-square me-1"></i>Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="container my-5">
        <div class="card-custom">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-3 mt-auto">
        <p><i class="bi bi-c-circle me-1"></i>{{ date('Y') }} Football App | Todos los derechos reservados</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
