<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->role === 'prestataire') {
                // If user is a service provider, check if they have a profile
                if ($user->serviceProvider) {
                    return redirect()->route('service-providers.show', $user->serviceProvider);
                } else {
                    return redirect()->route('service-providers.create');
                }
            }
        }

        return $next($request);
    }
} 