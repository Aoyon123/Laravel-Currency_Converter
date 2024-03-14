<?php

namespace CurrencyExchange;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class CurrencyExchangeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CurrencyExchange::class, function ($app) {
            return new CurrencyExchange(
                new Client(),
                config('currency-exchange.url')
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/currency-exchange.php' => config_path('currency-exchange.php'),
        ]);
    }
}
