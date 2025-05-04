<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .event-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .event-logo-container {
            height: 200px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .event-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            background: white;
            padding: 10px;
            border-radius: 10px;
        }
        .event-card .card-body {
            padding: 1.5rem;
        }
        .event-card .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }
        .event-card .card-text {
            color: #666;
            margin-bottom: 1rem;
        }
        .event-date, .event-location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: #666;
        }
        .event-date i, .event-location i {
            color: #4ecdc4;
        }
        .card-footer {
            background: white;
            border-top: 1px solid rgba(0,0,0,0.1);
            padding: 1rem;
        }
        .btn-create {
            margin-bottom: 30px;
        }
        .event-date {
            color: #6c757d;
            font-weight: 500;
        }
        .event-location {
            font-style: italic;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .page-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        .btn-view-details {
            background-color: #4ecdc4;
            color: white;
            border: none;
        }
        .btn-view-details:hover {
            background-color: #45b7d1;
            color: white;
        }
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: bold;
            color: #333;
        }
        .nav-link {
            color: #666;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #4ecdc4;
        }
        .nav-link.active {
            color: #4ecdc4;
            font-weight: 500;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #4ecdc4;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .dropdown-item {
            padding: 0.5rem 1rem;
            color: #666;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #4ecdc4;
        }
        .dropdown-divider {
            margin: 0.5rem 0;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-calendar-check me-2"></i>Event Hive
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('events.index') }}">
                            <i class="fas fa-calendar me-1"></i>Événements
                        </a>
                    </li>
                    @if(Auth::user()->role === 'organisateur')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bookings.index') }}">
                            <i class="fas fa-ticket-alt me-1"></i>Réservations
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">
                            <i class="fas fa-users-cog me-1"></i>Utilisateurs
                        </a>
                    </li>
                    @endif
                </ul>
                <div class="user-info">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user me-2"></i>Profil
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="page-header text-center">
        <div class="container">
            <h1 class="display-4">Événements à venir</h1>
            <p class="lead">Découvrez et participez aux prochains événements</p>
        </div>
    </div>

    <div class="container">
        @if(Auth::user()->role === 'organisateur')
        <div class="row mb-4">
            <div class="col-12 text-end">
                <a href="{{ route('events.create') }}" class="btn btn-primary btn-create">
                    <i class="fas fa-plus-circle me-2"></i>Créer un événement
                </a>
            </div>
        </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            @foreach($events as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card event-card h-100">
                        <div class="event-logo-container">
                            @if($event->logo_path)
                                <img src="{{ asset('storage/' . $event->logo_path) }}" alt="Logo de l'événement" class="event-logo">
                            @else
                                <i class="fas fa-calendar-alt fa-4x text-white"></i>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $event->title }}</h3>
                            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                            <div class="event-date">
                                <i class="far fa-calendar-alt"></i>
                                <span>{{ $event->date }}</span>
                                <i class="far fa-clock ms-3"></i>
                                <span>{{ $event->time }}</span>
                            </div>
                            <div class="event-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="action-buttons">
                                <a href="{{ route('events.show', $event) }}" class="btn btn-view-details">
                                    <i class="fas fa-eye me-1"></i>Voir détails
                                </a>
                                
                                @if(Auth::user()->role === 'admin' && Auth::id() === $event->user_id)
                                    <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit me-1"></i>Modifier
                                    </a>
                                    <form action="{{ route('events.destroy', $event) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-trash-alt me-1"></i>Supprimer
                                        </button>
                                    </form>
                                @elseif(Auth::user()->role === 'organisateur' && Auth::id() === $event->user_id)
                                    <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit me-1"></i>Modifier
                                    </a>
                                    <a href="{{ route('bookings.event', $event) }}" class="btn btn-outline-success">
                                        <i class="fas fa-users me-1"></i>Gérer les réservations
                                    </a>
                                @elseif(Auth::user()->role === 'user')
                                    @php
                                        $booking = $event->bookings()->where('user_id', Auth::id())->first();
                                    @endphp
                                    @if($booking)
                                        <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                        @if($booking->status !== 'cancelled')
                                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="fas fa-times me-1"></i>Annuler
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <form action="{{ route('bookings.store', $event) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-calendar-check me-1"></i>Réserver
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>