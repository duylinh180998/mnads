<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Call;

class CallController extends Controller
{
    public $data;
    private $perPage;
    private $model;

    public function __construct()
    {
        $this->perPage  = config('admin.per_page');
        $this->model    = new Call();
        //
        $this->data['controller'] = __CLASS__;
    }

    public function index() {

        $user_id = Auth::user()->id;
        $this->data['data'] = $this->model->where('user_id',$user_id)->get();
        return view('call.index', $this->data);
    }

    public function create() {

        return view('call.create');
    }

    public function store( Request $request)
    {
        $requestData = $request->all();

        $user_id = Auth::user()->id;

        $this->model->insert(
            array('user_id'=>$user_id,'name'=>$requestData['name'],'phone_number'=>$requestData['phone_number'],'description'=>$requestData['description'])
        );

       return redirect('call/index');
    }

    public function edit(Request $request, $id) {

        $this->data['data'] = $this->model->where('id',$id)->first();

        return view('call.update',$this->data);
    }


    public function update(Request $request){

        $requestData = $request->all();
        $this->model->where('id',$requestData['id'])->update(
            array('name'=>$requestData['name'],'phone_number'=>$requestData['phone'],'description'=>$requestData['description']
        ));

         return redirect('call/index');
    }

    public function delete(Request $request, $id){
      $this->model->where('id', $id)->delete();

      return redirect('call/index');
    }


}
