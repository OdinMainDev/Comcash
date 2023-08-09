<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

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
        $current_language = Cookie::get('language');
        
        if (!$current_language) {
            $prefer = mb_strtoupper($request->getPreferredLanguage());
            if(!in_array($prefer, $languages))
                $prefer = "EN";
            
            Cookie::queue('language', $prefer, 60 * 24 * 30);
            $current_language = $prefer;
        }

        if ($request->has('language') && is_string($request->get('language')) && mb_strlen($request->get('language')) < 50) {
            $lang = mb_strtoupper($request->get('language'));
            if (in_array($lang, $languages)) {
                Cookie::queue('language', $lang, 60 * 24 * 30);
                $current_language = $lang;
            }
        }

        app()->setLocale(mb_strtolower($current_language));
        return $next($request);
    }
}
