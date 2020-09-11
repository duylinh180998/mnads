<?php

namespace App\Http\Controllers\Admin;

use App\Calllog;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class CalllogController extends Controller
{
    private $model;
    private $data;
    private $perPage;
    public function __construct(){
        $this->model=new Calllog();
        $this->data['controller']=__CLASS__;
        $this->perPage=config('admin.perpage');
    }
    public function index(Request $request){
        $user_id=Auth::id();
        $requestData=$request->all();
        if(isset($requestData['date1'])||isset($requestData['date2'])){
            if($requestData['date1']==$requestData['date2']){
                $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',$requestData['date2'])->paginate(5);
                return view('calllog.index',$this->data);
            }
            else{
//                $this->data['data']=$this->model->where('user_id',$user_id)->paginate(2);
                $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',$requestData['date1'])->whereDate('created_at','<=',$requestData['date2'])->paginate(5);
                return view('calllog.index',$this->data);
            }
        }
        if(isset($requestData['paginator'])){
            if($requestData['paginator']=="1"){
                $this->data['data']=$this->model->where('user_id',$user_id)->paginate(10);
                return view('calllog.index',$this->data);
            }elseif ($requestData['paginator']=="2"){
                $this->data['data']=$this->model->where('user_id',$user_id)->paginate(15);
                return view('calllog.index',$this->data);
            }
        }
        $this->data['data']=$this->model->where('user_id',$user_id)->paginate(5);
        return view('calllog.index',$this->data);
    }
//    public function print(){
//        $user_id=Auth::id();
//        $this->data['data']=$this->model->where('user_id',$user_id)->paginate(10);
//        $pdf = PDF::loadView('calllog.index',['data'=>$this->data]);
//        return $pdf->download('invoice.pdf');
//    }
    /**
     * ajax update printed
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function printed(Request $request)
    {
        $respon = array(
            'status'    => false,
            'message'   => '',
            'data'      => []
        );
        //
        $serialChecked      = trim($request->input('serial_checked',''),',');
        $serialUnChecked    = trim($request->input('serial_un_checked',''),',');
        //
        $dataUpdate['updated_at']   = date('Y-m-d H:i:s');
        $dataUpdate['updated_user'] = Auth::user()->admin_username;
        //
        if($serialChecked){
            $dataUpdate['serial_printed'] = 1;
            if (Serials::whereIn('serial_id', explode(',', $serialChecked))->update($dataUpdate)) {
                $respon['status'] = true;
                $respon['message'] = __('admin.message_update_sucess');
            } else {
                $respon['message'] = __('admin.message_error_database');
            }
        }
        //
        if ($serialUnChecked) {
            $dataUpdate['serial_printed'] = 0;
            if (Serials::whereIn('serial_id', explode(',', $serialUnChecked))->update($dataUpdate)) {
                $respon['status']   = true;
                $respon['message']  = __('admin.message_update_sucess');
            } else {
                $respon['message'] = __('admin.message_error_database');
            }
        }

        return response()->json($respon);
    }

    /**
     * Download file pdf.
     *
     * @param  string $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function downloadPDF()
    {

            $user_id=Auth::id();
            //
             $this->data['data']=$this->model->where('user_id',$user_id)->paginate(5);
            //
//            PDF::setOptions(['default_font' => 'HGMaruGoThicMPRO']);
            $pdf = PDF::loadView('calllog/index' , $this->data);
            return $pdf->stream('serial_codes.pdf');


    }
}
