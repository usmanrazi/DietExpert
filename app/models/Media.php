<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

public $table = "media";

protected $fillable = ['id','food_id', 'media'];

public static $rules = array(

		'food_id'=>'required',
		'media'=>'required',

	);

}
