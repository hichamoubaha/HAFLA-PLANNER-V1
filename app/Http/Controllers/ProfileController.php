<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        
        
        if (Schema::hasColumn('users', 'address')) {
            $user->address = $request->address;
        }
        if (Schema::hasColumn('users', 'city')) {
            $user->city = $request->city;
        }
        if (Schema::hasColumn('users', 'zip_code')) {
            $user->zip_code = $request->zip_code;
        }

        if ($request->hasFile('profile_picture')) {
            
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile-pictures', $filename, 'public');
            
            if ($path) {
                $user->profile_picture = $path;
            } else {
                return back()->withErrors(['profile_picture' => 'Erreur lors du téléchargement de l\'image.']);
            }
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
} 