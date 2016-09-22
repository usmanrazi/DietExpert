<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{

public $table = "cuisine";

protected $fillable = ['id','cuisine_name'];

public static $rules = array(

		'cuisine_name'=>'required',

	);

}
