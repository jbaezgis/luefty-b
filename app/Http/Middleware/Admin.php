<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if (auth()->guest())
        {
            return redirect('/login')->with('error', __('Please log in. This area is for administrators only.'));
        }
        if(auth()->user()->isAdmin == 1)
        {
            return $next($request);
        }
        return redirect('/')->with('error', __('You do not have admin access'));
    }
}
