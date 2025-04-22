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
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-white shadow-md">
      <div class="p-6">
        <div class="mb-8">
          <h2 class="text-xl font-semibold mb-2">Account</h2>
          <div class="text-blue-600">
            <span class="text-gray-500">> </span>
            <span>My Profile</span>
          </div>
        </div>

        <nav class="space-y-4">
          <a href="{{ route('profile') }}" class="flex items-center text-blue-600 py-2">
            <i class="fas fa-user mr-3"></i>
            My Profile
          </a>
          <a href="{{ route('events.index') }}" class="flex items-center text-gray-600 py-2">
            <i class="fas fa-calendar mr-3"></i>
            Bookings
          </a>
          <a href="#" class="flex items-center text-gray-600 py-2">
            <i class="fas fa-cog mr-3"></i>
            Settings
          </a>
          <a href="#" class="flex items-center text-gray-600 py-2">
            <i class="fas fa-envelope mr-3"></i>
            Contact us
          </a>
        </nav>

        <div class="absolute bottom-0 left-0 w-full p-6">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center text-gray-600 py-2 w-full">
              <i class="fas fa-sign-out-alt mr-3"></i>
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
      <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold">Settings</h1>
        </div>

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

        <!-- Profile Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
          <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
              @if($user->profile_picture)
                <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" 
                  class="w-16 h-16 rounded-full object-cover">
              @else
                <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                  <i class="fas fa-user text-2xl text-gray-400"></i>
                </div>
              @endif
              <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
            </div>
            <button type="button" onclick="document.getElementById('profile_picture').click()" 
              class="text-red-500 hover:text-red-600">
              Edit Profile
            </button>
          </div>

          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-6">
              <!-- First Name -->
              <div>
                <label class="block text-sm text-gray-500 mb-1">First Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
              </div>

              <!-- Last Name -->
              <div>
                <label class="block text-sm text-gray-500 mb-1">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', '') }}" 
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
              </div>

              <!-- Username -->
              <div class="col-span-2">
                <label class="block text-sm text-gray-500 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->email) }}" 
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
              </div>

              <!-- Email -->
              <div>
                <label class="block text-sm text-gray-500 mb-1">Billing Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
              </div>

              <!-- Status -->
              <div>
                <label class="block text-sm text-gray-500 mb-1">Status</label>
                <input type="text" value="Active" disabled 
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-50">
              </div>

              <!-- Zip Code -->
              <div>
                <label class="block text-sm text-gray-500 mb-1">Zip code</label>
                <input type="text" name="zip_code" value="{{ old('zip_code', '') }}" 
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
              </div>

              <!-- Phone -->
              <div>
                <label class="block text-sm text-gray-500 mb-1">Contact</label>
                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" 
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
              </div>

              <!-- Address -->
              <div>
                <label class="block text-sm text-gray-500 mb-1">Address</label>
                <input type="text" name="address" value="{{ old('address', '') }}" 
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
              </div>

              <!-- City -->
              <div>
                <label class="block text-sm text-gray-500 mb-1">City</label>
                <input type="text" name="city" value="{{ old('city', '') }}" 
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
              </div>

              <!-- Hidden file input -->
              <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*" 
                onchange="this.form.submit()">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>