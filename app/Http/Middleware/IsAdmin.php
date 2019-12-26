<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class IsAdmin
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

        if(Auth::check()){
            if(auth()->user()->type == "Admin") {
                return $next($request);
            }
        }
        Auth::logout();
        return redirect('admin/login');

    }
}
