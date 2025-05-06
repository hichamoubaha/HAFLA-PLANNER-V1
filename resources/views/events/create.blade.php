<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f0 100%);
            max-width: 1280px;
            margin: 0 auto;
            padding: 40px 20px;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: 700;
            margin: 50px 0;
            color: #1a1a1a;
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        h3 {
            font-size: 24px;
            font-weight: 600;
            margin: 30px 0 20px;
            color: #2d2d2d;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .form-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        input, textarea, select {
            width: 100%;
            padding: 16px;
            font-size: 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background: #fafafa;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #4f46e5;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        select {
            background: #fafafa;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%232d2d2d'%3E%3Cpath d='M7 10l5 5 5-5H7z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.5em;
        }

        button {
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
            color: white;
            border: none;
            padding: 18px 36px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            margin-top: 30px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        button::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        button:hover::after {
            left: 100%;
        }

        input::placeholder, textarea::placeholder {
            color: #9ca3af;
            font-style: italic;
        }

        .file-upload {
            border: 2px dashed #d1d5db;
            padding: 30px;
            text-align: center;
            border-radius: 12px;
            cursor: pointer;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .file-upload:hover {
            border-color: #4f46e5;
            background: #f0f5ff;
        }

        .media-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            margin: 15px 0;
        }

        .media-preview img, .media-preview video {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .media-preview img:hover, .media-preview video:hover {
            transform: scale(1.03);
        }

        .media-item {
            position: relative;
            overflow: hidden;
        }

        .remove-media {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .remove-media:hover {
            background: #ef4444;
            transform: scale(1.1);
        }

        .media-error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 8px;
            display: none;
            font-weight: 500;
        }

        .file-upload.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #f3f4f6;
        }

        .color-picker {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 15px 0;
        }

        .color-option {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            position: relative;
        }

        .color-option:hover {
            transform: scale(1.1);
        }

        .color-option.selected {
            border-color: #1f2937;
            box-shadow: 0 0 0 4px rgba(31, 41, 55, 0.1);
        }

        .color-option::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .color-option.selected::after {
            opacity: 1;
        }

        .status-select {
            margin-top: 20px;
        }

        .grid {
            display: grid;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .grid-cols-1 {
                grid-template-columns: 1fr;
            }
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
            display: block;
        }
    </style>
</head>
<body>
    <h2>Créer un nouvel événement</h2>
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Basic Information Section -->
        <div class="form-section">
            <h3>Informations de base</h3>
            <input type="text" name="title" placeholder="Titre de l'événement" required>
            <textarea name="description" placeholder="Description de l'événement" required></textarea>
            <input type="date" name="date" required>
            <input type="time" name="time" required>
            <input type="text" name="location" placeholder="Lieu de l'événement" required>
            <input type="number" name="max_participants" placeholder="Nombre maximum de participants" required>
        </div>

        <!-- Event Type Section -->
        <div class="form-section">
            <h3>Type d'événement</h3>
            <select name="event_type" required>
                <option value="">Sélectionnez un type d'événement</option>
                <option value="mariage">Mariage</option>
                <option value="anniversaire">Anniversaire</option>
                <option value="fete_fin_etudes">Fête de fin d'études</option>
                <option value="autre">Autre</option>
            </select>
            <select name="category" required>
                <option value="">Sélectionnez une catégorie</option>
                <option value="prive">Privé</option>
                <option value="public">Public</option>
                <option value="entreprise">Entreprise</option>
            </select>
        </div>

        <!-- Customization Section -->
        <div class="form-section">
            <h3>Détails de l'événement</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="title" class="block text-gray-700 mb-2">Titre de l'événement</label>
                    <input type="text" id="title" name="title" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label for="date" class="block text-gray-700 mb-2">Date</label>
                    <input type="date" id="date" name="date" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label for="time" class="block text-gray-700 mb-2">Heure</label>
                    <input type="time" id="time" name="time" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label for="location" class="block text-gray-700 mb-2">Lieu</label>
                    <input type="text" id="location" name="location" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label for="price" class="block text-gray-700 mb-2">Prix (€)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" class="w-full p-2 border rounded">
                </div>
            </div>
        </div>

        <!-- Customization Section -->
        <div class="form-section">
            <h3>Personnalisation</h3>
            <div class="color-picker">
                <label>Couleurs du thème:</label>
                <input type="hidden" name="theme_colors" id="theme_colors">
                @foreach(['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEEAD'] as $color)
                    <div class="color-option" style="background-color: {{ $color }}" data-color="{{ $color }}"></div>
                @endforeach
            </div>

            <div class="file-upload">
                <label>Logo de l'événement:</label>
                <input type="file" name="logo" accept="image/*">
            </div>

            <textarea name="custom_message" placeholder="Message personnalisé"></textarea>
        </div>

        <!-- Media Gallery Section -->
        <div class="form-section">
            <h3>Galerie média</h3>
            <p class="text-muted mb-2">Ajoutez jusqu'à 5 photos ou vidéos</p>
            <div class="file-upload">
                <input type="file" name="media_gallery[]" multiple accept="image/*,video/*" id="media-gallery-input">
                <div class="media-error" id="media-error"></div>
            </div>
            <div class="media-preview" id="media-preview"></div>
        </div>

        <!-- Budget Section -->
        <div class="form-section">
            <h3>Budget</h3>
            <input type="number" name="budget" placeholder="Budget" step="0.01">
            <textarea name="budget_breakdown" placeholder="Détails du budget"></textarea>
        </div>

        <!-- Additional Details Section -->
        <div class="form-section">
            <h3>Détails supplémentaires</h3>
            <textarea name="amenities" placeholder="Équipements et services"></textarea>
            <textarea name="special_requirements" placeholder="Exigences particulières"></textarea>
        </div>

        <!-- Contact Information Section -->
        <div class="form-section">
            <h3>Informations de contact</h3>
            <input type="email" name="contact_email" placeholder="Email de contact">
            <input type="text" name="contact_phone" placeholder="Téléphone de contact">
        </div>

        <!-- Status Section -->
        <div class="form-section">
            <h3>Statut</h3>
            <select name="status" class="status-select" required>
                <option value="draft">Brouillon</option>
                <option value="published">Publié</option>
                <option value="cancelled">Annulé</option>
            </select>
        </div>

        <button type="submit">Créer l'événement</button>
    </form>

    <script>
        // Color selection
        document.querySelectorAll('.color-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                
                // Get current colors or initialize empty array
                let colors = [];
                const themeColorsInput = document.querySelector('input[name="theme_colors"]');
                if (themeColorsInput.value) {
                    try {
                        colors = JSON.parse(themeColorsInput.value);
                    } catch (e) {
                        colors = [];
                    }
                }
                
                // Add the new color
                colors.push(this.dataset.color);
                
                // Update the input
                themeColorsInput.value = JSON.stringify(colors);
            });
        });

        // File upload preview
        document.querySelector('input[name="logo"]').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const currentLogo = document.querySelector('.current-logo');
                    if (currentLogo) {
                        currentLogo.src = e.target.result;
                    } else {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('current-logo');
                        document.querySelector('.file-upload').appendChild(img);
                    }
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Media gallery handling
        const mediaInput = document.getElementById('media-gallery-input');
        const mediaPreview = document.getElementById('media-preview');
        const mediaError = document.getElementById('media-error');
        const maxFiles = 5;
        let currentFiles = [];

        mediaInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            
            // Check if adding these files would exceed the limit
            if (currentFiles.length + files.length > maxFiles) {
                mediaError.textContent = `Vous ne pouvez pas ajouter plus de ${maxFiles} fichiers au total.`;
                mediaError.style.display = 'block';
                return;
            }

            // Validate file types and sizes
            const invalidFiles = files.filter(file => {
                const isImage = file.type.startsWith('image/');
                const isVideo = file.type.startsWith('video/');
                const isUnderSize = file.size <= 10 * 1024 * 1024; // 10MB limit
                return !(isImage || isVideo) || !isUnderSize;
            });

            if (invalidFiles.length > 0) {
                mediaError.textContent = 'Seuls les fichiers image et vidéo de moins de 10MB sont acceptés.';
                mediaError.style.display = 'block';
                return;
            }

            mediaError.style.display = 'none';
            currentFiles = [...currentFiles, ...files];
            updateMediaPreview();
        });

        function updateMediaPreview() {
            mediaPreview.innerHTML = '';
            currentFiles.forEach((file, index) => {
                const mediaItem = document.createElement('div');
                mediaItem.className = 'media-item';
                
                const removeBtn = document.createElement('button');
                removeBtn.className = 'remove-media';
                removeBtn.innerHTML = '×';
                removeBtn.onclick = () => removeFile(index);

                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    mediaItem.appendChild(img);
                } else if (file.type.startsWith('video/')) {
                    const video = document.createElement('video');
                    video.src = URL.createObjectURL(file);
                    video.controls = true;
                    mediaItem.appendChild(video);
                }

                mediaItem.appendChild(removeBtn);
                mediaPreview.appendChild(mediaItem);
            });

            // Update file input
            const dataTransfer = new DataTransfer();
            currentFiles.forEach(file => dataTransfer.items.add(file));
            mediaInput.files = dataTransfer.files;

            // Disable/enable file input based on current count
            if (currentFiles.length >= maxFiles) {
                mediaInput.parentElement.classList.add('disabled');
                mediaInput.disabled = true;
            } else {
                mediaInput.parentElement.classList.remove('disabled');
                mediaInput.disabled = false;
            }
        }

        function removeFile(index) {
            currentFiles.splice(index, 1);
            updateMediaPreview();
        }
    </script>
</body>
</html>