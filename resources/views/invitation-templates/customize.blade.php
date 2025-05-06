@extends('layouts.app')

@section('content')
<div class="page-container">
    
    <div class="content-wrapper">
        
        <div class="header">
            <div class="header-title">
                <i class="fas fa-edit header-icon"></i>
                <h1>Personnaliser l'invitation</h1>
            </div>
            <a href="{{ route('invitation-templates.index') }}" class="back-button">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        
        <div class="content-grid">
            
            <div class="form-card">
                <form id="customizationForm" action="{{ route('invitation-templates.save-customization', $template) }}" method="POST" enctype="multipart/form-data" class="form-container">
                    @csrf
                    @foreach($template->customizable_fields as $field)
                        <div class="form-group">
                            <label for="{{ $field }}" class="form-label">{{ ucfirst($field) }}</label>
                            @if($field === 'description')
                                <textarea
                                    id="{{ $field }}"
                                    name="{{ $field }}"
                                    class="form-input"
                                    rows="4"></textarea>
                            @else
                                <input
                                    type="text"
                                    id="{{ $field }}"
                                    name="{{ $field }}"
                                    class="form-input">
                            @endif
                        </div>
                    @endforeach

                    
                    <div class="form-group">
                        <label class="form-label">Couleurs</label>
                        <div class="colors-grid">
                            <div class="color-item">
                                <label for="primary_color" class="color-label">Couleur principale</label>
                                <input type="color"
                                       id="primary_color"
                                       name="primary_color"
                                       class="color-input"
                                       value="{{ $template->default_colors['primary'] ?? '#000000' }}">
                            </div>
                            <div class="color-item">
                                <label for="secondary_color" class="color-label">Couleur secondaire</label>
                                <input type="color"
                                       id="secondary_color"
                                       name="secondary_color"
                                       class="color-input"
                                       value="{{ $template->default_colors['secondary'] ?? '#ffffff' }}">
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="cover_image" class="form-label">Image de couverture</label>
                        <input type="file"
                               id="cover_image"
                               name="cover_image"
                               accept="image/*"
                               class="form-input">
                    </div>

                    
                    <button type="submit" class="submit-button">
                        <i class="fas fa-save"></i> Générer l'invitation
                    </button>
                </form>
            </div>

            
            <div class="preview-card">
                <h2 class="preview-title">Aperçu</h2>
                <div id="preview" class="preview-container">
                    <div id="previewBackground" class="preview-background" style="background-image: url('{{ Storage::url($template->thumbnail_path) }}')">
                        <div class="preview-overlay"></div>
                    </div>
                    <div class="preview-content">
                        <h1 id="previewTitle" class="preview-text preview-title-text">Titre de l'événement</h1>
                        <div id="previewDate" class="preview-text preview-subtitle"></div>
                        <div id="previewLocation" class="preview-text preview-subtitle"></div>
                        <p id="previewDescription" class="preview-text preview-description"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('customizationForm');
    const preview = document.getElementById('preview');
    const inputs = form.querySelectorAll('input, textarea');
    const colorInputs = document.querySelectorAll('input[type="color"]');
    const coverImageInput = document.getElementById('cover_image');

    
    function updatePreview() {
        const formData = new FormData(form);
        
        
        document.getElementById('previewTitle').textContent = formData.get('title') || 'Titre de l\'événement';
        document.getElementById('previewDate').textContent = formData.get('date') || 'Date de l\'événement';
        document.getElementById('previewLocation').textContent = formData.get('location') || 'Lieu de l\'événement';
        document.getElementById('previewDescription').textContent = formData.get('description') || 'Description de l\'événement';

        
        const primaryColor = formData.get('primary_color');
        const secondaryColor = formData.get('secondary_color');
        preview.style.setProperty('--primary-color', primaryColor);
        preview.style.setProperty('--secondary-color', secondaryColor);
    }

    
    inputs.forEach(input => {
        input.addEventListener('input', updatePreview);
    });

    
    colorInputs.forEach(input => {
        input.addEventListener('input', updatePreview);
    });

    
    coverImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewBackground').style.backgroundImage = `url('${e.target.result}')`;
            };
            reader.readAsDataURL(file);
        }
    });

    
    updatePreview();
});
</script>
@endpush

<style>
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    
    .page-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #e6f0ff 0%, #fff5f9 100%);
        padding: 40px 20px;
        font-family: 'Arial', sans-serif;
    }

    
    .content-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        flex-wrap: wrap;
        gap: 20px;
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

    .back-button {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #6b7280;
        color: white;
        padding: 12px 20px;
        border-radius: 50px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background: #8b95a5;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
    }

    
    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        animation: fadeInUp 0.5s ease-out;
        transition: all 0.3s ease;
    }

    .form-card:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .form-container {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
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

    textarea.form-input {
        resize: vertical;
        min-height: 100px;
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
        display: block;
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

    /* Submit Button */
    .submit-button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #4a00e0;
        color: white;
        padding: 12px;
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

    /* Preview Card */
    .preview-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        animation: fadeInUp 0.5s ease-out;
        transition: all 0.3s ease;
    }

    .preview-card:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .preview-title {
        font-size: 20px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 20px;
    }

    .preview-container {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        min-height: 600px;
        border: 1px solid #ddd;
    }

    .preview-background {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        transition: opacity 0.3s ease;
    }

    .preview-container:hover .preview-background {
        opacity: 0.9;
    }

    .preview-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        transition: background 0.3s ease;
    }

    .preview-content {
        position: relative;
        z-index: 10;
        padding: 30px;
        color: white;
    }

    .preview-text {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .preview-title-text {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 20px;
        color: var(--primary-color, white);
    }

    .preview-subtitle {
        font-size: 20px;
        margin-bottom: 15px;
        color: var(--secondary-color, white);
    }

    .preview-description {
        font-size: 16px;
        line-height: 1.6;
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
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .preview-container {
            min-height: 500px;
        }
    }

    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
        }

        .form-card,
        .preview-card {
            padding: 20px;
        }

        .preview-title-text {
            font-size: 28px;
        }

        .preview-subtitle {
            font-size: 18px;
        }

        .preview-description {
            font-size: 14px;
        }

        .colors-grid {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .header h1 {
            font-size: 24px;
        }

        .header-icon {
            font-size: 28px;
        }

        .back-button,
        .submit-button {
            font-size: 14px;
            padding: 10px 16px;
        }

        .form-input,
        .preview-title {
            font-size: 14px;
        }

        .preview-container {
            min-height: 400px;
        }

        .preview-content {
            padding: 20px;
        }
    }
</style>
@endsection