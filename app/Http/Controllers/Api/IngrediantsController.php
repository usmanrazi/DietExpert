<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\models\Ingrediants;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;
use App\models\Course;
	
class IngrediantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ingrediants(Request $request)
    {
		$input=$request->all();
		$api_key = $input['api_key'];
		
		
		$verify_key = Helper::apiKeyVerify_people($api_key);
		
		if( !$verify_key ){
			return Response::json(array("message"=>"Api Key not valid"),401);
		}
		
		$pant_inger = DB::table('ingrediants')->select('*')->where('container', '=', 'pantry')->get();
		$diet_option = DB::table('diet_option')->select('*')->get();
		foreach ( $pant_inger as $ingre_p ){
			$ingre_p->ingrediant_picture = "http://dietexpert.bitbytez.net/uploads/ingrediant/" . $ingre_p->ingrediant_picture;
		}
		
		$refr_inger = DB::table('ingrediants')->select('*')->where('container', '=', 'refrigerator')->get();
		foreach ( $refr_inger as $ingre_ref ){
			$ingre_ref->ingrediant_picture = "http://dietexpert.bitbytez.net/uploads/ingrediant/" . $ingre_ref->ingrediant_picture;
		}
		
		$course=DB::table('course')->select('*')->get();
		$cuisine=DB::table('cuisine')->select('*')->get();
		
		$ingrediants = array();
		$ingrediants['ingrediants_pantry'] 			= $pant_inger;
		$ingrediants['ingrediants_refrigerator'] 	= $refr_inger;
		$ingrediants['diet_option'] 	= $diet_option;
		$ingrediants['course'] 	= $course;
		$ingrediants['cuisine'] 	= $cuisine;
		//$ingrediant=Ingrediants::latest()->get();
		
		return Response::json($ingrediants, 200);
    }

}
