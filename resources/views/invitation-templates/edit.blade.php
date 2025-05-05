@extends('layouts.app')

@php
use App\Models\InvitationTemplate;
@endphp

@section('content')
<script>
    function removeThumbnail(path) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
            // Create a hidden input to indicate thumbnail removal
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_remove_thumbnail';
            input.value = '1';
            document.getElementById('templateForm').appendChild(input);

            // Remove the thumbnail preview
            const preview = document.querySelector('.thumbnail-preview');
            if (preview) {
                preview.remove();
            }
        }
    }
</script>
<div class="page-container">
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="header">
            <div class="header-title">
                <a href="{{ route('invitation-templates.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <i class="fas fa-edit header-icon"></i>
                <h1>Modifier le modèle</h1>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('invitation-templates.update', $template) }}"
              method="POST"
              enctype="multipart/form-data"
              class="form-container">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Nom du modèle</label>
                <div class="input-wrapper">
                    <input class="form-input @error('name') form-input-error @enderror"
                           id="name"
                           type="text"
                           name="name"
                           value="{{ old('name', $template->name ?? '') }}"
                           required
                           placeholder="Entrez le nom du modèle">
                    <i class="fas fa-tag input-icon"></i>
                </div>
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
                        @foreach(InvitationTemplate::getTemplateTypes() as $type)
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
                <div class="textarea-wrapper">
                    <textarea class="form-input @error('description') form-input-error @enderror"
                              id="description"
                              name="description"
                              rows="4"
                              placeholder="Décrivez le modèle d'invitation">{{ old('description', $template->description ?? '') }}</textarea>
                    <i class="fas fa-align-left textarea-icon"></i>
                </div>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Thumbnail -->
            <div class="form-group">
                <label for="thumbnail" class="form-label">Image de couverture</label>
                <div class="file-upload-wrapper">
                    <div class="file-upload-container">
                        <input type="file"
                               class="form-input file-input @error('thumbnail') form-input-error @enderror"
                               id="thumbnail"
                               name="thumbnail"
                               accept="image/*">
                        <div class="upload-preview">
                            <i class="fas fa-image upload-icon"></i>
                            <span class="upload-text">Choisir une image</span>
                        </div>
                    </div>
                    @if($template->thumbnail_path)
                        <div class="thumbnail-preview mt-2">
                            <div class="thumbnail-container">
                                <img src="{{ Storage::url($template->thumbnail_path) }}" 
                                     alt="Current thumbnail" 
                                     class="rounded-lg thumbnail-image">
                                <button type="button" class="remove-thumbnail" onclick="removeThumbnail('{{ $template->thumbnail_path }}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                @error('thumbnail')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Default Colors -->
            <div class="form-group">
                <label class="form-label">Couleurs par défaut</label>
                <div class="colors-grid">
                    <div class="color-item">
                        <label for="primary_color" class="color-label">Couleur principale</label>
                        <div class="color-picker-wrapper">
                            <input type="color"
                                   class="color-input"
                                   id="primary_color"
                                   name="default_colors[primary]"
                                   value="{{ old('default_colors.primary', $template->default_colors['primary'] ?? '#000000') }}">
                            <div class="color-preview" style="background-color: {{ old('default_colors.primary', $template->default_colors['primary'] ?? '#000000') }}"></div>
                        </div>
                    </div>
                    <div class="color-item">
                        <label for="secondary_color" class="color-label">Couleur secondaire</label>
                        <div class="color-picker-wrapper">
                            <input type="color"
                                   class="color-input"
                                   id="secondary_color"
                                   name="default_colors[secondary]"
                                   value="{{ old('default_colors.secondary', $template->default_colors['secondary'] ?? '#ffffff') }}">
                            <div class="color-preview" style="background-color: {{ old('default_colors.secondary', $template->default_colors['secondary'] ?? '#ffffff') }}"></div>
                        </div>
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
                    <div class="custom-checkbox">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="title"
                               class="checkbox-input"
                               id="title"
                               {{ in_array('title', $customizableFields) ? 'checked' : '' }}>
                        <label for="title" class="checkbox-label">
                            <span class="checkbox-text">Titre</span>
                            <i class="fas fa-edit checkbox-icon"></i>
                        </label>
                    </div>
                    <div class="custom-checkbox">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="date"
                               class="checkbox-input"
                               id="date"
                               {{ in_array('date', $customizableFields) ? 'checked' : '' }}>
                        <label for="date" class="checkbox-label">
                            <span class="checkbox-text">Date</span>
                            <i class="fas fa-calendar checkbox-icon"></i>
                        </label>
                    </div>
                    <div class="custom-checkbox">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="location"
                               class="checkbox-input"
                               id="location"
                               {{ in_array('location', $customizableFields) ? 'checked' : '' }}>
                        <label for="location" class="checkbox-label">
                            <span class="checkbox-text">Lieu</span>
                            <i class="fas fa-map-marker-alt checkbox-icon"></i>
                        </label>
                    </div>
                    <div class="custom-checkbox">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="description"
                               class="checkbox-input"
                               id="description"
                               {{ in_array('description', $customizableFields) ? 'checked' : '' }}>
                        <label for="description" class="checkbox-label">
                            <span class="checkbox-text">Description</span>
                            <i class="fas fa-align-left checkbox-icon"></i>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Active Status -->
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

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="submit-button">
                    <i class="fas fa-save"></i> Mettre à jour
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
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Header */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-icon {
        font-size: 1.5rem;
        color: #0d6efd;
    }

    .header h1 {
        font-size: 1.75rem;
        color: #333;
    }

    .back-button {
        color: #6c757d;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        border-radius: 6px;
        transition: color 0.3s ease;
    }

    .back-button:hover {
        color: #0d6efd;
    }

    /* Form Styles */
    .form-container {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #444;
    }

    .input-wrapper,
    .textarea-wrapper,
    .select-wrapper,
    .file-upload-wrapper {
        position: relative;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }

    .input-icon,
    .textarea-icon,
    .select-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        pointer-events: none;
    }

    .textarea-wrapper textarea {
        resize: vertical;
        min-height: 100px;
    }

    .select-wrapper select {
        width: 100%;
        padding: 0.75rem;
        border: none;
        border-radius: 6px;
        background: transparent;
    }

    .file-upload-container {
        position: relative;
        cursor: pointer;
        background: #f8f9fa;
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 2rem 1rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .file-upload-container:hover {
        border-color: #6c757d;
        background: #e9ecef;
    }

    .file-input {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .upload-preview {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }

    .upload-icon {
        font-size: 2rem;
        color: #6c757d;
    }

    .upload-text {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .thumbnail-preview {
        margin-top: 1rem;
    }

    .thumbnail-container {
        position: relative;
        width: 150px;
        height: 150px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .thumbnail-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .remove-thumbnail {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .remove-thumbnail:hover {
        transform: rotate(90deg);
    }

    .remove-thumbnail i {
        font-size: 12px;
    }

    .colors-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .color-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .color-label {
        font-size: 0.9rem;
        color: #444;
    }

    .color-picker-wrapper {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .color-input {
        width: 2rem;
        height: 2rem;
        padding: 0;
    }

    .color-preview {
        width: 2rem;
        height: 2rem;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .custom-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .checkbox-input {
        display: none;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .checkbox-label:hover {
        background: #f8f9fa;
    }

    .checkbox-input:checked + .checkbox-label {
        background: #0d6efd;
        color: white;
    }

    .checkbox-icon {
        font-size: 1rem;
        color: #6c757d;
    }

    .checkbox-input:checked + .checkbox-label .checkbox-icon {
        color: white;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }

    .submit-button,
    .cancel-link {
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .submit-button {
        background: #0d6efd;
        color: white;
        border: none;
        cursor: pointer;
    }

    .submit-button:hover {
        background: #0b5ed7;
    }

    .cancel-link {
        color: #6c757d;
    }

    .cancel-link:hover {
        color: #0d6efd;
    }

    /* Error Styles */
    .form-input-error {
        border-color: #dc3545;
    }

    .form-error {
        color: #dc3545;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }
</style>
@endsection