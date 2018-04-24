<?php

namespace App\Http\Middleware;

use Closure;

class roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles)
    {
        foreach(auth()->user()->rules as $rule)
        {

            foreach($roles as $role)
            {
                if($rule->pivot->rule_id==$role){
                    return $next($request);
                }
            }

        }
        return abort(404);
    }
}
