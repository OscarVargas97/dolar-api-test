<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DollarService;
use App\Services\ApiDollarService;

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
        $data = ApiDollarService::getAllDolar();
        $alias = $data['unidad_medida'];
        $this->dollarService->postFromDollarApi($data['serie'], $alias);
    }
}

