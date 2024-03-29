# Laravel-Currency_Converter
## Currency Exchange Package for Laravel
This package provides a convenient way to integrate daily currency exchange rate functionality into your Laravel application. It fetches rates from the European Central Bank (ECB) and offers an API endpoint for conversion.


Install the package:
```sh
composer require fahamidul/currency-exchange-converter-package
```
## Usage:
API Endpoint
The package might expose an API endpoint (e.g., /api/exchange-rate) for retrieving exchange rates. Refer to the specific package documentation for details on available endpoints, parameters, and responses. amount and currency comes from the api end point.

##Using from Controller:
Example Usage in a Controller


```sh
namespace App\Http\Controllers;
use CurrencyExchange\CurrencyExchange;
use Illuminate\Http\Request;

class MyController extends Controller
{
    public function convertCurrency(Request $request)
    {
        $amount = $request->input('amount');
        $currency = $request->input('currency', 'EUR');

        $currencyExchange = app(CurrencyExchange::class);

        try {
            $result = $currencyExchange->getExchangeRate($amount, $currency);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
```

## Publish the configuration file:
```sh
php artisan vendor:publish --provider="CurrencyExchange\CurrencyExchangeServiceProvider"
```


## Contributions
You're open to create any pull request.
