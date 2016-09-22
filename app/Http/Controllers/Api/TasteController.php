<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\models\Taste;

class TasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function alltaste(Request $request)
    {
		$input=$request->all();
		$api_key = $input['api_key'];
		
		$verify_key = Helper::apiKeyVerify_people($api_key);
		
		if( !$verify_key ){
			return Response::json(array("message"=>"Api Key not valid"),401);
		}
		
      $taste=Taste::latest()->get();
	  return Response::json($taste);
    }

}
