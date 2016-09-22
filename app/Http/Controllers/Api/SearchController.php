<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\models\Taste;
use App\models\People;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;
use Carbon;
use App\models\Food;
use App\models\Cuisine;
use App\models\Course;
use App\models\Events;
use App\models\Ingrediants;
use App\models\Media;
use App\models\Dietoption;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
		$input=$request->all();
		
		$verify_key = Helper::apiKeyVerify($input['api_key'], $input['token']);
		if( $verify_key->status() == 401 ){ 
			return $verify_key;
		}
		
		$people = People::where('token', '=', $input['token'])->firstOrFail();
		$people_id  = $people['id'];
		
		//cal per week
		$calories_per_week = $this->calories_per_week($people['height'], $people['dob'], $people['weight'], $people['gender']);
		
		//user consume
		$people_cal = DB::table('history')->join('food', 'history.food_id', '=', 'food.id')->select('history.*',  'food.food_name', 'food.calories')->where('people_id', '=', $people_id)
						->whereBetween('history.created_at', [
							Carbon\Carbon::parse('last monday')->startOfDay(),
							Carbon\Carbon::parse('next sunday')->endOfDay(),
						])->get();
		
		
		$total_consume_cal = 0;
		if($people_cal){
			foreach($people_cal as $cal_peo){
				$total_consume_cal = $total_consume_cal + $cal_peo->calories;
			}
		}
		
		//remaining calories
		$remain_cal_per_week = 0;
		if( $total_consume_cal < $calories_per_week ){
			//remaining calories
			$remain_cal_per_week = $calories_per_week - $total_consume_cal;
		}else{
			//return Response::json(array("message"=>"You Consume More calories this week"),200);
		}
		
		//remaining_days in week
		$now = strtotime(date('Y-m-d')); // or your date as well
		$your_date = strtotime('next Sunday');
		$datediff = abs($now - $your_date);
		$remaining_days = floor($datediff/(60*60*24) + 1);
		
		//remaining calories for per day
		$remaining_cal_per_day = 0;
		if($remain_cal_per_week != 0){
			$remaining_cal_per_day = $remain_cal_per_week / $remaining_days;
		}else{
			$remaining_cal_per_day = $calories_per_week / $remaining_days;
		}
		
		$remaining_cal_per_day = round( round($remaining_cal_per_day) / 3 );
		
		//return $calories_per_week.'--'.$total_consume_cal.'--'.$remain_cal_per_week.'--'.$remaining_days.'--'.$remaining_cal_per_day;
		
		$food_query = "table('food')->select('*')";
		$diet_option = $people['diet_option'];
		
		if($input['event'] != '-1' ){
			$events = DB::table('events')->select('id')->where('event_name', '=', $input['event'])->get();
			//$event = $events->id;
			foreach($events as $evnt){
				$event = $evnt->id;
			}
		}else{
			$event = 1;
		}
		
		$cal_threshold = 100;
		
		$peop_ingr = array();
		$ingrediants_people = DB::table('container')->select('ingrediant_id')->where('people_id', '=', $people_id)->orderBy('ingrediant_id', 'DESC')->get();
		foreach($ingrediants_people as $ingr_peop){
			$peop_ingr[] = $ingr_peop->ingrediant_id;
		}
		
		$peop_taste = array();
		$tastes_people = DB::table('resource_type')->select('resourcetype_taste')->where('resourcetype_id', '=', $people_id)->where('resource_type', '=', 'people')->orderBy('resourcetype_taste', 'DESC')->get();
		foreach($tastes_people as $tast_peop){
			$peop_taste[] = $tast_peop->resourcetype_taste;
		}
	
		$allergies_exist = DB::table('people_allergies')->select('*')->where('people_id', '=', $people_id)->get();
		if($allergies_exist){
				if($input['course'] != '-1' && $input['cuisine'] != '-1'){
					$foods = DB::table('food')->select('food.id', 'food.food_name', 'food.diet_option', 'food.calories', 'food.ingrediants')
					->join('food_allergies', 'food.id', '=', 'food_allergies.food_id')
					->join('allergies', 'food_allergies.allergy_id', '=', 'allergies.id')
					->join('people_allergies', 'allergies.id', '=', 'people_allergies.allergy_id')
					->where('food.diet_option', '=', $diet_option)
					->where('food.event_id', '=', $event)
					->where('food.course_id', '=', $input['course'])
					->where('food.cuisine_id', '=', $input['cuisine'])
					->whereBetween('food.calories', [$remaining_cal_per_day-$cal_threshold, $remaining_cal_per_day+$cal_threshold])
					->groupBy('food.id')->get();
					
				}else if ( $input['course'] != '-1' && $input['cuisine'] == '-1'){
					
					$foods = DB::table('food')->select('food.id', 'food.food_name', 'food.diet_option', 'food.calories', 'food.ingrediants')
					->join('food_allergies', 'food.id', '=', 'food_allergies.food_id')
					->join('allergies', 'food_allergies.allergy_id', '=', 'allergies.id')
					->join('people_allergies', 'allergies.id', '=', 'people_allergies.allergy_id')
					->where('food.diet_option', '=', $diet_option)
					->where('food.event_id', '=', $event)
					->where('food.course_id', '=', $input['course'])
					->whereBetween('food.calories', [$remaining_cal_per_day-$cal_threshold, $remaining_cal_per_day+$cal_threshold])
					->groupBy('food.id')->get();
					
				}else if($input['course'] == '-1' && $input['cuisine'] != '-1'){
					
					$foods = DB::table('food')->select('food.id', 'food.food_name', 'food.diet_option', 'food.calories', 'food.ingrediants')
					->join('food_allergies', 'food.id', '=', 'food_allergies.food_id')
					->join('allergies', 'food_allergies.allergy_id', '=', 'allergies.id')
					->join('people_allergies', 'allergies.id', '=', 'people_allergies.allergy_id')
					->where('food.diet_option', '=', $diet_option)
					->where('food.event_id', '=', $event)
					->where('food.course_id', '=', $input['course'])
					->whereBetween('food.calories', [$remaining_cal_per_day-$cal_threshold, $remaining_cal_per_day+$cal_threshold])
					->groupBy('food.id')->get();
					
				}else{
				
					$foods = DB::table('food')->select('food.id', 'food.food_name', 'food.diet_option', 'food.calories', 'food.ingrediants')
					->join('food_allergies', 'food.id', '=', 'food_allergies.food_id')
					->join('allergies', 'food_allergies.allergy_id', '=', 'allergies.id')
					->join('people_allergies', 'allergies.id', '=', 'people_allergies.allergy_id')
					->where('food.diet_option', '=', $diet_option)
					->where('food.event_id', '=', $event)
					->whereBetween('food.calories', [$remaining_cal_per_day-$cal_threshold, $remaining_cal_per_day+$cal_threshold])
					->groupBy('food.id')->get();
				
				}
		}else{
			
			if($input['course'] != '-1' && $input['cuisine'] != '-1'){
				$foods = DB::table('food')->select('food.id', 'food.food_name', 'food.diet_option', 'food.calories', 'food.ingrediants')
				->where('food.diet_option', '=', $diet_option)
				->where('food.event_id', '=', $event)
				->where('food.course_id', '=', $input['course'])
				->where('food.cuisine_id', '=', $input['cuisine'])
				->whereBetween('food.calories', [$remaining_cal_per_day-$cal_threshold, $remaining_cal_per_day+$cal_threshold])
				->groupBy('food.id')->get();
			
			}else if ( $input['course'] != '-1' && $input['cuisine'] == '-1'){
				
				$foods = DB::table('food')->select('food.id', 'food.food_name', 'food.diet_option', 'food.calories', 'food.ingrediants')
				->where('food.diet_option', '=', $diet_option)
				->where('food.event_id', '=', $event)
				->where('food.course_id', '=', $input['course'])
				->whereBetween('food.calories', [$remaining_cal_per_day-$cal_threshold, $remaining_cal_per_day+$cal_threshold])
				->groupBy('food.id')->get();
				
			}else if($input['course'] == '-1' && $input['cuisine'] != '-1'){
				
				$foods = DB::table('food')->select('food.id', 'food.food_name', 'food.diet_option', 'food.calories', 'food.ingrediants')
				->where('food.diet_option', '=', $diet_option)
				->where('food.event_id', '=', $event)
				->where('food.cuisine_id', '=', $input['cuisine'])
				->whereBetween('food.calories', [$remaining_cal_per_day-$cal_threshold, $remaining_cal_per_day+$cal_threshold])
				->groupBy('food.id')->get();
				
			}else{
				$foods = DB::table('food')->select('food.id', 'food.food_name', 'food.diet_option', 'food.calories', 'food.ingrediants')
				->where('food.diet_option', '=', $diet_option)
				->where('food.event_id', '=', $event)
				->whereBetween('food.calories', [$remaining_cal_per_day-$cal_threshold, $remaining_cal_per_day+$cal_threshold])
				->groupBy('food.id')->get();
			}
			
			
		}
			
		$foods = DB::table('food')->select('food.id', 'food.food_name', 'food.diet_option', 'food.calories', 'food.ingrediants')
		->join('food_allergies', 'food.id', '=', 'food_allergies.food_id')
		->join('allergies', 'food_allergies.allergy_id', '=', 'allergies.id')
		->join('people_allergies', 'allergies.id', '=', 'people_allergies.allergy_id')
		->where('food.diet_option', '=', $diet_option)
		->where('food.event_id', '=', $event)
		->groupBy('food.id')->get(); 
		//->whereBetween('food.calories', [$remaining_cal_per_day-$cal_threshold, $remaining_cal_per_day+$cal_threshold])
		
		//return $foods;
		
		$food_halal = array();
		if($input['halal'] == 'yes'){
			foreach( $foods as $fd){
				$ingrediants = explode(",", $fd->ingrediants);
				$no_ingre = count($ingrediants);
				$i = 0;
				foreach($ingrediants as $ingre){
					$ingrediants_halal = DB::table('ingrediants')->select('*')->where('id', '=', $ingre)->where('halal', '=', 'yes')->get();
					if($ingrediants_halal){
						$i++;
					}
				}
				if($no_ingre == $i){
					$food_halal[] = $fd;
				}
			}
		}else{
			foreach( $foods as $fd){
				$ingrediants = explode(",", $fd->ingrediants);
				$no_ingre = count($ingrediants);
				$i = 0;
				foreach($ingrediants as $ingre){
					$ingrediants_halal = DB::table('ingrediants')->select('*')->where('id', '=', $ingre)->where('halal', '=', 'no')->get();
					if($ingrediants_halal){
						$i++;
					}
				}
				if($i > 0){
					$food_halal[] = $fd;
				}
			}
		}
		
		//return $food_halal;
		
		$ing_match_food = array();
		$i =0;
		if( $peop_ingr ){
			foreach( $foods as $fd){
				$ingrediants = explode(",", $fd->ingrediants);
				$result = array_intersect($peop_ingr, $ingrediants );
				
				if(count($result) != 0){
					$ing_match_food[$i]['id'] = $fd->id;
					$ing_match_food[$i]['match_ingr'] = count($result);
					$i++;
				}
			}
			$sorted_ingred_food = $this->array_sort_by_column($ing_match_food, 'match_ingr');
		}else{
				//return "test";
			$sorted_ingred_food = $foods;
		}

		
		/* $array = array_values(array_sort($ing_match_food, function($value)
		{
			return $value['match_ingr'];
		})); */
		
			$final_food_array = array();
			//return $peop_taste;
			//return $sorted_ingred_food;
			if($peop_taste){
				foreach($sorted_ingred_food as $match_taste ){
				$tastes_food = DB::table('resource_type')->select('resourcetype_taste')->where('resourcetype_id', '=', $match_taste['id'])->where('resource_type', '=', 'food')->orderBy('resourcetype_taste', 'DESC')->get();
				//return $tastes_food;
				
					foreach($tastes_food as $food_taste){
						
						if (in_array($food_taste->resourcetype_taste, $peop_taste)) {
							if(!in_array($match_taste['id'], $final_food_array)){
								$final_food_array[]['id'] = $match_taste['id'];
							}
							
						}
						
					}
				}
			}else{
				$final_food_array = $sorted_ingred_food;
			}
			
		
		//return $final_food_array;
		
		$foods_final = array();
		foreach($final_food_array as $f_food){
			$foods_final[] =  Food::findOrFail($f_food['id']);
		}
		//return $foods_final;
		//$foods=Food::latest()->get();
		foreach( $foods_final as $food ){
			
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
		return Response::json($foods_final);
		//return Response::json($total_consume_cal);
    }
	
	public function calories_per_week($height, $dob, $weight, $gender){
		$dob =  floor((time() - strtotime($dob)) / 31556926);
		//per week calories
		//Men: BMR=66.47+ (13.75 x W) + (5.0 x H) - (6.75 x A)
		//Women: BMR=665.09 + (9.56 x W) + (1.84 x H) - (4.67 x A)
		$height = 30.48 * $height;
		if( $gender == "male" ){
			$cal_total_per_week = 66.47 + (13.75 * $weight) + (5.0 * $height) - (6.75 * $dob);
		}else{
			$cal_total_per_week =  665.09 + (9.56 * $weight) + (1.84 * $height) - (4.67 * $dob);
		}
		$cal_total_per_week = $cal_total_per_week * 7;
		return round($cal_total_per_week);
	}
	
	public function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
		$sort_col = array();
		foreach ($arr as $key => $row) {
			$sort_col[$key] = $row[$col];
		}

		array_multisort($sort_col, $dir, $arr);
		return $arr;
	}

}
