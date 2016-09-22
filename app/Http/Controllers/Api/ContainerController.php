<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\models\Container;
use  App\Helpers\Helper;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function containers(Request $request)
    {
		$input=$request->all();
		
		$verify_key = Helper::apiKeyVerify($input['api_key'], $input['token']);
		if( $verify_key->status() == 401 ){ 
			return $verify_key;
		}
		
        $container=Container::latest()->get();
	    return Response::json($container);
    }
	
	public function ingrediants(Request $request){
		$input=$request->all();
		
		$verify_key = Helper::apiKeyVerify($input['api_key'], $input['token']);
		if( $verify_key->status() == 401 ){ 
			return $verify_key;
		}
		
		$ingre=Container::create($input);
		$result = $ingre->save();
		if($result){
			return Response::json(array("message"=>"Container Ingrediant added Sucessfully"),200);
		}else{
			return Response::json(array("message"=>"Try Again!"),401);
		}
	}

}
