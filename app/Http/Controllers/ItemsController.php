<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyItemRequest;
use App\Http\Requests\PullItemRequest;
use App\Http\Requests\SellItemRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Lib\Customers\CustomerRepository;
use Lib\Items\ItemRepository;
use Theme;
use App\Http\Controllers\BaseController;

class ItemsController extends BaseController
{
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->middleware('auth');
        $this->itemRepository = $itemRepository;

    }

    public function addAssets()
    {
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
        $this->theme->asset()->usePath()->add('page-css', 'css/page.css', array('bootstrap-css'));
        $this->theme->asset()->usePath()->add('items-css', 'css/items.css', array('global-css'));
        $this->theme->set('title','Inventory');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $data = array();
        $itemType = $request->has('type') ? $request->get('type') : 'active';
        $items = array();
        switch($itemType){
            case 'void':
                $items = $this->itemRepository->getVoid();
                break;
            case 'bought':
                $items = $this->itemRepository->getBought();
                break;
            case 'archive':
                $items = $this->itemRepository->getArchive();
                break;
            case 'active':
            default:
                $items = $this->itemRepository->getActive();
                break;
        }

        $data['count'] = $this->itemRepository->itemCount();
        //dd($items);
        $data['items'] = $items;
        //dd($data['items'][0]->process);
        return $this->theme->scope('items.index', $data)->render();

    }

    public function buyItem()
    {
        $data = array();
        return $this->theme->scope('items.buy', $data)->render();
    }

    public function doBuyItem(BuyItemRequest $request)
    {
        $data = array(
            'name' => $request->get('item_name'),
            'brand' => $request->get('item_brand'),
            'serial' => $request->get('item_serial'),
            'description' => $request->get('item_desc'),
            'acquire_price' => $request->get('acquire_price'),
            'selling_value' => $request->get('acquire_price'),
            'displayed_at' => Carbon::now(),
        );

        $this->itemRepository->create($data);

        return redirect('display')->with('success', 'Item Bought');
    }

    public function sellItem($id, CustomerRepository $customerRepository)
    {
        $data = array();
        $data['customers'] = $customerRepository->getValueByKey('full_name');
        $data['item'] = $this->itemRepository->with('process')->find($id);

        return $this->theme->scope('items.sell', $data)->render();
    }

    public function doSellItem(SellItemRequest $request)

    {
        $data = array(
            'sold_at' => Carbon::now(),
            'customer_id' => $request->get('customer_id'),
            'selling_value' => $request->get('item_sell_price'),
        );

        $this->itemRepository->update($data, $request->get('item_id'));

        return redirect('inventory')->with('success_msg', 'Item Sold');
    }

    public function pullItem($id, CustomerRepository $customerRepository)
    {
        $data = array();
        $data['customers'] = $customerRepository->getValueByKey('full_name');
        $data['item'] = $this->itemRepository->with('process')->find($id);

        return $this->theme->scope('items.pull', $data)->render();
    }

    public function doPullItem(PullItemRequest $request)
    {

        $item = $this->itemRepository->softDelete($request->get('item_id'));
        //dd($item);
        return redirect('inventory')->with('success_msg', 'Item Pulled Out');
    }

    public function itemDetails($id)
    {
        $data['item'] = $this->itemRepository->with('process')->find($id);

        return $this->theme->scope('items.show', $data)->render();
    }


}
