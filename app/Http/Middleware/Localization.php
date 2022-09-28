<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
use App;

class Localization
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
        
        if (Auth::user()) 
        {
            App::setLocale(Auth::user()->lang);
            
        } elseif (\Session::has('locale'))
        {
            \App::setLocale(\Session::get('locale'));
        }
      
        return $next($request);

    }
}
