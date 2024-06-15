<?php

namespace App\Services;

use App\Models\CurrencyAlias;
use App\Models\Dollars;
use Carbon\Carbon;
use Exception;

class DollarService
{
    public function getDollars($startDate = null, $endDate = null)
    {
        $query = Dollars::query()
            ->join('currency_types', 'dollars.type_id', '=', 'currency_types.id')
            ->select('dollars.id', 'dollars.date', 'dollars.value', 'currency_types.name');
        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }
        try {
            return $query->get();
        } catch (Exception $e) {
            throw new \RuntimeException('Error 500: oops something went wrong', 500);
        }
    }
    public function postDollars($alias, $date, $value): array
    {
        $currencyAlias = CurrencyAlias::where('alias', $alias)->first();
        if (!$currencyAlias) {
            throw new \RuntimeException('Error 404: Currency alias not found', 404);
        }
        try {
            Dollars::firstOrCreate(
                ['date' => Carbon::parse($date)],
                [
                    'value' => $value,
                    'type_id' => $currencyAlias->currency_type_id
                ]
            );
        } catch (Exception $e) {
            throw new \RuntimeException('Error 500: oops something went wrong', 500);
        }

        return ['message' => 'Dollar and its value have been created successfully'];
    }
    #Este método es poco eficiente, no alcanzo a estudiar sobre volcado de datos masivos en Laravel.
    #Esto en Django se hace con bulk_create
    public function postFromDollarApi($data, $alias): array
    {
        $response = [];
        foreach ($data as $dollar) {
            $response[] = $this->postDollars($alias, $dollar['fecha'], $dollar['valor']);
        }
        return $response;
    }
}
