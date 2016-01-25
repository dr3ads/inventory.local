<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessoryBulkInRequest;
use App\Http\Requests\AccessoryBulkOutRequest;
use App\Http\Requests\AccessoryCreateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lib\Accessories\AccessoryRepository;
use Theme;
use App\Http\Controllers\BaseController;

class AccessoriesController extends BaseController
{
    protected $accessoryRepository;

    public function __construct(AccessoryRepository $accessoryRepository)
    {
        $this->accessoryRepository = $accessoryRepository;
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
        $this->theme->asset()->usePath()->add('page-css', 'css/page.css', array('bootstrap-css'));
        $this->theme->asset()->usePath()->add('misc-css', 'css/misc.css', array('global-css'));
        $this->theme->set('title','Accessories');
    }

    public function index()
    {
        $data = array();
        $data['accessories'] = $this->accessoryRepository->paginate();

        return $this->theme->scope('accessories.index', $data)->render();
    }

    public function show($id)
    {
        $data = array();
        $data['accessory'] = $this->accessoryRepository->find($id);

        return $this->theme->scope('accessories.show', $data)->render();
    }

    public function create()
    {
        $data = array();
        $data['accessories'] = $this->accessoryRepository->getValueByKey('name');

        return $this->theme->scope('accessories.create', $data)->render();
    }

    public function doCreate(AccessoryCreateRequest $request)
    {
        $this->accessoryRepository->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'quantity' => $request->get('quantity'),
            'unit_price' => $request->get('unit_price'),

        ]);

        return redirect('accessories')->with('success_msg', 'New Accessory Added');
    }

    public function bulkIn()
    {
        $data = array();
        $data['accessories'] = $this->accessoryRepository->getValueByKey('name');

        return $this->theme->scope('accessories.bulk-in', $data)->render();
    }

    public function doBulkIn(AccessoryBulkInRequest $request)
    {
        $accessory = $this->accessoryRepository->find($request->get('accessory_id'));
        $accessory->transactions()->create([
            'type' => 'in',
            'amount' => $request->get('amount'),
            'quantity' => $request->get('quantity'),
            'description' => $request->get('description'),
        ]);

        $accessory->quantity += $request->get('quantity');

        $accessory->save();
    }

    public function bulkOut()
    {
        $data = array();
        $data['accessories'] = $this->accessoryRepository->getValueByKey('name');

        return $this->theme->scope('accessories.bulk-out', $data)->render();
    }

    public function doBulkOut(AccessoryBulkOutRequest $request)
    {
        $accessory = $this->accessoryRepository->find($request->get('accessory_id'));
        $accessory->transactions()->create([
            'type' => 'out',
            'amount' => $request->get('amount'),
            'quantity' => $request->get('quantity'),
            'description' => $request->get('description'),
        ]);

        $accessory->quantity -= $request->get('quantity');

        $accessory->save();
    }

    public function sell($id)
    {
        $data = array();
        $data['accessory'] = $this->accessoryRepository->find($id);

        return $this->theme->scope('accessories.sell', $data)->render();

    }

    public function doSell(AccessoryBulkOutRequest $request)
    {
        $accessory = $this->accessoryRepository->find($request->get('accessory_id'));
        $accessory->transactions()->create([
            'type' => 'out',
            'amount' => $request->get('amount'),
            'quantity' => $request->get('quantity'),
            'description' => 'bought at '. Carbon::now()->format('M d, Y'),
        ]);

        $accessory->quantity -= $request->get('quantity');

        $accessory->save();

        return redirect('accessories')->with('success_msg', 'Accessory Sold');
    }

}
