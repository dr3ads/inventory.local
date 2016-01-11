<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lib\Alerts\AlertRepository;
use Theme;
use App\Http\Controllers\BaseController;
use Carbon;

class AlertsController extends BaseController
{
    protected $alertsRepository;

    public function __construct(AlertRepository $alertRepository)
    {
        $this->alertsRepository = $alertRepository;
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
        $this->theme->asset()->usePath()->add('page-css', 'css/page.css', array('bootstrap-css'));
        $this->theme->asset()->usePath()->add('alerts-css', 'css/alerts.css', array('global-css'));
        $this->theme->set('title','Alerts');
    }

    public function index()
    {
        $data = array();
        //dd($this->alertsRepository->getCurrentAlerts()->paginate());
        $data['alerts'] = $this->alertsRepository->getCurrentAlerts()->paginate();
        return $this->theme->scope('alerts.index', $data)->render();

    }

}
