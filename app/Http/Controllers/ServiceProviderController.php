<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceProviderController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceProvider::with(['user', 'reviews']);

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by service type
        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        // Filter by budget range
        if ($request->filled('min_budget')) {
            $query->where('min_budget', '>=', (float)$request->min_budget);
        }
        if ($request->filled('max_budget')) {
            $query->where('max_budget', '<=', (float)$request->max_budget);
        }

        // Sort by rating
        if ($request->filled('sort') && $request->sort === 'rating') {
            $query->orderBy('rating', 'desc');
        }

        $providers = $query->paginate(12);

        return view('service-providers.index', compact('providers'));
    }

    public function show(ServiceProvider $provider)
    {
        $provider->load(['user', 'reviews.user']);
        return view('service-providers.show', compact('provider'));
    }

    public function create()
    {
        return view('service-providers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'description' => 'required|string',
            'service_type' => 'required|string',
            'location' => 'required|string',
            'min_budget' => 'required|numeric|min:0',
            'max_budget' => 'required|numeric|min:0|gte:min_budget',
            'availability' => 'nullable|array',
            'profile_picture' => 'nullable|image|max:2048' // Max 2MB
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $provider = new ServiceProvider($validated);
        $provider->user_id = Auth::id();
        $provider->save();

        return redirect()->route('service-providers.show', $provider)
            ->with('success', 'Profil prestataire créé avec succès');
    }

    public function edit(ServiceProvider $provider)
    {
        $this->authorize('update', $provider);
        return view('service-providers.edit', compact('provider'));
    }

    public function update(Request $request, ServiceProvider $provider)
    {
        $this->authorize('update', $provider);

        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'description' => 'required|string',
            'service_type' => 'required|string',
            'location' => 'required|string',
            'min_budget' => 'required|numeric|min:0',
            'max_budget' => 'required|numeric|min:0|gte:min_budget',
            'availability' => 'nullable|array',
            'profile_picture' => 'nullable|image|max:2048' // Max 2MB
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($provider->profile_picture) {
                Storage::disk('public')->delete($provider->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $provider->update($validated);

        return redirect()->route('service-providers.show', $provider)
            ->with('success', 'Profil mis à jour avec succès');
    }

    public function destroy(ServiceProvider $provider)
    {
        $this->authorize('delete', $provider);
        
        // Delete profile picture if exists
        if ($provider->profile_picture) {
            Storage::disk('public')->delete($provider->profile_picture);
        }
        
        $provider->delete();

        return redirect()->route('service-providers.index')
            ->with('success', 'Profil supprimé avec succès');
    }
} 