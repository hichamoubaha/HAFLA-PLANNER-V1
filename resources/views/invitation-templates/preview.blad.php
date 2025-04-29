@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Aperçu du modèle</h1>
            <div class="flex space-x-4">
                <a href="{{ route('invitation-templates.customize', $template) }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                    Personnaliser
                </a>
                <a href="{{ route('invitation-templates.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                    Retour
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="relative">
                <img src="{{ Storage::url($template->thumbnail_path) }}" alt="{{ $template->name }}" class="w-full h-64 object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <h2 class="text-4xl font-bold text-white">{{ $template->name }}</h2>
                </div>
            </div>

            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Description</h3>
                    <p class="text-gray-600">{{ $template->description }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Type d'événement</h3>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                        {{ ucfirst($template->type) }}
                    </span>
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Couleurs par défaut</h3>
                    <div class="flex space-x-4">
                        <div>
                            <span class="block text-sm text-gray-600 mb-1">Couleur principale</span>
                            <div class="w-20 h-20 rounded" style="background-color: {{ $template->default_colors['primary'] ?? '#000000' }}"></div>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-600 mb-1">Couleur secondaire</span>
                            <div class="w-20 h-20 rounded" style="background-color: {{ $template->default_colors['secondary'] ?? '#ffffff' }}"></div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Champs personnalisables</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($template->customizable_fields as $field)
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">{{ ucfirst($field) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 