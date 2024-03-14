<?php

namespace CurrencyExchange\Facades;

use CurrencyExchange\CurrencyExchange;
use Illuminate\Support\Facades\Facade;

class CurrencyExchangeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CurrencyExchange::class;
    }

    public static function getExchangeRate(float $amount, string $currency = 'EUR'): array
    {
        return app(CurrencyExchange::class)->getExchangeRate($amount, $currency);
    }
}
