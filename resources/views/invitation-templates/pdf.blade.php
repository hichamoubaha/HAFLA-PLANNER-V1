<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $invitation->title }}</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .invitation-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
        }
        .invitation-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .invitation-header h1 {
            font-size: 2.5rem;
            margin: 0;
            color: {{ $invitation->primary_color ?? '#4a00e0' }};
        }
        .invitation-content {
            max-width: 100%;
            margin: 0 auto;
        }
        .invitation-details {
            margin: 1.5rem 0;
        }
        .invitation-details h2 {
            color: {{ $invitation->secondary_color ?? '#6a1bff' }};
            margin-bottom: 1rem;
        }
        .invitation-details p {
            margin: 0.5rem 0;
        }
        .invitation-footer {
            margin-top: 2rem;
            text-align: center;
            color: #666;
        }
        .cover-image {
            max-width: 100%;
            height: auto;
            margin: 2rem 0;
            display: block;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .cover-image-container {
            text-align: center;
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <div class="invitation-container">
        <div class="invitation-header">
            <h1>{{ $invitation->title }}</h1>
        </div>

        <div class="invitation-content">
            @if(isset($coverImagePath) && $coverImagePath)
                <div class="cover-image-container">
                    <img src="{{ $coverImagePath }}" alt="Cover Image" class="cover-image">
                </div>
            @endif

            <div class="invitation-details">
                <h2>Détails de l'événement</h2>
                <p><strong>Date:</strong> {{ $invitation->date }}</p>
                <p><strong>Localisation:</strong> {{ $invitation->location }}</p>
                <p><strong>Description:</strong></p>
                <p>{{ $invitation->description }}</p>
            </div>

            <div class="invitation-footer">
                <p>Generated on: {{ now()->format('d M, Y') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
