<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Lib\Processes\ProcessRepository;
use Lib\Alerts\AlertRepository;

class Expire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ProcessRepository $processRepository)
    {
        //loop through all parent process and check the expiry date
        $processRepository->setExpirableAlerts();

        //loop through all parent process and set expired status
        $processRepository->setProcessExpired();

        //loop through all parent process and set void status if necessary
        $processRepository->setProcessVoid();
    }
}
