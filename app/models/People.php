<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{

public $table = "people";

protected $fillable = ['id','first_name', 'last_name', 'gender', 'height', 'dob', 'weight', 'lifeStyle', 'facebook_id', 'email', 'token'];

public static $rules = array(

		'first_name'=>'required',
		'last_name'=>'required',
		'gender'=>'required',
		'height'=>'required',
		'dob'=>'required',
		'weight'=>'required',
		'lifeStyle'=>'required',
		'facebook_id'=>'required',
		'email'=>'required',
		'token'=>'required',

	);

}
