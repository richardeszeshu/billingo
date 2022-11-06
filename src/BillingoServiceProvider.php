<?php

declare(strict_types=1);

namespace RichardEszes\Billingo;

use Illuminate\Support\ServiceProvider;

class BillingoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Billingo', function ($app) {
            return new BillingoApi(
                config('billingo.baseUrl'),
                config('billingo.apikey'),
                (int) config('billingo.blockId')
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/billingo.php' => config_path('billingo.php'),
        ], 'billingo-config');
    }
}