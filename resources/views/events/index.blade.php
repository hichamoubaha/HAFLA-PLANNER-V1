<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .event-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .event-card:hover {
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
        .event-card .card-body {
            padding: 1.5rem;
        }
        .event-card .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }
        .event-card .card-text {
            color: #666;
            margin-bottom: 1rem;
        }
        .event-date, .event-location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: #666;
        }
        .event-date i, .event-location i {
            color: #4ecdc4;
        }
        .card-footer {
            background: white;
            border-top: 1px solid rgba(0,0,0,0.1);
            padding: 1rem;
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
            flex-wrap: wrap;
        }
        .page-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        .btn-view-details {
            background-color: #4ecdc4;
            color: white;
            border: none;
        }
        .btn-view-details:hover {
            background-color: #45b7d1;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('events.index') }}" class="text-2xl font-bold text-indigo-600">Événements</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('events.index') }}" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Événements</a>
                        <a href="{{ route('bookings.index') }}" class="text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Mes Réservations</a>
                        <a href="{{ route('invitation-templates.my-invitations') }}" class="text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Mes Invitations</a>
                        <a href="{{ route('service-providers.index') }}" class="text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Prestataires</a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <div class="ml-3 relative">
                        <button id="profileDropdown" class="flex items-center text-gray-500 hover:text-gray-900 focus:outline-none">
                            <i class="fas fa-user-circle text-xl mr-2"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div id="profileDropdownMenu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 hidden">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon Profil</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="sm:hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('events.index') }}" class="bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Événements</a>
                <a href="{{ route('bookings.index') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Mes Réservations</a>
                <a href="{{ route('invitation-templates.my-invitations') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Mes Invitations</a>
                <a href="{{ route('service-providers.index') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Prestataires</a>
                <a href="{{ route('profile') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Mon Profil</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium w-full text-left">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="page-header text-center">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="display-4 text-4xl font-bold">Événements à venir</h1>
            <p class="lead mt-2 text-lg">Découvrez et participez aux prochains événements</p>
        </div>
    </div>

    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(Auth::user()->role === 'organisateur')
        <div class="mb-4 text-right">
            <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                <i class="fas fa-plus-circle mr-2"></i>Créer un événement
            </a>
        </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="event-card bg-white rounded-xl h-full flex flex-col">
                    <div class="event-logo-container">
                        @if($event->logo_path)
                            <img src="{{ asset('storage/' . $event->logo_path) }}" alt="Logo de l'événement" class="event-logo">
                        @else
                            <i class="fas fa-calendar-alt text-6xl text-white"></i>
                        @endif
                    </div>
                    <div class="card-body flex-grow">
                        <h3 class="card-title text-xl font-semibold">{{ $event->title }}</h3>
                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                        <div class="event-date">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ $event->date }}</span>
                            <i class="far fa-clock ml-3"></i>
                            <span>{{ $event->time }}</span>
                        </div>
                        <div class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $event->location }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="action-buttons">
                            <a href="{{ route('events.show', $event) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                <i class="fas fa-eye mr-1"></i>Voir détails
                            </a>
                            @if(Auth::user()->role === 'admin' && Auth::id() === $event->user_id)
                                <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-4 py-2 border border-indigo-500 text-indigo-500 rounded-md hover:bg-indigo-50">
                                    <i class="fas fa-edit mr-1"></i>Modifier
                                </a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-50">
                                        <i class="fas fa-trash-alt mr-1"></i>Supprimer
                                    </button>
                                </form>
                            @elseif(Auth::user()->role === 'organisateur' && Auth::id() === $event->user_id)
                                <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-4 py-2 border border-indigo-500 text-indigo-500 rounded-md hover:bg-indigo-50">
                                    <i class="fas fa-edit mr-1"></i>Modifier
                                </a>
                                <a href="{{ route('bookings.event', $event) }}" class="inline-flex items-center px-4 py-2 border border-green-500 text-green-500 rounded-md hover:bg-green-50">
                                    <i class="fas fa-users mr-1"></i>Gérer les réservations
                                </a>
                            @elseif(Auth::user()->role === 'user')
                                @php
                                    $booking = $event->bookings()->where('user_id', Auth::id())->first();
                                @endphp
                                @if($booking)
                                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                    @if($booking->status !== 'cancelled')
                                        <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-50">
                                                <i class="fas fa-times mr-1"></i>Annuler
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <form action="{{ route('bookings.store', $event) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                            <i class="fas fa-calendar-check mr-1"></i>Réserver
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