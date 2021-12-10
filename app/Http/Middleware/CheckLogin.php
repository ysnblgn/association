<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
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
        if (\Auth::guest())
        {
            return $next($request);

        }

//        elseif (\Auth::guest() && \Auth::user()->user_role=='üye' )
//
//            return back()->with('error','Erişim Yetkiniz Yok');

        else {

            return redirect(route('home.Index'));
        }

    }
}
