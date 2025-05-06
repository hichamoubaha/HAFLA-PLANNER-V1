<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réservations - {{ $event->title }}</title>
    
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
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .booking-card:hover {
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
        .status-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>
<body>
    <div class="page-header text-center">
        <div class="container">
            <h1 class="display-4">Gestion des Réservations</h1>
            <p class="lead">Événement: {{ $event->title }}</p>
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
                <a href="{{ route('events.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Retour aux événements
                </a>
            </div>
        </div>

        <div class="row">
            @forelse($bookings as $booking)
                <div class="col-md-6 col-lg-4">
                    <div class="card booking-card">
                        <div class="event-logo-container">
                            @if($event->logo_path)
                                <img src="{{ asset('storage/' . $event->logo_path) }}" alt="Logo de l'événement" class="event-logo">
                            @else
                                <i class="fas fa-calendar-alt fa-4x text-white"></i>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $booking->user->name }}</h5>
                            <p class="card-text">
                                <i class="fas fa-envelope me-2"></i>{{ $booking->user->email }}
                                @if($booking->user->phone)
                                    <br><i class="fas fa-phone me-2"></i>{{ $booking->user->phone }}
                                @endif
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge status-badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : ($booking->status === 'rejected' ? 'secondary' : 'warning')) }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <small class="text-muted">
                                    <i class="far fa-clock me-1"></i>{{ $booking->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            
                            <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="input-group">
                                    <select name="status" class="form-select">
                                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                                        <option value="rejected" {{ $booking->status === 'rejected' ? 'selected' : '' }}>Rejeté</option>
                                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Mettre à jour
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="lead">Aucune réservation pour cet événement.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html> 