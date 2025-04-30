@extends('layouts.app')

@section('content')
<div class="page-container">
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="header">
            <div class="header-title">
                <i class="fas fa-eye header-icon"></i>
                <h1>Aperçu du modèle</h1>
            </div>
            <div class="header-actions">
                <a href="{{ route('invitation-templates.customize', $template) }}" class="action-button customize">
                    <i class="fas fa-edit"></i> Personnaliser
                </a>
                <a href="{{ route('invitation-templates.index') }}" class="action-button back">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>

        <!-- Template Preview Card -->
        <div class="preview-card">
            <!-- Thumbnail Section -->
            <div class="thumbnail-wrapper">
                <img src="{{ Storage::url($template->thumbnail_path) }}" alt="{{ $template->name }}" class="thumbnail">
                <div class="thumbnail-overlay">
                    <h2>{{ $template->name }}</h2>
                </div>
            </div>

            <!-- Content Section -->
            <div class="card-content">
                <!-- Description -->
                <div class="section">
                    <h3 class="section-title">Description</h3>
                    <p class="section-text">{{ $template->description }}</p>
                </div>

                <!-- Event Type -->
                <div class="section">
                    <h3 class="section-title">Type d'événement</h3>
                    <span class="event-type">{{ ucfirst($template->type) }}</span>
                </div>

                <!-- Default Colors -->
                <div class="section">
                    <h3 class="section-title">Couleurs par défaut</h3>
                    <div class="colors-grid">
                        <div class="color-item">
                            <span class="color-label">Couleur principale</span>
                            <div class="color-box" style="background-color: {{ $template->default_colors['primary'] ?? '#000000' }}"></div>
                        </div>
                        <div class="color-item">
                            <span class="color-label">Couleur secondaire</span>
                            <div class="color-box" style="background-color: {{ $template->default_colors['secondary'] ?? '#ffffff' }}"></div>
                        </div>
                    </div>
                </div>

                <!-- Customizable Fields -->
                <div class="section">
                    <h3 class="section-title">Champs personnalisables</h3>
                    <div class="fields-grid">
                        @foreach($template->customizable_fields as $field)
                        <div class="field-item">
                            <i class="fas fa-check-circle field-icon"></i>
                            <span>{{ ucfirst($field) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
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
        background: linear-gradient(135deg, #e6f0ff 0%, #fff5f9 100%);
        padding: 40px 20px;
        font-family: 'Arial', sans-serif;
    }

    /* Content Wrapper */
    .content-wrapper {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Header */
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

    .header-actions {
        display: flex;
        gap: 15px;
    }

    .action-button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 50px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }

    .customize {
        background: #28a745;
    }

    .customize:hover {
        background: #38c95f;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .back {
        background: #6b7280;
    }

    .back:hover {
        background: #8b95a5;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Preview Card */
    .preview-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.5s ease-out;
        transition: all 0.3s ease;
    }

    .preview-card:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    /* Thumbnail */
    .thumbnail-wrapper {
        position: relative;
        overflow: hidden;
    }

    .thumbnail {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: opacity 0.3s ease;
    }

    .preview-card:hover .thumbnail {
        opacity: 0.9;
    }

    .thumbnail-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s ease;
    }

    .thumbnail-overlay h2 {
        font-size: 36px;
        font-weight: 800;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Card Content */
    .card-content {
        padding: 30px;
    }

    /* Section */
    .section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 10px;
    }

    .section-text {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    /* Event Type */
    .event-type {
        display: inline-block;
        background: #4a00e0;
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .event-type:hover {
        background: #6a1bff;
    }

    /* Colors Grid */
    .colors-grid {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .color-item {
        text-align: center;
    }

    .color-label {
        display: block;
        font-size: 14px;
        color: #666;
        margin-bottom: 8px;
    }

    .color-box {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .color-box:hover {
        transform: scale(1.1);
    }

    /* Fields Grid */
    .fields-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }

    .field-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #2d2d2d;
    }

    .field-icon {
        font-size: 18px;
        color: #28a745;
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
        .header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
        }

        .thumbnail {
            height: 250px;
        }

        .thumbnail-overlay h2 {
            font-size: 28px;
        }

        .colors-grid {
            flex-direction: column;
            align-items: center;
        }

        .fields-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .header h1 {
            font-size: 24px;
        }

        .action-button {
            padding: 10px 16px;
            font-size: 14px;
        }

        .thumbnail {
            height: 200px;
        }

        .thumbnail-overlay h2 {
            font-size: 24px;
        }

        .card-content {
            padding: 20px;
        }

        .section-title {
            font-size: 18px;
        }

        .section-text {
            font-size: 14px;
        }
    }
</style>
@endsection