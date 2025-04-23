<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md">
            <div class="p-6 border-b">
            <img src="{{ asset('images/hafla_logo.png') }}" alt="Logo" class="mx-auto h-20 w-20 rounded-full">
                <h1 class="text-center text-xl font-bold mt-4">Hafla planner</h1>
            </div>
            
            <nav class="p-4">
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
                        <a href="#" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-users mr-3"></i>
                            Participants
                        </a>
                    </li>
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
        <div class="flex-1 bg-gray-100">
            <!-- Header -->
            <header class="bg-white shadow-md p-6 flex justify-between items-center">
                <div class="flex items-center">
                    <h2 class="text-2xl font-bold">Bienvenue, {{ Auth::user()->name }}</h2>
                </div>
                <div class="flex items-center space-x-4">
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
                <div class="grid grid-cols-3 gap-6">
                    
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-gray-500 uppercase text-sm">Total Événements</h3>
                                <p class="text-3xl font-bold text-blue-600">24</p>
                            </div>
                            <i class="fas fa-calendar-alt text-3xl text-blue-300"></i>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-gray-500 uppercase text-sm">Participants</h3>
                                <p class="text-3xl font-bold text-green-600">1,245</p>
                            </div>
                            <i class="fas fa-users text-3xl text-green-300"></i>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-gray-500 uppercase text-sm">Revenus</h3>
                                <p class="text-3xl font-bold text-purple-600">€45,678</p>
                            </div>
                            <i class="fas fa-euro-sign text-3xl text-purple-300"></i>
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

                
                <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">Activité Récente</h3>
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600">
                                <th class="p-3 text-left">Événement</th>
                                <th class="p-3 text-left">Date</th>
                                <th class="p-3 text-left">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-3">Conférence Tech 2025</td>
                                <td class="p-3">15 Mars 2025</td>
                                <td class="p-3">
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full">Terminé</span>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-3">Séminaire Marketing</td>
                                <td class="p-3">22 Avril 2025</td>
                                <td class="p-3">
                                    <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full">En cours</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-3">Workshop Innovation</td>
                                <td class="p-3">05 Mai 2025</td>
                                <td class="p-3">
                                    <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full">À venir</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>