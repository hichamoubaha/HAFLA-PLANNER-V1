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
</style>

<div class="profile-container">
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

        <!-- Reviews Section -->
        <div class="section">
            <h2 class="section-title">
                <i class="fas fa-comment"></i> Avis 
                <span class="review-badge">{{ $provider->total_reviews }}</span>
            </h2>

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

                        <button type="submit" class="btn-submit">
                            Publier l'avis
                        </button>
                    </form>
                </div>
            @endif

            <div class="review-list">
                @forelse($provider->reviews as $review)
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="avatar">
                                    <i class="fas fa-user"></i>
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
</script>
@endpush
@endsection