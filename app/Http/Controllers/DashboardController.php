<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total events
        $totalEvents = Event::count();
        
        // Get total participants (users who have made at least one booking)
        $totalParticipants = User::whereHas('bookings')->count();
        
        // Get total bookings
        $totalBookings = Booking::count();
        
        // Get recent events (limit to 5)
        $recentEvents = Event::orderBy('date', 'asc')
            ->take(5)
            ->get();
        
        return view('dashboard', compact(
            'totalEvents',
            'totalParticipants',
            'totalBookings',
            'recentEvents'
        ));
    }
} 