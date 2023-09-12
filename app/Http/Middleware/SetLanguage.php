<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $languages = Config::get("app.languages");
        $current_language = $request->segment(1);
        
        if (!$current_language || !in_array($current_language, $languages)) {
            $prefer = mb_strtoupper($request->getPreferredLanguage());
            if(!in_array($prefer, $languages))
                $prefer = "ru";
            
            $current_language = "ru";
            // return redirect('/'.$prefer);
        }

        app()->setLocale(mb_strtolower($current_language));
        URL::defaults(['locale' => mb_strtolower($current_language)]);
        Cookie::queue('language', mb_strtolower($current_language), 60 * 24 * 30);
        return $next($request);
    }
}
