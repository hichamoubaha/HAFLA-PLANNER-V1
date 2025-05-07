<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function create()
    {
        
        if (Auth::user()->role !== 'organisateur') {
            return redirect()->route('events.index')->with('error', 'Seuls les organisateurs peuvent créer des événements.');
        }
        
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'event_type' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'theme_colors' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'custom_message' => 'nullable|string',
            'media_gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'budget' => 'nullable|numeric|min:0',
            'budget_breakdown' => 'nullable|string',
            'max_participants' => 'required|integer|min:1',
            'amenities' => 'nullable|string',
            'special_requirements' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|in:draft,published,cancelled'
        ], [
            'date.after' => 'La date de l\'événement doit être dans le futur.',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('event-logos', 'public');
            $data['logo_path'] = $logoPath;
        }

        
        if ($request->hasFile('media_gallery')) {
            $mediaPaths = [];
            foreach ($request->file('media_gallery') as $media) {
                $path = $media->store('event-media', 'public');
                $mediaPaths[] = $path;
            }
            $data['media_gallery'] = $mediaPaths; 
        } else {
            $data['media_gallery'] = []; 
        }

        
        if (isset($data['theme_colors'])) {
            $data['theme_colors'] = json_decode($data['theme_colors'], true) ?: [];
        } else {
            $data['theme_colors'] = [];
        }
        
        if (isset($data['budget_breakdown'])) {
            $data['budget_breakdown'] = json_decode($data['budget_breakdown'], true) ?: [];
        } else {
            $data['budget_breakdown'] = [];
        }
        
        if (isset($data['amenities'])) {
            $data['amenities'] = json_decode($data['amenities'], true) ?: [];
        } else {
            $data['amenities'] = [];
        }

        try {
            Event::create($data);
            return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la création de l\'événement: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Event $event)
    {
        if (Auth::id() !== $event->user_id) {
            return redirect()->route('events.index')->with('error', 'Accès refusé.');
        }

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        if (Auth::id() !== $event->user_id) {
            return redirect()->route('events.index')->with('error', 'Accès refusé.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'event_type' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'theme_colors' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'custom_message' => 'nullable|string',
            'media_gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'budget' => 'nullable|numeric|min:0',
            'budget_breakdown' => 'nullable|string',
            'max_participants' => 'required|integer|min:1',
            'amenities' => 'nullable|string',
            'special_requirements' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|in:draft,published,cancelled'
        ], [
            'date.after' => 'La date de l\'événement doit être dans le futur.',
        ]);

        $data = $request->all();

        
        if ($request->hasFile('logo')) {
            
            if ($event->logo_path) {
                Storage::disk('public')->delete($event->logo_path);
            }
            $logoPath = $request->file('logo')->store('event-logos', 'public');
            $data['logo_path'] = $logoPath;
        }

        
        if ($request->hasFile('media_gallery')) {
            
            if ($event->media_gallery && is_array($event->media_gallery)) {
                foreach ($event->media_gallery as $oldMediaPath) {
                    Storage::disk('public')->delete($oldMediaPath);
                }
            }
            
            $mediaPaths = [];
            foreach ($request->file('media_gallery') as $media) {
                $path = $media->store('event-media', 'public');
                $mediaPaths[] = $path;
            }
            $data['media_gallery'] = $mediaPaths; 
        }

        
        if (isset($data['theme_colors'])) {
            $data['theme_colors'] = json_decode($data['theme_colors'], true) ?: [];
        }
        
        if (isset($data['budget_breakdown'])) {
            $data['budget_breakdown'] = json_decode($data['budget_breakdown'], true) ?: [];
        }
        
        if (isset($data['amenities'])) {
            $data['amenities'] = json_decode($data['amenities'], true) ?: [];
        }

        try {
            $event->update($data);
            return redirect()->route('events.index')->with('success', 'Événement mis à jour.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour de l\'événement: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Event $event)
    {
        if (Auth::id() !== $event->user_id) {
            return redirect()->route('events.index')->with('error', 'Accès refusé.');
        }

        
        if ($event->logo_path) {
            Storage::disk('public')->delete($event->logo_path);
        }
        
    
        if ($event->media_gallery && is_array($event->media_gallery)) {
            foreach ($event->media_gallery as $mediaPath) {
                Storage::disk('public')->delete($mediaPath);
            }
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Événement supprimé.');
    }
}


