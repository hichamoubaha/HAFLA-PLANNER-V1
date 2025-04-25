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
        // If the user is an organiser, show all bookings for their events
        if (Auth::user()->role === 'organisateur') {
            $events = Event::where('user_id', Auth::id())->pluck('id');
            $bookings = Booking::with(['event', 'user'])
                ->whereIn('event_id', $events)
                ->get();
        } else {
            // For regular users, show only their bookings
            $bookings = Booking::with('event')
                ->where('user_id', Auth::id())
                ->get();
        }
        
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
    
    public function eventBookings(Event $event)
    {
        // Check if the user is the organiser of this event
        if (Auth::id() !== $event->user_id || Auth::user()->role !== 'organisateur') {
            return back()->with('error', 'Unauthorized action.');
        }
        
        $bookings = Booking::with('user')
            ->where('event_id', $event->id)
            ->get();
            
        return view('bookings.event', compact('event', 'bookings'));
    }
    
    public function updateStatus(Request $request, Booking $booking)
    {
        // Check if the user is the organiser of the event
        if (Auth::id() !== $booking->event->user_id || Auth::user()->role !== 'organisateur') {
            return back()->with('error', 'Unauthorized action.');
        }
        
        $request->validate([
            'status' => 'required|in:confirmed,rejected,cancelled'
        ]);
        
        $booking->update(['status' => $request->status]);
        
        return back()->with('success', 'Booking status updated successfully.');
    }
} 