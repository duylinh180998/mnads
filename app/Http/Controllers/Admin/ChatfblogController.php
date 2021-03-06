<?php

namespace App\Http\Controllers\Admin;
use App\Chatfblog;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class ChatfblogController extends Controller
{
    private $model;
    private $data;
    private $perPage;

    public function __construct()
    {
        $this->model=new Chatfblog();
        $this->data['controller']=__CLASS__;
        $this->perPage=config('admin.perpage');
    }
    public function index(Request $request){
        $user_id=Auth::id();
        $requestData=$request->all();
        if(isset($requestData['date1'])||isset($requestData['date2'])){
            if($requestData['date1']==$requestData['date2']){
                $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',$requestData['date2'])->get();
                return view('chatfblog.index',$this->data);
            }
            else{
                $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',$requestData['date1'])->whereDate('created_at','<=',$requestData['date2'])->get();
                return view('chatfblog.index',$this->data);
            }
        }
        if(isset($requestData['paginator'])){
            if($requestData['paginator']=="1"){
                $this->data['data']=$this->model->where('user_id',$user_id)->paginate(10);
                return view('chatfblog.index',$this->data);
            }elseif ($requestData['paginator']=="2"){
                $this->data['data']=$this->model->where('user_id',$user_id)->paginate(15);
                return view('chatfblog.index',$this->data);
            }
        }
        $this->data['data']=$this->model->where('user_id',$user_id)->paginate(5);
        return view('chatfblog.index',$this->data);

    }
    public function downloadPDF()
    {

        $user_id=Auth::id();
        //
        $this->data['data']=$this->model->where('user_id',$user_id)->paginate(5);
        //
//            PDF::setOptions(['default_font' => 'HGMaruGoThicMPRO']);
        $pdf = PDF::loadView('chatfblog/index' , $this->data);
        return $pdf->stream('serial_codes.pdf');


    }
}
