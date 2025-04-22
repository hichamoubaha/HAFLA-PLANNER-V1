<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon Profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
  <div class="min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-md p-6">
      <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Mon Profil</h1>
        <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
          <i class="fas fa-arrow-left mr-2"></i>
          Retour au Tableau de Bord
        </a>
      </div>
    </header>

    <div class="container mx-auto px-4 py-8">
      @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
          <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif

      @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
          @csrf
          @method('PUT')

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
              <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Current Password -->
            <div>
              <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
              <input type="password" name="current_password" id="current_password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- New Password -->
            <div>
              <label for="new_password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
              <input type="password" name="new_password" id="new_password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Confirm Password -->
            <div>
              <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
              <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
          </div>

          <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
              <i class="fas fa-save mr-2"></i>
              Enregistrer les modifications
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>