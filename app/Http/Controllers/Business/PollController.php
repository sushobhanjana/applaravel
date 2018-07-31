<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\MCompany;
use App\Models\MPoll;
use App\Models\MOption;
use App\Models\MPollanswer;
use Lang;
use Redirect;

class PollController extends Controller
{
    public function new_poll(Request $request){
		$data['mnuactive']="dashboard";
        $company_id=$request->session()->get('company_id');
        $data['poll']=MPoll::where('business_fk_id',$company_id)->get()->toArray();
        return view('business.poll_genarate')->withData($data);
	}
    public function save_poll(Request $request){
    	$options = $request->option;
    	$valid = date('Y-m-d', strtotime($request->validity));
		$status = MPoll::insertGetId(['business_fk_id'=>$request->session()->get('company_id'), 
								'poll_title'=>$request->question_title,
								'valid_through'=>$valid,
								'status'=>'Y'
		]);
        foreach($options as $opt)
        {
            MOption::insert(array('option_value'=>$opt,'fk_poll_id'=>$status,'created_date'=>date('Y-m-d')));
        }
        
		if($status){
			$msg = Lang::get('language_business.success_msg');
			return Redirect::to('new_poll')->with('success', $msg);
		}
		else{
			$msg = Lang::get('language_business.error_msg');
			return Redirect::to('new_poll')->with('error', $msg);
		}
	}
	public function updatepollform(Request $request){
		$options = $request->option;
		$option_id=$request->option_id;
    	$valid = date('Y-m-d', strtotime($request->validity));
		$status = MPoll::where('business_fk_id',$request->session()->get('company_id'))->update([
								'poll_title'=>$request->question_title,
								'valid_through'=>$valid
		]);
		$r=0;
        foreach($options as $opt)
        {
        	if($option_id[$r] > 0)
        	{
        		MOption::where('id',$option_id[$r])->update(array('option_value'=>$opt));
        	}
        	else
        	{
        		MOption::insert(array('option_value'=>$opt,'fk_poll_id'=>$request->poll_id,'created_date'=>date('Y-m-d')));
        	}
            
            $r++;
        }
        
		$msg = Lang::get('language_business.success_update_msg');
		return Redirect::to('new_poll')->with('success', $msg);
		
		
	}
    public static function get_option($poll_id){
        $data=MOption::where('fk_poll_id',$poll_id)->get()->toArray();
        return $data;
    }
    public function poll_status(Request $request){
    	$status=$request->status;
    	$id=$request->id;
    	$result=MPoll::where('id',$id)->update(array('status'=>$status));
    	if($result)
    		$array=array('error'=>0,'msg'=>Lang::get('language_business.status_change_successful'));
    	else
    		$array=array('error'=>1,'msg'=>Lang::get('language_business.error'));
    	return $array;
    }
    public function delete_poll_option(Request $request){
    	$id=$request->id;
    	$result=MOption::where('id',$id)->delete();
    	if($result)
    		$array=array('error'=>0,'msg'=>Lang::get('language_business.delete_success'));
    	else
    		$array=array('error'=>1,'msg'=>Lang::get('language_business.error'));
    	return $array;
    }
    public static function total_poll_vote($id)
    {
    	$get=MOption::where('fk_poll_id',$id)->get()->toArray();
    	$flag=0;
    	foreach($get as $option)
    	{
    		$total=MPollanswer::where('fk_option_id',$option['id'])->count();
    		$flag+=$total;
    	}
    	return $flag;
    }
    public static function poll_vote($id)
    {
    	$total=MPollanswer::where('fk_option_id',$id)->count();
    	return $total;
    }
}
