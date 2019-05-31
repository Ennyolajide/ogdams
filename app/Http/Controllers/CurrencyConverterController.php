<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\CurrencyConverter;
use Illuminate\Http\Request;




class CurrencyConverterController extends TransactionController
{
    /**
     * get exchange rate using online free currency conveter api
     */
    protected function rate($fromCurrency = 'USD', $toCurrency = 'NGN')
    {
        $params = $fromCurrency . '_' . $toCurrency;
        $apiKey = env('FREE_CURRENCY_CONVERTER_API_TOKEN');
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $query =  'convert?q=' . $params . '&compact=ultra&apiKey=' . $apiKey;
        $request = $client->get(\config('constants.url.freecurrencyconveter') . $query);
        $status = $request->getStatusCode() == '200' ? true : false;
        $result = $status ? json_decode($request->getBody()->getContents(), true) : false;
        return $result ? ceil($result[$params]) : false;
    }

    /**
     * Create a new row to store currency (USD to Naira)
     */
    protected function insertRate()
    {
        CurrencyConverter::create([
            'currency' => 'USD', 'rate' => $this->rate(),
            'expires' => Carbon::parse(date('Y-m-d H:i:s'))->addHour()
        ]);
    }

    /**
     * update the currency rate ( to be updated every hour)
     */
    protected function updateRate()
    {
        $rate = $this->rate();
        CurrencyConverter::whereCurrency('USD')->first()->update([
            'currency' => 'USD', 'rate' => $rate,
            'expires' => Carbon::parse(date('Y-m-d H:i:s'))->addHour()
        ]);

        return $rate;
    }

    /**
     * Store the Rate (insert/update)
     */
    protected function storeExchangeRate($action = null)
    {
        return is_null($action) ? $this->insertRate() : $this->updateRate();
    }

    /**
     * Get the Exchange rate .. (fetch new rate every hour )
     */
    public function getExchangeRate()
    {
        $storage = new CurrencyConverter();
        $storage->whereCurrency('USD')->get()->count() ? '' : $this->storeExchangeRate();
        $rateObject = $storage->whereCurrency('USD')->first();

        return $rateObject->expires > date('Y-m-d H:i:s', time()) ? $rateObject->rate : $this->storeExchangeRate('update');
    }

    public function test()
    {
        return $this->getExchangeRate();
    }
}
