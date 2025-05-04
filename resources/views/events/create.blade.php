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
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h2 {
            text-align: center;
            font-size: 28px;
            margin: 40px 0;
            color: #333;
        }

        h3 {
            font-size: 20px;
            margin: 20px 0;
            color: #444;
        }
        
        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        input, textarea, select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }

        select {
            background-color: white;
        }
        
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
        
        input::placeholder, textarea::placeholder {
            color: #aaa;
        }

        .file-upload {
            border: 2px dashed #e0e0e0;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .file-upload:hover {
            border-color: #4CAF50;
        }

        .media-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin: 10px 0;
        }

        .media-preview img, .media-preview video {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .media-item {
            position: relative;
        }

        .remove-media {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .remove-media:hover {
            background: rgba(255, 0, 0, 0.9);
        }

        .media-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .file-upload.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .color-picker {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }

        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .color-option.selected {
            border-color: #333;
        }

        .status-select {
            margin-top: 20px;
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