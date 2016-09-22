<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

public $table = "course";

protected $fillable = ['id','course_name'];

public static $rules = array(

		'course_name'=>'required',

	);

}
