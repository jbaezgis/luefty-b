<?php

namespace App\Http\Middleware;

use Closure;
use App\HasRoles;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    use HasRoles;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/');
        // }

        
        // if (Auth::guard($guard)->check()) {
        //     if (Auth::user()->hasRole('super-admin')) {
        //         return redirect('/admin/dashboard');
        //     } elseif (Auth::user()->hasRole('auctioneer')) {
        //         return redirect('/myauctions');
        //     } elseif (Auth::user()->hasRole('bidder')) {
        //         return redirect('/mybids');
        //     } else {
        //         return redirect('/home');
        //     }
            
        // }
        if (Auth::guard($guard)->check()) {
            if (\Auth::user()->user_type == 1) {
                return '/myauctions/privatetransfers/index';
                // return '/profile';
            } else {
                return '/suppliers';
            }
        }

        return $next($request);
    }
}
