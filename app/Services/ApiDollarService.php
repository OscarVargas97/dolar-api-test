<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiDollarService
{
    static function getApi(string $urlRequest, array $params=[]): Array
    {
        $url = env('API_DOLLAR_URL') . $urlRequest;
        $erro_response = 'Error 500: oops something went wrong';
        $response = Http::get($url,$params);
        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception($erro_response);
        }
    }     
  
}