@extends('layouts.app')

@section('content')
<style>
    /* Custom CSS styles */
    .catalog-container {
        background: linear-gradient(to right, #f8fafc, #f0f5ff);
        min-height: 100vh;
        padding: 2rem 1rem;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    
    .back-button {
        background: #f1f5f9;
        color: #475569;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
        margin-right: 1rem;
    }
    
    .back-button:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
    
    .back-button i {
        margin-right: 0.5rem;
    }
    
    .header-actions {
        display: flex;
        align-items: center;
    }
    
    .add-button {
        background: linear-gradient(to right, #3b82f6, #2563eb);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.1);
    }
    
    .add-button:hover {
        background: linear-gradient(to right, #2563eb, #1d4ed8);
        transform: translateY(-1px);
        box-shadow: 0 6px 8px rgba(37, 99, 235, 0.15);
    }
    
    .add-button i {
        margin-right: 0.5rem;
    }
    
    .filter-card {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid #f1f5f9;
    }
    
    .filter-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1rem;
    }
    
    @media (min-width: 768px) {
        .filter-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    .filter-group {
        margin-bottom: 1rem;
    }
    
    .filter-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #475569;
        margin-bottom: 0.375rem;
    }
    
    .filter-input, .filter-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        font-size: 0.95rem;
        color: #334155;
        transition: all 0.2s ease;
    }
    
    .filter-input:focus, .filter-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    
    .filter-input::placeholder {
        color: #94a3b8;
    }
    
    .filter-button-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 1rem;
        grid-column: 1 / -1;
    }
    
    .filter-button {
        background: linear-gradient(to right, #3b82f6, #2563eb);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(37, 99, 235, 0.1);
    }
    
    .filter-button:hover {
        background: linear-gradient(to right, #2563eb, #1d4ed8);
    }
    
    .filter-button i {
        margin-right: 0.5rem;
    }
    
    .providers-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
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
    
    .provider-card {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #f1f5f9;
        position: relative;
    }
    
    .provider-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .provider-tag {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background-color: rgba(37, 99, 235, 0.1);
        color: #2563eb;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
    }
    
    .provider-content {
        padding: 1.5rem;
    }
    
    .provider-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .provider-image-container {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 1rem;
        flex-shrink: 0;
        border: 2px solid #e2e8f0;
    }
    
    .provider-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    
    .provider-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f1f5f9;
    }
    
    .provider-image-placeholder i {
        font-size: 1.5rem;
        color: #94a3b8;
    }
    
    .provider-info-container {
        flex: 1;
    }
    
    .provider-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 0.25rem 0;
    }
    
    .provider-rating {
        display: flex;
        align-items: center;
        background-color: #fffbeb;
        padding: 0.25rem 0.5rem;
        border-radius: 0.5rem;
        width: fit-content;
    }
    
    .rating-star {
        color: #f59e0b;
        margin-right: 0.25rem;
    }
    
    .rating-value {
        font-weight: 600;
        color: #1e293b;
    }
    
    .rating-count {
        color: #64748b;
        font-size: 0.75rem;
        margin-left: 0.25rem;
    }
    
    .provider-description {
        color: #64748b;
        margin-bottom: 1rem;
        line-height: 1.5;
    }
    
    .provider-info {
        margin-bottom: 1rem;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        color: #64748b;
        margin-bottom: 0.5rem;
    }
    
    .info-item i {
        width: 1.5rem;
        margin-right: 0.5rem;
        color: #3b82f6;
    }
    
    .view-button {
        display: block;
        width: 100%;
        background: linear-gradient(to right, #3b82f6, #2563eb);
        color: white;
        padding: 0.75rem;
        text-align: center;
        border-radius: 0.5rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .view-button:hover {
        background: linear-gradient(to right, #2563eb, #1d4ed8);
    }
    
    .pagination {
        margin-top: 2rem;
    }
    
    /* Additional styling for empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .empty-state-icon {
        font-size: 3rem;
        color: #94a3b8;
        margin-bottom: 1rem;
    }
    
    .empty-state-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    .empty-state-text {
        color: #64748b;
        margin-bottom: 1.5rem;
    }
</style>

<div class="catalog-container">
    <div class="container mx-auto">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-actions">
                <a href="{{ url()->previous() }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
                <h1 class="page-title">Catalogue des Prestataires</h1>
            </div>
            @if(auth()->user()->role === 'prestataire')
                <a href="{{ route('service-providers.create') }}" class="add-button">
                    <i class="fas fa-plus"></i>Ajouter mon profil
                </a>
            @endif
        </div>

        <!-- Filter Section -->
        <div class="filter-card">
            <form action="{{ route('service-providers.index') }}" method="GET">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label class="filter-label" for="location">Localisation</label>
                        <div class="input-wrapper">
                            <input type="text" id="location" name="location" value="{{ request('location') }}" 
                                class="filter-input" placeholder="Entrez une ville...">
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label" for="service_type">Type de service</label>
                        <select name="service_type" id="service_type" class="filter-select">
                            <option value="">Tous les types</option>
                            <option value="photographe" {{ request('service_type') === 'photographe' ? 'selected' : '' }}>Photographe</option>
                            <option value="dj" {{ request('service_type') === 'dj' ? 'selected' : '' }}>DJ</option>
                            <option value="traiteur" {{ request('service_type') === 'traiteur' ? 'selected' : '' }}>Traiteur</option>
                            <option value="decoration" {{ request('service_type') === 'decoration' ? 'selected' : '' }}>Décoration</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label" for="min_budget">Budget minimum</label>
                        <input type="number" id="min_budget" name="min_budget" value="{{ request('min_budget') }}" 
                            class="filter-input" placeholder="€">
                    </div>

                    <div class="filter-group">
                        <label class="filter-label" for="max_budget">Budget maximum</label>
                        <input type="number" id="max_budget" name="max_budget" value="{{ request('max_budget') }}" 
                            class="filter-input" placeholder="€">
                    </div>

                    <div class="filter-button-container">
                        <button type="submit" class="filter-button">
                            <i class="fas fa-search"></i>Filtrer
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
                        <div class="provider-content">
                            <div class="provider-header">
                                <div class="provider-image-container">
                                    @if($provider->profile_picture)
                                        <img src="{{ asset('storage/' . $provider->profile_picture) }}" 
                                            alt="{{ $provider->business_name }}" 
                                            class="provider-image">
                                    @else
                                        <div class="provider-image-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="provider-info-container">
                                    <h2 class="provider-name">{{ $provider->business_name }}</h2>
                                    <div class="provider-rating">
                                        <i class="fas fa-star rating-star"></i>
                                        <span class="rating-value">{{ number_format($provider->rating, 1) }}</span>
                                        <span class="rating-count">({{ $provider->total_reviews }})</span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="provider-description">{{ Str::limit($provider->description, 100) }}</p>
                            
                            <div class="provider-info">
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $provider->location }}</span>
                                </div>
                                
                                <div class="info-item">
                                    <i class="fas fa-euro-sign"></i>
                                    <span>{{ number_format($provider->min_budget, 0) }}€ - {{ number_format($provider->max_budget, 0) }}€</span>
                                </div>
                            </div>

                            <a href="{{ route('service-providers.show', $provider) }}" class="view-button">
                                Voir le profil
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
                <h3 class="empty-state-title">Aucun prestataire trouvé</h3>
                <p class="empty-state-text">Essayez de modifier vos critères de recherche</p>
            </div>
        @endif

        <div class="pagination">
            {{ $providers->links() }}
        </div>
    </div>
</div>
@endsection