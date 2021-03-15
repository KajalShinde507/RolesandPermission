<?php

namespace App\Http\Middleware;

use Closure;

class FrontUser
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

        if(Auth::check() && Auth::user()->role==config('roles.Front User'))
        {
            return $next($request); 
        
           //return redirect('admin');
        }



       return response()->view('errors.403');

     //   return $next($request);
    }
}
