<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Lang;
use Illuminate\Http\Request;
use App\Models\MCompany;
use Mail;

class RegistrationController extends Controller
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

    use AuthenticatesUsers;

    public function business_registration(){
        return view('business.registration');

    }
    public function check_business_email(Request $request){
        $company_email=$request->email;
        $return=array();
        $total_email=MCompany::where('email',$company_email)->count();
        if($total_email > 0)
        {
            $return=array('total'=>1,'msg'=>Lang::get('language_business.company_email_exist'));
        }
        else
        {
            $return=array('total'=>0,'msg'=>Lang::get('language_business.company_email_accepted'));
        }
        return $return;
    }
    public function register_business_data(Request $request)
    {
        $total_email=MCompany::where('email',$request->email)->count();
        if($total_email == 0)
        {
            $qry=MCompany::insert(array('name'=>$request->name,'surname'=>$request->surname,'organization'=>$request->organization,'email'=>$request->email,'password'=>$request->password,'find_us'=>$request->find_us,'access_type'=>$request->access_type,'status'=>1,'created_date'=>date('Y-m-d H:i:s')));
            if($qry)
            {
            	$data=array('name'=>$request->name,'surname'=>$request->surname,'url'=>url('/').'/company/'.strtolower($request->company_url));
            	$email=$request->email;
            	Mail::send('emails.registration_email', $data, function($message) use($email)
				{
				    $message->to($email, 'Unsilome')->subject(Lang::get('language_business.registration_email_subject'));
				});

               $return=array('error'=>0,'msg'=>Lang::get('language_business.company_reg_success')); 
            }
            else
            {
               $return=array('error'=>1,'msg'=>Lang::get('language_business.error')); 
            }
        }
        else
        {
            $return=array('error'=>1,'msg'=>Lang::get('language_business.company_email_exist')); 
        }
        
       return $return;
    }
}
