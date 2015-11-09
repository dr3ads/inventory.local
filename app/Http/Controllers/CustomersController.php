<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Lib\Customers\CustomerRepository;
use App\Http\Controllers\BaseController;
use Theme;
use Validator;


class CustomersController extends BaseController
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
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
        $data['customers'] = $this->customerRepository->all();
        return $this->theme->scope('customers.index', $data)->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        return $this->theme->scope('customers.create', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'age' => 'required|numeric|min:18',
            'phone' => "required_without:mobile",
        ]);

        if ($validator->fails()) {
            return redirect('customers/create')
                ->withErrors($validator)
                ->withInput();
        }
        $data = array(
            'fname' => $request->fname,
            'lname' => $request->lname,
            'age' => $request->age,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
        );
        $this->customerRepository->create($data);

        $request->session()->flash('alert-success', 'Customer was successfully added!');
        return redirect()->route("customers.index");
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
