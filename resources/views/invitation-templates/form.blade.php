@extends('layouts.app')

@section('content')
<div class="page-container">
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="header">
            <div class="header-title">
                <i class="fas fa-plus-circle header-icon"></i>
                <h1>{{ isset($template) ? 'Modifier le modèle' : 'Créer un nouveau modèle' }}</h1>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ isset($template) ? route('invitation-templates.update', $template) : route('invitation-templates.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="form-container">
            @csrf
            @if(isset($template))
                @method('PUT')
            @endif

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Nom du modèle</label>
                <input class="form-input @error('name') form-input-error @enderror"
                       id="name"
                       type="text"
                       name="name"
                       value="{{ old('name', $template->name ?? '') }}"
                       required>
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Event Type -->
            <div class="form-group">
                <label for="type" class="form-label">Type d'événement</label>
                <div class="select-wrapper">
                    <select class="form-input @error('type') form-input-error @enderror"
                            id="type"
                            name="type"
                            required>
                        <option value="">Sélectionnez un type</option>
                        @foreach($templateTypes as $type)
                            <option value="{{ $type }}" {{ (old('type', $template->type ?? '') == $type) ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down select-icon"></i>
                </div>
                @error('type')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-input @error('description') form-input-error @enderror"
                          id="description"
                          name="description"
                          rows="4">{{ old('description', $template->description ?? '') }}</textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Thumbnail -->
            <div class="form-group">
                <label for="thumbnail" class="form-label">Image de couverture</label>
                <input type="file"
                       class="form-input @error('thumbnail') form-input-error @enderror"
                       id="thumbnail"
                       name="thumbnail"
                       accept="image/*"
                       {{ isset($template) ? '' : 'required' }}>
                @error('thumbnail')
                    <p class="form-error">{{ $message }}</p>
                @enderror
                @if(isset($template) && $template->thumbnail_path)
                    <div class="thumbnail-preview">
                        <img src="{{ Storage::url($template->thumbnail_path) }}" alt="Current thumbnail">
                    </div>
                @endif
            </div>

            <!-- Default Colors -->
            <div class="form-group">
                <label class="form-label">Couleurs par défaut</label>
                <div class="colors-grid">
                    <div class="color-item">
                        <label for="primary_color" class="color-label">Couleur principale</label>
                        <input type="color"
                               class="color-input"
                               id="primary_color"
                               name="default_colors[primary]"
                               value="{{ old('default_colors.primary', $template->default_colors['primary'] ?? '#000000') }}">
                    </div>
                    <div class="color-item">
                        <label for="secondary_color" class="color-label">Couleur secondaire</label>
                        <input type="color"
                               class="color-input"
                               id="secondary_color"
                               name="default_colors[secondary]"
                               value="{{ old('default_colors.secondary', $template->default_colors['secondary'] ?? '#ffffff') }}">
                    </div>
                </div>
            </div>

            <!-- Customizable Fields -->
            <div class="form-group">
                <label class="form-label">Champs personnalisables</label>
                <div class="checkbox-group">
                    @php
                        $customizableFields = old('customizable_fields', $template->customizable_fields ?? []);
                    @endphp
                    <label class="checkbox-item">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="title"
                               {{ in_array('title', $customizableFields) ? 'checked' : '' }}
                               class="checkbox-input">
                        <span>Titre</span>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="date"
                               {{ in_array('date', $customizableFields) ? 'checked' : '' }}
                               class="checkbox-input">
                        <span>Date</span>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="location"
                               {{ in_array('location', $customizableFields) ? 'checked' : '' }}
                               class="checkbox-input">
                        <span>Lieu</span>
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="description"
                               {{ in_array('description', $customizableFields) ? 'checked' : '' }}
                               class="checkbox-input">
                        <span>Description</span>
                    </label>
                </div>
            </div>

            <!-- Active Status -->
            @if(isset($template))
            <div class="form-group">
                <label class="checkbox-item">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ $template->is_active ? 'checked' : '' }}
                           class="checkbox-input">
                    <span>Modèle actif</span>
                </label>
            </div>
            @endif

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="submit-button">
                    <i class="fas fa-save"></i> {{ isset($template) ? 'Mettre à jour' : 'Créer' }}
                </button>
                <a href="{{ route('invitation-templates.index') }}" class="cancel-link">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Page Container */
    .page-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #e6f0ff 0%, #fff5f9 100%);
        padding: 40px 20px;
        font-family: 'Arial', sans-serif;
    }

    /* Content Wrapper */
    .content-wrapper {
        max-width: 700px;
        margin: 0 auto;
    }

    /* Header */
    .header {
        margin-bottom: 40px;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-icon {
        font-size: 32px;
        color: #4a00e0;
    }

    .header h1 {
        font-size: 36px;
        font-weight: 800;
        color: #2d2d2d;
        animation: fadeInDown 0.5s ease-out;
    }

    /* Form Container */
    .form-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        animation: fadeInUp 0.5s ease-out;
        transition: all 0.3s ease;
    }

    .form-container:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    /* Form Group */
    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        color: #2d2d2d;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #4a00e0;
        box-shadow: 0 0 0 3px rgba(74, 0, 224, 0.1);
    }

    .form-input-error {
        border-color: #dc3545;
    }

    .form-error {
        color: #dc3545;
        font-size: 12px;
        font-style: italic;
        margin-top: 5px;
    }

    /* Select Wrapper */
    .select-wrapper {
        position: relative;
    }

    .select-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 16px;
        pointer-events: none;
    }

    select.form-input {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    /* Textarea */
    textarea.form-input {
        resize: vertical;
        min-height: 100px;
    }

    /* Thumbnail Preview */
    .thumbnail-preview {
        margin-top: 10px;
    }

    .thumbnail-preview img {
        max-height: 150px;
        width: auto;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Colors Grid */
    .colors-grid {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .color-item {
        flex: 1;
        min-width: 120px;
    }

    .color-label {
        font-size: 12px;
        color: #666;
        margin-bottom: 6px;
    }

    .color-input {
        width: 100%;
        height: 40px;
        border-radius: 8px;
        border: 1px solid #ddd;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .color-input:hover {
        transform: scale(1.05);
    }

    /* Checkbox Group */
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #2d2d2d;
    }

    .checkbox-input {
        width: 16px;
        height: 16px;
        accent-color: #4a00e0;
        cursor: pointer;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .submit-button {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #4a00e0;
        color: white;
        padding: 12px 20px;
        border-radius: 50px;
        border: none;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-button:hover {
        background: #6a1bff;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .cancel-link {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #4a00e0;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .cancel-link:hover {
        color: #6a1bff;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header h1 {
            font-size: 28px;
        }

        .form-container {
            padding: 20px;
        }

        .colors-grid {
            flex-direction: column;
        }

        .form-actions {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 480px) {
        .header h1 {
            font-size: 24px;
        }

        .header-icon {
            font-size: 28px;
        }

        .form-input,
        .submit-button {
            font-size: 14px;
        }

        .thumbnail-preview img {
            max-height: 120px;
        }
    }
</style>
@endsection