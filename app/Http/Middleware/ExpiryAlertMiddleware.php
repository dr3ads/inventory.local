<?php

namespace App\Http\Middleware;

use Closure;
use Lib\Processes\ProcessRepository;
use Lib\Alerts\AlertRepository;


class ExpiryAlertMiddleware
{
    protected $processRepository;
    protected $alertRepository;

    public function __construct(ProcessRepository $processRepository, AlertRepository $alertRepository)
    {
        $this->processRepository = $processRepository;
        $this->alertRepository = $alertRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //loop through all parent process and check the expiry date
        $this->processRepository->setExpirableAlerts();

        //loop through all parent process and set expired status
        $this->processRepository->setProcessExpired();

        //loop through all parent process and set void status if necessary
        $this->processRepository->setProcessVoid();

        return $next($request);
    }

}
