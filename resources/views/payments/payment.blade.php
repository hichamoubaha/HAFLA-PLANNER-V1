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

    /* Payment Card Styles */
    .payment-card {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .payment-card h5 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .payment-card p {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .payment-card p strong {
        color: #1f2937;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        color: #1f2937;
        background: #f9fafb;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Payment Method Styles */
    .payment-method {
        display: flex;
        align-items: center;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        margin-bottom: 0.75rem;
        cursor: pointer;
        background: #fff;
        transition: all 0.3s ease;
    }

    .payment-method:hover {
        border-color: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .payment-method.active {
        border-color: #3b82f6;
        background: #f8fafc;
    }

    .payment-method i {
        margin-right: 0.5rem;
        color: #6b7280;
    }

    .payment-method.active i {
        color: #3b82f6;
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
        border: none;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-primary i {
        margin-right: 0.5rem;
    }

    .btn-secondary {
        display: inline-block;
        background: #6b7280;
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

    .btn-secondary:hover {
        background: #4b5563;
    }

    .btn-secondary i {
        margin-right: 0.5rem;
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

<!-- Payment Form -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Payment Details</h3>
                </div>
                <div class="card-body">
                    <div class="payment-card">
                        <h5>Event: {{ $booking->event->title }}</h5>
                        <p><strong>Price:</strong> {{ $booking->event->price }}€</p>
                        <p><strong>Date:</strong> {{ $booking->event->date }}</p>
                        <p><strong>Location:</strong> {{ $booking->event->location }}</p>
                    </div>

                    <form action="{{ route('payment.process', $booking) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="amount" class="form-label">Amount to Pay</label>
                            <input type="number" class="form-control" id="amount" name="amount" 
                                   value="{{ $booking->event->price }}" min="0" step="0.01" required>
                        </div>

                        <div id="payment-methods">
                            <div class="payment-method active" data-method="credit_card">
                                <i class="fas fa-credit-card"></i>Credit Card
                            </div>
                            <div class="payment-method" data-method="paypal">
                                <i class="fab fa-paypal"></i>PayPal
                            </div>
                            <div class="payment-method" data-method="bank_transfer">
                                <i class="fas fa-university"></i>Bank Transfer
                            </div>
                        </div>

                        <input type="hidden" name="payment_method" id="selected_payment_method" value="credit_card">

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-credit-card"></i>Pay Now
                            </button>
                            <a href="{{ route('bookings.index') }}" class="btn-secondary">
                                <i class="fas fa-arrow-left"></i>Cancel
                            </a>
                        </div>
                    </form>
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

    // Payment method selection
    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            // Remove active class from all methods
            document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
            
            // Add active class to clicked method
            this.classList.add('active');
            
            // Update hidden input value
            document.getElementById('selected_payment_method').value = this.dataset.method;
        });
    });
</script>
@endsection