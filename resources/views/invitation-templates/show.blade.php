@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Votre invitation personnalisée</h1>
            <div class="flex space-x-4">
                <a href="{{ route('invitation-templates.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                    Retour aux modèles
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="relative">
                @if($customizedInvitation->cover_image_path)
                    <img src="{{ Storage::url($customizedInvitation->cover_image_path) }}" alt="Cover" class="w-full h-64 object-cover">
                @else
                    <img src="{{ Storage::url($customizedInvitation->template->thumbnail_path) }}" alt="Template" class="w-full h-64 object-cover">
                @endif
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <h2 class="text-4xl font-bold text-white">{{ $customizedInvitation->title ?? $customizedInvitation->template->name }}</h2>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Détails de l'invitation</h3>
                        
                        @if($customizedInvitation->date)
                        <div class="mb-4">
                            <span class="block text-sm font-medium text-gray-500">Date</span>
                            <span class="text-lg">{{ $customizedInvitation->date }}</span>
                        </div>
                        @endif
                        
                        @if($customizedInvitation->location)
                        <div class="mb-4">
                            <span class="block text-sm font-medium text-gray-500">Lieu</span>
                            <span class="text-lg">{{ $customizedInvitation->location }}</span>
                        </div>
                        @endif
                        
                        @if($customizedInvitation->description)
                        <div class="mb-4">
                            <span class="block text-sm font-medium text-gray-500">Description</span>
                            <p class="text-lg">{{ $customizedInvitation->description }}</p>
                        </div>
                        @endif
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Personnalisation</h3>
                        
                        <div class="mb-4">
                            <span class="block text-sm font-medium text-gray-500">Modèle utilisé</span>
                            <span class="text-lg">{{ $customizedInvitation->template->name }}</span>
                        </div>
                        
                        <div class="mb-4">
                            <span class="block text-sm font-medium text-gray-500">Couleurs</span>
                            <div class="flex space-x-4 mt-2">
                                @if($customizedInvitation->primary_color)
                                <div>
                                    <span class="block text-xs text-gray-500">Principale</span>
                                    <div class="w-12 h-12 rounded" style="background-color: {{ $customizedInvitation->primary_color }}"></div>
                                </div>
                                @endif
                                
                                @if($customizedInvitation->secondary_color)
                                <div>
                                    <span class="block text-xs text-gray-500">Secondaire</span>
                                    <div class="w-12 h-12 rounded" style="background-color: {{ $customizedInvitation->secondary_color }}"></div>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <span class="block text-sm font-medium text-gray-500">Créée le</span>
                            <span class="text-lg">{{ $customizedInvitation->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('invitation-templates.customize', $customizedInvitation->template) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg">
                        Créer une nouvelle invitation
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 