<?php

namespace App\Services;

use App\Models\CurrencyAlias;
use App\Models\Dollars;
use App\Models\DollarsValues;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class DollarService
{
    public function getDollars($startDate = null, $endDate = null)
    {
        $query = Dollars::query()
            ->join('dollars_values', 'dollars.value_id', '=', 'dollars_values.id')
            ->join('currency_types', 'dollars_values.type_id', '=', 'currency_types.id')
            ->select('dollars.id', 'dollars.date', 'dollars_values.value', 'currency_types.name');
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
            $dollarsValue = DollarsValues::create([
                'value' => $value,
                'type_id' => $currencyAlias->currencyType->id
            ]);
        } catch (Exception $e) {
            throw new \RuntimeException('Error 500: oops something went wrong', 500);
        }
        try {
            Dollars::create([
                'date' => Carbon::parse($date),
                'value_id' => $dollarsValue->id, // Asegurarse de usar la columna correcta
            ]);
        } catch (Exception $e) {
            throw new \RuntimeException('Error 500: oops something went wrong', 500);
        }

        return ['message' => 'Dollar and its value have been created successfully'];
    }
    public function postFromDollarApi($data, $alias): array
    {
        $response = [];
        foreach ($data as $dollar) {
            print_r($dollar);
            $response[] = $this->postDollars($alias, $dollar['fecha'], $dollar['valor']);
        }
        return $response;
    }

    public function postMultiDollarsTwo(array $data): array
    {
        $response  = [];
        DB::beginTransaction();
        try {
            $dollarValuesData = [];
            $dollarsData = [];
            foreach ($data as $dollar) {
                $currencyAlias = CurrencyAlias::where('alias', $dollar['alias'])->first();
                if (!$currencyAlias) {
                    throw new \RuntimeException('Error 404: Currency alias not found', 404);
                }
                $dollarValuesData[] = [
                    'value' => $dollar['value'],
                    'type_id' => $currencyAlias->currencyType->id
                ];
            }

            // Insertar valores de dólares y obtener sus IDs
            $dollarValues = DollarsValues::insert($dollarValuesData);

            // Crear datos para la inserción de dólares
            foreach ($dollarValues as $index => $dollarValue) {
                $dollarsData[] = [
                    'date' => Carbon::parse($data[$index]['date']),
                    'value_id' => $dollarValue->id,
                ];

                $response[] = ['message' => 'Dollar and its value have been created successfully'];
            }

            // Insertar dólares
            Dollars::insert($dollarsData);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new \RuntimeException('Error 500: oops something went wrong', 500);
        }

        return $response;
    }
}
