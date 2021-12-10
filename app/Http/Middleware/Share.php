<?php

namespace App\Http\Middleware;

use App\Abouts;
use App\Settings;
use Closure;
use Illuminate\Support\Facades\View;

class Share
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
        $data['settings']=Settings::all();

        foreach ($data['settings'] as $key)
        {
            $settings[$key->settings_key]=$key->settings_value;
        }


        $about=Abouts::all()->sortby('about_must')->first();
        $settings['slug']=$about['about_slug'];
        View::share($settings);


        return $next($request);
    }
}
