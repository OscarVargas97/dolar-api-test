<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DollarService;

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
        $this->dollarService->postDollars();
    }
}

