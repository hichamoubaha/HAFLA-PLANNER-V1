<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationEmail;

class GuestController extends Controller
{
    public function index(Event $event)
    {
        $guests = $event->guests()->with('user')->get();
        return view('guests.index', compact('guests', 'event'));
    }

    public function create(Event $event)
    {
        return view('guests.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email',
            'phone' => 'nullable|string',
            'dietary_preferences' => 'nullable|string',
            'special_requests' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $guest = $event->guests()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'dietary_preferences' => $validated['dietary_preferences'],
            'special_requests' => $validated['special_requests'],
            'notes' => $validated['notes'],
            'user_id' => auth()->id(),
            'status' => 'pending'
        ]);

        // Send invitation email
        Mail::to($guest->email)->send(new InvitationEmail($guest, $event));

        return redirect()->route('events.guests.index', $event)
            ->with('success', 'Guest invited successfully!');
    }

    public function edit(Event $event, Guest $guest)
    {
        return view('guests.edit', compact('event', 'guest'));
    }

    public function update(Request $request, Event $event, Guest $guest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email,' . $guest->id,
            'phone' => 'nullable|string',
            'dietary_preferences' => 'nullable|string',
            'special_requests' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $guest->update($validated);

        return redirect()->route('events.guests.index', $event)
            ->with('success', 'Guest updated successfully!');
    }

    public function destroy(Event $event, Guest $guest)
    {
        $guest->delete();
        return redirect()->route('events.guests.index', $event)
            ->with('success', 'Guest removed successfully!');
    }

    public function showRsvpForm(Guest $guest)
    {
        return view('guests.rsvp', compact('guest'));
    }

    public function processRsvp(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'status' => 'required|in:confirmed,declined',
            'dietary_preferences' => 'nullable|string',
            'special_requests' => 'nullable|string',
        ]);

        $guest->update($validated);

        return redirect()->route('guests.rsvp', $guest)
            ->with('success', 'RSVP submitted successfully!');
    }
} 