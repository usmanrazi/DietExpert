<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

public $table = "food";

protected $fillable = ['id','food_name', 'cuisine_id', 'vegetarian', 'course_id', 'event_id', 'effort', 'calories', 'fat', 'cholestrol', 'sodium', 'carbohydrate', 'protein', 'calcium', 'vitamin_A', 'fiber', 'ingrediants', 'diet_option', 'preparation' ];

public static $rules = array(

		'food_name'=>'required',
		'effort'=>'required',
		'calories'=>'required',
		'fat'=>'required',
		'cholestrol'=>'required',
		'sodium'=>'required',
		'carbohydrate'=>'required',
		'protein'=>'required',
		'calcium'=>'required',
		'fiber'=>'required',
		'calcium'=>'required',
		'ingrediants'=>'required',
		'diet_option'=>'required',
		'preparation'=>'required',

	);

}
