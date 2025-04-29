@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            {{ isset($template) ? 'Modifier le modèle' : 'Créer un nouveau modèle' }}
        </h1>

        <form action="{{ isset($template) ? route('invitation-templates.update', $template) : route('invitation-templates.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @if(isset($template))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nom du modèle
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                       id="name"
                       type="text"
                       name="name"
                       value="{{ old('name', $template->name ?? '') }}"
                       required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                    Type d'événement
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('type') border-red-500 @enderror"
                        id="type"
                        name="type"
                        required>
                    <option value="">Sélectionnez un type</option>
                    @foreach($templateTypes as $type)
                        <option value="{{ $type }}" {{ (old('type', $template->type ?? '') == $type) ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
                @error('type')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                          id="description"
                          name="description"
                          rows="3">{{ old('description', $template->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                    Image de couverture
                </label>
                <input type="file"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('thumbnail') border-red-500 @enderror"
                       id="thumbnail"
                       name="thumbnail"
                       accept="image/*"
                       {{ isset($template) ? '' : 'required' }}>
                @error('thumbnail')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                @if(isset($template) && $template->thumbnail_path)
                    <div class="mt-2">
                        <img src="{{ Storage::url($template->thumbnail_path) }}" alt="Current thumbnail" class="h-32 w-auto">
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Couleurs par défaut
                </label>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="primary_color">Couleur principale</label>
                        <input type="color"
                               class="w-full h-10 rounded"
                               id="primary_color"
                               name="default_colors[primary]"
                               value="{{ old('default_colors.primary', $template->default_colors['primary'] ?? '#000000') }}">
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1" for="secondary_color">Couleur secondaire</label>
                        <input type="color"
                               class="w-full h-10 rounded"
                               id="secondary_color"
                               name="default_colors[secondary]"
                               value="{{ old('default_colors.secondary', $template->default_colors['secondary'] ?? '#ffffff') }}">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Champs personnalisables
                </label>
                <div class="space-y-2">
                    @php
                        $customizableFields = old('customizable_fields', $template->customizable_fields ?? []);
                    @endphp
                    <label class="inline-flex items-center">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="title"
                               {{ in_array('title', $customizableFields) ? 'checked' : '' }}
                               class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2">Titre</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="date"
                               {{ in_array('date', $customizableFields) ? 'checked' : '' }}
                               class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2">Date</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="location"
                               {{ in_array('location', $customizableFields) ? 'checked' : '' }}
                               class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2">Lieu</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox"
                               name="customizable_fields[]"
                               value="description"
                               {{ in_array('description', $customizableFields) ? 'checked' : '' }}
                               class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2">Description</span>
                    </label>
                </div>
            </div>

            @if(isset($template))
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ $template->is_active ? 'checked' : '' }}
                           class="form-checkbox h-4 w-4 text-blue-600">
                    <span class="ml-2">Modèle actif</span>
                </label>
            </div>
            @endif

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                    {{ isset($template) ? 'Mettre à jour' : 'Créer' }}
                </button>
                <a href="{{ route('invitation-templates.index') }}"
                   class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 