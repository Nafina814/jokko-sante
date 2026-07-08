<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
            // ShipiiX recrée la base à chaque déploiement sans jouer les migrations
            // des tables cache/sessions → utiliser le driver file qui ne nécessite
            // aucune table et fonctionne avec le stockage persistant ShipiiX.
            config([
                'session.driver'  => 'file',
                'session.secure'  => false,
                'cache.default'   => 'file',
                'queue.default'   => 'sync',
            ]);
        }
    }
}
