<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Lang;
use App\Http\Requests;
use App\Models\MSuperAdminCredential;
use Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function admin_auth(){
        return view('admin.login');
    }
    public function superAdminLogin(Request $request){
		$res=MSuperAdminCredential::where('username',$request->username)->where('pass',base64_encode($request->password))->get()->toArray();
		if(sizeof($res)>0){
			MSuperAdminCredential::where('username',$request->username)->update(array('logindatetime'=>date('Y-m-d H:i:s'),'loginip'=>LoginController::get_client_ip_server()));
			$session['username']=$res[0]['username'];
			$request->session()->put('admin_username',$res[0]['username']);
			$data['error_code']=1;
			$data['msg']=Lang::get('language_admin.success_login');
			$data['redirect']='admin_dashboard';
		}else{
			$data['error_code']=0;
			$data['msg']=Lang::get('language_admin.internal_error');	
		}
		return Response::json($data);
	}
	public	static function get_client_ip_server() {
	    $ipaddress = '';
	    if (array_key_exists('HTTP_CLIENT_IP', $_SERVER))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(array_key_exists('HTTP_X_FORWARDED', $_SERVER))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(array_key_exists('HTTP_FORWARDED_FOR', $_SERVER))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(array_key_exists('HTTP_FORWARDED', $_SERVER))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(array_key_exists('REMOTE_ADDR', $_SERVER))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	 
	    return $ipaddress;
	}
}
