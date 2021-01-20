<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$roles)
    {
        
            if(auth()->user()->hasRole($roles)) {
                return $next($request);
            }
        
        
        return response()->view('errors.403');
        /*if($permission !== null && !$request->user()->can($permission)) {
            return response()->view('errors.403');
        }*/

    }

      

      // return response()->view('errors.403');

        // }
}
