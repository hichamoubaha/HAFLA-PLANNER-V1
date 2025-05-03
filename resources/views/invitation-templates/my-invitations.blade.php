@extends('layouts.app')

@section('content')
<div class="page-container">
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="header">
            <div class="header-title">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <i class="fas fa-list-alt header-icon"></i>
                <h1>Mes invitations personnalisées</h1>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Invitations Card -->
        <div class="invitations-card">
            @if($invitations->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-exclamation-circle empty-icon"></i>
                    <p>Vous n'avez pas encore personnalisé d'invitations.</p>
                    <a href="{{ route('invitation-templates.index') }}" class="empty-action">
                        <i class="fas fa-plus"></i> Créer une invitation
                    </a>
                </div>
            @else
                <div class="invitations-list">
                    @foreach($invitations as $invitation)
                        <div class="invitation-item">
                            <div class="item-header">
                                <h5 class="item-title">{{ $invitation->template->name }}</h5>
                                <span class="item-date">{{ $invitation->created_at->format('d M, Y') }}</span>
                            </div>
                            @if($invitation->cover_image_path)
                                <div class="item-image">
                                    <img src="{{ Storage::url($invitation->cover_image_path) }}" alt="Cover Image" class="cover-image">
                                </div>
                            @endif
                            <p class="item-description">Personnalisée avec vos détails</p>
                            <div class="item-actions">
                                <a href="{{ url('/invitation-templates/' . $invitation->id) }}" class="action-button view-button">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="{{ route('invitation-templates.generate-pdf', $invitation->id) }}" class="action-button pdf-button" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                                <form action="{{ route('invitation-templates.destroy-customized', $invitation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-button delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette invitation ?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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
        max-width: 800px;
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

    /* Invitations Card */
    .invitations-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        animation: fadeInUp 0.5s ease-out;
        transition: all 0.3s ease;
    }

    .invitations-card:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    /* Empty State */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 15px;
        padding: 40px 20px;
    }

    .empty-icon {
        font-size: 48px;
        color: #666;
    }

    .empty-state p {
        font-size: 16px;
        color: #666;
        margin: 0;
    }

    .empty-action {
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

    .empty-action:hover {
        background: #6a1bff;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Invitations List */
    .invitations-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .invitation-item {
        background: #f9f9f9;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
        animation: fadeInUp 0.5s ease-out;
    }

    .invitation-item:hover {
        background: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }

    .item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .item-title {
        font-size: 18px;
        font-weight: 700;
        color: #2d2d2d;
        margin: 0;
    }

    .item-date {
        font-size: 14px;
        color: #666;
    }

    .item-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .item-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-right: 8px;
    }

    .pdf-button {
        background: #dc3545;
        color: white;
    }

    .pdf-button:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }

    .view-button {
        background: #4a00e0;
        color: white;
    }

    .view-button:hover {
        background: #6a1bff;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .delete-button {
        background: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
    }

    .delete-button:hover {
        background: #c82333;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .header h1 {
            font-size: 28px;
        }

        .invitations-card {
            padding: 20px;
        }

        .item-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .item-actions {
            flex-direction: row;
            justify-content: flex-start;
        }

        .cover-image {
            height: 150px;
        }
    }

    @media (max-width: 480px) {
        .header h1 {
            font-size: 24px;
        }

        .header-icon {
            font-size: 28px;
        }

        .action-button {
            font-size: 12px;
            padding: 8px 12px;
        }

        .empty-state {
            padding: 20px;
        }

        .empty-icon {
            font-size: 36px;
        }

        .empty-action {
            font-size: 14px;
            padding: 10px 16px;
        }

        .item-title {
            font-size: 16px;
        }

        .item-date,
        .item-description {
            font-size: 12px;
        }

        .cover-image {
            height: 120px;
        }

        .back-button {
            width: 35px;
            height: 35px;
        }

        .back-button i {
            font-size: 16px;
        }
    }

    /* Alert Messages */
    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: fadeInDown 0.5s ease-out;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert i {
        font-size: 18px;
    }

    /* Invitation Item Image */
    .item-image {
        margin: 15px 0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .cover-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .cover-image:hover {
        transform: scale(1.05);
    }

    /* Back Button */
    .back-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f0f0f0;
        color: #4a00e0;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-right: 15px;
    }

    .back-button:hover {
        background: #4a00e0;
        color: white;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .back-button i {
        font-size: 18px;
    }
</style>
@endsection