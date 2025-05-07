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
        
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'organisateur') {
            return redirect()->route('dashboard')->with('error', 'Accès refusé.');
        }

        
        if (Auth::user()->role === 'organisateur') {
            $events = Event::where('user_id', Auth::id())->pluck('id');
            $bookings = Booking::with(['user', 'event'])
                ->whereIn('event_id', $events)
                ->get();
        } else {
            
            $bookings = Booking::with(['user', 'event'])->get();
        }

        
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
        
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'organisateur') {
            return redirect()->route('dashboard')->with('error', 'Accès refusé.');
        }

        
        if (Auth::user()->role === 'organisateur') {
            $events = Event::where('user_id', Auth::id())->pluck('id');
            $bookings = Booking::with('event')
                ->where('user_id', $user->id)
                ->whereIn('event_id', $events)
                ->get();
        } else {
            
            $bookings = Booking::with('event')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('participants.show', compact('user', 'bookings'));
    }
} 