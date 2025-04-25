<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'événement</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .event-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .event-title {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .event-type {
            display: inline-block;
            padding: 5px 15px;
            background-color: #ff6b6b;
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
        
        .theme-display {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .color-sample {
            width: 20px;
            height: 20px;
            border-radius: 50%;
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
        
        .payment-method {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 15px;
            background: #f8f9fa;
            border-radius: 20px;
            font-size: 14px;
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
    </style>
</head>
<body>
    <div class="event-header">
        <h1 class="event-title">{{ $event->title }}</h1>
        <span class="event-type">{{ ucfirst($event->event_type) }}</span>
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
        </div>
        <div class="info-item">
            <span class="info-label">Description</span>
            <span class="info-value">{{ $event->description }}</span>
        </div>
    </div>

    <div class="event-section">
        <h2 class="section-title">Personnalisation</h2>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Thème</span>
                <div class="theme-display">
                    <span class="info-value">{{ ucfirst($event->selected_theme) }}</span>
                </div>
            </div>
            <div class="info-item">
                <span class="info-label">Couleur principale</span>
                <div class="theme-display">
                    <div class="color-sample" style="background-color: {{ $event->selected_color }}"></div>
                    <span class="info-value">{{ $event->selected_color }}</span>
                </div>
            </div>
        </div>
    </div>

    @if($event->event_images || $event->event_videos)
    <div class="event-section">
        <h2 class="section-title">Médias</h2>
        <div class="media-gallery">
            @foreach($event->event_images as $image)
            <div class="media-item">
                <img src="{{ asset('storage/' . $image) }}" alt="Image de l'événement">
            </div>
            @endforeach
            @foreach($event->event_videos as $video)
            <div class="media-item">
                <video controls>
                    <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="event-section">
        <h2 class="section-title">Budget</h2>
        <div class="budget-info">
            <div class="budget-item">
                <span class="budget-label">Budget estimé</span>
                <span class="budget-value estimated">{{ number_format($event->estimated_budget, 2) }} €</span>
            </div>
            <div class="budget-item">
                <span class="budget-label">Dépenses actuelles</span>
                <span class="budget-value spent">{{ number_format($event->current_spent, 2) }} €</span>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <span class="info-label">Méthode de paiement</span>
            <div class="payment-method">
                <i class="fas fa-{{ $event->payment_method === 'card' ? 'credit-card' : ($event->payment_method === 'paypal' ? 'paypal' : 'university') }}"></i>
                <span>{{ ucfirst($event->payment_method) }}</span>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ route('events.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i>
            Retour
        </a>
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
    </div>
</body>
</html> 