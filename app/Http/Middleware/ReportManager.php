<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Closure;

class ReportManager
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
        if(Auth::check() && Auth::user()->role==2)
        {
            return $next($request); 
        
           //return redirect('admin');
        }

       return response()->view('errors.403');


        //return $next($request);
    }
}
