<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasNickname
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->nickname) {
            return $next($request);
        } else {
            return redirect('/add-nickname')->with('error', 'Vyplňte Minecraft nickname.');
        }
    }
}
