@extends('layouts.app')

@php
use Carbon\Carbon;
@endphp

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Responsive Layout */
        @media (max-width: 1024px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                position: static;
                margin-bottom: 2rem;
            }
            
            .main-content {
                width: 100%;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-card {
                padding: 1rem;
                margin-bottom: 1rem;
            }
            
            .header {
                flex-direction: column;
                gap: 1rem;
            }
            
            .header-buttons {
                width: 100%;
                justify-content: center;
            }
            
            .header-buttons button {
                width: 100%;
                margin: 0.5rem 0;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                padding: 1rem;
            }
            
            .sidebar-logo {
                margin-bottom: 1rem;
            }
            
            .sidebar-logo img {
                width: 40px;
                height: 40px;
            }
            
            .sidebar-logo h1 {
                font-size: 1rem;
                margin-top: 0.5rem;
            }
            
            .sidebar-nav {
                padding: 0.5rem;
            }
            
            .sidebar-nav ul {
                padding: 0;
            }
            
            .sidebar-nav li {
                margin-bottom: 0.5rem;
            }
            
            .sidebar-nav a {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
            
            .header {
                padding: 1rem;
            }
            
            .header h2 {
                font-size: 1.5rem;
            }
            
            .stats-card {
                padding: 0.75rem;
            }
            
            .stats-card h3 {
                font-size: 0.9rem;
            }
            
            .stats-card p {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="dashboard-container flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 bg-white shadow-md">
            <div class="sidebar-logo p-6 border-b">
                <img src="{{ asset('images/hafla_logo.png') }}" alt="Logo" class="mx-auto h-20 w-20 rounded-full">
                <h1 class="text-center text-xl font-bold mt-4">Event Hive</h1>
            </div>
            
            <nav class="sidebar-nav p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('profile') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Tableau de bord
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events.index') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-calendar mr-3"></i>
                            Événements
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('participants.index') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-users mr-3"></i>
                            Participants
                        </a>
                    </li>
                    @if(Auth::user()->role === 'organisateur')
                    <li>
                        <a href="{{ route('guests.overview') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-user-friends mr-3"></i>
                            Gérer les invités
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bookings.index') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-ticket-alt mr-3"></i>
                            Gérer les réservations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('invitation-templates.index') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-envelope mr-3"></i>
                            Modèles d'invitations
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role === 'admin')
                    <li>
                        <a href="{{ route('admin.users') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-user-cog mr-3"></i>
                            Gérer les utilisateurs
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 bg-gray-100">
            <!-- Header -->
            <header class="bg-white shadow-md p-6 header flex justify-between items-center">
                <div class="flex items-center">
                    <h2 class="text-2xl font-bold">Bienvenue, {{ Auth::user()->name }}</h2>
                </div>
                <div class="flex items-center space-x-4 header-buttons">
                    <span class="text-gray-600">
                        <i class="fas fa-user-tag mr-2"></i>
                        Rôle : {{ Auth::user()->role }}
                    </span>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button 
                            type="submit" 
                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 flex items-center"
                        >
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-8">
                <div class="stats-grid grid grid-cols-3 gap-6">
                    <!-- Quick Stats Cards -->
                    <div class="stats-card bg-white p-6 rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-gray-500 uppercase text-sm">Total Événements</h3>
                                <p class="text-3xl font-bold text-blue-600">{{ $totalEvents }}</p>
                            </div>
                            <i class="fas fa-calendar-alt text-3xl text-blue-300"></i>
                        </div>
                    </div>

                    <div class="stats-card bg-white p-6 rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-gray-500 uppercase text-sm">Participants</h3>
                                <p class="text-3xl font-bold text-green-600">{{ $totalParticipants }}</p>
                            </div>
                            <i class="fas fa-users text-3xl text-green-300"></i>
                        </div>
                    </div>

                    <div class="stats-card bg-white p-6 rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-gray-500 uppercase text-sm">Réservations</h3>
                                <p class="text-3xl font-bold text-purple-600">{{ $totalBookings }}</p>
                            </div>
                            <i class="fas fa-ticket-alt text-3xl text-purple-300"></i>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->role === 'admin')
                <!-- Admin Actions -->
                <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">Actions Administrateur</h3>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.users') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg flex items-center transition duration-300">
                            <i class="fas fa-users-cog mr-2"></i>
                            Gérer les Utilisateurs
                        </a>
                    </div>
                </div>
                @endif

                <!-- Recent Activity -->
                <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">Activité Récente</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600">
                                    <th class="p-3 text-left">Événement</th>
                                    <th class="p-3 text-left">Date</th>
                                    <th class="p-3 text-left">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentEvents as $event)
                                    <tr class="border-b">
                                        <td class="p-3">{{ $event->title }}</td>
                                        <td class="p-3">{{ $event->date->format('d/m/Y') }}</td>
                                        <td class="p-3">
                                            @php
                                                $now = Carbon::now();
                                                $eventDate = Carbon::parse($event->date);
                                                
                                                if ($eventDate->isPast()) {
                                                    $status = 'Terminé';
                                                    $class = 'bg-secondary';
                                                } elseif ($eventDate->isToday()) {
                                                    $status = 'En cours';
                                                    $class = 'bg-success';
                                                } else {
                                                    $status = 'À venir';
                                                    $class = 'bg-primary';
                                                }
                                            @endphp
                                            <span class="badge {{ $class }}">{{ $status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="p-3 text-center">Aucun événement trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
@endsection