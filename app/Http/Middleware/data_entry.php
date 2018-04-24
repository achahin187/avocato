<?php

namespace App\Http\Middleware;

use Closure;

class data_entry
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

    foreach(auth()->user()->rules as $rule)
        {
        if($rule->pivot->rule_id==3){
        return $next($request);
            }
        }
        return abort(404);
    }
}
