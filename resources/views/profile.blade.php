<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon Profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .gradient-bg {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    }
    .custom-shadow {
      box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1), 0 8px 10px -6px rgba(59, 130, 246, 0.1);
    }
    .icon-gradient {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .hover-scale {
      transition: transform 0.3s ease;
    }
    .hover-scale:hover {
      transform: scale(1.03);
    }
  </style>
</head>

<body class="bg-gray-50">
  <div class="min-h-screen flex">
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 w-72 h-full bg-white shadow-lg z-10">
      <div class="p-6 h-full flex flex-col">
        <div class="mb-10">
          <div class="flex items-center space-x-3 mb-8">
            <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center text-white">
              <i class="fas fa-user-circle text-xl"></i>
            </div>
            <h1 class="text-xl font-bold text-gray-800">My Account</h1>
          </div>
          
          <div class="pl-2 border-l-4 border-indigo-600 py-1">
            <span class="text-indigo-600 font-medium">My Profile</span>
          </div>
        </div>

        <nav class="flex-1 space-y-1">
          <a href="{{ route('profile') }}" class="flex items-center px-4 py-3 text-indigo-600 bg-indigo-50 rounded-lg">
            <i class="fas fa-user text-lg w-6"></i>
            <span class="ml-3 font-medium">My Profile</span>
          </a>
          <a href="{{ route('events.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
            <i class="fas fa-calendar text-lg w-6 text-gray-500"></i>
            <span class="ml-3">Bookings</span>
          </a>
          @if($user->role === 'user' || $user->role === 'organisateur')
          <a href="{{ route('service-providers.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
            <i class="fas fa-users-cog text-lg w-6 text-gray-500"></i>
            <span class="ml-3">Service Providers</span>
          </a>
          @endif
          <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
            <i class="fas fa-cog text-lg w-6 text-gray-500"></i>
            <span class="ml-3">Settings</span>
          </a>
          <a href="{{ url('/contact') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
            <i class="fas fa-envelope text-lg w-6 text-gray-500"></i>
            <span class="ml-3">Contact us</span>
          </a>
        </nav>

        <div class="pt-6 border-t border-gray-200 mt-6">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center text-gray-700 hover:text-red-600 py-2 w-full transition-colors">
              <i class="fas fa-sign-out-alt text-lg w-6"></i>
              <span class="ml-3">Logout</span>
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="ml-72 p-8 w-full">
      <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
          <div>
            <h1 class="text-3xl font-bold text-gray-800">My Profile</h1>
            <p class="text-gray-500 mt-1">Manage your personal information and account settings</p>
          </div>
          <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">Last updated: Today</span>
            <div class="h-6 w-6 bg-green-400 rounded-full flex items-center justify-center">
              <i class="fas fa-check text-white text-xs"></i>
            </div>
          </div>
        </div>

        @if(session('success'))
          <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6 flex items-center" role="alert">
            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
            <span class="block sm:inline">{{ session('success') }}</span>
          </div>
        @endif

        @if($errors->any())
          <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6" role="alert">
            <div class="flex items-center mb-2">
              <i class="fas fa-exclamation-circle text-red-500 mr-3 text-lg"></i>
              <span class="font-medium">Please correct the following errors:</span>
            </div>
            <ul class="list-disc ml-6">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Profile Card -->
        <div class="bg-white rounded-xl custom-shadow p-8 mb-6 relative overflow-hidden">
          <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50 rounded-full -mr-32 -mt-32 z-0"></div>
          <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-50 rounded-full -ml-24 -mb-24 z-0"></div>

          <div class="relative z-10">
            <div class="flex items-start justify-between mb-8">
              <div class="flex items-center">
                @if($user->profile_picture)
                  <div class="relative group">
                    <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" 
                      class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                    <div onclick="document.getElementById('profile_picture').click()" 
                      class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity">
                      <i class="fas fa-camera text-white text-xl"></i>
                    </div>
                  </div>
                @else
                  <div class="relative group">
                    <div class="w-24 h-24 rounded-full gradient-bg flex items-center justify-center shadow-lg border-4 border-white">
                      <i class="fas fa-user text-3xl text-white"></i>
                    </div>
                    <div onclick="document.getElementById('profile_picture').click()" 
                      class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity">
                      <i class="fas fa-camera text-white text-xl"></i>
                    </div>
                  </div>
                @endif
                <div class="ml-6">
                  <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                  <div class="flex items-center mt-1 text-gray-500">
                    <i class="fas fa-envelope mr-2"></i>
                    <span>{{ $user->email }}</span>
                  </div>
                  <div class="flex items-center mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                      <i class="fas fa-check-circle mr-1"></i> Active
                    </span>
                  </div>
                </div>
              </div>
              <button type="button" onclick="document.getElementById('profile_picture').click()" 
                class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition-colors">
                <i class="fas fa-camera mr-2"></i> Change Photo
              </button>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Personal Information Section -->
                <div class="md:col-span-2">
                  <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-circle mr-2 text-indigo-600"></i>
                    Personal Information
                  </h3>
                </div>

                <!-- First Name -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                      <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                      class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                  </div>
                </div>

                <!-- Last Name -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                      <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="last_name" value="{{ old('last_name', '') }}" 
                      class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                  </div>
                </div>

                <!-- Username -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                      <i class="fas fa-at"></i>
                    </span>
                    <input type="text" name="username" value="{{ old('username', $user->email) }}" 
                      class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                  </div>
                </div>

                <!-- Email -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Billing Email</label>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                      <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                      class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                  </div>
                </div>

                <!-- Contact Information Section -->
                <div class="md:col-span-2 mt-6">
                  <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-address-card mr-2 text-indigo-600"></i>
                    Contact Information
                  </h3>
                </div>

                <!-- Phone -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                      <i class="fas fa-phone"></i>
                    </span>
                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" 
                      class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                  </div>
                </div>

                <!-- Status -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Account Status</label>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                      <i class="fas fa-check-circle"></i>
                    </span>
                    <input type="text" value="Active" disabled 
                      class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 text-gray-500">
                  </div>
                </div>

                <!-- Address Section -->
                <div class="md:col-span-2 mt-6">
                  <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i>
                    Address Information
                  </h3>
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                      <i class="fas fa-home"></i>
                    </span>
                    <input type="text" name="address" value="{{ old('address', '') }}" 
                      class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                  </div>
                </div>

                <!-- City -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                      <i class="fas fa-city"></i>
                    </span>
                    <input type="text" name="city" value="{{ old('city', '') }}" 
                      class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                  </div>
                </div>

                <!-- Zip Code -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Zip Code</label>
                  <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                      <i class="fas fa-map-pin"></i>
                    </span>
                    <input type="text" name="zip_code" value="{{ old('zip_code', '') }}" 
                      class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                  </div>
                </div>

                <!-- Hidden file input -->
                <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*" 
                  onchange="this.form.submit()">
              </div>

              <div class="mt-10 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow transition-colors">
                  <i class="fas fa-save mr-2"></i> Save Changes
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
          <div class="bg-white p-6 rounded-xl custom-shadow hover-scale">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center text-white mr-4">
                <i class="fas fa-lock text-xl"></i>
              </div>
              <h3 class="text-lg font-semibold text-gray-800">Security</h3>
            </div>
            <p class="text-gray-600 mb-4">Manage your password and security settings</p>
            <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center">
              <span>Change password</span>
              <i class="fas fa-arrow-right ml-2"></i>
            </a>
          </div>

          <div class="bg-white p-6 rounded-xl custom-shadow hover-scale">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center text-white mr-4">
                <i class="fas fa-bell text-xl"></i>
              </div>
              <h3 class="text-lg font-semibold text-gray-800">Notifications</h3>
            </div>
            <p class="text-gray-600 mb-4">Customize how you receive alerts and updates</p>
            <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center">
              <span>Notification preferences</span>
              <i class="fas fa-arrow-right ml-2"></i>
            </a>
          </div>

          <div class="bg-white p-6 rounded-xl custom-shadow hover-scale">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center text-white mr-4">
                <i class="fas fa-users text-xl"></i>
              </div>
              <h3 class="text-lg font-semibold text-gray-800">Connected Accounts</h3>
            </div>
            <p class="text-gray-600 mb-4">Manage linked social accounts and applications</p>
            <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center">
              <span>View connections</span>
              <i class="fas fa-arrow-right ml-2"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>