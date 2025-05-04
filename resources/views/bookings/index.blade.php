<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
                        <a href="{{ route('events.index') }}" class="text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Événements</a>
                        <a href="{{ route('bookings.index') }}" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Mes Réservations</a>
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
                <a href="{{ route('events.index') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Événements</a>
                <a href="{{ route('bookings.index') }}" class="bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Mes Réservations</a>
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
            <h1 class="display-4 text-4xl font-bold">{{ Auth::user()->role === 'organisateur' ? 'Gestion des Réservations' : 'Mes Réservations' }}</h1>
            <p class="lead mt-2 text-lg">{{ Auth::user()->role === 'organisateur' ? 'Gérez les réservations pour vos événements' : 'Gérez vos réservations d\'événements' }}</p>
        </div>
    </div>

    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

        <div class="mb-4">
            <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 border border-indigo-500 text-indigo-500 rounded-md hover:bg-indigo-50">
                <i class="fas fa-arrow-left mr-2"></i>Retour aux événements
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($bookings as $booking)
                <div class="booking-card bg-white rounded-xl overflow-hidden">
                    <div class="event-logo-container">
                        @if($booking->event->logo_path)
                            <img src="{{ asset('storage/' . $booking->event->logo_path) }}" alt="Logo de l'événement" class="event-logo">
                        @else
                            <i class="fas fa-calendar-alt text-6xl text-white"></i>
                        @endif
                    </div>
                    <div class="p-6">
                        <h5 class="text-xl font-semibold">{{ $booking->event->title }}</h5>
                        <p class="text-gray-600 mt-2">{{ $booking->event->description }}</p>
                        <p class="text-gray-500 mt-3">
                            <i class="far fa-calendar-alt mr-2"></i>{{ $booking->event->date }}<br>
                            <i class="far fa-clock mr-2"></i>{{ $booking->event->time }}<br>
                            <i class="fas fa-map-marker-alt mr-2"></i>{{ $booking->event->location }}
                        </p>
                        <div class="mt-3">
                            <p class="text-gray-500">
                                <i class="fas fa-euro-sign mr-2"></i>Prix: {{ $booking->event->price }}€
                            </p>
                            <p class="mt-2">
                                <span class="status-badge inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-800' : ($booking->payment_status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </p>
                            @if($booking->payment_status === 'pending' && in_array(Auth::user()->role, ['user', 'client']))
                                <div class="mt-3">
                                    <a href="{{ route('payment.form', $booking) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                        <i class="fas fa-credit-card mr-2"></i>Payer maintenant
                                    </a>
                                </div>
                            @endif
                        </div>
                        @if(Auth::user()->role === 'organisateur')
                            <p class="text-gray-500 mt-3">
                                <i class="fas fa-user mr-2"></i>{{ $booking->user->name }}<br>
                                <i class="fas fa-envelope mr-2"></i>{{ $booking->user->email }}
                                @if($booking->user->phone)
                                    <br><i class="fas fa-phone mr-2"></i>{{ $booking->user->phone }}
                                @endif
                            </p>
                        @endif
                        <div class="mt-4 flex justify-between items-center">
                            <span class="status-badge inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : ($booking->status === 'rejected' ? 'bg-gray-100 text-gray-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                            @if(Auth::user()->role === 'organisateur')
                                <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST" class="flex">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="border-gray-300 rounded-l-md text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                                        <option value="rejected" {{ $booking->status === 'rejected' ? 'selected' : '' }}>Rejeté</option>
                                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                    </select>
                                    <button type="submit" class="px-3 py-2 bg-indigo-600 text-white rounded-r-md hover:bg-indigo-700">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </form>
                            @elseif($booking->status !== 'cancelled')
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-50">
                                        <i class="fas fa-times mr-1"></i>Annuler
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center">
                    <p class="text-lg text-gray-600">Vous n'avez pas encore de réservations.</p>
                    <a href="{{ route('events.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        <i class="fas fa-calendar-alt mr-2"></i>Voir les événements
                    </a>
                </div>
            @endforelse
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