<?php namespace App\Http\Controllers;

use Theme;
use Lib\Alerts\AlertRepository;

class BaseController extends Controller {

    protected $theme = null;
    protected $layout = '';
    protected $theme_name = '';
    protected $data = array();

    public function __construct()
    {
        $this->middleware = 'auth';
        setlocale(LC_MONETARY, 'en_PH');

    }

    protected function setupLayout()
    {
        $this->layout = getenv('LAYOUT');
        $this->theme_name = getenv('THEME');
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
        $this->addAssets();
    }


    public function addAssets()
    {
        return;
    }

    public function callAction($method, $parameters)
    {
        $this->setupLayout();

        return call_user_func_array(array($this, $method), $parameters);
    }


}