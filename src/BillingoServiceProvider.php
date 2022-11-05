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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        die('asd');
        $this->publishes([
            __DIR__ . '/../config/billingo.php' => config_path('billingo.php'),
        ], 'billingo-config');
    }
}