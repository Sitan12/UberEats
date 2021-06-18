<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->role; 
                $is_admin = Auth::user()->is_admin;
                if ($is_admin == 1){
                return 'isadmins';
                } else
        
                switch ($role) {
                  case 'resto':
                     return redirect('/restos');
                     break;
                  case 'client':
                     return redirect('/clients');
                     break; 
            
                  default:
                     return redirect('/home'); 
                     break;
                }

                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
