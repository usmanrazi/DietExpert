<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{

public $table = "events";

protected $fillable = ['id','event_name'];

public static $rules = array(

		'event_name'=>'required',

	);

}
