<?php namespace App\Http\Controllers;

use Theme;
use Lib\Alerts\AlertRepository;

class BaseController extends Controller {

    public $theme = null;
    public $layout = '';
    public $theme_name = '';
    public $data = array();

    public function __construct()
    {
        $this->middleware = 'auth';
        setlocale(LC_MONETARY, 'en_PH');
        $this->layout = getenv('LAYOUT');
        $this->theme_name = getenv('THEME');
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