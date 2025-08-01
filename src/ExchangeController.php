<?php

namespace App;

use App\Utils\Response;

class ExchangeController
{
    public static function convert(Response $response, array $params)
    {

        $amount = floatval($params[1]);
        $from = strtoupper($params[2]);
        $to = strtoupper($params[3]);
        $rate = floatval($params[4]);

        $supportedCurrencies = [
            'BRL' => ['EUR', 'USD'],
            'EUR' => ['BRL'],
            'USD' => ['BRL']
        ];

        $symbols = [
            'BRL' => 'R$',
            'USD' => '$',
            'EUR' => '€'
        ];

        if (!isset($supportedCurrencies[$from]) || !in_array($to, $supportedCurrencies[$from])) {
            $response::exchangeNotSupported($from, $supportedCurrencies[$from]);
            return;
        }

        $convertedAmount = $amount * $rate;

        $response::exchangeOk($convertedAmount, $symbols[$to]);
    }
}
