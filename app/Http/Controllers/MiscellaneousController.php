<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreMiscRequest;
use Lib\Misc\MiscRepository;
use Theme;

class MiscellaneousController extends BaseController
{
    protected $miscRepository;

    public function __construct(MiscRepository $miscRepository)
    {
        $this->miscRepository = $miscRepository;
        $this->middleware('auth');
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
    }

    public function index()
    {
        $data['miscs'] = $this->miscRepository->all();

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
