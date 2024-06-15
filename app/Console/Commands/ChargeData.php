<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DollarService;
use App\Services\ApiDollarService;
use DateTime;

class ChargeData extends Command
{
        /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:charge-data';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $dollarService;

    public function __construct(DollarService $dollarService)
    {
        parent::__construct();
        $this->dollarService = $dollarService;
    }

    public function handle()
    {
        $currentYear = (new DateTime())->format('Y');
        $lastYear = (new DateTime('-1 year'))->format('Y');
        $years = [$lastYear, $currentYear];
        foreach ($years as $year) {
            $data = ApiDollarService::getApi('dolar/'. $year);
            $this->dollarService->postFromDollarApi($data['serie'], $data['unidad_medida']);
            echo('Datos del año '. $year .' cargados correctamente' . PHP_EOL);
        }
    }
}

