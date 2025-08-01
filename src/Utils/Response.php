<?php

namespace App\Utils;

class Response
{
    public static function json(array $data, int $status = 200)
    {
        http_response_code($status);

        header("Content-type: application/json");

        echo json_encode($data);
    }

    public static function routeNotFound()
    {
        self::json(['message' => 'Rota não encontrada!'], 400);
    }

    public static function exchangeNotSupported($from, $supportedCurrencies)
    {
        self::json([
            'message' => "Moedas suportadas para " . $from . ": " . implode(', ', $supportedCurrencies)
        ], 400);
    }

    public static function exchangeOk($convertedAmount, $symbol)
    {
        self::json([
            'data' => [
                'valorConvertido' => $convertedAmount,
                'simboloMoeda' => $symbol
            ]
        ], 200);
    }
}
