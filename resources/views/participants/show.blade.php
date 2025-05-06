<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Participant - {{ $user->name }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }
        .page-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2), transparent 70%);
            opacity: 0.3;
        }
        .page-header h1 {
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .page-header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        .card-header {
            background: linear-gradient(90deg, #2575fc, #6a11cb);
            color: white;
            padding: 1.5rem;
            border-radius: 15px 15px 0 0;
        }
        .booking-card {
            background: white;
            margin-bottom: 2rem;
        }
        .booking-card .card-body {
            padding: 2rem;
        }
        .status-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-weight: 500;
        }
        .btn-outline-primary {
            border-color: #2575fc;
            color: #2575fc;
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover {
            background-color: #2575fc;
            color: white;
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 2rem;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-title {
            font-weight: 600;
            color: #2a5298;
        }
        .card-text {
            color: #6c757d;
            line-height: 1.6;
        }
        .text-muted i {
            color: #2575fc;
        }
        .container {
            max-width: 1200px;
        }
        h3 {
            color: #2a5298;
            font-weight: 600;
            margin-bottom: 2rem;
        }
        @media (max-width: 768px) {
            .page-header {
                padding: 2rem 0;
            }
            .page-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-header text-center">
        <div class="container position-relative">
            <h1 class="display-4">Détails du Participant</h1>
            <p class="lead">{{ $user->name }}</p>
        </div>
    </div>

    <div class="container py-5">
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

        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('participants.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste des participants
                </a>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Informations du participant</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Nom:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        @if($user->phone)
                            <p><strong>Téléphone:</strong> {{ $user->phone }}</p>
                        @endif
                        <p><strong>Rôle:</strong> {{ ucfirst($user->role) }}</p>
                        <p><strong>Date d'inscription:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Statistiques</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre total de réservations:</strong> {{ count($bookings) }}</p>
                        <p><strong>Réservations confirmées:</strong> {{ $bookings->where('status', 'confirmed')->count() }}</p>
                        <p><strong>Réservations en attente:</strong> {{ $bookings->where('status', 'pending')->count() }}</p>
                        <p><strong>Réservations annulées:</strong> {{ $bookings->where('status', 'cancelled')->count() }}</p>
                        <p><strong>Réservations rejetées:</strong> {{ $bookings->where('status', 'rejected')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h3>Réservations</h3>
        <div class="row">
            @forelse($bookings as $booking)
                <div class="col-md-6 col-lg-4">
                    <div class="card booking-card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $booking->event->title }}</h5>
                            <p class="card-text">{{ $booking->event->description }}</p>
                            <p class="text-muted">
                                <i class="far fa-calendar-alt me-2"></i>{{ $booking->event->date }}
                                <br>
                                <i class="far fa-clock me-2"></i>{{ $booking->event->time }}
                                <br>
                                <i class="fas fa-map-marker-alt me-2"></i>{{ $booking->event->location }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge status-badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : ($booking->status === 'rejected' ? 'secondary' : 'warning')) }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <small class="text-muted">
                                    <i class="far fa-clock me-1"></i>{{ $booking->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="lead">Aucune réservation trouvée pour ce participant.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>