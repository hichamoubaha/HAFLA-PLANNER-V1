@extends('layouts.app')

@php
use App\Models\InvitationTemplate;

// Get template types directly
$templateTypes = InvitationTemplate::getTemplateTypes();
@endphp

@section('content')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('templateModal');
    const openModalBtn = document.getElementById('openModal');
    const closeModalBtn = document.getElementById('closeModal');
    const closeButtons = document.querySelectorAll('.close-modal');

    // Open modal
    if (openModalBtn) {
        openModalBtn.addEventListener('click', function() {
            modal.style.display = 'block';
        });
    }

    // Close modal
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    // Close modal when clicking close buttons
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    });

    // Handle form submission
    const form = document.getElementById('templateForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    modal.style.display = 'none';
                    location.reload(); // Refresh page to show new template
                } else {
                    alert(data.message || 'Une erreur est survenue');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue lors de la création du modèle');
            });
        });
    }
});
</script>
<div class="page-container">
    <!-- Header Section -->
    <div class="content-wrapper">
        <div class="header">
            <div class="header-title">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <i class="fas fa-ticket-alt header-icon"></i>
                <h1>Modèles d'invitations</h1>
            </div>
            @if(auth()->user()->role === 'organisateur')
            <button type="button" class="add-button" id="openModal">
                <i class="fas fa-plus"></i> Ajouter un modèle
            </button>
            @endif

            <!-- Modal Dialog -->
            <div id="templateModal" class="modal">
                <div class="modal-overlay"></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Ajouter un modèle d'invitation</h2>
                        <button type="button" class="close-modal" id="closeModal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="templateForm" action="{{ route('invitation-templates.store') }}" method="POST" enctype="multipart/form-data" class="template-form">
                            @csrf

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="form-label">Nom du modèle</label>
                                <div class="input-wrapper">
                                    <input class="form-input @error('name') form-input-error @enderror"
                                           id="name"
                                           type="text"
                                           name="name"
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
                                        @foreach($templateTypes as $type)
                                            <option value="{{ $type }}">
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
                                              placeholder="Décrivez le modèle d'invitation"></textarea>
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
                                               accept="image/*"
                                               required>
                                        <div class="upload-preview">
                                            <i class="fas fa-image upload-icon"></i>
                                            <span class="upload-text">Choisir une image</span>
                                        </div>
                                    </div>
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
                                                   value="#000000">
                                            <div class="color-preview" style="background-color: #000000"></div>
                                        </div>
                                    </div>
                                    <div class="color-item">
                                        <label for="secondary_color" class="color-label">Couleur secondaire</label>
                                        <div class="color-picker-wrapper">
                                            <input type="color"
                                                   class="color-input"
                                                   id="secondary_color"
                                                   name="default_colors[secondary]"
                                                   value="#ffffff">
                                            <div class="color-preview" style="background-color: #ffffff"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customizable Fields -->
                            <div class="form-group">
                                <label class="form-label">Champs personnalisables</label>
                                <div class="checkbox-group">
                                    <div class="custom-checkbox">
                                        <input type="checkbox"
                                               name="customizable_fields[]"
                                               value="title"
                                               class="checkbox-input"
                                               id="title">
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
                                               id="date">
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
                                               id="location">
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
                                               id="description">
                                        <label for="description" class="checkbox-label">
                                            <span class="checkbox-text">Description</span>
                                            <i class="fas fa-align-left checkbox-icon"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-modal">
                                    <i class="fas fa-times"></i>
                                    Annuler
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Créer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <style>
                /* Modal Styles */
                .modal {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    z-index: 1000;
                    overflow-x: hidden;
                    overflow-y: auto;
                }

                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 1001;
                }

                .modal-content {
                    position: relative;
                    background-color: #fff;
                    margin: 50px auto;
                    padding: 2rem;
                    width: 90%;
                    max-width: 600px;
                    border-radius: 12px;
                    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
                    z-index: 1002;
                    animation: fadeInDown 0.3s ease-out;
                }

                .modal-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 2rem;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid #eee;
                }

                .modal-title {
                    font-size: 1.5rem;
                    font-weight: 600;
                    color: #333;
                }

                .close-modal {
                    background: none;
                    border: none;
                    font-size: 1.5rem;
                    color: #666;
                    cursor: pointer;
                    padding: 0.5rem;
                    transition: color 0.3s ease;
                }

                .close-modal:hover {
                    color: #dc3545;
                }

                /* Form Styles */
                .template-form {
                    display: flex;
                    flex-direction: column;
                    gap: 1.5rem;
                }

                .form-group {
                    display: flex;
                    flex-direction: column;
                    gap: 0.5rem;
                }

                .form-label {
                    font-weight: 500;
                    color: #444;
                    margin-bottom: 0.5rem;
                }

                .input-wrapper,
                .textarea-wrapper,
                .select-wrapper,
                .file-upload-wrapper {
                    position: relative;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 0.5rem;
                    transition: border-color 0.3s ease;
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

                .select-wrapper select:focus {
                    outline: none;
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

                .modal-footer {
                    display: flex;
                    justify-content: flex-end;
                    gap: 1rem;
                    margin-top: 2rem;
                    padding-top: 1rem;
                    border-top: 1px solid #eee;
                }

                .btn {
                    padding: 0.75rem 1.5rem;
                    border-radius: 6px;
                    font-weight: 500;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }

                .btn-secondary {
                    background: #6c757d;
                    color: white;
                }

                .btn-secondary:hover {
                    background: #5a6268;
                }

                .btn-primary {
                    background: #0d6efd;
                    color: white;
                }

                .btn-primary:hover {
                    background: #0b5ed7;
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
            </style>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="success-message" role="alert">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Templates Grid -->
        <div class="templates-grid">
            @foreach($templates as $template)
            <div class="template-card">
                <!-- Thumbnail with Overlay -->
                <div class="thumbnail-wrapper">
                    <img src="{{ Storage::url($template->thumbnail_path) }}" alt="{{ $template->name }}" class="thumbnail">
                    <div class="thumbnail-overlay">
                        <span class="template-type">{{ ucfirst($template->type) }}</span>
                    </div>
                </div>
                <!-- Content -->
                <div class="card-content">
                    <h2 class="card-title">{{ $template->name }}</h2>
                    <p class="card-description">{{ $template->description }}</p>
                    <!-- Actions -->
                    <div class="card-actions">
                        <a href="{{ route('invitation-templates.preview', $template) }}" class="action-link preview">
                            <i class="fas fa-eye"></i> Aperçu
                        </a>
                        @if(auth()->user()->role === 'user')
                        <a href="{{ route('invitation-templates.customize', $template) }}" class="action-link customize">
                            <i class="fas fa-edit"></i> Personnaliser
                        </a>
                        @endif
                        @if(auth()->user()->role === 'organisateur')
                        <a href="{{ route('invitation-templates.edit', $template->id) }}" class="text-yellow-500 hover:text-yellow-700">
                            <i class="fas fa-cog"></i> Modifier
                        </a>
                        <form action="{{ route('invitation-templates.destroy', $template->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce modèle ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
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
        background: linear-gradient(135deg, #f0f4ff 0%, #ffeef5 100%);
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

    .add-button {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #4a00e0;
        color: white;
        padding: 12px 20px;
        border-radius: 50px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .add-button:hover {
        background: #6a1bff;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Success Message */
    .success-message {
        background: #e6ffed;
        border-left: 4px solid #28a745;
        color: #1a3c34;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideInRight 0.5s ease-out;
    }

    .success-message i {
        font-size: 20px;
        color: #28a745;
    }

    /* Templates Grid */
    .templates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    /* Template Card */
    .template-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        animation: fadeInUp 0.5s ease-out;
    }

    .template-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    /* Thumbnail */
    .thumbnail-wrapper {
        position: relative;
        overflow: hidden;
    }

    .thumbnail {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: opacity 0.3s ease;
    }

    .template-card:hover .thumbnail {
        opacity: 0.9;
    }

    .thumbnail-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
        opacity: 0;
        display: flex;
        align-items: flex-end;
        padding: 15px;
        transition: opacity 0.3s ease;
    }

    .template-card:hover .thumbnail-overlay {
        opacity: 1;
    }

    .template-type {
        background: #4a00e0;
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    /* Card Content */
    .card-content {
        padding: 20px;
    }

    .card-title {
        font-size: 22px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 10px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .card-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Card Actions */
    .card-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .action-link {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .action-link i {
        font-size: 16px;
    }

    .preview { color: #4a00e0; }
    .preview:hover { color: #6a1bff; }
    .customize { color: #28a745; }
    .customize:hover { color: #38c95f; }
    .edit { color: #e0a800; }
    .edit:hover { color: #ffc107; }

    .delete-button {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 600;
        color: white;
        background: #dc3545;
        padding: 8px 12px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .delete-button:hover {
        background: #ff4d5e;
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .delete-button i {
        font-size: 16px;
    }

    .action-form {
        display: inline;
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

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
        }

        .templates-grid {
            grid-template-columns: 1fr;
        }

        .thumbnail {
            height: 180px;
        }
    }

    @media (max-width: 480px) {
        .header h1 {
            font-size: 24px;
        }

        .add-button {
            padding: 10px 16px;
            font-size: 14px;
        }

        .card-title {
            font-size: 18px;
        }

        .card-actions {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    .back-button {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4a00e0;
        text-decoration: none;
        font-weight: 600;
        margin-right: 20px;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        color: #6a1bff;
        transform: translateX(-5px);
    }

    .back-button i {
        font-size: 16px;
    }
</style>
@endsection