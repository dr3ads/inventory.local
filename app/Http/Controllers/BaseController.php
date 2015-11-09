<?php namespace App\Http\Controllers;

use Theme;

class BaseController extends Controller {

    var $theme = null;
    var $layout = 'default';
    var $theme_name = 'inventory';
    var $data = array();

    public function __construct()
    {
        $this->middleware = 'auth';
    }

    protected function setupLayout()
    {
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
    }


    public function callAction($method, $parameters)
    {
        $this->setupLayout();

        return call_user_func_array(array($this, $method), $parameters);

    }
}