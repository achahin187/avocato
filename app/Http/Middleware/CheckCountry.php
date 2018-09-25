<?php

namespace App\Http\Middleware;

use Closure;
// use Session;

class CheckCountry
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
        // dd(session('country'));
        if(!$request->session()->exists('country'))
        {
            return redirect('choose_country');
        }
        return $next($request);
    }
}
