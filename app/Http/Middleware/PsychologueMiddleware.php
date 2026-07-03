<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PsychologueMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->isPsychologue()) {
            abort(403, 'Accès réservé aux psychologues.');
        }
        return $next($request);
    }
}