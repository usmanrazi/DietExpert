<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{

public $table = "container";

protected $fillable = ['container_id','container_name', 'ingrediant_id', 'quantity', 'expiry_date', 'people_id'];

public static $rules = array(

		'container_name'=>'required',
		'ingrediant_id'=>'required',
		'quantity'=>'required',
		'expiry_date'=>'required',
		'people_id'=>'required',

	);

}
