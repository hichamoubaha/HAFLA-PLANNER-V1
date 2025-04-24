<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
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
            <h1 class="display-4">Mes Réservations</h1>
            <p class="lead">Gérez vos réservations d'événements</p>
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
                                <span class="badge status-badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                @if($booking->status !== 'cancelled')
                                    <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-times me-1"></i>Annuler
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="lead">Vous n'avez pas encore de réservations.</p>
                    <a href="{{ route('events.index') }}" class="btn btn-primary">
                        <i class="fas fa-calendar-alt me-2"></i>Voir les événements
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html> 