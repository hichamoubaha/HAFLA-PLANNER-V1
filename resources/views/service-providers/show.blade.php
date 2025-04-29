@extends('layouts.app')

@section('content')
<style>
/* Custom CSS for Service Provider Profile */
.profile-container {
  max-width: 1140px;
  margin: 0 auto;
  padding: 2rem 1rem;
}

.profile-card {
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
  overflow: hidden;
}

.profile-header {
  position: relative;
  padding: 2rem;
  background: linear-gradient(135deg, #4f6ef7 0%, #3b5fe4 100%);
  color: white;
}

.profile-info {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.profile-image-container {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  overflow: hidden;
  border: 4px solid white;
  margin-right: 1.5rem;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f3f4f6;
}

.profile-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}

.profile-image-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f3f4f6;
}

.profile-image-placeholder i {
  font-size: 3rem;
  color: #9ca3af;
}

.profile-details {
  flex: 1;
}

.business-name {
  font-size: 2.25rem;
  font-weight: 700;
  margin-bottom: 0.75rem;
}

.location-badge {
  display: inline-flex;
  align-items: center;
  background-color: rgba(255, 255, 255, 0.2);
  padding: 0.5rem 1rem;
  border-radius: 50px;
  margin-bottom: 1rem;
}

.rating-display {
  display: flex;
  align-items: center;
  background-color: rgba(255, 255, 255, 0.2);
  padding: 0.5rem 1rem;
  border-radius: 50px;
  width: fit-content;
}

.star-gold {
  color: #ffd700;
}

.star-gray {
  color: #d1d5db;
}

.action-buttons .btn {
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 8px;
  font-weight: 500;
  display: inline-flex;
  align-items: center;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-edit {
  background-color: #3b82f6;
  color: white;
}

.btn-edit:hover {
  background-color: #2563eb;
}

.btn-delete {
  background-color: #ef4444;
  color: white;
}

.btn-delete:hover {
  background-color: #dc2626;
}

.btn-secondary {
  background-color: #6b7280;
  color: white;
}

.btn-secondary:hover {
  background-color: #4b5563;
}

.section {
  padding: 2rem;
  border-bottom: 1px solid #e5e7eb;
}

.section-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #2d3748;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
}

.section-title i {
  margin-right: 0.75rem;
  color: #4f6ef7;
}

.description {
  color: #4a5568;
  line-height: 1.7;
  margin-bottom: 2rem;
}

.info-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1.5rem;
}

@media (min-width: 768px) {
  .info-grid {
    grid-template-columns: 1fr 1fr;
  }
}

.info-card {
  background-color: #f9fafb;
  border-radius: 8px;
  padding: 1.5rem;
  border: 1px solid #e5e7eb;
}

.info-card-title {
  font-weight: 600;
  margin-bottom: 0.5rem;
  display: flex;
  align-items: center;
}

.info-card-title i {
  margin-right: 0.75rem;
  color: #4f6ef7;
}

.review-badge {
  background-color: #e0e7ff;
  color: #4338ca;
  font-weight: 500;
  padding: 0.25rem 0.75rem;
  border-radius: 50px;
  font-size: 0.875rem;
  margin-left: 0.75rem;
}

.review-form {
  background-color: #f9fafb;
  border-radius: 8px;
  padding: 1.5rem;
  margin-bottom: 2rem;
  border: 1px solid #e5e7eb;
}

.form-title {
  font-weight: 600;
  font-size: 1.25rem;
  margin-bottom: 1.5rem;
  color: #2d3748;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-label {
  display: block;
  font-weight: 500;
  margin-bottom: 0.5rem;
  color: #4a5568;
}

.star-rating {
  display: flex;
  margin-bottom: 0.5rem;
}

.star-rating label {
  cursor: pointer;
  padding: 0 0.25rem;
  font-size: 1.5rem;
}

.star-rating label:hover i,
.star-rating label:hover ~ label i {
  color: #fbbf24;
}

textarea.form-control {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  resize: vertical;
}

textarea.form-control:focus {
  outline: none;
  border-color: #4f6ef7;
  box-shadow: 0 0 0 3px rgba(79, 110, 247, 0.2);
}

.btn-submit {
  background-color: #4f6ef7;
  color: white;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  font-weight: 500;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-submit:hover {
  background-color: #3b5fe4;
}

.review-list {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.review-item {
  border-bottom: 1px solid #e5e7eb;
  padding-bottom: 2rem;
}

.review-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1rem;
}

.reviewer-info {
  display: flex;
  align-items: center;
}

.avatar {
  width: 2.5rem;
  height: 2.5rem;
  background-color: #e5e7eb;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 1rem;
}

.reviewer-name {
  font-weight: 600;
  color: #2d3748;
}

.review-rating {
  display: flex;
  align-items: center;
  margin-top: 0.25rem;
}

.review-date {
  font-size: 0.875rem;
  color: #6b7280;
  margin-left: 0.75rem;
}

.review-actions {
  display: flex;
  gap: 0.75rem;
}

.btn-icon {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1rem;
  transition: color 0.2s ease;
}

.btn-icon.edit {
  color: #3b82f6;
}

.btn-icon.edit:hover {
  color: #2563eb;
}

.btn-icon.delete {
  color: #ef4444;
}

.btn-icon.delete:hover {
  color: #dc2626;
}

.review-content {
  color: #4a5568;
  line-height: 1.6;
}

.empty-reviews {
  background-color: #eff6ff;
  border: 1px solid #dbeafe;
  color: #1e40af;
  padding: 2rem;
  text-align: center;
  border-radius: 8px;
}

.empty-reviews i {
  font-size: 2rem;
  margin-bottom: 1rem;
  display: block;
}

/* Additional styles for tabs and analytics */
.tabs-container {
    border-bottom: 1px solid #e5e7eb;
}

.tabs-header {
    display: flex;
    border-bottom: 1px solid #e5e7eb;
    margin-bottom: 1rem;
}

.tab-button {
    padding: 1rem 1.5rem;
    font-weight: 500;
    color: #6b7280;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    transition: all 0.2s ease;
    background: none;
    border: none;
    display: flex;
    align-items: center;
}

.tab-button i {
    margin-right: 0.5rem;
}

.tab-button:hover {
    color: #4f6ef7;
}

.tab-button.active {
    color: #4f6ef7;
    border-bottom-color: #4f6ef7;
}

.tab-content {
    display: none;
    padding: 1rem 0;
}

.tab-content.active {
    display: block;
}

.reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.reviews-filter {
    display: flex;
    gap: 1rem;
}

.filter-select {
    padding: 0.5rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    background-color: white;
    font-size: 0.875rem;
}

.avatar-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.analytics-container {
    padding: 1rem 0;
}

.analytics-card {
    background-color: #f9fafb;
    border-radius: 0.5rem;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
}

.analytics-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #2d3748;
}

.rating-summary {
    display: flex;
    gap: 2rem;
}

.overall-rating {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-width: 150px;
}

.rating-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: #4f6ef7;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.5rem;
}

.rating-value {
    font-size: 1.5rem;
    font-weight: 700;
}

.rating-max {
    font-size: 0.875rem;
    opacity: 0.8;
}

.rating-stars {
    margin-bottom: 0.5rem;
}

.rating-count {
    font-size: 0.875rem;
    color: #6b7280;
}

.rating-bars {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.rating-bar-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.rating-label {
    width: 80px;
    font-size: 0.875rem;
    color: #4b5563;
}

.rating-bar-container {
    flex: 1;
    height: 8px;
    background-color: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
}

.rating-bar {
    height: 100%;
    background-color: #4f6ef7;
    border-radius: 4px;
}

.rating-count {
    width: 40px;
    text-align: right;
    font-size: 0.875rem;
    color: #6b7280;
}

/* Add new styles for the top navigation */
.top-nav {
    background-color: white;
    padding: 1rem 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.logout-btn {
    background-color: transparent;
    color: #4b5563;
    border: 1px solid #e5e7eb;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
}

.logout-btn:hover {
    background-color: #f3f4f6;
    color: #1f2937;
}

.logout-btn i {
    margin-right: 0.5rem;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
}

.btn-dashboard {
    background-color: #f3f4f6;
    color: #4b5563;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}

.btn-dashboard:hover {
    background-color: #e5e7eb;
    color: #1f2937;
}

.booking-form {
    background-color: #f9fafb;
    border-radius: 8px;
    padding: 1.5rem;
    margin-top: 1rem;
    border: 1px solid #e5e7eb;
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    margin-top: 0.25rem;
    font-size: 1rem;
}

.form-control:focus {
    outline: none;
    border-color: #4f6ef7;
    box-shadow: 0 0 0 2px rgba(79, 110, 247, 0.2);
}

.is-invalid {
    border-color: #ef4444;
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.btn-primary {
    background-color: #4f6ef7;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background-color: #3b5fe4;
}

.btn-primary i {
    margin-right: 0.5rem;
}

.alert {
    padding: 1rem;
    border-radius: 6px;
    margin-top: 1rem;
}

.alert-info {
    background-color: #e0f2fe;
    color: #075985;
    border: 1px solid #bae6fd;
}

.alert-info a {
    color: #0369a1;
    text-decoration: underline;
}

.alert-info i {
    margin-right: 0.5rem;
}

/* Reservations Styles */
.reservations-container {
    padding: 1rem 0;
}

.reservations-card {
    background-color: #f9fafb;
    border-radius: 0.5rem;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
}

.reservations-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #2d3748;
}

.reservations-filter {
    margin-bottom: 1.5rem;
}

.reservations-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.reservation-item {
    background-color: white;
    border-radius: 0.5rem;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.reservation-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.client-info {
    display: flex;
    align-items: center;
}

.client-name {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.25rem;
}

.reservation-date {
    font-size: 0.875rem;
    color: #6b7280;
    display: flex;
    align-items: center;
}

.reservation-date i {
    margin-right: 0.5rem;
    color: #4f6ef7;
}

.reservation-status {
    font-weight: 500;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.875rem;
}

.status-pending {
    background-color: #fef3c7;
    color: #92400e;
}

.status-confirmed {
    background-color: #dcfce7;
    color: #166534;
}

.status-cancelled {
    background-color: #fee2e2;
    color: #991b1b;
}

.status-completed {
    background-color: #e0e7ff;
    color: #4338ca;
}

.reservation-notes {
    background-color: #f9fafb;
    border-radius: 0.375rem;
    padding: 1rem;
    margin: 1rem 0;
    font-size: 0.875rem;
    color: #4b5563;
}

.reservation-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 1rem;
}

.btn-success {
    background-color: #10b981;
    color: white;
}

.btn-success:hover {
    background-color: #059669;
}

.btn-danger {
    background-color: #ef4444;
    color: white;
}

.btn-danger:hover {
    background-color: #dc2626;
}

.empty-reservations {
    background-color: #eff6ff;
    border: 1px solid #dbeafe;
    color: #1e40af;
    padding: 2rem;
    text-align: center;
    border-radius: 8px;
}

.empty-reservations i {
    font-size: 2rem;
    margin-bottom: 1rem;
    display: block;
}

.inline-block {
    display: inline-block;
}

/* Existing Booking Styles */
.existing-booking {
    margin-top: 1rem;
}

.booking-status-card {
    background-color: #f9fafb;
    border-radius: 8px;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
}

.booking-status-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.booking-status-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2d3748;
    margin: 0;
}

.booking-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.booking-info {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #4b5563;
}

.info-item i {
    color: #4f6ef7;
    width: 20px;
}

.booking-actions {
    display: flex;
    gap: 0.75rem;
}
</style>

<div class="profile-container">
    @if(auth()->id() === $provider->user_id)
    <div class="top-nav">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Déconnexion
            </button>
        </form>
    </div>
    @endif

    <div class="profile-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-info">
                <div class="flex items-center">
                    <div class="profile-image-container">
                        @if($provider->profile_picture)
                            <img src="{{ asset('storage/' . $provider->profile_picture) }}" 
                                alt="{{ $provider->business_name }}" 
                                class="profile-image">
                        @else
                            <div class="profile-image-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <div class="profile-details">
                        <h1 class="business-name">{{ $provider->business_name }}</h1>
                        <div class="location-badge">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $provider->location }}</span>
                        </div>
                        <div class="rating-display">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $provider->rating ? 'star-gold' : 'star-gray' }} mr-1"></i>
                            @endfor
                            <span class="font-medium ml-2">{{ number_format($provider->rating, 1) }}</span>
                            <span class="ml-1">({{ $provider->total_reviews }} avis)</span>
                        </div>
                    </div>
                </div>
                @if(auth()->id() === $provider->user_id)
                    <div class="action-buttons">
                        <a href="{{ route('service-providers.edit', $provider) }}" 
                            class="btn btn-edit">
                            <i class="fas fa-edit mr-2"></i>Modifier
                        </a>
                        <form action="{{ route('service-providers.destroy', $provider) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce profil ?')">
                                <i class="fas fa-trash mr-2"></i>Supprimer
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Detailed Information -->
        <div class="section">
            <h2 class="section-title"><i class="fas fa-info-circle"></i> À propos</h2>
            <p class="description">{{ $provider->description }}</p>

            <div class="info-grid">
                <div class="info-card">
                    <h3 class="info-card-title"><i class="fas fa-tag"></i> Type de service</h3>
                    <p>{{ ucfirst($provider->service_type) }}</p>
                </div>
                <div class="info-card">
                    <h3 class="info-card-title"><i class="fas fa-euro-sign"></i> Fourchette de prix</h3>
                    <p>{{ number_format($provider->min_budget, 0) }}€ - {{ number_format($provider->max_budget, 0) }}€</p>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="tabs-container">
            <div class="tabs-header">
                <button class="tab-button active" data-tab="reviews">
                    <i class="fas fa-comment"></i> Avis ({{ $provider->total_reviews }})
                </button>
                @if(auth()->id() === $provider->user_id)
                <button class="tab-button" data-tab="analytics">
                    <i class="fas fa-chart-bar"></i> Statistiques
                </button>
                <button class="tab-button" data-tab="reservations">
                    <i class="fas fa-calendar-check"></i> Réservations
                </button>
                @endif
            </div>
            
            <!-- Reviews Tab Content -->
            <div class="tab-content active" id="reviews-tab">
                <div class="reviews-header">
                    <h2 class="section-title">
                        <i class="fas fa-comment"></i> Avis 
                        <span class="review-badge">{{ $provider->total_reviews }}</span>
                    </h2>
                    
                    @if(auth()->id() === $provider->user_id)
                    <div class="reviews-filter">
                        <select id="rating-filter" class="filter-select">
                            <option value="all">Tous les avis</option>
                            <option value="5">5 étoiles</option>
                            <option value="4">4 étoiles</option>
                            <option value="3">3 étoiles</option>
                            <option value="2">2 étoiles</option>
                            <option value="1">1 étoile</option>
                        </select>
                        <select id="sort-filter" class="filter-select">
                            <option value="newest">Plus récents</option>
                            <option value="oldest">Plus anciens</option>
                            <option value="highest">Note la plus haute</option>
                            <option value="lowest">Note la plus basse</option>
                        </select>
                    </div>
                    @endif
                </div>

                @if(auth()->check() && auth()->id() !== $provider->user_id)
                    <div class="review-form">
                        <h3 class="form-title">Laisser un avis</h3>
                        <form action="{{ route('reviews.store', $provider) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Note</label>
                                <div class="star-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label>
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" required>
                                            <i class="fas fa-star {{ $i <= old('rating', 0) ? 'star-gold' : 'star-gray' }}"></i>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Commentaire</label>
                                <textarea name="comment" rows="4" required class="form-control">{{ old('comment') }}</textarea>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-submit">
                                    Publier l'avis
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn-dashboard">
                                    <i class="fas fa-arrow-left mr-2"></i>Retour au tableau de bord
                                </a>
                            </div>
                        </form>
                    </div>
                @endif

                <div class="review-list" id="reviews-container">
                    @forelse($provider->reviews as $review)
                        <div class="review-item" data-rating="{{ $review->rating }}">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <div class="avatar">
                                        @if($review->user->profile_picture)
                                            <img src="{{ asset('storage/' . $review->user->profile_picture) }}" 
                                                alt="{{ $review->user->name }}" 
                                                class="avatar-image">
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="reviewer-name">{{ $review->user->name }}</div>
                                        <div class="review-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $review->rating ? 'star-gold' : 'star-gray' }}"></i>
                                            @endfor
                                            <span class="review-date">{{ $review->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if(auth()->id() === $review->user_id)
                                    <div class="review-actions">
                                        <button onclick="editReview({{ $review->id }})" class="btn-icon edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon delete"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <p class="review-content">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <div class="empty-reviews">
                            <i class="fas fa-comment-slash"></i>
                            <p>Aucun avis pour le moment. Soyez le premier à partager votre expérience!</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Analytics Tab Content (for service provider only) -->
            @if(auth()->id() === $provider->user_id)
            <div class="tab-content" id="analytics-tab">
                <div class="analytics-container">
                    <div class="analytics-card">
                        <h3 class="analytics-title">Résumé des avis</h3>
                        <div class="rating-summary">
                            <div class="overall-rating">
                                <div class="rating-circle">
                                    <span class="rating-value">{{ number_format($provider->rating, 1) }}</span>
                                    <span class="rating-max">/5</span>
                                </div>
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= round($provider->rating) ? 'star-gold' : 'star-gray' }}"></i>
                                    @endfor
                                </div>
                                <div class="rating-count">{{ $provider->total_reviews }} avis</div>
                            </div>
                            
                            <div class="rating-bars">
                                @php
                                    $ratingCounts = $provider->reviews->groupBy('rating')->map->count();
                                    $maxCount = $ratingCounts->max() ?: 1;
                                @endphp
                                
                                @for($i = 5; $i >= 1; $i--)
                                    @php
                                        $count = $ratingCounts[$i] ?? 0;
                                        $percentage = $provider->total_reviews > 0 ? ($count / $provider->total_reviews) * 100 : 0;
                                    @endphp
                                    <div class="rating-bar-item">
                                        <div class="rating-label">{{ $i }} étoiles</div>
                                        <div class="rating-bar-container">
                                            <div class="rating-bar" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <div class="rating-count">{{ $count }}</div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Reservations Tab Content (for service provider only) -->
            @if(auth()->id() === $provider->user_id)
            <div class="tab-content" id="reservations-tab">
                <div class="reservations-container">
                    <div class="reservations-card">
                        <h3 class="reservations-title">Gestion des réservations</h3>
                        
                        <div class="reservations-filter">
                            <select id="status-filter" class="filter-select">
                                <option value="all">Toutes les réservations</option>
                                <option value="pending">En attente</option>
                                <option value="confirmed">Confirmées</option>
                                <option value="cancelled">Annulées</option>
                                <option value="completed">Terminées</option>
                            </select>
                        </div>
                        
                        <div class="reservations-list" id="reservations-container">
                            @forelse($provider->bookings as $booking)
                                <div class="reservation-item" data-status="{{ $booking->status }}">
                                    <div class="reservation-header">
                                        <div class="client-info">
                                            <div class="avatar">
                                                @if($booking->user->profile_picture)
                                                    <img src="{{ asset('storage/' . $booking->user->profile_picture) }}" 
                                                        alt="{{ $booking->user->name }}" 
                                                        class="avatar-image">
                                                @else
                                                    <i class="fas fa-user"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="client-name">{{ $booking->user->name }}</div>
                                                <div class="reservation-date">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    {{ $booking->booking_date->format('d/m/Y H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reservation-status status-{{ $booking->status }}">
                                            {{ ucfirst($booking->status) }}
                                        </div>
                                    </div>
                                    
                                    @if($booking->notes)
                                        <div class="reservation-notes">
                                            <strong>Notes:</strong> {{ $booking->notes }}
                                        </div>
                                    @endif
                                    
                                    @if($booking->status == 'pending')
                                        <div class="reservation-actions">
                                            <form action="{{ route('service-provider-bookings.update-status', $booking) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check"></i> Accepter
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('service-provider-bookings.update-status', $booking) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-times"></i> Refuser
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($booking->status == 'confirmed')
                                        <div class="reservation-actions">
                                            <form action="{{ route('service-provider-bookings.update-status', $booking) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-check-double"></i> Marquer comme terminée
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="empty-reservations">
                                    <i class="fas fa-calendar-times"></i>
                                    <p>Aucune réservation pour le moment.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="section">
            <h2 class="section-title">
                <i class="fas fa-calendar-alt"></i>
                Book This Service Provider
            </h2>
            
            @auth
                @if(Auth::id() !== $provider->user_id)
                    @php
                        $existingBooking = $provider->bookings()
                            ->where('user_id', Auth::id())
                            ->whereIn('status', ['pending', 'confirmed'])
                            ->first();
                    @endphp
                    
                    @if($existingBooking)
                        <div class="existing-booking">
                            <div class="booking-status-card">
                                <div class="booking-status-header">
                                    <h3>Your Existing Booking</h3>
                                    <span class="booking-status status-{{ $existingBooking->status }}">
                                        {{ ucfirst($existingBooking->status) }}
                                    </span>
                                </div>
                                
                                <div class="booking-details">
                                    <div class="booking-info">
                                        <div class="info-item">
                                            <i class="fas fa-calendar"></i>
                                            <span>Date: {{ $existingBooking->booking_date->format('d/m/Y H:i') }}</span>
                                        </div>
                                        @if($existingBooking->notes)
                                            <div class="info-item">
                                                <i class="fas fa-sticky-note"></i>
                                                <span>Notes: {{ $existingBooking->notes }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    @if($existingBooking->status == 'pending')
                                        <div class="booking-actions">
                                            <form action="{{ route('service-provider-bookings.update-status', $existingBooking) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-times"></i> Cancel Booking
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="booking-form">
                            <form action="{{ route('service-provider-bookings.store', $provider) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="booking_date" class="form-label">Preferred Date and Time</label>
                                    <input type="datetime-local" 
                                           id="booking_date" 
                                           name="booking_date" 
                                           class="form-control @error('booking_date') is-invalid @enderror"
                                           required
                                           min="{{ date('Y-m-d\TH:i') }}">
                                    @error('booking_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="notes" class="form-label">Additional Notes</label>
                                    <textarea id="notes" 
                                              name="notes" 
                                              class="form-control @error('notes') is-invalid @enderror"
                                              rows="3"
                                              placeholder="Any specific requirements or details you'd like to share..."></textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-calendar-check"></i>
                                    Request Booking
                                </button>
                            </form>
                        </div>
                    @endif
                @endif
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Please <a href="{{ route('login') }}">login</a> to book this service provider.
                </div>
            @endauth
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Fonction pour gérer l'affichage des étoiles lors de la sélection
    document.querySelectorAll('input[name="rating"]').forEach(input => {
        input.addEventListener('change', function() {
            const rating = this.value;
            document.querySelectorAll('input[name="rating"]').forEach((input, index) => {
                const star = input.nextElementSibling;
                if (index < rating) {
                    star.classList.add('star-gold');
                    star.classList.remove('star-gray');
                } else {
                    star.classList.add('star-gray');
                    star.classList.remove('star-gold');
                }
            });
        });
    });
    
    // Tab switching functionality
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Show corresponding content
            const tabId = this.getAttribute('data-tab');
            document.getElementById(`${tabId}-tab`).classList.add('active');
        });
    });
    
    // Rating filter functionality
    const ratingFilter = document.getElementById('rating-filter');
    if (ratingFilter) {
        ratingFilter.addEventListener('change', function() {
            filterReviews();
        });
    }
    
    // Sort filter functionality
    const sortFilter = document.getElementById('sort-filter');
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            filterReviews();
        });
    }
    
    function filterReviews() {
        const ratingValue = ratingFilter ? ratingFilter.value : 'all';
        const sortValue = sortFilter ? sortFilter.value : 'newest';
        
        const reviewsContainer = document.getElementById('reviews-container');
        const reviewItems = Array.from(reviewsContainer.querySelectorAll('.review-item'));
        
        // Filter by rating
        let filteredReviews = reviewItems;
        if (ratingValue !== 'all') {
            filteredReviews = reviewItems.filter(item => 
                parseInt(item.getAttribute('data-rating')) === parseInt(ratingValue)
            );
        }
        
        // Sort reviews
        filteredReviews.sort((a, b) => {
            const ratingA = parseInt(a.getAttribute('data-rating'));
            const ratingB = parseInt(b.getAttribute('data-rating'));
            const dateA = new Date(a.querySelector('.review-date').textContent.split('/').reverse().join('-'));
            const dateB = new Date(b.querySelector('.review-date').textContent.split('/').reverse().join('-'));
            
            if (sortValue === 'newest') {
                return dateB - dateA;
            } else if (sortValue === 'oldest') {
                return dateA - dateB;
            } else if (sortValue === 'highest') {
                return ratingB - ratingA;
            } else if (sortValue === 'lowest') {
                return ratingA - ratingB;
            }
            
            return 0;
        });
        
        // Clear container
        reviewsContainer.innerHTML = '';
        
        // Add filtered and sorted reviews
        if (filteredReviews.length === 0) {
            reviewsContainer.innerHTML = `
                <div class="empty-reviews">
                    <i class="fas fa-comment-slash"></i>
                    <p>Aucun avis ne correspond à vos critères de filtrage.</p>
                </div>
            `;
        } else {
            filteredReviews.forEach(review => {
                reviewsContainer.appendChild(review);
            });
        }
    }
    
    // Reservation filter functionality
    const statusFilter = document.getElementById('status-filter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            filterReservations();
        });
    }
    
    function filterReservations() {
        const statusValue = statusFilter ? statusFilter.value : 'all';
        
        const reservationsContainer = document.getElementById('reservations-container');
        const reservationItems = Array.from(reservationsContainer.querySelectorAll('.reservation-item'));
        
        // Filter by status
        let filteredReservations = reservationItems;
        if (statusValue !== 'all') {
            filteredReservations = reservationItems.filter(item => 
                item.getAttribute('data-status') === statusValue
            );
        }
        
        // Clear container
        reservationsContainer.innerHTML = '';
        
        // Add filtered reservations
        if (filteredReservations.length === 0) {
            reservationsContainer.innerHTML = `
                <div class="empty-reservations">
                    <i class="fas fa-calendar-times"></i>
                    <p>Aucune réservation ne correspond à vos critères de filtrage.</p>
                </div>
            `;
        } else {
            filteredReservations.forEach(reservation => {
                reservationsContainer.appendChild(reservation);
            });
        }
    }
</script>
@endpush
@endsection