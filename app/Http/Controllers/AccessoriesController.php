<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lib\Accessories\AccessoryRepository;

class AccessoriesController extends Controller
{
    protected $accessoryRepository;

    public function __construct(AccessoryRepository $accessoryRepository)
    {
        $this->accessoryRepository = $accessoryRepository;
    }

    public function index()
    {
        print_r($this->accessoryRepository->all());
    }
}
