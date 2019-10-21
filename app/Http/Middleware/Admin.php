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
        $roles = ['developer', 'admin', 'moderators'];

        if (!in_array(Auth::user()->role, $roles)) {
            return redirect()->route('user.logout');
        }
        return $next($request);
    }
}
