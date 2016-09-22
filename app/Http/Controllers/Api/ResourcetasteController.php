<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\models\Resourcetaste;
use App\models\People;

class ResourcetasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resources(Request $request)
    {
		$input=$request->all();
		$verify_key = Helper::apiKeyVerify($input['api_key'], $input['token']);
		if( $verify_key->status() == 401 ){ 
			return $verify_key;
		}
		
		if( $input['resource_type'] == 'people' ){
			$people_old = People::where('token', '=', $input['token'])->firstOrFail();
			$people_id		    = $people_old['id'];
		
			$input['resourcetype_id'] = $people_id;
		}
		
		$Resourcetaste=Resourcetaste::create($input);
		$res = $Resourcetaste->save();
		
		if( $res ){
			return Response::json(array("message"=>"Resource created Sucessfully"),200);
		}
	    else{
			return Response::json(array("message"=>"Try Again!"),401);
		}
    }

}
