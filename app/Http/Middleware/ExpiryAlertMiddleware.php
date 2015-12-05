<?php

namespace App\Http\Middleware;

use Closure;
use Lib\Processes\ProcessRepository;
use Lib\Alerts\AlertRepository;
use Theme;

class ExpiryAlertMiddleware
{
    protected $processRepository;
    protected $alertRepository;
    protected $theme;

    public function __construct(ProcessRepository $processRepository, AlertRepository $alertRepository, Theme $theme)
    {
        $this->processRepository = $processRepository;
        $this->alertRepository = $alertRepository;
        $this->theme = $theme;
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

        //loop through all parent process and set void status if necessary
        $this->processRepository->setProcessVoid();

        $this->theme->set('alerts',$this->alertRepository->getCurrentAlerts());

        return $next($request);
    }

}
