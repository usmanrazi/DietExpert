<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\models\api\Auth;
use  App\Helpers\Helper;

class AuthController extends Controller
{
		
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    
    public function index()
    {
      
	  return 'test';
    } */
	
	public function userauthentication(Request $request){
		$input=$request->all();
		$api_key = $input['api_key'];
		
		$verify_key = Helper::apiKeyVerify_people($api_key);
		
		if( !$verify_key ){
			return Response::json(array("message"=>"Api Key not valid"),401);
		}
		$facebook_id = $input['facebook_id'];
		
		if (Auth::where('facebook_id', '=', $facebook_id)->exists()){ 
			
			$user = Auth::where('facebook_id', '=', $facebook_id)->firstOrFail();
			$user_token		    = $user['token'];
			
			$update = $user->update($input);
			
		    return Response::json(array("message"=>"User already exist", "token"=>$user_token ),200);
		}else{
			
			$token = Helper::tokengenrator($facebook_id, $api_key);
		
			$input['token'] = $token;
			
			$user=Auth::create($input);
			$user->save();
			
			return Response::json(array("message"=>"User added Successfully", "token"=>$token),200);
		}
		
	}


}
