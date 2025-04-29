<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants - Fiesta</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #2d3436;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        .main-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #6c5ce7;
        }

        .nav-link {
            color: #2d3436;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #6c5ce7;
        }

        .nav-link.active {
            color: #6c5ce7;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6c5ce7 0%, #a363d5 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        /* Main Content Styles */
        .main-content {
            margin-top: 76px;
            flex: 1;
        }

        .page-header {
            background: linear-gradient(135deg, #6c5ce7 0%, #a363d5 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') center/cover;
            opacity: 0.1;
            z-index: 0;
        }

        .page-header .container {
            position: relative;
            z-index: 1;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .participant-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 25px;
            border: none;
            overflow: hidden;
        }

        .participant-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .participant-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #6c5ce7 0%, #a363d5 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            margin: 0 auto 1rem;
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.2);
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 1rem;
            text-align: center;
        }

        .participant-info {
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            color: #636e72;
        }

        .info-item i {
            width: 25px;
            color: #6c5ce7;
            margin-right: 10px;
        }

        .booking-count {
            background: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            color: #6c5ce7;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .btn-view-details {
            background: #6c5ce7;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-view-details:hover {
            background: #5b4bc4;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.2);
        }

        .btn-back {
            background: #636e72;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .btn-back:hover {
            background: #4d5656;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .alert {
            border-radius: 15px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
        }

        .alert-success {
            background: #00b894;
            color: white;
        }

        .alert-danger {
            background: #d63031;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .empty-state i {
            font-size: 3rem;
            color: #6c5ce7;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #636e72;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .main-header {
                position: relative;
            }
            
            .main-content {
                margin-top: 0;
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }

            .page-header {
                padding: 3rem 0;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .participant-card {
                margin-bottom: 20px;
            }

            .card-body {
                padding: 1.5rem;
            }
        }

        /* Footer Styles */
        .main-footer {
            background: #2d3436;
            color: white;
            padding: 3rem 0;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h5 {
            color: #6c5ce7;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: #dfe6e9;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: #6c5ce7;
            padding-left: 5px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            color: white;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: #6c5ce7;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <i class="fas fa-glass-cheers me-2"></i>Fiesta
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-home me-1"></i>Tableau de bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('participants.index') }}">
                                <i class="fas fa-users me-1"></i>Participants
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('events.index') }}">
                                <i class="fas fa-calendar-alt me-1"></i>Événements
                            </a>
                        </li>
                    </ul>
                    <div class="user-menu">
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-dark text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
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
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header text-center">
            <div class="container">
                <h1>Participants</h1>
                <p>Liste des participants aux événements</p>
            </div>
        </div>

        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('dashboard') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Retour au tableau de bord
                </a>
            </div>

            <div class="row">
                @forelse($participants as $userId => $participant)
                    <div class="col-md-6 col-lg-4">
                        <div class="participant-card">
                            <div class="card-body">
                                <div class="participant-avatar">
                                    {{ strtoupper(substr($participant['user']->name, 0, 1)) }}
                                </div>
                                <h5 class="card-title">{{ $participant['user']->name }}</h5>
                                <div class="participant-info">
                                    <div class="info-item">
                                        <i class="fas fa-envelope"></i>
                                        {{ $participant['user']->email }}
                                    </div>
                                    @if($participant['user']->phone)
                                        <div class="info-item">
                                            <i class="fas fa-phone"></i>
                                            {{ $participant['user']->phone }}
                                        </div>
                                    @endif
                                </div>
                                <div class="booking-count">
                                    <i class="fas fa-calendar-check"></i>
                                    {{ count($participant['bookings']) }} événements réservés
                                </div>
                                <a href="{{ route('participants.show', $participant['user']) }}" class="btn btn-view-details">
                                    <i class="fas fa-eye"></i>
                                    Voir les détails
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <p>Aucun participant trouvé.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5>À propos de Fiesta</h5>
                    <p>Fiesta est votre plateforme de gestion d'événements tout-en-un. Organisez, gérez et suivez vos événements en toute simplicité.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h5>Liens rapides</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li><a href="{{ route('events.index') }}">Événements</a></li>
                        <li><a href="{{ route('participants.index') }}">Participants</a></li>
                        <li><a href="#">Aide et support</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5>Contact</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-envelope me-2"></i>support@fiesta.com</li>
                        <li><i class="fas fa-phone me-2"></i>+33 1 23 45 67 89</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>123 Rue de Paris, 75001 Paris</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Fiesta. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html> 