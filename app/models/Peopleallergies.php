<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Peopleallergies extends Model
{

public $table = "people_allergies";

protected $fillable = ['id', 'allergy_id', 'people_id', 'created_at'];

public static $rules = array(


		'allergy_id'=>'required',
		'people_id'=>'required',
	
	);

}
