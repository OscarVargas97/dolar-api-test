<?php

namespace App\Console\Commands;

use App\Services\ApiDollarService;
use Illuminate\Console\Command;

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

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info(ApiDollarService::getAllDolar());
    }
}
