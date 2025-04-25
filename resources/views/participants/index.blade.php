<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants</title>
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
        .participant-card {
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        .participant-card:hover {
            transform: translateY(-5px);
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 0.3rem 0.6rem;
        }
    </style>
</head>
<body>
    <div class="page-header text-center">
        <div class="container">
            <h1 class="display-4">Participants</h1>
            <p class="lead">Liste des participants aux événements</p>
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
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Retour au tableau de bord
                </a>
            </div>
        </div>

        <div class="row">
            @forelse($participants as $userId => $participant)
                <div class="col-md-6 col-lg-4">
                    <div class="card participant-card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $participant['user']->name }}</h5>
                            <p class="card-text">
                                <i class="fas fa-envelope me-2"></i>{{ $participant['user']->email }}
                                @if($participant['user']->phone)
                                    <br><i class="fas fa-phone me-2"></i>{{ $participant['user']->phone }}
                                @endif
                            </p>
                            <p class="card-text">
                                <strong>Événements réservés:</strong> {{ count($participant['bookings']) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('participants.show', $participant['user']) }}" class="btn btn-primary">
                                    <i class="fas fa-eye me-1"></i>Voir les détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="lead">Aucun participant trouvé.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>