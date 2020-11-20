<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class NonAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->isAdmin()==0)
        {
            return $next($request); 
        
           //return redirect('admin');
        }



        return response()->view('errors.403');
//return redirect('admin')->with('status','Acess Denied for Nonadmin');
    }
}
