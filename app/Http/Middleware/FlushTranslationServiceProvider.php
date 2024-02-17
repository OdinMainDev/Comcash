<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $this->flushTranslationServiceProvider();
    }

    protected function flushTranslationServiceProvider()
    {
        // JoeDixon\Translation\TranslationServiceProvider
        $providerName = 'Joedixon\\LaravelTranslation\\TranslationServiceProvider';

        if (app()->getProvider($providerName)) {
            app()->getProvider($providerName)->unregister();

            // Регистрируем сервис-провайдер заново
            (new $providerName(app()))->register();
        }

        // JoeDixon\Translation\TranslationBindingsServiceProvider
        $providerName = 'Joedixon\\LaravelTranslation\\TranslationBindingsServiceProvider';

        if (app()->getProvider($providerName)) {
            app()->getProvider($providerName)->unregister();

            // Регистрируем сервис-провайдер заново
            (new $providerName(app()))->register();
        }
    }
}
