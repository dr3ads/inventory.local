<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
        $this->theme = Theme::uses($this->theme_name)->layout($this->layout);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        if($request->get('on_hand')){
            $data['items'] = $this->itemRepository->itemsOnhand();
        }
        else{
            $data['items'] = $this->itemRepository->itemsOuthand();
        }
        //dd($data['items'][0]->process);
        return $this->theme->scope('items.index', $data)->render();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
