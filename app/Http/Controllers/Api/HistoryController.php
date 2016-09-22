<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\models\History;
use App\models\People;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;
use App\models\Food;
use App\models\Cuisine;
use App\models\Course;
use App\models\Events;
use App\models\Ingrediants;
use App\models\Dietoption;
use App\models\Media;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gethistory(Request $request)
    {
		$input=$request->all();

		$verify_key = Helper::apiKeyVerify($input['api_key'], $input['token']);
		if( $verify_key->status() == 401 ){ 
			return $verify_key;
		}
		
		$people_old = People::where('token', '=', $input['token'])->firstOrFail();
		$id		    = $people_old['id'];
		
		$history = DB::table('history')->join('food', 'history.food_id', '=', 'food.id')->select('history.id as history_id',  'food.*', 'history.created_at as history_created_at')->where('people_id', '=', $id)->orderBy('history.id', 'desc')->get();
		
		foreach( $history as $hist ){
			$cuisine =  Cuisine::findOrFail($hist->cuisine_id);
			$course =  Course::findOrFail($hist->course_id);
			$event =  Events::findOrFail($hist->event_id);
			$diet_option =  Dietoption::findOrFail($hist->diet_option);
			
			$media = DB::table('media')->where('food_id', '=', $hist->id)->get();
			foreach($media as $med){
				$media_pic = "http://dietexpert.bitbytez.net/uploads/media/" . $med->media;
				$med->media = $media_pic;
			}
			
			$ingrediants = array();
			$ingr_ids = explode(',', $hist->ingrediants);
			
			foreach( $ingr_ids as $id ){
				$ingrediant =  Ingrediants::findOrFail($id);
				$path = "http://dietexpert.bitbytez.net/uploads/ingrediant/" . $ingrediant['ingrediant_picture'];
				$ingrediant['ingrediant_picture'] = $path;
				$ingrediants[] = $ingrediant;
			}
			
			$hist->cuisine_id 	= $cuisine;
			$hist->course_id  	= $course;
			$hist->event_id   	= $event;
			$hist->ingrediants  = $ingrediants;
			$hist->diet_option   = $diet_option;
			$hist->media   = $media;
			
		}
		//$history=DB::table('history')->where('people_id', '=', $id)->get();
		return Response::json($history, 200);
    }
	
	public function addhistory(Request $request)
    {
		$input=$request->all();

		$verify_key = Helper::apiKeyVerify($input['api_key'], $input['token']);
		if( $verify_key->status() == 401 ){ 
			return $verify_key;
		}
		
		$people_old = People::where('token', '=', $input['token'])->firstOrFail();
		$id		    = $people_old['id'];
		
		$hist = array();
		$hist['people_id'] = $id;
		$hist['food_id'] = $input['food_id'];
		
		$history_exist = DB::table('history')->select('*')->where('food_id', '=', $input['food_id'])->where('people_id', '=', $id)->whereDate('created_at', '=', date('Y-m-d'))->get();
		if( $history_exist ){
			return Response::json(array("message"=>"Already Cooked!"),401);
		}
		
		$history=History::create($hist);
		$res = $history->save();
		
		if( $res ){
			return Response::json(array("message"=>"History added Sucessfully"),200);
		}
	    else{
			return Response::json(array("message"=>"Try Again!"),401);
		}
	}
	

}
