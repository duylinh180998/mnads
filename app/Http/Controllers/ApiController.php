<?php
/**
 * Description  : Api process
 * Created by   : Thangnv
 * Created date : 2020/08/19
 * -----------------------
 * Description update  :
 * Update by           :
 * Update date         :
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Controller;
//use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Calllog;
use App\Chatfblog;
use App\Chatzalolog;
use App\Contactlog;
use App\Maplog;
use App\Users;
use Carbon\Carbon;

use App\Call;
use App\ChatFaceBook;
use App\ChatZalo;
use App\Contact;
use App\Maps;

class ApiController extends Controller
{
    private $respon;
    protected $user;

    public function __construct(){
        $this->respon = array(
            'status' => false,
            'message' => '',
            'data' => (object)[]
        );
    }


    /**
     * API add call
     * Created by   : Thangnv
     * Created date : 2020/08/19
     *
     * @param    Request $request
     * @return      json
     */
    public function calllog(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
            'call_id.required'        => __('api.call_id_required'),
            'ip.required'    => __('api.ip_required'),
            'location.required'     => __('api.location_required'),
        );
        $rule = [
            'token'          => 'required',
            'call_id'         => 'required',
            'ip'     => 'required',
            'location'     => 'required',
        ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        }else{
            //
            $user = Users::where('token',$request->input('token'))->first();

            //
            $data = [
                'user_id'      => $user->id,
                'call_id'     => $request->input('call_id'),
                'ip'  => $request->input('ip'),
                'location'   => $request->input('location')
            ];

            //
            $call = Calllog::insert($data);
            //
            if($call){
                $this->respon['status']   = true;
                $this->respon['message']  = __('api.success');
                $this->respon['data']     = $call;
                $this->respon['error_type'] = 1;
            } else {
                $this->respon['message']  = __('api.error');
            }
        }

        return response()->json($this->respon);

    }

    public function chatfblog(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
            'facebook_id.required'        => __('api.facebook_id_required'),
            'ip.required'    => __('api.ip_required'),
            'location.required'     => __('api.location_required'),
        );
        $rule = [
            'token'          => 'required',
            'facebook_id'         => 'required',
            'ip'     => 'required',
            'location'     => 'required',
        ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        }else{
            //
            $user = Users::where('token', $request->input('token'))->first();
            //
            $data = [
                'user_id'      => $user->id,
                'facebook_id'     => $request->input('facebook_id'),
                'ip'  => $request->input('ip'),
                'location'   => $request->input('location')
            ];

            //
            $cfb = Chatfblog::insert($data);
            //
            if($cfb){
                $this->respon['status']   = true;
                $this->respon['message']  = __('api.success');
                $this->respon['data']     = $cfb;
                $this->respon['error_type'] = 1;
            } else {
                $this->respon['message']  = __('api.error');
            }
        }

        return response()->json($this->respon);

    }

    public function chatzalolog(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
            'zalo_id.required'        => __('api.zalo_id_required'),
            'ip.required'    => __('api.ip_required'),
            'location.required'     => __('api.location_required'),
        );
        $rule = [
            'token'          => 'required',
            'zalo_id'         => 'required',
            'ip'     => 'required',
            'location'     => 'required',
        ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        }else{
            //
            $user = Users::where('token', $request->input('token'))->first();
            //
            $data = [
                'user_id'      => $user->id,
                'zalo_id'     => $request->input('zalo_id'),
                'ip'  => $request->input('ip'),
                'location'   => $request->input('location')
            ];

            //
            $czl = Chatzalolog::insert($data);
            //
            if($czl){
                $this->respon['status']   = true;
                $this->respon['message']  = __('api.success');
                $this->respon['data']     = $czl;
                $this->respon['error_type'] = 1;
            } else {
                $this->respon['message']  = __('api.error');
            }
        }

        return response()->json($this->respon);

    }

    public function contactlog(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
            'lienhe_id.required'        => __('api.lienhe_id_required'),
            'ip.required'    => __('api.ip_required'),
            'location.required'     => __('api.location_required'),
            'mobile.required'   => __('api.mobile_required'),
            'description.required'  => __('api.description_required')
        );
        $rule = [
            'token'          => 'required',
            'lienhe_id'         => 'required',
            'ip'     => 'required',
            'location'     => 'required',
            'mobile'    => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        }else{
            //
            $user = Users::where('token', $request->input('token'))->first();
            //
            $data = [
                'user_id'      => $user->id,
                'lienhe_id'     => $request->input('lienhe_id'),
                'ip'  => $request->input('ip'),
                'location'   => $request->input('location'),
                'mobile'    => $request->input('mobile'),
                'description'   => $request->input('description')
            ];
            //
            $contact = Contactlog::insert($data);
            //
            if($contact){
                $this->respon['status']   = true;
                $this->respon['message']  = __('api.success');
                $this->respon['data']     = $contact;
                $this->respon['error_type'] = 1;
            } else {
                $this->respon['message']  = __('api.error');
            }
        }
        return response()->json($this->respon);
    }
    public function maplog(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
            'map_id.required'        => __('api.map_id_required'),
            'ip.required'    => __('api.ip_required'),
            'location.required'     => __('api.location_required'),
        );
        $rule = [
            'token'          => 'required',
            'map_id'         => 'required',
            'ip'     => 'required',
            'location'     => 'required',
        ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        }else{
            //
            $user = Users::where('token', $request->input('token'))->first();
            //
            $data = [
                'user_id'      => $user->id,
                'map_id'     => $request->input('map_id'),
                'ip'  => $request->input('ip'),
                'location'   => $request->input('location')
            ];
            //
            $map = Maplog::insert($data);
            //
            if($map){
                $this->respon['status']   = true;
                $this->respon['message']  = __('api.success');
                $this->respon['data']     = $map;
                $this->respon['error_type'] = 1;
            } else {
                $this->respon['message']  = __('api.error');
            }
        }
        return response()->json($this->respon);
    }
    public  function chart(Request $request){
//        $requestData=$request->all();
//        $user_id=Auth::id();
//        $facelog=Chatfblog::where('token',$request->input('token'))->first();
//        $data=[
//            'id'=>$facelog->id,
//            'user_id'=>$facelog->user_id,
//            'facebook_id'=>$facelog->facebook_id,
//            'ip'=>$facelog->ip,
//            'location'=>$facelog->location,
//            'created_at'=>$facelog->created_at,
//        ];
        $requestData=$request->all();
        $zalolog=[];
        $contactlog=[];
        $maplog=[];
        $calllog=[];
        $fblog=[];
        if(isset($requestData['date1']) && isset($requestData['date2'])){
            $date1=$requestData['date1'];
            $date2=$requestData['date2'];
            {
                if($requestData['date1']==$requestData['date2']){
                    $zalolog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatzalo_log where date(`created_at`)=date('$date1') group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $contactlog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from lienhe_log where date(`created_at`)=date('$date1')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $maplog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from maps_log where date(`created_at`)=date('$date1')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $calllog=DB::select("select DATE(created_at) as created_at, count(`id`) as count from call_log where date(`created_at`)=date('$date1')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $fblog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatfb_log where date(`created_at`)=date('$date1')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                }else{
                    $zalolog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatzalo_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date ('$date2') group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $contactlog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from lienhe_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date ('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $maplog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from maps_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date ('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $calllog=DB::select("select DATE(created_at) as created_at, count(`id`) as count from call_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date ('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $fblog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatfb_log where date(`created_at`)>=date('$date1') AND date(`created_at`)<=date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                }
            }

        }else{
            $zalolog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatzalo_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
            $contactlog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from lienhe_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
            $maplog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from maps_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
            $calllog=DB::select("select DATE(created_at) as created_at, count(`id`) as count from call_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
            $fblog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatfb_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
        }
        $data=[
            'zalolog'=>$zalolog,
            'contactlog'=>$contactlog,
            'maplog'=>$maplog,
            'fblog'=>$fblog,
            'calllog'=>$calllog,
        ];
        $this->respon['status']   = true;
        $this->respon['message']  = __('api.success');
        $this->respon['data']     = $data;
        $this->respon['error_type'] = 1;
        return response()->json($this->respon);
    }


    /**
     * API add call
     * Created by   : Thangnv
     * Created date : 2020/08/19
     *
     * @param    Request $request
     * @return      json
     */
    public function userinfo(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
        );
        $rule = [
            'token'          => 'required',
         ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        }else{

            //
            $user = Users::where('token',$request->input('token'))->first();

            $call = Call::where('user_id',$user->id)->get();
            $fb = ChatFaceBook::where('user_id',$user->id)->get();
            $zl = ChatZalo::where('user_id',$user->id)->get();
            $contact = Contact::where('user_id',$user->id)->get();
            $map = Maps::where('user_id',$user->id)->get();


            $data=[
                'zalo'=>$zl,
                'contact'=>$contact,
                'map'=>$map,
                'fb'=>$fb,
                'call'=>$call,
            ];

            $this->respon['status']   = true;
            $this->respon['message']  = __('api.success');
            $this->respon['data']     = $data;
            $this->respon['error_type'] = 1;
            return response()->json($this->respon);

        }



    }
    public function sentmessage(Request $request) {

        $requestData = $request->all();
        $user = Users::where('token',$request->input('token'))->first();
        $requestData['author']=$user->username;
        $requestData['conten']=$requestData['content'];
        app('App\Http\Controllers\Admin\ChatController')->store($requestData);

        $this->respon['status']   = true;
        $this->respon['message']  = __('api.success');
        $this->respon['data']     = $requestData['content'];
        $this->respon['error_type'] = 1;
        return response()->json($this->respon);
    }
}
