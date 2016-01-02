<?php namespace Lib\Alerts;

use Carbon\Carbon;
use Lib\AbstractRepository;
use Lib\Alerts\Alert;

class AlertRepository extends AbstractRepository
{
    public function __construct(Alert $alert)
    {
        $this->model = $alert;
    }

    public function checkAlertExisting($id)
    {
        return $this->model->where('created_at', '=', Carbon::today()->__toString())->where('process_id', '=', $id)->count();
    }

    public function getCurrentAlerts()
    {
        return $this->model->where('created_at', '=', Carbon::today()->__toString())->where('seen', '=', '0');
    }
}