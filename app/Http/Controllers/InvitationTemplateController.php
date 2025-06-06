<?php

namespace App\Http\Controllers;

use App\Models\InvitationTemplate;
use App\Models\CustomizedInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InvitationTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = InvitationTemplate::where('is_active', true)->get();
        return view('invitation-templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Only allow organisateur role to create templates
        if (Auth::user()->role !== 'organisateur') {
            return redirect()->route('invitation-templates.index')->with('error', 'Accès refusé. Seuls les organisateurs peuvent créer des modèles.');
        }
        
        $templateTypes = InvitationTemplate::getTemplateTypes();
        return view('invitation-templates.create', compact('templateTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', InvitationTemplate::getTemplateTypes()),
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'default_colors' => 'nullable|array',
            'layout_config' => 'nullable|array',
            'customizable_fields' => 'nullable|array',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('templates/thumbnails', 'public');
            $validated['thumbnail_path'] = $path;
        }

        $template = InvitationTemplate::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Template créé avec succès.'
            ]);
        }

        return redirect()->route('invitation-templates.index')
            ->with('success', 'Template créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $customizedInvitation = CustomizedInvitation::find($id);
        
        if ($customizedInvitation) {
            return view('invitation-templates.show', compact('customizedInvitation'));
        }
        
        
        $template = InvitationTemplate::findOrFail($id);
        return view('invitation-templates.preview', compact('template'));
    }

    public function generatePdf($id)
    {
        $invitation = CustomizedInvitation::findOrFail($id);
        
        
        if ($invitation->user_id !== auth()->id()) {
            abort(403, 'Vous n\'êtes pas autorisé à accéder à ce fichier.');
        }

        
        $coverImagePath = null;
        if ($invitation->cover_image_path) {
            $coverImagePath = Storage::disk('public')->path($invitation->cover_image_path);
        }

        
        $pdf = \PDF::loadView('invitation-templates.pdf', [
            'invitation' => $invitation,
            'coverImagePath' => $coverImagePath
        ]);
        
        return $pdf->download('invitation-' . $invitation->title . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        if (Auth::user()->role !== 'organisateur') {
            return redirect()->route('invitation-templates.index')->with('error', 'Accès refusé. Seuls les organisateurs peuvent modifier les modèles.');
        }
        
        $template = InvitationTemplate::findOrFail($id);
        $templateTypes = InvitationTemplate::getTemplateTypes();
        return view('invitation-templates.edit', compact('template', 'templateTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if (Auth::user()->role !== 'organisateur') {
            return redirect()->route('invitation-templates.index')->with('error', 'Accès refusé. Seuls les organisateurs peuvent modifier les modèles.');
        }
        
        $template = InvitationTemplate::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', InvitationTemplate::getTemplateTypes()),
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'default_colors' => 'nullable|array',
            'layout_config' => 'nullable|array',
            'customizable_fields' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            
            if ($template->thumbnail_path) {
                Storage::disk('public')->delete($template->thumbnail_path);
            }
            $path = $request->file('thumbnail')->store('templates/thumbnails', 'public');
            $validated['thumbnail_path'] = $path;
        }

        $template->update($validated);

        return redirect()->route('invitation-templates.index')
            ->with('success', 'Template mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if (Auth::user()->role !== 'organisateur') {
            return redirect()->route('invitation-templates.index')->with('error', 'Accès refusé. Seuls les organisateurs peuvent supprimer les modèles.');
        }
        
        $template = InvitationTemplate::findOrFail($id);
        
        if ($template->thumbnail_path) {
            Storage::disk('public')->delete($template->thumbnail_path);
        }
        
        $template->delete();

        return redirect()->route('invitation-templates.index')
            ->with('success', 'Template supprimé avec succès.');
    }

    public function preview(InvitationTemplate $template)
    {
        return view('invitation-templates.preview', compact('template'));
    }

    public function customize(InvitationTemplate $template)
    {
        
        if (Auth::user()->role !== 'user') {
            return redirect()->route('invitation-templates.index')->with('error', 'Accès refusé. Seuls les utilisateurs peuvent personnaliser les modèles.');
        }
        
        return view('invitation-templates.customize', compact('template'));
    }

    public function saveCustomization(Request $request, InvitationTemplate $template)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'date' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customizedInvitation = new CustomizedInvitation();
        $customizedInvitation->user_id = auth()->id();
        $customizedInvitation->template_id = $template->id;
        $customizedInvitation->title = $validated['title'] ?? null;
        $customizedInvitation->date = $validated['date'] ?? null;
        $customizedInvitation->location = $validated['location'] ?? null;
        $customizedInvitation->description = $validated['description'] ?? null;
        $customizedInvitation->primary_color = $validated['primary_color'] ?? null;
        $customizedInvitation->secondary_color = $validated['secondary_color'] ?? null;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('customized-invitations/covers', 'public');
            $customizedInvitation->cover_image_path = $path;
        }

        $customizedInvitation->save();

        return redirect()->route('invitation-templates.show', $customizedInvitation)
            ->with('success', 'Invitation personnalisée créée avec succès!');
    }

    public function myInvitations()
    {
        $invitations = auth()->user()->customizedInvitations()->with('template')->get();
        return view('invitation-templates.my-invitations', compact('invitations'));
    }

    public function destroyCustomizedInvitation($id)
    {
        $invitation = CustomizedInvitation::findOrFail($id);
        
        
        if ($invitation->user_id !== auth()->id()) {
            return redirect()->route('invitation-templates.my-invitations')
                ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette invitation.');
        }
        
        
        if ($invitation->cover_image_path) {
            Storage::disk('public')->delete($invitation->cover_image_path);
        }
        
        $invitation->delete();
        
        return redirect()->route('invitation-templates.my-invitations')
            ->with('success', 'Invitation supprimée avec succès.');
    }
}
