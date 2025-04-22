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

      <!-- Profile Picture Section -->
      <div class="flex flex-col items-center mb-8">
        <div class="relative">
          @if($user->profile_picture)
            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" 
              class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg">
          @else
            <div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center border-4 border-white shadow-lg">
              <i class="fas fa-user text-6xl text-gray-400"></i>
            </div>
          @endif
        </div>
        <h2 class="mt-4 text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
        <p class="text-gray-600">{{ $user->email }}</p>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

            <!-- Phone -->
            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
              <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Profile Picture -->
            <div>
              <label for="profile_picture" class="block text-sm font-medium text-gray-700">Photo de profil</label>
              <div class="mt-2 flex items-center space-x-4">
                <div class="flex-shrink-0">
                  @if($user->profile_picture)
                    <img src="{{ Storage::url($user->profile_picture) }}" alt="Current Profile Picture" 
                      class="w-20 h-20 rounded-full object-cover">
                  @else
                    <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                      <i class="fas fa-user text-3xl text-gray-400"></i>
                    </div>
                  @endif
                </div>
                <div class="flex-1">
                  <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                  <p class="mt-1 text-sm text-gray-500">PNG, JPG ou GIF jusqu'à 2MB</p>
                </div>
              </div>
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