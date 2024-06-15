<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CurrencyAlias;
use App\Models\CurrencyType;

class CurrencyAliasSeeder extends Seeder
{
    public function run(): void
    {
        $currencyAliases = [
            ['alias' => 'Pesos', 'currency_type_id' => CurrencyType::where('name', 'CLP')->first()->id],
            ['alias' => 'pesos', 'currency_type_id' => CurrencyType::where('name', 'CLP')->first()->id],
            ['alias' => 'dolar', 'currency_type_id' => CurrencyType::where('name', 'USD')->first()->id]
        ];

        foreach ($currencyAliases as $alias) {
            CurrencyAlias::create($alias);
        }
    }
}