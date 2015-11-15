<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTransactionRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use Lib\Items\ItemRepository;
use Lib\Processes\ProcessRepository;
use Lib\Customers\CustomerRepository;
use App\Http\Controllers\BaseController;
use Theme;
use Validator;

class TransactionsController extends BaseController
{
    protected $processRepository;
    protected $customers;

    public function __construct(ProcessRepository $processRepository)
    {
        $this->middleware('auth');
        $this->processRepository = $processRepository;
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);

        $this->theme->asset()->container('footer')->usePath()->add('transactions','js/transactions.js',array('jquery'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        switch($request->status){
            case 'default':
                $data['transactions'] = $this->processRepository->all();
                break;
            case 'renewed':
                $data['transactions'] = $this->processRepository->allRenewed();
                break;
            case 'expired':
                $data['transactions'] = $this->processRepository->allExpired();
                break;
            default:
                $data['transactions'] = $this->processRepository->all();
                break;
        }
        $data['status'] = $request->status;

        return $this->theme->scope('transactions.index', $data)->render();
    }

    /**
     * Show the form for creating a new resource.
     * @param CustomerRepository $customersRepository
     * @return mixed
     */
    public function create(CustomerRepository $customersRepository)
    {
        $data = array();
        $data['customers'] = $customersRepository->getValueByKey('full_name');
        array_unshift($data['customers'], 'Select Customer');
        return $this->theme->scope('transactions.create', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTransactionRequest $request, ItemRepository $itemRepository)
    {
        $itemData = array(
            'name' => $request->item_name,
            'description' => $request->item_desc,
            'value' => $request->item_value,
        );

        $processData = array(
            'customer_id' => $request->customer_id,
            'pawn_amount' => $request->pawn_amount,
        );

        $item = $itemRepository->create($itemData);
        $item->transaction()->create($processData);
        return redirect('transactions')->with('success_msg', 'Transaction Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $action)
    {
        switch($action){
            case 'repawn':

                break;
            default:
                break;
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
