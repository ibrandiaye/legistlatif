<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckMaxSessions
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::id();

            // Compter les sessions actives de l'utilisateur
            $activeSessions = DB::table('sessions')
                ->where('user_id', $userId)
                ->count();
        
            // Limite à 2 sessions maximum
            if ($activeSessions >= 2) {
                // Option 1 : déconnecter les sessions les plus anciennes
                DB::table('sessions')
                    ->where('user_id', $userId)
                    ->orderBy('last_activity')
                    ->limit(1)
                    ->delete();
            }
        }

        return $next($request);
    }
}

