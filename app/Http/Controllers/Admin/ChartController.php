<?php

namespace App\Http\Controllers\Admin;

use App\Chatfblog;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    private $data;
    private $model;
    public function __construct()
    {
        $this->data['controller']=__CLASS__;
        $this->model=new Chatfblog();
    }
    public function index(){
        return view('chart.index');
    }
}
