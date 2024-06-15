<?php

namespace App\Services;

use App\Models\CurrencyAlias;
use App\Models\Dollar;
use Carbon\Carbon;
use App\Models\DollarValue;
use Exception;
use PhpParser\Node\Expr\Cast\String_;

class DollarService
{
    public function getDollars($startDate = null, $endDate = null) 
    {
        $query = Dollar::query()->with(['dollarValue.currencyType']);
    
        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }
    
        try {
            return $query->get();
        } catch (Exception $e) {
            throw new \RuntimeException('Error 500: oops something went wrong', 500);
        }
    }

    public function postDollars(): array
    {
        $alias = 'pesos';
        $date = '2021-01-01';
        $value=300;
        $currencyAlias = CurrencyAlias::where('alias', $alias)->first();
        $typeID = $currencyAlias->currencyType->id;
        if(!$currencyAlias){
            throw new \RuntimeException('Error 404: Currency alias not found', 404);
        }
        $dollarsValue = DollarValue::create([
            'value' => $value,
            'type_id' => $currencyAlias->currencyType->id
        ]);
        $dollar = Dollar::create([
            'date' => Carbon::parse($date),
            'dollar_value' => $dollarsValue->id, // Asegurarse de usar la columna correcta
        ]);


        return ['message' => 'Dollar and its value have been created successfully'];
    }


}