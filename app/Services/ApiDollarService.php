<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiDollarService
{
    public static function getAllDolar(): Array
    {
        $url = env('API_DOLLAR_URL') . 'dolar/';
        $erro_response = 'Error fetching rates';
        return self::getApi($url,$erro_response);
    }
    public static function getByDates(int $year)
    {
        $url = env('API_DOLLAR_URL') . 'dolar/'.'year';
        $erro_response = 'Error fetching rates for year ' . $year;
        return self::getApi($url,$erro_response);
    }
    private static function getApi(string $url, $erro_response): Array
    {
        $response = Http::get($url);
        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception($erro_response);
        }
    }       
}