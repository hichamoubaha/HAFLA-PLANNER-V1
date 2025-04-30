@extends('layouts.app')

@section('content')
<div class="page-container">
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="header">
            <div class="header-title">
                <i class="fas fa-ticket-alt header-icon"></i>
                <h1>Votre invitation personnalisée</h1>
            </div>
            <div class="header-actions">
                <a href="{{ route('invitation-templates.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Retour aux modèles
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="success-message" role="alert">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Invitation Card -->
        <div class="invitation-card">
            <!-- Thumbnail Section -->
            <div class="thumbnail-wrapper">
                @if($customizedInvitation->cover_image_path)
                    <img src="{{ Storage::url($customizedInvitation->cover_image_path) }}" alt="Cover" class="thumbnail">
                @else
                    <img src="{{ Storage::url($customizedInvitation->template->thumbnail_path) }}" alt="Template" class="thumbnail">
                @endif
                <div class="thumbnail-overlay">
                    <h2>{{ $customizedInvitation->title ?? $customizedInvitation->template->name }}</h2>
                </div>
            </div>

            <!-- Content Section -->
            <div class="card-content">
                <div class="details-grid">
                    <!-- Invitation Details -->
                    <div class="details-section">
                        <h3 class="section-title">Détails de l'invitation</h3>
                        @if($customizedInvitation->date)
                        <div class="detail-item">
                            <span class="detail-label">Date</span>
                            <span class="detail-value">{{ $customizedInvitation->date }}</span>
                        </div>
                        @endif
                        @if($customizedInvitation->location)
                        <div class="detail-item">
                            <span class="detail-label">Lieu</span>
                            <span class="detail-value">{{ $customizedInvitation->location }}</span>
                        </div>
                        @endif
                        @if($customizedInvitation->description)
                        <div class="detail-item">
                            <span class="detail-label">Description</span>
                            <p class="detail-value">{{ $customizedInvitation->description }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Customization Details -->
                    <div class="details-section">
                        <h3 class="section-title">Personnalisation</h3>
                        <div class="detail-item">
                            <span class="detail-label">Modèle utilisé</span>
                            <span class="detail-value">{{ $customizedInvitation->template->name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Couleurs</span>
                            <div class="colors-grid">
                                @if($customizedInvitation->primary_color)
                                <div class="color-item">
                                    <span class="color-label">Principale</span>
                                    <div class="color-box" style="background-color: {{ $customizedInvitation->primary_color }}"></div>
                                </div>
                                @endif
                                @if($customizedInvitation->secondary_color)
                                <div class="color-item">
                                    <span class="color-label">Secondaire</span>
                                    <div class="color-box" style="background-color: {{ $customizedInvitation->secondary_color }}"></div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Créée le</span>
                            <span class="detail-value">{{ $customizedInvitation->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="action-wrapper">
                    <a href="{{ route('invitation-templates.customize', $customizedInvitation->template) }}" class="action-button">
                        <i class="fas fa-plus"></i> Créer une nouvelle invitation
                    </a>
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

    /* Invitation Card */
    .invitation-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.5s ease-out;
        transition: all 0.3s ease;
    }

    .invitation-card:hover {
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

    .invitation-card:hover .thumbnail {
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

    /* Details Grid */
    .details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .details-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 10px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .detail-label {
        font-size: 14px;
        font-weight: 500;
        color: #666;
    }

    .detail-value {
        font-size: 16px;
        color: #2d2d2d;
        line-height: 1.5;
    }

    .detail-value p {
        margin: 0;
    }

    /* Colors Grid */
    .colors-grid {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .color-item {
        text-align: center;
    }

    .color-label {
        font-size: 12px;
        color: #666;
        margin-bottom: 6px;
        display: block;
    }

    .color-box {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .color-box:hover {
        transform: scale(1.1);
    }

    /* Action Wrapper */
    .action-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .action-button {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #4a00e0;
        color: white;
        padding: 12px 24px;
        border-radius: 50px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .action-button:hover {
        background: #6a1bff;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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
            align-items: center;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .thumbnail {
            height: 250px;
        }

        .thumbnail-overlay h2 {
            font-size: 28px;
        }

        .card-content {
            padding: 20px;
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
        .action-button {
            font-size: 14px;
            padding: 10px 16px;
        }

        .thumbnail {
            height: 200px;
        }

        .thumbnail-overlay h2 {
            font-size: 24px;
        }

        .section-title {
            font-size: 18px;
        }

        .detail-value {
            font-size: 14px;
        }

        .colors-grid {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endsection