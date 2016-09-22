<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\models\Food;
use App\models\Cuisine;
use App\models\Course;
use App\models\Events;
use App\models\Ingrediants;
use App\models\Dietoption;
use App\models\Media;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;
	
class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    //public function index()
    {
		$input=$request->all();

		$verify_key = Helper::apiKeyVerify($input['api_key'], $input['token']);
		if( $verify_key->status() == 401 ){ 
			return $verify_key;
		}
		
		$foods=DB::table('food')->get();
		foreach( $foods as $food ){
			
			$cuisine =  Cuisine::findOrFail($food->cuisine_id);
			$course =  Course::findOrFail($food->course_id);
			$event =  Events::findOrFail($food->event_id);
			$diet_option =  Dietoption::findOrFail($food->diet_option);
			
			$media = DB::table('media')->where('food_id', '=', $food->id)->get();
			foreach($media as $med){
				$media_pic = "http://dietexpert.bitbytez.net/uploads/media/" . $med->media;
				$med->media = $media_pic;
			}
			
			
			$ingrediants = array();
			$ingr_ids = explode(',', $food->ingrediants);
			
			foreach( $ingr_ids as $id ){
				$ingrediant =  Ingrediants::findOrFail($id);
				$path = "http://dietexpert.bitbytez.net/uploads/ingrediant/" . $ingrediant['ingrediant_picture'];
				$ingrediant['ingrediant_picture'] = $path;
				$ingrediants[] = $ingrediant;
			}
			
			$food->cuisine_id = $cuisine;
			$food->course_id  = $course;
			$food->event_id   = $event;
			$food->ingrediants   = $ingrediants;
			$food->diet_option   = $diet_option;
			$food->media   = $media;
			/* echo "<pre>";
			echo Response::json($food);
			echo "</pre>";
			die; */
		}
		return Response::json($foods);
    }

}
