<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
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
        if(!Auth::user()->is_admin || !Auth::user()->Account->admin_panel) {
            return redirect()->route('settings.index')->withErrors(['You do not have access to the admin page']);
        }
        return $next($request);
    }
}
