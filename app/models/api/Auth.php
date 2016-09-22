<?php
namespace App\models\api;
use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{

	public $table = "people";

	protected $fillable = ['id','first_name', 'last_name', 'gender', 'height', 'age', 'weight', 'lifeStyle', 'facebook_id', 'email', 'token'];

	static $rules = array(

		'first_name'=>'required',
		'last_name'=>'required',
		'gender'=>'required',
		'height'=>'required',
		'age'=>'required',
		'weight'=>'required',
		'lifeStyle'=>'required',

	);

}
