<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{

public $table = "history";

protected $fillable = ['id','people_id', 'food_id'];

public static $rules = array(

		'people_id'=>'required',
		'food_id'=>'required',

	);

}
