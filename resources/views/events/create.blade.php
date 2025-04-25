<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h2 {
            text-align: center;
            font-size: 28px;
            margin: 40px 0;
        }
        
        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 15px;
            font-size: 14px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        button {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        
        /* Making the form look more like the image */
        input::placeholder, textarea::placeholder {
            color: #aaa;
        }

        .form-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .form-section h3 {
            margin-bottom: 15px;
            color: #333;
            font-size: 18px;
        }

        .color-picker {
            display: flex;
            gap: 10px;
            margin-top: 10px;
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

        .theme-options {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .theme-option {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
        }

        .theme-option.selected {
            border-color: #ff6b6b;
            background-color: #fff5f5;
        }

        .media-upload {
            border: 2px dashed #e0e0e0;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .media-upload:hover {
            border-color: #ff6b6b;
            background-color: #fff5f5;
        }

        .media-upload.dragover {
            border-color: #4ecdc4;
            background-color: #f0f9f8;
        }

        .image-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .image-preview {
            position: relative;
            width: 100%;
            padding-bottom: 100%;
            border-radius: 5px;
            overflow: hidden;
        }

        .image-preview img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 107, 107, 0.9);
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

        .upload-icon {
            font-size: 24px;
            color: #666;
            margin-bottom: 10px;
        }

        .upload-text {
            color: #666;
            margin-bottom: 5px;
        }

        .upload-hint {
            font-size: 12px;
            color: #999;
        }

        .budget-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .payment-options {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .payment-option {
            flex: 1;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            text-align: center;
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
        </div>

        <!-- Customization Section -->
        <div class="form-section">
            <h3>Personnalisation</h3>
            
            <h4>Thème</h4>
            <div class="theme-options">
                <div class="theme-option" data-theme="classique">Classique</div>
                <div class="theme-option" data-theme="moderne">Moderne</div>
                <div class="theme-option" data-theme="rustique">Rustique</div>
                <div class="theme-option" data-theme="sur_mesure">Sur mesure</div>
            </div>
            
            <h4>Couleurs</h4>
            <div class="color-picker">
                <div class="color-option" style="background-color: #ff6b6b;" data-color="#ff6b6b"></div>
                <div class="color-option" style="background-color: #4ecdc4;" data-color="#4ecdc4"></div>
                <div class="color-option" style="background-color: #45b7d1;" data-color="#45b7d1"></div>
                <div class="color-option" style="background-color: #96ceb4;" data-color="#96ceb4"></div>
                <div class="color-option" style="background-color: #ffeead;" data-color="#ffeead"></div>
            </div>
            
            <input type="hidden" name="selected_theme" id="selected_theme">
            <input type="hidden" name="selected_color" id="selected_color">
        </div>

        <!-- Media Section -->
        <div class="form-section">
            <h3>Médias</h3>
            <div class="media-upload" id="image-upload-container">
                <input type="file" name="event_images[]" multiple accept="image/*" style="display: none;" id="image-upload">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <p class="upload-text">Glissez vos images ici ou cliquez pour sélectionner</p>
                <p class="upload-hint">Formats acceptés: JPG, PNG, GIF (Max 5MB par image)</p>
                <div class="image-preview-container" id="image-preview-container"></div>
            </div>
            <div class="media-upload" id="video-upload-container">
                <input type="file" name="event_videos[]" multiple accept="video/*" style="display: none;" id="video-upload">
                <div class="upload-icon">
                    <i class="fas fa-video"></i>
                </div>
                <p class="upload-text">Glissez vos vidéos ici ou cliquez pour sélectionner</p>
                <p class="upload-hint">Formats acceptés: MP4, MOV (Max 50MB par vidéo)</p>
            </div>
        </div>

        <!-- Budget Section -->
        <div class="form-section">
            <h3>Gestion du budget</h3>
            <div class="budget-inputs">
                <input type="number" name="estimated_budget" placeholder="Budget estimé (€)" required>
                <input type="number" name="current_spent" placeholder="Dépenses actuelles (€)" value="0">
            </div>
            
            <h4>Options de paiement</h4>
            <div class="payment-options">
                <div class="payment-option">
                    <input type="radio" name="payment_method" value="card" id="card">
                    <label for="card">Carte bancaire</label>
                </div>
                <div class="payment-option">
                    <input type="radio" name="payment_method" value="paypal" id="paypal">
                    <label for="paypal">PayPal</label>
                </div>
                <div class="payment-option">
                    <input type="radio" name="payment_method" value="virement" id="virement">
                    <label for="virement">Virement</label>
                </div>
            </div>
        </div>

        <button type="submit">Créer l'événement</button>
    </form>

    <script>
        // Theme selection
        document.querySelectorAll('.theme-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.theme-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                document.getElementById('selected_theme').value = this.dataset.theme;
            });
        });

        // Color selection
        document.querySelectorAll('.color-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                document.getElementById('selected_color').value = this.dataset.color;
            });
        });

        // Enhanced Media upload
        const imageUpload = document.getElementById('image-upload');
        const imageContainer = document.getElementById('image-upload-container');
        const imagePreviewContainer = document.getElementById('image-preview-container');

        // Handle drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            imageContainer.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            imageContainer.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            imageContainer.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            imageContainer.classList.add('dragover');
        }

        function unhighlight(e) {
            imageContainer.classList.remove('dragover');
        }

        imageContainer.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        imageUpload.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            [...files].forEach(previewFile);
        }

        function previewFile(file) {
            if (!file.type.startsWith('image/')) return;
            
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = function() {
                const preview = document.createElement('div');
                preview.className = 'image-preview';
                preview.innerHTML = `
                    <img src="${reader.result}" alt="Preview">
                    <button type="button" class="remove-image" onclick="this.parentElement.remove()">×</button>
                `;
                imagePreviewContainer.appendChild(preview);
            }
        }

        // Click to upload
        imageContainer.addEventListener('click', function() {
            imageUpload.click();
        });
    </script>
</body>
</html>