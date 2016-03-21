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
    }

    public function addAssets()
    {
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
        $this->theme->asset()->usePath()->add('page-css', 'css/page.css', array('bootstrap-css'));
        $this->theme->asset()->usePath()->add('items-css', 'css/items.css', array('global-css'));
        $this->theme->set('title', 'Daily Report');
    }

    public function daily($timestamp = '')
    {
        $data = array();
        $this->theme->set('title', 'Daily Report');
        $date = ($timestamp) ? date('Y-m-d', $timestamp) : date('Y-m-d');
        $data['yesterday']['total'] = 10000; //compute yesterdays total;
        $data['claims'] = $this->processRepository->getTodayClaims();
        $sum_claim = 0;

        $data['active_items'] = $this->itemRepository->getActive();

        foreach($data['claims'] as $claim){
            $sum_claim += $claim->pawn_amount;
        }

        $data['total_claim'] = $sum_claim;
        $data['pawns'] = $this->processRepository->getTodayPawns();

        //calculate total pawns
        $sum = 0;
        foreach($data['pawns'] as $pawn){
            $sum += $pawn->pawn_amount;
        }
        $data['total_pawn'] = $sum;
        $data['sold_units'] = $this->itemRepository->getTodaySoldUnits();
        $sum_sold_units = 0;
        foreach($data['sold_units'] as $sold_unit){
            $sum_sold_units += $sold_unit->sold_price;
        }

        $data['display_items'] = $this->itemRepository->getActiveDisplay();

        $data['total_sold_units'] = $sum_sold_units;
        $data['bought_units'] = $this->itemRepository->getTodayBoughtUnits();

        $data['total_bought_units'] = 0;

        foreach($data['bought_units'] as $bought_unit){
            $data['total_bought_units'] += $bought_unit->acquire_price;
        }

        $data['cash_ins'] = $this->miscRepository->getTodayCashIn();

        $data['total_cash_ins'] = 0;

        foreach($data['cash_ins'] as $cash_in){
            $data['total_cash_ins'] += $cash_in->amount;
        }

        $data['cash_outs'] = $this->miscRepository->getTodayCashOut();

        $data['total_cash_outs'] = 0;

        foreach($data['cash_outs'] as $cash_outs){
            $data['total_cash_outs'] += $cash_outs->amount;
        }

        $data['sold_accessories'] = $this->accessoryTransactionRepository->getTodaySoldAccessories();
        $sum_sold_accessories = 0;

        foreach($data['sold_accessories'] as $sold_accessory){
            $sum_sold_accessories += $sold_accessory->amount;
        }
        $data['sum_sold_accessories'] = $sum_sold_accessories;
        //dd($data['cash_out']);
        return $this->theme->scope('reports.daily', $data)->render();
    }
}
