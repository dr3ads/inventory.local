<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTransactionRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = array();

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
    public function store(SaveTransactionRequest $request)
    {
        dd($request);
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
    public function edit($id)
    {
        //
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
