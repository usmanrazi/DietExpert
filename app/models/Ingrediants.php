<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Ingrediants extends Model
{

public $table = "ingrediants";

protected $fillable = ['id','ingrediant_name', 'container' ,'halal', 'ingrediant_picture', 'created_at'];

public static $rules = array(

		'ingrediant_name'=>'required',
		'container'=>'required'
		

	);

}
