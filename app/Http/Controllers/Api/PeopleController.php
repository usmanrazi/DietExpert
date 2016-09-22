<?php

namespace App\Http\Controllers\Api;
use  App\Helpers\Helper;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\models\People;
use App\models\Peopleallergies;
use App\models\Resourcetype;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;
use App\models\Container;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    //public function index()
    {
		$input=$request->all();

		$verify_key = Helper::apiKeyVerify($input['api_key'], $input['token']);
		if( $verify_key->status() == 401 ){
			return $verify_key;
		}

		$people_old = People::where('token', '=', $input['token'])->firstOrFail();
		$id		    = $people_old['id'];
		$people_old['dob'] = date("Y-m-d", $people_old['dob']);
		$people_old['age'] =  floor((time() - strtotime($people_old['dob'])) / 31556926);


		$allergy = DB::table('people_allergies')->join('allergies', 'people_allergies.allergy_id', '=', 'allergies.id')->select('allergies.id', 'allergies.allergy_name')->where('people_id', '=', $id)->get();
		$people_old['allergies'] = $allergy;
		$taste = DB::table('resource_type')->join('taste', 'resource_type.resourcetype_taste', '=', 'taste.id')->select('taste.id', 'taste.taste' )->where('resourcetype_id', '=', $id)->where('resource_type', '=', 'people')->get();
		$people_old['taste'] = $taste;

		$ingrediants_pantry = DB::table('container')->join('ingrediants', 'container.ingrediant_id', '=', 'ingrediants.id')
		->select('container.id as container_id', 'container.container_name as container', 'container.quantity', 'container.expiry_date' ,'ingrediants.id as id', 'ingrediants.ingrediant_name', 'ingrediants.halal', 'ingrediants.ingrediant_picture')
		->where('people_id', '=', $id)->where('container_name', '=', "pantry")->get();

		$ingrediants_refri = DB::table('container')->join('ingrediants', 'container.ingrediant_id', '=', 'ingrediants.id')
		->select('container.id as container_id', 'container.container_name as container', 'container.quantity', 'container.expiry_date' ,'ingrediants.id as id', 'ingrediants.ingrediant_name', 'ingrediants.halal', 'ingrediants.ingrediant_picture')
		->where('people_id', '=', $id)->where('container_name', '=', "refrigerator")->get();

		foreach($ingrediants_pantry as $ingrediant_pantry ){
			$ingrediant_pantry->expiry_date = date("Y-m-d", $ingrediant_pantry->expiry_date);
			$ingrediant_pantry->ingrediant_picture = "http://dietexpert.bitbytez.net/uploads/ingrediant/" . $ingrediant_pantry->ingrediant_picture;
		}

		foreach($ingrediants_refri as $ingrediant_refri ){
			$ingrediant_refri->expiry_date 			= date("Y-m-d", $ingrediant_refri->expiry_date);
			$ingrediant_refri->ingrediant_picture = "http://dietexpert.bitbytez.net/uploads/ingrediant/" . $ingrediant_refri->ingrediant_picture;
		}
		$people_old['ingrediants_refrigerator'] = $ingrediants_refri;
		$people_old['ingrediants_pantry'] = $ingrediants_pantry;

		$people=People::latest()->get();
		return Response::json($people_old, 200);
    }

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		$input=$request->all();
    $data = json_decode(json_encode($input), true);
	//return Response::json($data['allergies'], 200);

	$allergies = $data['allergies'];
		
    $api_key = $data['api_key'];
    $diet_option = $data['diet_option'];
    $email = $data['email'];
    $first_name = $data['first_name'];
    $gender = $data['gender'];
    $height = $data['height'];
    $ingrediants = $data['ingrediants'];
    $last_name = $data['last_name'];
    $lifestyle = $data['lifestyle'];
    $tastes = $data['tastes'];
    $token = $data['token'];
    $weight = $data['weight'];
	if($data['dob'] != ""){
		$dob = $data['dob'];
	}else{
		$dob = "2000-01-01";
	}
	
    

		$verify_key = Helper::apiKeyVerify($api_key, $token);
		if( $verify_key->status() == 401 ){
			return $verify_key;
		}

		$people_old = People::where('token', '=', $token)->firstOrFail();
		$id		    = $people_old['id'];



		//ingrediants
		DB::table('container')->where('people_id', '=', $id)->delete();
		if( $data['ingrediants'] != 'No' ){
			foreach($ingrediants as $ingredient){
				$ingredient['expiry_date'] = strtotime($ingredient['expiry_date']);
				$ingre=Container::create($ingredient);
				$res_ingre = $ingre->save();
			}
		}

		//allergies
		DB::table('people_allergies')->where('people_id', '=', $id)->delete();

		$alle_input = array();
		if( $data['allergies'] != 'No' ){
			
			$alle_input['people_id'] = $id;
			foreach($allergies as $allergy){
				$alle_input['allergy_id'] = $allergy;
				$allergy_new=Peopleallergies::create($alle_input);
				$res = $allergy_new->save();
			}
		}



		//taste
		DB::table('resource_type')->where('resource_type', '=', 'people')->where('resourcetype_id', '=', $id)->delete();
			
		$taste = array();
		if( $data['tastes'] != 'No' ){
			$taste['resource_type'] = 'people';
			$taste['resourcetype_id'] = $id;

			foreach($tastes as $tp){
				$taste['resourcetype_taste'] = $tp;
				$tst=Resourcetype::create($taste);
				$res_tst = $tst->save();
			}
		}


		$profile = array();
		
		$profile['first_name']	= $first_name;
		$profile['last_name'] 	= $last_name;
		$profile['gender'] 		= $gender;
		$profile['height'] 		= $height;
		$profile['dob'] 		= strtotime($dob);
		$profile['weight'] 		= $weight;
		$profile['lifestyle'] 	= $lifestyle;
		$profile['diet_option'] = $diet_option;
		
		
		$update = $people_old->update($profile);
		if( $update ){
			return Response::json(array("message"=>"Profile Updated Sucessfully"),200);
		}
		else{
			return Response::json(array("message"=>"Try Again!"),401);
		}
    }

	public function allergies(Request $request){
		$input=$request->all();

		$verify_key = Helper::apiKeyVerify($input['api_key'], $input['token']);
		if( $verify_key->status() == 401 ){
			return $verify_key;
		}

		$people_old = People::where('token', '=', $input['token'])->firstOrFail();
		$id		    = $people_old['id'];

	}


}
