<?php

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
                config('billingo.endpoint'),
                config('billingo.apikey'),
                config('billingo.blockId')
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