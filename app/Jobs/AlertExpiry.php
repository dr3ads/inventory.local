<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Lib\Processes\ProcessRepository;
use Lib\Alerts\AlertRepository;

class AlertExpiry extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $processRepository;
    protected $alertRepository;

    /**
     * AlertExpiry constructor.
     * @param ProcessRepository $processRepository
     * @param AlertRepository $alertRepository
     */
    public function __construct(ProcessRepository $processRepository, AlertRepository $alertRepository)
    {
        $this->processRepository = $processRepository;
        $this->alertRepository = $alertRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //loop through all parent process and check the expiry date
        $this->processRepository->setExpirableAlerts();

        //loop through all parent process and set expired status
        $this->processRepository->setProcessExpired();

        //loop through all parent process and set void status if necessary
        $this->processRepository->setProcessVoid();
    }
}
