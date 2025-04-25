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
    <style>
        .page-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        .booking-card {
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        .booking-card:hover {
            transform: translateY(-5px);
        }
        .status-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>
<body>
    <div class="page-header text-center">
        <div class="container">
            <h1 class="display-4">Détails du Participant</h1>
            <p class="lead">{{ $user->name }}</p>
        </div>
    </div>

    <div class="container">
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

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
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

        <h3 class="mb-4">Réservations</h3>
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