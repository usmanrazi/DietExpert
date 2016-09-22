<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Taste extends Model
{

public $table = "taste";

protected $fillable = ['id','taste'];

public static $rules = array(

		'taste'=>'required',

	);

}
