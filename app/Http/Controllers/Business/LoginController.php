<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Lang;
//use Request;
use Illuminate\Http\Request;
use App\Models\MCompany;
use App\Models\MForgetpassword_otp;
use Mail;
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

    use AuthenticatesUsers;

    public function business_auth(Request $request){
        return view('business.login');

    }
    public function business_authentication(Request $request){
        $return=array();
        $qry=MCompany::where('email',$request->email)->where('password',$request->password)->get()->toArray();
        if(sizeof($qry) > 0)
        {
            $request->session()->put('company_id',$qry[0]['id']);
            $request->session()->put('company_email',$request->email);
            $return=array('error'=>0,'msg'=>Lang::get('language_business.login_success'));
        }
        else
        {
            $return=array('error'=>1,'msg'=>Lang::get('language_business.credential_not_found'));
        }
        return $return;

    }
    public function business_forget_password(Request $request){
        $email=$request->company_forget_email;
        $url=$request->url;
        $qry=MCompany::where('email',$request->company_forget_email)->get()->toArray();
        if(sizeof($qry) == 0)
        {
            $return=array('error'=>1,'msg'=>Lang::get('language_business.email_not_found'));
        }
        else
        {
            $otp=rand(1000,9999);
            $count=MForgetpassword_otp::where('fk_company_email',$request->company_forget_email)->count();
            if($count > 0)
            {
                MForgetpassword_otp::where('fk_company_email',$request->company_forget_email)->update(array('otp'=>$otp,'created_date_time'=>date('Y-m-d H:i:s')));
            }
            else
            {
                $insert=MForgetpassword_otp::insert(array('fk_company_email'=>$request->company_forget_email,'otp'=>$otp,'created_date_time'=>date('Y-m-d H:i:s')));
            }
            $data=array('name'=>$qry[0]['name'],'surname'=>$qry[0]['surname'],'otp'=>$otp);
            $email=$request->company_forget_email;
            Mail::send('emails.otp_email', $data, function($message) use($email)
            {
                $message->to($email, 'Unsilome')->subject(Lang::get('language_business.otp_email_subject'));
            });
            $return=array('error'=>0,'msg'=>Lang::get('language_business.email_found'));
        }
        return $return;
    }
    public function check_otp(Request $request)
    {
        $otp=$request->otp;
        $email=$request->company_email;
        $qry=MForgetpassword_otp::where('fk_company_email',$email)->where('otp',$otp)->get()->toArray();
        if(sizeof($qry) > 0)
        {
            $otp_time=date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($qry[0]['created_date_time'])));
            if(date('Y-m-d H:i:s') > $otp_time)
                {
                    $return=array('error'=>1,'msg'=>Lang::get('language_business.otp_expired')); 
                }
            else
            {
                $return=array('error'=>0,'msg'=>Lang::get('language_business.otp_found'));
            }
        }
        else
        {
           $return=array('error'=>1,'msg'=>Lang::get('language_business.wrong_otp')); 
        }
        return $return;
    }
    public function business_reset_password(Request $request){
        $new_password=$request->new_password;
        $email=$request->company_email_data;
        $qry=MCompany::where('email',$email)->update(array('password'=>$new_password));
        if($qry)
            $return =array('error'=>0,'msg'=>Lang::get('language_business.password_update_successful'));
        else
            $return=array('error'=>1,'msg'=>Lang::get('language_business.error'));
        return $return;
    }
}
