@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Personnaliser l'invitation</h1>
            <a href="{{ route('invitation-templates.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                Retour
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Formulaire de personnalisation -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <form id="customizationForm" action="{{ route('invitation-templates.save-customization', $template) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @foreach($template->customizable_fields as $field)
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $field }}">
                                {{ ucfirst($field) }}
                            </label>
                            @if($field === 'description')
                                <textarea
                                    id="{{ $field }}"
                                    name="{{ $field }}"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    rows="4"
                                ></textarea>
                            @else
                                <input
                                    type="text"
                                    id="{{ $field }}"
                                    name="{{ $field }}"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                >
                            @endif
                        </div>
                    @endforeach

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Couleurs
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-600 text-sm mb-1" for="primary_color">Couleur principale</label>
                                <input type="color"
                                       class="w-full h-10 rounded"
                                       id="primary_color"
                                       name="primary_color"
                                       value="{{ $template->default_colors['primary'] ?? '#000000' }}">
                            </div>
                            <div>
                                <label class="block text-gray-600 text-sm mb-1" for="secondary_color">Couleur secondaire</label>
                                <input type="color"
                                       class="w-full h-10 rounded"
                                       id="secondary_color"
                                       name="secondary_color"
                                       value="{{ $template->default_colors['secondary'] ?? '#ffffff' }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="cover_image">
                            Image de couverture
                        </label>
                        <input type="file"
                               id="cover_image"
                               name="cover_image"
                               accept="image/*"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Générer l'invitation
                    </button>
                </form>
            </div>

            <!-- Aperçu en direct -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Aperçu</h2>
                <div id="preview" class="border rounded-lg p-4 min-h-[600px] relative">
                    <div class="absolute inset-0 bg-cover bg-center" id="previewBackground" style="background-image: url('{{ Storage::url($template->thumbnail_path) }}')">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                    </div>
                    <div class="relative z-10 text-white p-6">
                        <h1 id="previewTitle" class="text-4xl font-bold mb-4"></h1>
                        <div id="previewDate" class="text-xl mb-4"></div>
                        <div id="previewLocation" class="text-xl mb-4"></div>
                        <p id="previewDescription" class="text-lg"></p>
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

    // Fonction pour mettre à jour l'aperçu
    function updatePreview() {
        const formData = new FormData(form);
        
        // Mise à jour du texte
        document.getElementById('previewTitle').textContent = formData.get('title') || 'Titre de l\'événement';
        document.getElementById('previewDate').textContent = formData.get('date') || 'Date de l\'événement';
        document.getElementById('previewLocation').textContent = formData.get('location') || 'Lieu de l\'événement';
        document.getElementById('previewDescription').textContent = formData.get('description') || 'Description de l\'événement';

        // Mise à jour des couleurs
        const primaryColor = formData.get('primary_color');
        const secondaryColor = formData.get('secondary_color');
        preview.style.setProperty('--primary-color', primaryColor);
        preview.style.setProperty('--secondary-color', secondaryColor);
    }

    // Écouteurs d'événements pour les champs de formulaire
    inputs.forEach(input => {
        input.addEventListener('input', updatePreview);
    });

    // Écouteurs d'événements pour les couleurs
    colorInputs.forEach(input => {
        input.addEventListener('input', updatePreview);
    });

    // Écouteur d'événement pour l'image de couverture
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

    // Initialisation de l'aperçu
    updatePreview();
});
</script>
@endpush
@endsection 