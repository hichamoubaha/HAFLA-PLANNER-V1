<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    public function index()
    {
        // Check if the user is an admin or organiser
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'organisateur') {
            return redirect()->route('dashboard')->with('error', 'Accès refusé.');
        }

        // If the user is an organiser, show only participants for their events
        if (Auth::user()->role === 'organisateur') {
            $events = Event::where('user_id', Auth::id())->pluck('id');
            $bookings = Booking::with(['user', 'event'])
                ->whereIn('event_id', $events)
                ->get();
        } else {
            // If the user is an admin, show all participants
            $bookings = Booking::with(['user', 'event'])->get();
        }

        // Group bookings by user
        $participants = [];
        foreach ($bookings as $booking) {
            $userId = $booking->user_id;
            if (!isset($participants[$userId])) {
                $participants[$userId] = [
                    'user' => $booking->user,
                    'bookings' => []
                ];
            }
            $participants[$userId]['bookings'][] = $booking;
        }

        return view('participants.index', compact('participants'));
    }

    public function show(User $user)
    {
        // Check if the user is an admin or organiser
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'organisateur') {
            return redirect()->route('dashboard')->with('error', 'Accès refusé.');
        }

        // If the user is an organiser, show only bookings for their events
        if (Auth::user()->role === 'organisateur') {
            $events = Event::where('user_id', Auth::id())->pluck('id');
            $bookings = Booking::with('event')
                ->where('user_id', $user->id)
                ->whereIn('event_id', $events)
                ->get();
        } else {
            // If the user is an admin, show all bookings for the user
            $bookings = Booking::with('event')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('participants.show', compact('user', 'bookings'));
    }
} 