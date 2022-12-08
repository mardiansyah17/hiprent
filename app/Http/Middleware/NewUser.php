<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NewUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd
        if (auth()->user()->new) {
            return $next($request);
        } else {
            return redirect()->route('profile.show');
        }
    }
}
