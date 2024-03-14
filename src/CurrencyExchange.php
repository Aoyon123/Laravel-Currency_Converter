<?php

namespace CurrencyExchange;

use GuzzleHttp\Client;
use SimpleXMLElement;

class CurrencyExchange
{
    protected $client;
    protected $url;

    public function __construct(Client $client, string $url)
    {
        $this->client = $client;
        $this->url = $url;
    }

    public function getExchangeRate(float $amount, string $currency = 'EUR'): array
    {
        $response = $this->client->get($this->url);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to fetch exchange rates.');
        }

        $xml = simplexml_load_string($response->getBody());

        if (!$xml instanceof SimpleXMLElement) {
            throw new \Exception('Failed to parse XML response.');
        }

        $exchangeRate = null;
        foreach ($xml->Cube->Cube->Cube as $cube) {
            $attributes = $cube->attributes();
            if ((string)$attributes['currency'] === $currency) {
                $exchangeRate = (float)$attributes['rate'];
                break;
            }
        }

        if (!$exchangeRate) {
            throw new \Exception("Currency '$currency' not found in exchange rates.");
        }

        return [
            'amount' => $amount * $exchangeRate,
            'currency' => $currency,
            'rate' => $exchangeRate,
        ];
    }
}
