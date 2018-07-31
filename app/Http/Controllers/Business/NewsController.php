<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\MNews;
use Lang;
use Redirect;
use Crypt;

class NewsController extends Controller
{
    public function newspost(){
		$data['mnuactive']="dashboard";
		$data['news'] = MNews::orderBy('news_date', 'desc')->get()->toArray();
        return view('business.news_post_page')->withData($data);
	}
	public function save_news(Request $request){
		$filename = '';
		$dir = '';
		$validity = NULL;
		if($request->validity != ''){
			$validity = date('Y-m-d', strtotime($request->validity));
		}
		if($request->hasFile('post_photo')){
			$file=$request->file('post_photo');
		    $allowed =  array('jpeg','png','jpg');
		    if(!in_array($file->getClientOriginalExtension(), $allowed) ) {
				return back()->with('error', Lang::get('language_business.file_ext_error'));
			}
			else{
				$dir = 'storage/app/public/business/news/';
				$filepath = storage_path('app/public/business/news/');
			    $filename = md5(time()).'.'.$file->getClientOriginalExtension();
			    $file->move($filepath, $filename);
			}
		}
		$insert = MNews::insert([
					'business_fk_id' => $request->session()->get('company_id'),
					'filename' => $filename,
					'filepath' => $dir,
					'headline' => addslashes($request->headline),
					'description' => addslashes($request->describe),
					'news_date' => date('Y-m-d H:i:s'),
					'validity_date' => $validity
		]);
		if($insert){
			return back()->with('success', Lang::get('language_business.success_msg'));
		}
		else{
			return back()->with('error', Lang::get('language_business.error_msg'));
		}
	}
	public function newsread(Request $request){
		$id = Crypt::decrypt($request->s);
		$data['mnuactive']="dashboard";
		$data['news'] = MNews::where('id', $id)->get()->toArray();
		if(sizeof($data['news']) > 0){
			return view('business.read_news')->withData($data);
		}
		else{
			return back();
		}
	}
	public function deletenews(Request $request){
		$id = Crypt::decrypt($request->d);
		$delete = MNews::where('id', $id)->delete();
		if($delete){
			return back()->with('success', Lang::get('language_business.delete_success'));
		}
		else{
			return back()->with('error', Lang::get('language_business.error_msg'));
		}
	}
}
