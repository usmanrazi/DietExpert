<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Allergies extends Model
{

public $table = "allergies";

protected $fillable = ['id','allergy_name'];

public static $rules = array(

		'allergy_name'=>'required',

	);

}
