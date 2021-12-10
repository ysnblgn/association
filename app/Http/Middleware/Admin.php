<?php

namespace App\Http\Middleware;

use Closure;

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
        if (!\Auth::guest() && \Auth::user()->user_role=='yönetici')
        {
            return $next($request);

        }
//        elseif (!\Auth::guest() && \Auth::user()->user_role=='üye' )
//
//            return redirect(route('ybadmin.Login'))->with('error','Erişim Yetkiniz Yok');

        else {
                return redirect(route('ybadmin.Login'))->with('error','Erişim Yetkiniz Yok');
        }

        return redirect(route('ybadmin.Login'));


    }
}
