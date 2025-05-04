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
            padding: 20px;
            color: #2d3436;
        }
        
        .event-header {
            text-align: center;
            margin-bottom: 40px;
            background: linear-gradient(135deg, #6c5ce7 0%, #a363d5 100%);
            color: white;
            padding: 4rem 0;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(108, 92, 231, 0.2);
        }
        
        .event-header::before {
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
        
        .event-logo {
            width: 180px;
            height: 180px;
            object-fit: contain;
            margin-bottom: 25px;
            background: white;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease;
        }
        
        .event-logo:hover {
            transform: scale(1.05);
        }
        
        .event-title {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .event-type {
            display: inline-block;
            padding: 8px 20px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            backdrop-filter: blur(5px);
            margin: 0 10px;
            position: relative;
            z-index: 1;
        }
        
        .event-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            transition: transform 0.3s ease;
        }
        
        .event-section:hover {
            transform: translateY(-5px);
        }
        
        .section-title {
            color: #2d3436;
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: #6c5ce7;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 25px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .info-item:hover {
            background: #f1f3f5;
            transform: translateY(-3px);
        }
        
        .info-label {
            color: #636e72;
            font-size: 0.9rem;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .info-value {
            color: #2d3436;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .media-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .media-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .media-item:hover {
            transform: scale(1.02);
        }
        
        .media-item img, .media-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .budget-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .budget-item {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .budget-item:hover {
            background: #f1f3f5;
            transform: translateY(-3px);
        }
        
        .budget-label {
            color: #636e72;
            font-size: 0.9rem;
            margin-bottom: 10px;
            font-weight: 500;
        }
        
        .budget-value {
            color: #2d3436;
            font-size: 2rem;
            font-weight: 700;
        }
        
        .budget-value.estimated {
            color: #6c5ce7;
        }
        
        .budget-value.spent {
            color: #e84393;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-edit {
            background-color: #6c5ce7;
            color: white;
        }
        
        .btn-delete {
            background-color: #e84393;
            color: white;
        }
        
        .btn-back {
            background-color: #636e72;
            color: white;
        }

        .amenities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .amenity-item {
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            color: #636e72;
            transition: all 0.3s ease;
        }

        .amenity-item:hover {
            background: #6c5ce7;
            color: white;
            transform: translateY(-2px);
        }

        .status-badge {
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
            margin: 10px;
            position: relative;
            z-index: 1;
        }

        .status-draft { 
            background-color: #636e72; 
            color: white; 
        }
        .status-published { 
            background-color: #00b894; 
            color: white; 
        }
        .status-cancelled { 
            background-color: #d63031; 
            color: white; 
        }

        @media (max-width: 768px) {
            .event-title {
                font-size: 2rem;
            }
            
            .event-logo {
                width: 150px;
                height: 150px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .budget-info {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="event-header">
            @if($event->logo_path)
                <img src="{{ asset('storage/' . $event->logo_path) }}" alt="Logo de l'événement" class="event-logo">
            @endif
            <h1 class="event-title">{{ $event->title }}</h1>
            <span class="event-type"><i class="fas fa-calendar-alt me-2"></i>{{ ucfirst($event->event_type) }}</span>
            <span class="status-badge status-{{ $event->status }}">
                <i class="fas fa-circle me-2"></i>{{ ucfirst($event->status) }}
            </span>
        </div>

        <div class="event-section">
            <h2 class="section-title"><i class="fas fa-info-circle"></i>Informations de l'événement</h2>
            <div class="event-info">
                <div class="info-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ $event->date }}</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ $event->time }}</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $event->location }}</span>
                </div>
                @if($event->price)
                <div class="info-item">
                    <i class="fas fa-euro-sign"></i>
                    <span>{{ number_format($event->price, 2) }}€</span>
                </div>
                @endif
            </div>
        </div>

        <div class="event-section">
            <h2 class="section-title"><i class="fas fa-info-circle"></i>Informations de base</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label"><i class="far fa-calendar-alt me-2"></i>Date</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="far fa-clock me-2"></i>Heure</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-map-marker-alt me-2"></i>Lieu</span>
                    <span class="info-value">{{ $event->location }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-tag me-2"></i>Catégorie</span>
                    <span class="info-value">{{ ucfirst($event->category) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-users me-2"></i>Participants maximum</span>
                    <span class="info-value">{{ $event->max_participants }}</span>
                </div>
            </div>
            <div class="info-item">
                <span class="info-label"><i class="fas fa-align-left me-2"></i>Description</span>
                <span class="info-value">{{ $event->description }}</span>
            </div>
        </div>

        @if($event->custom_message)
        <div class="event-section">
            <h2 class="section-title"><i class="fas fa-comment-alt"></i>Message personnalisé</h2>
            <p class="info-value">{{ $event->custom_message }}</p>
        </div>
        @endif

        @if($event->theme_colors)
        <div class="event-section">
            <h2 class="section-title"><i class="fas fa-palette"></i>Personnalisation</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-paint-brush me-2"></i>Couleurs du thème</span>
                    <div class="d-flex gap-3 mt-3">
                        @foreach($event->theme_colors as $color)
                            <div style="width: 40px; height: 40px; background-color: {{ $color }}; border-radius: 50%; box-shadow: 0 3px 10px rgba(0,0,0,0.1);"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($event->media_gallery && count($event->media_gallery) > 0)
        <div class="event-section">
            <h2 class="section-title"><i class="fas fa-images"></i>Galerie média</h2>
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
            <h2 class="section-title"><i class="fas fa-wallet"></i>Budget</h2>
            <div class="budget-info">
                <div class="budget-item">
                    <span class="budget-label"><i class="fas fa-chart-line me-2"></i>Budget estimé</span>
                    <span class="budget-value estimated">{{ number_format($event->budget, 2) }} €</span>
                </div>
                @if($event->budget_breakdown)
                <div class="budget-item">
                    <span class="budget-label"><i class="fas fa-list-ul me-2"></i>Détails du budget</span>
                    <div class="mt-3">
                        @foreach($event->budget_breakdown as $item => $amount)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">{{ $item }}</span>
                                <span class="fw-bold">{{ number_format($amount, 2) }} €</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($event->amenities)
        <div class="event-section">
            <h2 class="section-title"><i class="fas fa-concierge-bell"></i>Équipements et services</h2>
            <div class="amenities-list">
                @foreach($event->amenities as $amenity)
                    <span class="amenity-item"><i class="fas fa-check me-2"></i>{{ $amenity }}</span>
                @endforeach
            </div>
        </div>
        @endif

        @if($event->special_requirements)
        <div class="event-section">
            <h2 class="section-title"><i class="fas fa-exclamation-circle"></i>Exigences particulières</h2>
            <p class="info-value">{{ $event->special_requirements }}</p>
        </div>
        @endif

        <div class="event-section">
            <h2 class="section-title"><i class="fas fa-address-card"></i>Informations de contact</h2>
            <div class="info-grid">
                @if($event->contact_email)
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-envelope me-2"></i>Email de contact</span>
                    <span class="info-value">{{ $event->contact_email }}</span>
                </div>
                @endif
                @if($event->contact_phone)
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-phone me-2"></i>Téléphone de contact</span>
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