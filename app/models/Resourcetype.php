<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Resourcetype extends Model
{

public $table = "resource_type";

protected $fillable = ['id', 'resource_type', 'resourcetype_id', 'resourcetype_taste', 'created_at'];

public static $rules = array(


		'resource_type'=>'required',
		'resourcetype_id'=>'required',
		'resourcetype_taste'=>'required',

	);

}
