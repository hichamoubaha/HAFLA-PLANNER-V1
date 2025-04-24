<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('event')
            ->where('user_id', Auth::id())
            ->get();
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request, Event $event)
    {
        // Check if user already has a booking for this event
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'You have already booked this event.');
        }

        // Create new booking
        Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Event booked successfully!');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Booking cancelled successfully.');
    }
} 