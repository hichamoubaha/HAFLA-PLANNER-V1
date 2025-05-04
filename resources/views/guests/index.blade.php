@extends('layouts.app')

@section('content')
<style>
    /* Container and Card Styles */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(to right, #2563eb, #4f46e5);
        color: white;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.75rem;
        font-weight: 700;
    }

    .card-body {
        padding: 1.5rem;
    }

    .alert-success {
        background: #d1fae5;
        border-left: 4px solid #10b981;
        color: #065f46;
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-radius: 0 0.5rem 0.5rem 0;
    }

    /* Table Styles */
    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.5rem;
    }

    th {
        padding: 1rem;
        text-align: left;
        color: #4b5563;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    tr {
        background: #f9fafb;
        border-radius: 0.5rem;
        transition: box-shadow 0.2s ease;
    }

    tr:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    td {
        padding: 1rem;
        color: #1f2937;
        vertical-align: middle;
    }

    td:not(:last-child) {
        color: #6b7280;
    }

    /* Button Styles */
    .btn-primary {
        display: inline-block;
        background: #3b82f6;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: background 0.2s ease;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-info {
        display: inline-block;
        background: #06b6d4;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: background 0.2s ease;
    }

    .btn-info:hover {
        background: #0891b2;
    }

    .btn-danger {
        display: inline-block;
        background: #ef4444;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    /* Badge Styles */
    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: capitalize;
    }

    .bg-success {
        background: #10b981;
        color: white;
    }

    .bg-danger {
        background: #ef4444;
        color: white;
    }

    .bg-warning {
        background: #f59e0b;
        color: white;
    }

    /* Navbar Styles */
    .navbar {
        background: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .navbar-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 4rem;
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: #4f46e5;
        text-decoration: none;
    }

    .navbar-links {
        display: flex;
        gap: 1.5rem;
    }

    .navbar-links a {
        color: #6b7280;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        padding: 0.25rem 0;
        border-bottom: 2px solid transparent;
        transition: color 0.2s ease, border-color 0.2s ease;
    }

    .navbar-links a.active {
        color: #1f2937;
        border-bottom-color: #4f46e5;
    }

    .navbar-links a:hover {
        color: #1f2937;
    }

    .profile-section {
        position: relative;
    }

    .profile-button {
        display: flex;
        align-items: center;
        color: #6b7280;
        background: none;
        border: none;
        font-size: 0.875rem;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .profile-button:hover {
        color: #1f2937;
    }

    .profile-button i {
        margin-right: 0.5rem;
    }

    .profile-dropdown {
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 0.75rem;
        width: 12rem;
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
    }

    .profile-dropdown.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .profile-dropdown a,
    .profile-dropdown button {
        display: block;
        width: 100%;
        padding: 0.75rem 1rem;
        color: #374151;
        text-align: left;
        text-decoration: none;
        font-size: 0.875rem;
        background: none;
        border: none;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .profile-dropdown a:hover,
    .profile-dropdown button:hover {
        background: #f9fafb;
    }

    .mobile-menu-button {
        display: none;
        background: none;
        border: none;
        padding: 0.5rem;
        color: #6b7280;
        cursor: pointer;
    }

    .mobile-menu {
        display: none;
        padding: 0.5rem 0;
    }

    .mobile-menu a,
    .mobile-menu button {
        display: block;
        padding: 0.75rem 1rem;
        color: #6b7280;
        text-decoration: none;
        font-size: 1rem;
        border-left: 4px solid transparent;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .mobile-menu a.active {
        background: #eef2ff;
        color: #4f46e5;
        border-left-color: #4f46e5;
    }

    .mobile-menu a:hover,
    .mobile-menu button:hover {
        background: #f9fafb;
        color: #1f2937;
    }

    .mobile-menu button {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
    }

    @media (max-width: 640px) {
        .navbar-links {
            display: none;
        }

        .mobile-menu-button {
            display: block;
        }

        .mobile-menu.active {
            display: block;
        }

        .profile-section {
            display: none;
        }
    }
</style>

<!-- Navigation Bar -->
<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-flex">
            <div class="navbar-left">
                <a href="{{ route('events.index') }}" class="navbar-brand">Événements</a>
                <div class="navbar-links hidden sm:flex">
                    <a href="{{ route('events.index') }}" class="active">Événements</a>
                    <a href="{{ route('bookings.index') }}">Mes Réservations</a>
                    <a href="{{ route('invitation-templates.my-invitations') }}">Mes Invitations</a>
                    <a href="{{ route('service-providers.index') }}">Prestataires</a>
                </div>
            </div>
            <div class="profile-section hidden sm:flex items-center">
                <button id="profileDropdown" class="profile-button">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div id="profileDropdownMenu" class="profile-dropdown">
                    <a href="{{ route('profile') }}">Mon Profil</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Déconnexion</button>
                    </form>
                </div>
            </div>
            <button class="mobile-menu-button sm:hidden">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <div class="mobile-menu sm:hidden" id="mobile-menu">
            <a href="{{ route('events.index') }}" class="active">Événements</a>
            <a href="{{ route('bookings.index') }}">Mes Réservations</a>
            <a href="{{ route('invitation-templates.my-invitations') }}">Mes Invitations</a>
            <a href="{{ route('service-providers.index') }}">Prestataires</a>
            <a href="{{ route('profile') }}">Mon Profil</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Déconnexion</button>
            </form>
        </div>
    </div>
</nav>

<!-- Guest List Content -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Guest List for {{ $event->name }}</h3>
                    <a href="{{ route('events.guests.create', $event) }}" class="btn-primary">Add Guest</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Dietary Preferences</th>
                                    <th>Special Requests</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guests as $guest)
                                    <tr>
                                        <td>{{ $guest->name }}</td>
                                        <td>{{ $guest->email }}</td>
                                        <td>{{ $guest->phone }}</td>
                                        <td>
                                            <span class="badge bg-{{ $guest->status === 'confirmed' ? 'success' : ($guest->status === 'declined' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($guest->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $guest->dietary_preferences }}</td>
                                        <td>{{ $guest->special_requests }}</td>
                                        <td>
                                            <a href="{{ route('events.guests.edit', [$event, $guest]) }}" class="btn-info">Edit</a>
                                            <form action="{{ route('events.guests.destroy', [$event, $guest]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle profile dropdown
    const profileButton = document.getElementById('profileDropdown');
    const profileDropdown = document.getElementById('profileDropdownMenu');

    profileButton.addEventListener('click', function (event) {
        event.stopPropagation();
        profileDropdown.classList.toggle('active');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!profileDropdown.contains(event.target) && !profileButton.contains(event.target)) {
            profileDropdown.classList.remove('active');
        }
    });

    // Toggle mobile menu
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', function (event) {
        event.stopPropagation();
        mobileMenu.classList.toggle('active');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function (event) {
        if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
            mobileMenu.classList.remove('active');
        }
    });
</script>
@endsection