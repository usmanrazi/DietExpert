<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Mealtime extends Model
{

public $table = "meal_time";

protected $fillable = ['id','mealtime_name'];

public static $rules = array(

		'mealtime_name'=>'required',

	);

}
