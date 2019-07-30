<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        /*  $roles = ['developer', 'owner', 'admin', 'moderators'];
        if (in_array(Auth::user()->role, $roles)) { } else {
            return redirect('/users/logout');
        } */
        return $next($request);
    }
}
