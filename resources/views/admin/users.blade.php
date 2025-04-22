<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white px-6 py-4 flex items-center justify-between">
                <h2 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-users mr-3"></i>
                    Liste des Utilisateurs
                </h2>
                <div class="flex items-center space-x-3">
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter Utilisateur
                    </button>
                    <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md flex items-center">
                        <i class="fas fa-filter mr-2"></i>
                        Filtrer
                    </button>
                </div>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Nom</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-center">Rôle</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($users as $user)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $user->id }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @php
                                        $roleColors = [
                                            'admin' => 'bg-red-200 text-red-600',
                                            'user' => 'bg-green-200 text-green-600',
                                            'moderator' => 'bg-blue-200 text-blue-600'
                                        ];
                                        $colorClass = $roleColors[$user->role] ?? 'bg-gray-200 text-gray-600';
                                    @endphp
                                    <span class="{{ $colorClass }} py-1 px-3 rounded-full text-xs">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <button class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                <a href="/dashboard" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour au Tableau de Bord
                </a>
                <div class="text-gray-600">
                    Total Utilisateurs: {{ count($users) }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>