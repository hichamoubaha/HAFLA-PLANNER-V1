@extends('layouts.app')

@section('content')
<div class="page-container">
    <!-- Header Section -->
    <div class="content-wrapper">
        <div class="header">
            <div class="header-title">
                <i class="fas fa-ticket-alt header-icon"></i>
                <h1>Modèles d'invitations</h1>
            </div>
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'organisateur')
            <a href="{{ route('invitation-templates.create') }}" class="add-button">
                <i class="fas fa-plus"></i> Ajouter un modèle
            </a>
            @endif
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
                        <a href="{{ route('invitation-templates.customize', $template) }}" class="action-link customize">
                            <i class="fas fa-edit"></i> Personnaliser
                        </a>
                        @if(auth()->user()->is_admin)
                        <a href="{{ route('invitation-templates.edit', $template) }}" class="action-link edit">
                            <i class="fas fa-cog"></i> Modifier
                        </a>
                        <form action="{{ route('invitation-templates.destroy', $template) }}" method="POST" class="action-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-link delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce modèle ?')">
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
    .delete { color: #dc3545; background: none; border: none; cursor: pointer; }
    .delete:hover { color: #ff4d5e; }

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
</style>
@endsection