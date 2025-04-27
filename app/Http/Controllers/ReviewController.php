<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, ServiceProvider $provider)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
            'booking_id' => 'nullable|exists:bookings,id'
        ]);

        $review = new Review($validated);
        $review->user_id = Auth::id();
        $review->service_provider_id = $provider->id;
        $review->save();

        // Update provider's average rating
        $provider->rating = $provider->reviews()->avg('rating');
        $provider->total_reviews = $provider->reviews()->count();
        $provider->save();

        return back()->with('success', 'Avis publié avec succès');
    }

    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10'
        ]);

        $review->update($validated);

        // Update provider's average rating
        $provider = $review->serviceProvider;
        $provider->rating = $provider->reviews()->avg('rating');
        $provider->save();

        return back()->with('success', 'Avis mis à jour avec succès');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        
        $provider = $review->serviceProvider;
        $review->delete();

        // Update provider's average rating
        $provider->rating = $provider->reviews()->avg('rating');
        $provider->total_reviews = $provider->reviews()->count();
        $provider->save();

        return back()->with('success', 'Avis supprimé avec succès');
    }
} 