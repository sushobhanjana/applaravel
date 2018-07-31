<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App;
use Session;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(Request $request){
    	$cookie = Session::get('lang');
    	$locale = App::getLocale();
    	if($cookie != ""){
			$locale = $cookie;
		}
		
            /*$langFile =file_get_contents(base_path().DIRECTORY_SEPARATOR.
                'resources'.DIRECTORY_SEPARATOR.
                'lang'.DIRECTORY_SEPARATOR.
                $locale. DIRECTORY_SEPARATOR.
                'language.php');
           $langFile = str_replace('<?php','',$langFile);
            $langArray =eval($langFile);
		print_r($langArray);
		die;*/
		App::setLocale($locale);
	}
}
