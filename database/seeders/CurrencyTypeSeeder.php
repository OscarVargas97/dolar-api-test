<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CurrencyType;

class CurrencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $currencyTypes = [
            ['name' => 'CLP'],
            ['name' => 'USD'],
            ['name' => 'EUR'],
            ['name' => 'GBP'],
        ];

        foreach ($currencyTypes as $type) {
            CurrencyType::create($type);
        }
    }
}