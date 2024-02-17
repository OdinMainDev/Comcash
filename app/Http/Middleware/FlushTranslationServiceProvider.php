<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JoeDixon\Translation\TranslationBindingsServiceProvider;
use JoeDixon\Translation\TranslationServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class FlushTranslationServiceProvider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        app()->forgetInstance(TranslationServiceProvider::class);
        app()->forgetInstance(TranslationBindingsServiceProvider::class);
        return $next($request);
    }

    public function terminate($request, $response)
    {
        app()->forgetInstance(TranslationServiceProvider::class);
        app()->forgetInstance(TranslationBindingsServiceProvider::class);
    }

}
