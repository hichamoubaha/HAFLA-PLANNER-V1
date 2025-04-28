<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'événement</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            padding: 20px;
        }
        
        .event-header {
            text-align: center;
            margin-bottom: 40px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 3rem 0;
            border-radius: 10px;
        }
        
        .event-logo {
            width: 150px;
            height: 150px;
            object-fit: contain;
            margin-bottom: 20px;
            background: white;
            padding: 10px;
            border-radius: 10px;
        }
        
        .event-title {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .event-type {
            display: inline-block;
            padding: 5px 15px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 20px;
            font-size: 14px;
        }
        
        .event-section {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .section-title {
            color: #333;
            font-size: 20px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }
        
        .media-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .media-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .media-item img, .media-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .budget-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .budget-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        
        .budget-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .budget-value {
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }
        
        .budget-value.estimated {
            color: #4ecdc4;
        }
        
        .budget-value.spent {
            color: #ff6b6b;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-edit {
            background-color: #4ecdc4;
            color: white;
        }
        
        .btn-delete {
            background-color: #ff6b6b;
            color: white;
        }
        
        .btn-back {
            background-color: #6c757d;
            color: white;
        }

        .amenities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .amenity-item {
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            color: #666;
        }

        .status-badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-draft { background-color: #6c757d; color: white; }
        .status-published { background-color: #28a745; color: white; }
        .status-cancelled { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="event-header">
            @if($event->logo_path)
                <img src="{{ asset('storage/' . $event->logo_path) }}" alt="Logo de l'événement" class="event-logo">
            @endif
            <h1 class="event-title">{{ $event->title }}</h1>
            <span class="event-type">{{ ucfirst($event->event_type) }}</span>
            <span class="status-badge status-{{ $event->status }}">{{ ucfirst($event->status) }}</span>
        </div>

        <div class="event-section">
            <h2 class="section-title">Informations de base</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Date</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Heure</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Lieu</span>
                    <span class="info-value">{{ $event->location }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Catégorie</span>
                    <span class="info-value">{{ ucfirst($event->category) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Participants maximum</span>
                    <span class="info-value">{{ $event->max_participants }}</span>
                </div>
            </div>
            <div class="info-item">
                <span class="info-label">Description</span>
                <span class="info-value">{{ $event->description }}</span>
            </div>
        </div>

        @if($event->custom_message)
        <div class="event-section">
            <h2 class="section-title">Message personnalisé</h2>
            <p class="info-value">{{ $event->custom_message }}</p>
        </div>
        @endif

        @if($event->theme_colors)
        <div class="event-section">
            <h2 class="section-title">Personnalisation</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Couleurs du thème</span>
                    <div class="d-flex gap-2">
                        @foreach($event->theme_colors as $color)
                            <div style="width: 30px; height: 30px; background-color: {{ $color }}; border-radius: 50%;"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($event->media_gallery && count($event->media_gallery) > 0)
        <div class="event-section">
            <h2 class="section-title">Galerie média</h2>
            <div class="media-gallery">
                @foreach($event->media_gallery as $media)
                    @if(Str::endsWith(strtolower($media), ['.jpg', '.jpeg', '.png', '.gif']))
                        <div class="media-item">
                            <img src="{{ asset('storage/' . $media) }}" alt="Image de l'événement">
                        </div>
                    @elseif(Str::endsWith(strtolower($media), ['.mp4', '.webm']))
                        <div class="media-item">
                            <video controls>
                                <source src="{{ asset('storage/' . $media) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <div class="event-section">
            <h2 class="section-title">Budget</h2>
            <div class="budget-info">
                <div class="budget-item">
                    <span class="budget-label">Budget estimé</span>
                    <span class="budget-value estimated">{{ number_format($event->budget, 2) }} €</span>
                </div>
                @if($event->budget_breakdown)
                <div class="budget-item">
                    <span class="budget-label">Détails du budget</span>
                    <div class="mt-2">
                        @foreach($event->budget_breakdown as $item => $amount)
                            <div class="d-flex justify-content-between">
                                <span>{{ $item }}</span>
                                <span>{{ number_format($amount, 2) }} €</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($event->amenities)
        <div class="event-section">
            <h2 class="section-title">Équipements et services</h2>
            <div class="amenities-list">
                @foreach($event->amenities as $amenity)
                    <span class="amenity-item">{{ $amenity }}</span>
                @endforeach
            </div>
        </div>
        @endif

        @if($event->special_requirements)
        <div class="event-section">
            <h2 class="section-title">Exigences particulières</h2>
            <p class="info-value">{{ $event->special_requirements }}</p>
        </div>
        @endif

        <div class="event-section">
            <h2 class="section-title">Informations de contact</h2>
            <div class="info-grid">
                @if($event->contact_email)
                <div class="info-item">
                    <span class="info-label">Email de contact</span>
                    <span class="info-value">{{ $event->contact_email }}</span>
                </div>
                @endif
                @if($event->contact_phone)
                <div class="info-item">
                    <span class="info-label">Téléphone de contact</span>
                    <span class="info-value">{{ $event->contact_phone }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('events.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i>
                Retour
            </a>
            @if(Auth::id() === $event->user_id)
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-edit">
                    <i class="fas fa-edit"></i>
                    Modifier
                </a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">
                        <i class="fas fa-trash"></i>
                        Supprimer
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html> 