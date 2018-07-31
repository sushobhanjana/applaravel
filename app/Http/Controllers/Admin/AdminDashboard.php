<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Lang;
//use Request;
use Illuminate\Http\Request;
use App\Models\MCompany;
use App\Models\Mwidgets;
use App\Models\Mwidgetassign;

class AdminDashboard extends Controller
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
    public function admin_dashboard(){
        $data['mnuactive']="dashboard";
        return view('admin.admin_dashboard')->withData($data);
    }
    public function admin_logout(Request $request){
        $request->session()->forget('admin_username');
        $request->session()->flush();
        return redirect('admin/');
    }
    public function admin_companywidgetaccess(){
        $data['mnuactive']="widget";
        $data['get_company']=MCompany::select('id','name','organization','access_type','email','find_us','status')->get(); 
        return view('admin.admin_companywidgetaccess')->withData($data);
    }
    public function admin_widgetaccess($id){    
            $data['get_id'] = base64_decode($id);
            $data['business_details'] = MCompany::where('id',$data['get_id'])->get();
            $data['widget_list'] = Mwidgets::get();
            $data['user_widget_list'] = Mwidgetassign::join('tbl_widgets', 'tbl_widgets_access.fk_widget_id', '=', 'tbl_widgets.id')->where('fk_company_id',$data['get_id'])->get();

            if(sizeof($data['user_widget_list'])>0){
            $arr=array();    
                foreach($data['user_widget_list'] as $k=>$rwl){
                    $arr[]=$rwl['fk_widget_id'];
                }
             $data['company_available_widget']=Mwidgets::whereNotIn('id',$arr)->get();
            }
            $data['mnuactive']="widget";
            return view('admin.admin_widgetaccesspage')->withData($data);  
    }
    public function admin_widgetprocess(Request $request){
        $wid = $request->wid;
        $bid = $request->bid;
        $records = array('fk_company_id'=>$bid,
            'fk_widget_id'=>$wid,'created_at'=>date('Y-m-d h:m:s'));
        $insertion = Mwidgetassign::insert($records);
        if($insertion){
            echo "success";    
        }else{
            echo "failed";
        }
    }

}
