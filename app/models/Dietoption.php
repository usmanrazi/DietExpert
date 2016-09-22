<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Dietoption extends Model
{

public $table = "diet_option";

protected $fillable = ['id','dietoption_name'];

public static $rules = array(

		'dietoption_name'=>'required',

	);

}
