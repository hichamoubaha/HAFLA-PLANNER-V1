@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Modèles d'invitations</h1>
        @if(auth()->user()->is_admin)
        <a href="{{ route('invitation-templates.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            Ajouter un modèle
        </a>
        @endif
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($templates as $template)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ Storage::url($template->thumbnail_path) }}" alt="{{ $template->name }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $template->name }}</h2>
                <p class="text-gray-600 mb-2">{{ $template->description }}</p>
                <div class="flex items-center justify-between mt-4">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                        {{ ucfirst($template->type) }}
                    </span>
                    <div class="flex space-x-2">
                        <a href="{{ route('invitation-templates.preview', $template) }}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-eye"></i> Aperçu
                        </a>
                        <a href="{{ route('invitation-templates.customize', $template) }}" class="text-green-500 hover:text-green-700">
                            <i class="fas fa-edit"></i> Personnaliser
                        </a>
                        @if(auth()->user()->is_admin)
                        <a href="{{ route('invitation-templates.edit', $template) }}" class="text-yellow-500 hover:text-yellow-700">
                            <i class="fas fa-cog"></i> Modifier
                        </a>
                        <form action="{{ route('invitation-templates.destroy', $template) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce modèle ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection 