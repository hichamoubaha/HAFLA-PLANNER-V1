<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'événement</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS for Navigation Bar -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
            display: block;
            margin-left: auto;
            margin-right: auto;
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

        /* Custom Navigation Bar Styles */
        .custom-nav {
            background: linear-gradient(135deg, #6c5ce7 0%, #a363d5 100%);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .custom-nav a, .custom-nav button, .custom-nav span {
            font-family: 'Poppins', sans-serif;
            color: white !important;
            transition: all 0.3s ease;
        }

        .custom-nav a:hover, .custom-nav button:hover {
            color: #f1f3f5 !important;
        }

        .custom-nav .active-nav {
            border-color: white !important;
            color: white !important;
        }

        .custom-nav .mobile-menu a, .custom-nav .mobile-menu button {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin: 0 10px;
        }

        .custom-nav .mobile-menu a:hover, .custom-nav .mobile-menu button:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .custom-nav .dropdown-menu {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .custom-nav .dropdown-menu a, .custom-nav .dropdown-menu button {
            color: #2d3436 !important;
        }

        .custom-nav .dropdown-menu a:hover, .custom-nav .dropdown-menu button:hover {
            background: #f8f9fa;
            color: #6c5ce7 !important;
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
    <!-- Navigation Bar -->
    <nav class="custom-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('events.index') }}" class="text-2xl font-bold text-white">Événements</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('events.index') }}" class="active-nav text-white inline-flex items-center px-1 pt-1 border-b-2 border-white text-sm font-medium">Événements</a>
                        <a href="{{ route('bookings.index') }}" class="text-white hover:text-gray-200 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Mes Réservations</a>
                        <a href="{{ route('invitation-templates.my-invitations') }}" class="text-white hover:text-gray-200 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Mes Invitations</a>
                        <a href="{{ route('service-providers.index') }}" class="text-white hover:text-gray-200 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Prestataires</a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <div class="ml-3 relative">
                        <button id="profileDropdown" class="flex items-center text-white hover:text-gray-200 focus:outline-none">
                            <i class="fas fa-user-circle text-xl mr-2"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div id="profileDropdownMenu" class="dropdown-menu origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 hidden">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Mon Profil</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-gray-100/20 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="sm:hidden mobile-menu" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('events.index') }}" class="bg-white/10 text-white block pl-3 pr-4 py-2 border-l-4 border-white text-base font-medium">Événements</a>
                <a href="{{ route('bookings.index') }}" class="text-white hover:bg-white/20 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium">Mes Réservations</a>
                <a href="{{ route('invitation-templates.my-invitations') }}" class="text-white hover:bg-white/20 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium">Mes Invitations</a>
                <a href="{{ route('service-providers.index') }}" class="text-white hover:bg-white/20 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium">Prestataires</a>
                <a href="{{ route('profile') }}" class="text-white hover:bg-white/20 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium">Mon Profil</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white hover:bg-white/20 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium w-full text-left">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

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
    <script>
        // Toggle profile dropdown
        document.getElementById('profileDropdown').addEventListener('click', function () {
            document.getElementById('profileDropdownMenu').classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const dropdown = document.getElementById('profileDropdownMenu');
            const button = document.getElementById('profileDropdown');
            if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>