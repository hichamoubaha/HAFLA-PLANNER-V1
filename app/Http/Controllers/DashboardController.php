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
        
        $totalEvents = Event::count();
        
        
        $totalParticipants = User::whereHas('bookings')->count();
        
        
        $totalBookings = Booking::count();
        
        
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