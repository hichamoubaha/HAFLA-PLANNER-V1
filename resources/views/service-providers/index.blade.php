<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Providers</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Base Styles */
        :root {
            --primary: #4F46E5;
            --primary-light: #6366F1;
            --primary-dark: #4338CA;
            --secondary: #10B981;
            --dark: #1F2937;
            --light: #F9FAFB;
            --gray: #6B7280;
            --light-gray: #E5E7EB;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
        }
        
        .catalog-container {
            background-color: #F9FAFB;
            min-height: 100vh;
            padding: 2rem 1rem;
            background-image: url('https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }
        
        .catalog-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(249, 250, 251, 0.9);
            z-index: 0;
        }
        
        .container {
            position: relative;
            z-index: 1;
        }
        
        /* Header Styles */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
            position: relative;
            padding-left: 1.5rem;
        }
        
        .page-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 6px;
            background: var(--primary);
            border-radius: 6px;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .back-button {
            background: white;
            color: var(--gray);
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--light-gray);
        }
        
        .back-button:hover {
            background: var(--light);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .back-button i {
            margin-right: 0.5rem;
            color: var(--primary);
        }
        
        .add-button {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25);
        }
        
        .add-button:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.3);
        }
        
        .add-button i {
            margin-right: 0.5rem;
        }
        
        /* Filter Section */
        .filter-card {
            background-color: white;
            border-radius: 1.25rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 3rem;
            border: none;
            position: relative;
            overflow: hidden;
        }
        
        .filter-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
        }
        
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
        }
        
        @media (min-width: 768px) {
            .filter-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .filter-group {
            margin-bottom: 0;
        }
        
        .filter-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .filter-label i {
            margin-right: 0.5rem;
            color: var(--primary);
        }
        
        .filter-input, .filter-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 0.75rem;
            font-size: 0.95rem;
            color: var(--dark);
            transition: all 0.3s ease;
            background-color: var(--light);
        }
        
        .filter-input:focus, .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }
        
        .filter-input::placeholder {
            color: #9CA3AF;
        }
        
        .filter-button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
            grid-column: 1 / -1;
        }
        
        .filter-button {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25);
        }
        
        .filter-button:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.3);
        }
        
        .filter-button i {
            margin-right: 0.5rem;
        }
        
        .reset-button {
            background: white;
            color: var(--gray);
            padding: 0.875rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            border: 1px solid var(--light-gray);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }
        
        .reset-button:hover {
            background: var(--light);
            color: var(--dark);
        }
        
        .reset-button i {
            margin-right: 0.5rem;
        }
        
        /* Providers Grid */
        .providers-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 2rem;
        }
        
        @media (min-width: 768px) {
            .providers-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .providers-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        /* Provider Card */
        .provider-card {
            background-color: white;
            border-radius: 1.25rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .provider-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .provider-tag {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            padding: 0.375rem 1rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            backdrop-filter: blur(5px);
            z-index: 2;
        }
        
        .provider-image-container {
            height: 200px;
            width: 100%;
            overflow: hidden;
            position: relative;
        }
        
        .provider-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .provider-card:hover .provider-image {
            transform: scale(1.05);
        }
        
        .provider-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #E0E7FF, #C7D2FE);
        }
        
        .provider-image-placeholder i {
            font-size: 3rem;
            color: var(--primary);
            opacity: 0.5;
        }
        
        .provider-content {
            padding: 1.75rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .provider-header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.25rem;
        }
        
        .provider-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 1rem;
            flex-shrink: 0;
            border: 3px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: -40px;
            background: white;
            position: relative;
            z-index: 1;
        }
        
        .provider-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .provider-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #E0E7FF, #C7D2FE);
        }
        
        .provider-avatar-placeholder i {
            font-size: 1.5rem;
            color: var(--primary);
        }
        
        .provider-info-container {
            flex: 1;
        }
        
        .provider-name {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0 0 0.25rem 0;
            line-height: 1.3;
        }
        
        .provider-rating {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .rating-stars {
            display: flex;
            margin-right: 0.5rem;
        }
        
        .rating-star {
            color: var(--warning);
            font-size: 0.875rem;
        }
        
        .rating-value {
            font-weight: 600;
            color: var(--dark);
            margin-right: 0.25rem;
        }
        
        .rating-count {
            color: var(--gray);
            font-size: 0.75rem;
        }
        
        .provider-description {
            color: var(--gray);
            margin-bottom: 1.5rem;
            line-height: 1.5;
            flex: 1;
        }
        
        .provider-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
        }
        
        .meta-item i {
            margin-right: 0.5rem;
            color: var(--primary);
        }
        
        .meta-price {
            font-weight: 600;
            color: var(--success);
        }
        
        .view-button {
            display: block;
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 0.875rem;
            text-align: center;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            margin-top: auto;
        }
        
        .view-button:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.3);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background-color: white;
            border-radius: 1.25rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            margin: 2rem 0;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }
        
        .empty-state-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .empty-state-text {
            color: var(--gray);
            margin-bottom: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        
        .empty-state-button {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25);
        }
        
        .empty-state-button:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.3);
        }
        
        /* Pagination */
        .pagination {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-color: var(--primary);
        }
        
        .pagination .page-link {
            color: var(--primary);
            border-radius: 0.75rem;
            margin: 0 0.25rem;
            border: 1px solid var(--light-gray);
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .pagination .page-link:hover {
            background-color: var(--light);
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .provider-card {
            animation: fadeIn 0.5s ease forwards;
            opacity: 0;
        }
        
        .provider-card:nth-child(1) { animation-delay: 0.1s; }
        .provider-card:nth-child(2) { animation-delay: 0.2s; }
        .provider-card:nth-child(3) { animation-delay: 0.3s; }
        .provider-card:nth-child(4) { animation-delay: 0.4s; }
        .provider-card:nth-child(5) { animation-delay: 0.5s; }
        .provider-card:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('events.index') }}" class="text-2xl font-bold text-indigo-600">Hafla Planner</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('events.index') }}" class="text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Événements</a>
                        <a href="{{ route('bookings.index') }}" class="text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Mes Réservations</a>
                        <a href="{{ route('invitation-templates.my-invitations') }}" class="text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Mes Invitations</a>
                        <a href="{{ route('service-providers.index') }}" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Prestataires</a>
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
                <a href="{{ route('bookings.index') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Mes Réservations</a>
                <a href="{{ route('invitation-templates.my-invitations') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Mes Invitations</a>
                <a href="{{ route('service-providers.index') }}" class="bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Prestataires</a>
                <a href="{{ route('profile') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Mon Profil</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium w-full text-left">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="catalog-container">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="page-header">
                <div class="header-actions">
                    <a href="{{ url()->previous() }}" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </a>
                    <h1 class="page-title">Find Your Perfect Service Provider</h1>
                </div>
                @if(auth()->user()->role === 'prestataire')
                    <a href="{{ route('service-providers.create') }}" class="add-button">
                        <i class="fas fa-plus"></i>Add My Profile
                    </a>
                @endif
            </div>

            <!-- Filter Section -->
            <div class="filter-card">
                <form action="{{ route('service-providers.index') }}" method="GET">
                    <div class="filter-grid">
                        <div class="filter-group">
                            <label class="filter-label" for="location">
                                <i class="fas fa-map-marker-alt"></i>Location
                            </label>
                            <div class="input-wrapper">
                                <input type="text" id="location" name="location" value="{{ request('location') }}" 
                                    class="filter-input" placeholder="Enter city or region...">
                            </div>
                        </div>
                        
                        <div class="filter-group">
                            <label class="filter-label" for="service_type">
                                <i class="fas fa-tags"></i>Service Type
                            </label>
                            <select name="service_type" id="service_type" class="filter-select">
                                <option value="">All Services</option>
                                <option value="photographe" {{ request('service_type') === 'photographe' ? 'selected' : '' }}>Photographer</option>
                                <option value="dj" {{ request('service_type') === 'dj' ? 'selected' : '' }}>DJ</option>
                                <option value="traiteur" {{ request('service_type') === 'traiteur' ? 'selected' : '' }}>Caterer</option>
                                <option value="decoration" {{ request('service_type') === 'decoration' ? 'selected' : '' }}>Decorator</option>
                                <option value="music" {{ request('service_type') === 'music' ? 'selected' : '' }}>Live Music</option>
                                <option value="venue" {{ request('service_type') === 'venue' ? 'selected' : '' }}>Venue</option>
                                <option value="planner" {{ request('service_type') === 'planner' ? 'selected' : '' }}>Event Planner</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label" for="min_budget">
                                <i class="fas fa-euro-sign"></i>Min Budget
                            </label>
                            <input type="number" id="min_budget" name="min_budget" value="{{ request('min_budget') }}" 
                                class="filter-input" placeholder="€100">
                        </div>

                        <div class="filter-group">
                            <label class="filter-label" for="max_budget">
                                <i class="fas fa-euro-sign"></i>Max Budget
                            </label>
                            <input type="number" id="max_budget" name="max_budget" value="{{ request('max_budget') }}" 
                                class="filter-input" placeholder="€5000">
                        </div>

                        <div class="filter-button-container">
                            <a href="{{ route('service-providers.index') }}" class="reset-button">
                                <i class="fas fa-undo"></i>Reset
                            </a>
                            <button type="submit" class="filter-button">
                                <i class="fas fa-search"></i>Search Providers
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Providers List -->
            @if(count($providers) > 0)
                <div class="providers-grid">
                    @foreach($providers as $provider)
                        <div class="provider-card">
                            <div class="provider-tag">{{ ucfirst($provider->service_type) }}</div>
                            
                            <div class="provider-image-container">
                                @if($provider->cover_photo)
                                    <img src="{{ asset('storage/' . $provider->cover_photo) }}" 
                                        alt="{{ $provider->business_name }}" 
                                        class="provider-image">
                                @else
                                    <div class="provider-image-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="provider-content">
                                <div class="provider-header">
                                    <div class="provider-avatar">
                                        @if($provider->profile_picture)
                                            <img src="{{ asset('storage/' . $provider->profile_picture) }}" 
                                                alt="{{ $provider->business_name }}">
                                        @else
                                            <div class="provider-avatar-placeholder">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="provider-info-container">
                                        <h2 class="provider-name">{{ $provider->business_name }}</h2>
                                        <div class="provider-rating">
                                            <div class="rating-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= floor($provider->rating))
                                                        <i class="fas fa-star rating-star"></i>
                                                    @elseif($i - 0.5 <= $provider->rating)
                                                        <i class="fas fa-star-half-alt rating-star"></i>
                                                    @else
                                                        <i class="far fa-star rating-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="rating-value">{{ number_format($provider->rating, 1) }}</span>
                                            <span class="rating-count">({{ $provider->total_reviews }} reviews)</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="provider-description">
                                    {{ Str::limit($provider->description, 120) }}
                                </p>
                                
                                <div class="provider-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $provider->location }}</span>
                                    </div>
                                    
                                    <div class="meta-item">
                                        <i class="fas fa-euro-sign"></i>
                                        <span class="meta-price">{{ number_format($provider->min_budget, 0) }} - {{ number_format($provider->max_budget, 0) }}</span>
                                    </div>
                                    
                                    @if($provider->years_experience)
                                    <div class="meta-item">
                                        <i class="fas fa-briefcase"></i>
                                        <span>{{ $provider->years_experience }} yrs experience</span>
                                    </div>
                                    @endif
                                </div>

                                <a href="{{ route('service-providers.show', $provider) }}" class="view-button">
                                    View Profile <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="empty-state-title">No Service Providers Found</h3>
                    <p class="empty-state-text">
                        We couldn't find any providers matching your search criteria. 
                        Try adjusting your filters or browse our most popular providers.
                    </p>
                    <a href="{{ route('service-providers.index') }}" class="empty-state-button">
                        <i class="fas fa-redo mr-2"></i>Reset Filters
                    </a>
                </div>
            @endif

            <div class="pagination">
                {{ $providers->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling to all links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
            
            // Add animation class when elements come into view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.provider-card').forEach(card => {
                observer.observe(card);
            });

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
        });
    </script>
</body>
</html>