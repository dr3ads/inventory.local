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
    public function index(Request $request, CustomerRepository $customersRepository)
    {
        $data = array();
        $status = ($request->status) ? $request->status : 'default';

        dd($this->theme->get('alerts'));
        switch ($status) {

            case 'claimed':
                $transactions = $this->processRepository->allClaimed();
                break;
            case 'expired':
                $transactions = $this->processRepository->allExpired();
                break;
            case 'void':
                $transactions = $this->processRepository->allVoid();
                break;
            case 'default':
            default:
                $transactions = $this->processRepository->allParents();
                break;
        }
        $data['customers'] = $customersRepository->getValueByKey('full_name');
        array_unshift($data['customers'], 'Select Customer');

        foreach ($transactions as $transaction) {
            $data['transactions'][] = $this->processRepository->getProcessTree($transaction->id);
        }

        $data['paginator'] = $transactions->render();

        $data['status'] = $request->status;

        return $this->theme->scope('transactions.' . $status, $data)->render();
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
            'serial' => $request->item_serial,
            'brand' => $request->item_brand,
        );

        $processData = array(
            'customer_id' => $request->customer_id,
            'pawn_amount' => $request->pawn_amount,
            'expired_at' => Carbon::now()->addDays(getenv('EXPIRY_COUNT')),
        );

        $item = $itemRepository->create($itemData);
        $process = $item->process()->create($processData);

        $this->storeProcessAccountable($process, $request->pawn_amount);

        return redirect('transactions/show/' . $process->id)->with('success_msg', 'Transaction Saved');
    }

    protected function storeProcessAccountable($process, $amount)
    {

        $accData = array(
            'amount' => $amount,
            'accountable_type' => 'Process',
            'accountable_id' => $process->id,
            'type' => 'credit',
        );

        $accDataInterest = array(
            'amount' => ($amount * (getenv('INTEREST_RATE') / 100)),
            'accountable_type' => 'Process',
            'accountable_id' => $process->id,
            'type' => 'debit',
        );

        $process->accounting()->create($accData);
        $process->accounting()->create($accDataInterest);
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

        return $this->theme->scope('transactions.show', $data)->render();

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
        $data['processTree'] = $this->processRepository->getAllTree($id);
        echo "Show the receipts of all transactions under this tree";
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function renew($id)
    {
        $data = array();
        $data['transaction'] = $this->processRepository->find($id);
        $data['processTree'] = $this->processRepository->getProcessTree($id);
        $data['totalAmount'] = $this->processRepository->getTotalPawnAmount($id);

        return $this->theme->scope('transactions.renew', $data)->render();
    }

    public function claim($id)
    {
        $data = array();
        $data['transaction'] = $this->processRepository->find($id);
        $data['processTree'] = $this->processRepository->getAllTree($id);
        $data['transactionDetails'] = $this->processRepository->transactionDetails($id);
        $data['totalAmount'] = $this->processRepository->getTotalPawnAmount($id);

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
        $data['totalAmount'] = $this->processRepository->getTotalPawnAmount($id);

        //keep out
        if ($data['transaction']->status != 'active') {
            return redirect('transactions');
        }

        if ($data['transaction']->item->value <= $data['totalAmount']) {
            return redirect('transactions');
        }

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

        $process = $this->processRepository->create($data);
        $this->storeProcessAccountable($process, $request->pawn_amount);
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

        $process = $this->processRepository->create($data);

        $totalAmount = $this->processRepository->getTotalPawnAmount($request->parent_id);

        $accData = array(
            'amount' => ($totalAmount * (getenv('INTEREST_RATE') / 100)),
            'accountable_type' => 'Process',
            'accountable_id' => $process->id,
            'type' => 'debit',
        );

        $process->accounting()->create($accData);

        return redirect('transactions')->with('success_msg', 'Renew Transaction Saved');
    }

    public function storeClaim(Request $request)
    {
        $input = $request->all();

        $process = $this->processRepository->find($input['parent_id']);
        $this->processRepository->setProcessStatus($input['parent_id'], 'claimed');

        $accData = array(
            'amount' => $input['penalty'],
            'accountable_type' => 'Process',
            'accountable_id' => $request->id,
            'type' => 'debit',
        );

        $process->accounting()->create($accData);

        return redirect('transactions')->with('success_msg', 'Transaction Claimed');
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
