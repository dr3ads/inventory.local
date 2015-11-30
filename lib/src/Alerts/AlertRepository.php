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
        return $this->model->where('added_at', '=', Carbon::today()->toDateString())->where('id', '=', $id)->count();
    }
}