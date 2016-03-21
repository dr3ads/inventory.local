<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreMiscRequest;
use Lib\Misc\MiscRepository;
use Theme;
use Illuminate\Http\Request;

class MiscellaneousController extends BaseController
{
    protected $miscRepository;

    public function __construct(MiscRepository $miscRepository)
    {
        $this->miscRepository = $miscRepository;
        $this->middleware('auth');

    }

    public function addAssets()
    {
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
        $this->theme->asset()->usePath()->add('page-css', 'css/page.css', array('bootstrap-css'));
        $this->theme->asset()->usePath()->add('misc-css', 'css/misc.css', array('global-css'));
        $this->theme->set('title','Miscellaneous');
    }

    public function index(Request $request)
    {
        $flow = ($request->flow) ?  : 'in';
        $data['miscs'] = $this->miscRepository->getMiscByFlow($flow)->paginate();
        $data['count']['earn'] = $this->miscRepository->getMiscByFlow('in')->count();
        $data['count']['spend'] = $this->miscRepository->getMiscByFlow('out')->count();

        return $this->theme->scope('misc.index', $data)->render();
    }

    public function createIn()
    {
        $data = array();
        return $this->theme->scope('misc.create-in', $data)->render();
    }

    public function createOut()
    {
        $data = array();
        return $this->theme->scope('misc.create-out', $data)->render();
    }

    public function store(StoreMiscRequest $request)
    {

        $data = [
            'flow' => $request->flow,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ];

        $misc = $this->miscRepository->create($data);
        $accType = ($request->flow == 'in') ? 'debit' : 'credit';

        $accData = array(
            'amount' => $request->amount,
            'accountable_type' => 'Process',
            'accountable_id' => $request->id,
            'type' => $accType,
        );

        $misc->accounting()->create($accData);

        return redirect('misc')->with('success_msg', 'Miscellaneous Saved');
    }
}
