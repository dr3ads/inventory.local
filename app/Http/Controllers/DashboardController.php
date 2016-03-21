<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Theme;
use App\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function __construct()
    {

    }

    public function addAssets()
    {
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
        $this->theme->asset()->usePath()->add('page-css', 'css/page.css', array('bootstrap-css'));
        $this->theme->asset()->usePath()->add('items-css', 'css/items.css', array('global-css'));
        $this->theme->set('title','Inventory');
    }

    public function index()
    {
        $data = array();

        return $this->theme->scope('dashboard.index', $data)->render();
    }
}
