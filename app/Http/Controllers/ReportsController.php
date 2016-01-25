<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Lib\Accessories\AccessoryTransactionRepository;
use Lib\Misc\MiscRepository;
use Lib\Accounting\AccountingRepository;
use Lib\Items\ItemRepository;
use Lib\Processes\ProcessRepository;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Theme;

class ReportsController extends BaseController
{
    protected $processRepository;
    protected $accountingRepository;
    protected $itemRepository;
    protected $accessoryTransactionRepository;
    protected $miscRepository;

    public function __construct(
        ProcessRepository $processRepository,
        AccountingRepository $accountingRepository,
        ItemRepository $itemRepository,
        AccessoryTransactionRepository $accessoryTransactionRepository,
        MiscRepository $miscRepository
    ) {
        $this->accountingRepository = $accountingRepository;
        $this->processRepository = $processRepository;
        $this->itemRepository = $itemRepository;
        $this->accessoryTransactionRepository = $accessoryTransactionRepository;
        $this->miscRepository = $miscRepository;
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
        $this->theme->asset()->usePath()->add('page-css', 'css/page.css', array('bootstrap-css'));
        $this->theme->asset()->usePath()->add('items-css', 'css/items.css', array('global-css'));

    }

    public function daily($timestamp = '')
    {
        $data = array();
        $this->theme->set('title', 'Daily Report');
        $date = ($timestamp) ? date('Y-m-d', $timestamp) : date('Y-m-d');
        $data['yesterday']['total'] = 10000; //compute yesterdays total;
        $data['claims'] = $this->processRepository->getTodayClaims();
        $data['pawns'] = $this->processRepository->getTodayPawns();
        $data['sold_units'] = $this->itemRepository->getTodaySoldUnits();
        $data['bought_units'] = $this->itemRepository->getTodayBoughtUnits();
        $data['cash_ins'] = $this->miscRepository->getTodayCashIn();
        $data['cash_outs'] = $this->miscRepository->getTodayCashOut();
        $data['sold_accessories'] = $this->accessoryTransactionRepository->getTodaySoldAccessories();
        //dd($data['cash_out']);
        return $this->theme->scope('reports.daily', $data)->render();
    }
}
