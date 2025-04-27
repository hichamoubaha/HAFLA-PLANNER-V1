@extends('layouts.app')

@section('content')
<style>
    /* Custom CSS styles */
    .form-container {
        background: linear-gradient(to right, #f0f5ff, #f0f2ff);
        min-height: 100vh;
        padding: 3rem 1rem;
    }
    
    .form-card {
        max-width: 900px;
        margin: 0 auto;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #eaeaea;
    }
    
    .form-header {
        background: linear-gradient(to right, #2563eb, #4f46e5);
        color: white;
        padding: 1.5rem 2rem;
    }
    
    .form-header h1 {
        font-size: 1.8rem;
        font-weight: bold;
        margin: 0;
    }
    
    .form-header p {
        margin-top: 0.5rem;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .form-body {
        padding: 2rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #374151;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: all 0.2s ease;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    
    textarea.form-control {
        min-height: 120px;
    }
    
    .input-icon-wrapper {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    
    .input-with-icon {
        padding-left: 35px;
    }
    
    .budget-section {
        background-color: #f9fafb;
        border-radius: 8px;
        padding: 1.5rem;
        border: 1px solid #eaeaea;
        margin-bottom: 1.5rem;
    }
    
    .budget-section h3 {
        font-size: 1.1rem;
        font-weight: 500;
        margin-top: 0;
        margin-bottom: 1rem;
        color: #374151;
    }
    
    .budget-fields {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    
    .budget-field {
        flex: 1;
        min-width: 200px;
    }
    
    .form-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .btn svg {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.5rem;
    }
    
    .btn-cancel {
        background-color: white;
        color: #4b5563;
        border: 1px solid #d1d5db;
    }
    
    .btn-cancel:hover {
        background-color: #f9fafb;
    }
    
    .btn-primary {
        background: linear-gradient(to right, #2563eb, #4f46e5);
        color: white;
        border: none;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
    }
    
    .btn-primary:hover {
        background: linear-gradient(to right, #1d4ed8, #4338ca);
    }
    
    .support-card {
        margin-top: 1.5rem;
        background-color: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #eaeaea;
        display: flex;
        align-items: flex-start;
    }
    
    .support-icon {
        background-color: #dbeafe;
        border-radius: 50%;
        padding: 0.5rem;
        margin-right: 1rem;
    }
    
    .support-icon svg {
        width: 1.5rem;
        height: 1.5rem;
        color: #2563eb;
    }
    
    .support-content h3 {
        font-size: 1.1rem;
        font-weight: 500;
        margin-top: 0;
        margin-bottom: 0.25rem;
        color: #1f2937;
    }
    
    .support-content p {
        margin: 0;
        color: #6b7280;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .currency-wrapper {
        position: relative;
    }
    
    .currency-symbol {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
    }
    
    .currency-input {
        padding-left: 25px;
    }
    
    @media (max-width: 640px) {
        .budget-fields {
            flex-direction: column;
            gap: 1rem;
        }
        
        .form-buttons {
            flex-direction: column-reverse;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <!-- Header -->
        <div class="form-header">
            <h1>{{ isset($provider) ? 'Modifier le profil' : 'Créer un profil prestataire' }}</h1>
            <p>Complétez le formulaire ci-dessous pour {{ isset($provider) ? 'mettre à jour votre' : 'créer votre' }} profil professionnel</p>
        </div>

        <!-- Form content -->
        <div class="form-body">
            <form action="{{ isset($provider) ? route('service-providers.update', $provider) : route('service-providers.store') }}" 
                method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @if(isset($provider))
                    @method('PUT')
                @endif

                <div>
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-1">
                        Photo de profil
                    </label>
                    <div class="flex items-center space-x-4">
                        @if(isset($provider) && $provider->profile_picture)
                            <img src="{{ asset('storage/' . $provider->profile_picture) }}" 
                                alt="Profile picture" 
                                class="w-20 h-20 rounded-full object-cover">
                        @endif
                        <input type="file" name="profile_picture" id="profile_picture" 
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100"
                            accept="image/*">
                    </div>
                    @error('profile_picture')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="business_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nom de l'entreprise
                    </label>
                    <input type="text" name="business_name" id="business_name" 
                        value="{{ old('business_name', $provider->business_name ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        required>
                    @error('business_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="form-label">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="4" required
                        class="form-control"
                        placeholder="Décrivez votre entreprise et vos services...">{{ old('description', $provider->description ?? '') }}</textarea>
                    @error('description')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Service type -->
                <div class="form-group">
                    <label for="service_type" class="form-label">
                        Type de service
                    </label>
                    <select name="service_type" id="service_type" required
                        class="form-control">
                        <option value="">Sélectionnez un type de service</option>
                        <option value="photographe" {{ old('service_type', $provider->service_type ?? '') === 'photographe' ? 'selected' : '' }}>
                            Photographe
                        </option>
                        <option value="dj" {{ old('service_type', $provider->service_type ?? '') === 'dj' ? 'selected' : '' }}>
                            DJ
                        </option>
                        <option value="traiteur" {{ old('service_type', $provider->service_type ?? '') === 'traiteur' ? 'selected' : '' }}>
                            Traiteur
                        </option>
                        <option value="decoration" {{ old('service_type', $provider->service_type ?? '') === 'decoration' ? 'selected' : '' }}>
                            Décoration
                        </option>
                    </select>
                    @error('service_type')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div class="form-group">
                    <label for="location" class="form-label">
                        Localisation
                    </label>
                    <div class="input-icon-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <input type="text" name="location" id="location" 
                            value="{{ old('location', $provider->location ?? '') }}"
                            class="form-control input-with-icon"
                            placeholder="Ville ou région d'activité"
                            required>
                    </div>
                    @error('location')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Budget fields -->
                <div class="budget-section">
                    <h3>Budget estimé</h3>
                    <div class="budget-fields">
                        <div class="budget-field">
                            <label for="min_budget" class="form-label">
                                Budget minimum (€)
                            </label>
                            <div class="currency-wrapper">
                                <span class="currency-symbol">€</span>
                                <input type="number" name="min_budget" id="min_budget" 
                                    value="{{ old('min_budget', $provider->min_budget ?? '') }}"
                                    class="form-control currency-input"
                                    required min="0">
                            </div>
                            @error('min_budget')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="budget-field">
                            <label for="max_budget" class="form-label">
                                Budget maximum (€)
                            </label>
                            <div class="currency-wrapper">
                                <span class="currency-symbol">€</span>
                                <input type="number" name="max_budget" id="max_budget" 
                                    value="{{ old('max_budget', $provider->max_budget ?? '') }}"
                                    class="form-control currency-input"
                                    required min="0">
                            </div>
                            @error('max_budget')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form actions -->
                <div class="form-buttons">
                    <a href="{{ route('service-providers.index') }}" class="btn btn-cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ isset($provider) ? 'Mettre à jour' : 'Créer le profil' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Assistance information card -->
    <div class="support-card">
        <div class="support-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="support-content">
            <h3>Besoin d'aide ?</h3>
            <p>Si vous avez des questions concernant votre profil, n'hésitez pas à contacter notre équipe de support.</p>
        </div>
    </div>
</div>
@endsection