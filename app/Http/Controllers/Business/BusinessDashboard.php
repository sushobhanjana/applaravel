<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Lang;
//use Request;
use Illuminate\Http\Request;
use App\Models\MCompany;
use App\Models\MPoll;
use App\Models\MOption;

use Redirect;

class BusinessDashboard extends Controller
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
    public function dashboard(){
        $data['mnuactive']="dashboard";
        return view('business.business_dashboard')->withData($data);
    }
    public function business_logout(Request  $request){
        $request->session()->forget('company_id');
        $request->session()->forget('company_email');
        $request->session()->flush();
        return redirect('business/');
    }
    
}
