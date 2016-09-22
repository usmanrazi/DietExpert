<?php
	namespace App\Helpers;
	use Response;
	use App\models\People;
	
    class Helper
    {
		public static function apiKeyVerify($api_key, $token){
			$SECRET_API_KEY = 'DIETEXPERT786';
			
			if( $SECRET_API_KEY != $api_key ){
				return Response::json(array("status"=>false,"message"=>"Api Key not valid"),401);
			}
			$people_count = People::where('token', '=', $token)->count();

			if( $people_count < 1 ){
				return Response::json(array("status"=>false,"message"=>"Token not valid"),401);
			}
			return Response::json(array("status"=>true,"message"=>"Valid key and token"),200);
		}
		
		public static function tokengenrator($facebook_id, $api_key){
			return bcrypt("dietexpert"+$facebook_id+$api_key);
		}
		
		public static function apiKeyVerify_people($api_key){
			$SECRET_API_KEY = 'DIETEXPERT786';
			
			if( $SECRET_API_KEY != $api_key ){
				return false;
			}else{
				return true;
			}
		}
	}

?>