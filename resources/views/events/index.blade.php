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
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
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
        }
        .page-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="page-header text-center">
        <div class="container">
            <h1 class="display-4">Événements à venir</h1>
            <p class="lead">Découvrez et participez aux prochains événements</p>
        </div>
    </div>

    <div class="container">
        @if(Auth::user()->role === 'admin')
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
                        <div class="card-body">
                            <h3 class="card-title">{{ $event->title }}</h3>
                            <p class="card-text">{{ $event->description }}</p>
                            <p class="event-date">
                                <i class="far fa-calendar-alt me-2"></i>{{ $event->date }} 
                                <i class="far fa-clock ms-3 me-2"></i>{{ $event->time }}
                            </p>
                            <p class="event-location">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ $event->location }}
                            </p>
                        </div>
                        <div class="card-footer bg-white">
                            @if(Auth::user()->role === 'admin' && Auth::id() === $event->user_id)
                                <div class="action-buttons">
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
                                </div>
                            @elseif(Auth::user()->role === 'user')
                                @php
                                    $booking = $event->bookings()->where('user_id', Auth::id())->first();
                                @endphp
                                @if($booking)
                                    <div class="action-buttons">
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
                                    </div>
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
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>