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

        if(in_array($current_language, ["request-exportjson.json", "request-exportxml.xml", "telegrambot"])) {
            app()->setLocale("en");
            return $next($request);
        }
        
        if (!$current_language || !in_array($current_language, $languages)) {
            foreach($request->getLanguages() as $key => $language) {
                $language = mb_strtolower($language);
                if(in_array($language, $languages)){
                    $current_language = $language;
                }
            }
        }
        $current_language = mb_strtolower($current_language);
        app()->setLocale($current_language);
        URL::defaults(['locale' => $current_language]);
        Cookie::queue('language', $current_language, 60 * 24 * 30);
        return $next($request);
    }
}
