<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Foodallergy extends Model
{

public $table = "food_allergies";

protected $fillable = ['id', 'food_id', 'allergy_id', 'created_at'];

public static $rules = array(


		'food_id'=>'required',
		'allergy_id'=>'required',
	);

}
