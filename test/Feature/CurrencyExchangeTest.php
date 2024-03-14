<?php

namespace Tests\Feature;

use Tests\TestCase;
use CurrencyExchange\Facades\CurrencyExchangeFacade;

class CurrencyExchangeTest extends TestCase
{
    public function test_get_exchange_rate_for_eur()
    {
        $amount = 100;
        $currency = 'EUR';

        $expected = [
            'amount' => $amount,
            'currency' => $currency,
            'rate' => 1.0,
        ];

        CurrencyExchangeFacade::shouldReceive('getExchangeRate')
            ->with($amount, $currency)
            ->andReturn($expected);

        $response = $this->getJson('/api/exchange-rate', [
            'amount' => $amount,
            'currency' => $currency,
        ]);

        $response->assertJson($expected);
    }

    public function test_get_exchange_rate_for_usd()
    {
        // Similar test for USD
    }
}
