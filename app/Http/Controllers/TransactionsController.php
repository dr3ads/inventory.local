<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAdditionalTransactionRequest;
use App\Http\Requests\SaveRenewTransactionRequest;
use App\Http\Requests\SaveTransactionRequest;
use Carbon\Carbon;
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

        $this->theme->asset()->container('footer')->usePath()->add('transactions', 'js/transactions.js',
            array('jquery'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        switch ($request->status) {
            case 'default':
                $transactions = $this->processRepository->allParents();
                break;
            case 'renewed':
                $transactions = $this->processRepository->allRenewed();
                break;
            case 'expired':

                $transactions = $this->processRepository->allExpired();
                break;
            default:
                $transactions = $this->processRepository->allParents();
                break;
        }

        foreach ($transactions as $transaction) {
            $data['transactions'][] = $this->processRepository->getProcessTree($transaction->id);
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
     * @param  \Illuminate\Http\Request $request
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
            'expired_at' => Carbon::now()->addDays(getenv('EXPIRY_COUNT')),
        );

        $item = $itemRepository->create($itemData);
        $process = $item->process()->create($processData);
        return redirect('transactions/show/'.$process->id)->with('success_msg', 'Transaction Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['process'] = $this->processRepository->find($id);
        echo "Show the receipts of a certain transaction";
        echo "<pre>";print_r($data);echo "</pre>";
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showAll($id)
    {
        $data = array();
        $data['processTree'] = $this->processRepository->getProcessTree($id);
        echo "Show the receipts of all transactions under this tree";
        echo "<pre>";print_r($data);echo "</pre>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function renew($id, CustomerRepository $customersRepository)
    {
        $data = array();
        $data['transaction'] = $this->processRepository->find($id);
        $data['processTree'] = $this->processRepository->getProcessTree($id);
        $data['totalPawnAmount'] = $this->processRepository->getTotalPawnAmount($id);
        $data['customers'] = $customersRepository->getValueByKey('full_name');

        return $this->theme->scope('transactions.renew', $data)->render();
    }

    public function claim($id, CustomerRepository $customersRepository)
    {
        $data = array();
        $data['transaction'] = $this->processRepository->find($id);
        $data['processTree'] = $this->processRepository->getProcessTree($id);
        $data['totalPawnAmount'] = $this->processRepository->getTotalPawnAmount($id);
        $data['customers'] = $customersRepository->getValueByKey('full_name');

        return $this->theme->scope('transactions.claim', $data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $action)
    {
        switch ($action) {
            case 'repawn':
                return $this->theme->scope('transactions.repawn', $data)->render();
                break;
            default:
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function repawn($id, CustomerRepository $customersRepository)
    {
        $data = array();
        $data['transaction'] = $this->processRepository->find($id);
        $data['customers'] = $customersRepository->getValueByKey('full_name');
        return $this->theme->scope('transactions.repawn', $data)->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pawn_amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('transactions')
                ->withErrors($validator)
                ->withInput();
        }

        $item = $itemRepository->create($itemData);
        $item->transaction()->create($processData);
        return redirect('transactions')->with('success_msg', 'Transaction Saved');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function storeRepawn(SaveAdditionalTransactionRequest $request)
    {
        $data = array(
            'parent_id' => $request->parent_id,
            'customer_id' => $request->customer_id,
            'item_id' => $request->item_id,
            'pawn_amount' => $request->pawn_amount,
            'expired_at' => Carbon::now()->addDays(getenv('EXPIRY_COUNT')),
        );

        $this->processRepository->create($data);
        return redirect('transactions')->with('success_msg', 'Additional Transaction Saved');
    }


    public function storeRenew(SaveRenewTransactionRequest $request)
    {
        $processTree = $this->processRepository->getProcessTree($request->parent_id);
        $data = array(
            'parent_id' => $request->parent_id,
            'customer_id' => $request->customer_id,
            'item_id' => $request->item_id,
            'expired_at' => Carbon::createFromTimestamp(strtotime($processTree['lastChild']->expired_at))
                ->addDays(getenv('RENEW_COUNT')),
        );

        $this->processRepository->create($data);
        return redirect('transactions')->with('success_msg', 'Renew Transaction Saved');
    }


    public function storeClaim(SaveRenewTransactionRequest $request)
    {
        $processTree = $this->processRepository->getProcessTree($request->parent_id);
        $data = array(
            'parent_id' => $request->parent_id,
            'customer_id' => $request->customer_id,
            'item_id' => $request->item_id,
            'expired_at' => Carbon::createFromTimestamp(strtotime($processTree['lastChild']->expired_at))
                ->addDays(getenv('RENEW_COUNT')),
        );

        $this->processRepository->create($data);
        return redirect('transactions')->with('success_msg', 'Renew Transaction Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
