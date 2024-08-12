<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // $user =DB::table("users")->get();
      // dd(Auth::user(),$user);
        if( Auth::user()->role=='admin')
            return $next($request);
        else
           // return redirect()->route("login");
            return redirect()->back();

    }
}
