<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use App\Models\ServiceProviderBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceProviderBookingController extends Controller
{
    public function store(Request $request, ServiceProvider $serviceProvider)
    {
        $request->validate([
            'booking_date' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500'
        ]);

        
        $existingBooking = ServiceProviderBooking::where('user_id', Auth::id())
            ->where('service_provider_id', $serviceProvider->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'You already have an active booking with this service provider.');
        }

        
        ServiceProviderBooking::create([
            'user_id' => Auth::id(),
            'service_provider_id' => $serviceProvider->id,
            'booking_date' => $request->booking_date,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Booking request sent successfully! The service provider will confirm your booking.');
    }

    public function updateStatus(Request $request, ServiceProviderBooking $booking)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed'
        ]);

        
        if (Auth::id() === $booking->serviceProvider->user_id) {
            $booking->update(['status' => $request->status]);
            return back()->with('success', 'Booking status updated successfully.');
        }

        
        if ($request->status === 'cancelled') {
            if ($booking->status !== 'pending') {
                return back()->with('error', 'Only pending bookings can be cancelled.');
            }
            if (Auth::id() !== $booking->user_id) {
                return back()->with('error', 'Unauthorized action.');
            }
            $booking->update(['status' => 'cancelled']);
            return back()->with('success', 'Booking cancelled successfully.');
        }

        return back()->with('error', 'Unauthorized action.');
    }
} 