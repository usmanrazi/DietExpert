<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\models\Food;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Session,
    Input,
    DB,
    Debugbar,
    File;
class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $food=Food::latest()->get();
      return view('admin.food.index', compact('food'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuisine = DB::table('cuisine')->orderBy('id', 'desc')->lists('cuisine_name','id');
        $course  = DB::table('course')->orderBy('id', 'desc')->lists('course_name','id');
        $events  = DB::table('events')->orderBy('id', 'desc')->lists('event_name','id');
        $ingrediants  = DB::table('ingrediants')->orderBy('id', 'desc')->select('ingrediant_name', 'id')->get();
		$diet_option  = DB::table('diet_option')->orderBy('id', 'desc')->lists('dietoption_name','id');
		
        return view('admin.food.create')->with('cuisine',$cuisine)->with('course',$course)->with('events',$events)->with('ingrediants',$ingrediants)->with('diet_option',$diet_option);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, Food::$rules);

      $input=$request->all();
      //var_dump($input);
      $input['ingrediants'] = implode(',', $input['ingrediants']);
      //var_dump($input);
      //die;
      $container=Food::create($input);
      $container->save();
      return redirect('admin/food');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $cuisine = DB::table('cuisine')->orderBy('id', 'desc')->lists('cuisine_name','id');
      $course  = DB::table('course')->orderBy('id', 'desc')->lists('course_name','id');
      $events  = DB::table('events')->orderBy('id', 'desc')->lists('event_name','id');
      $ingrediants  = DB::table('ingrediants')->orderBy('id', 'desc')->select('ingrediant_name', 'id')->get();
	  $diet_option  = DB::table('diet_option')->orderBy('id', 'desc')->lists('dietoption_name','id');
		
      $food = Food::findOrFail($id);
      $food->ingrediants = explode(",", $food->ingrediants);
      //var_dump($food);
      //die;
      return view('admin.food.edit')->with('food',$food)->with('cuisine',$cuisine)->with('course',$course)->with('events',$events)->with('ingrediants',$ingrediants)->with('diet_option',$diet_option);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, Food::$rules);
      $container=Food::findOrFail($id);
      $input=$request->all();
      $input['ingrediants'] = implode(',', $input['ingrediants']);
      /* var_dump($input);
      die; */
      $container->update($input);

      return redirect('admin/food');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $food = Food::findOrFail($id);

      if ($food) {
          $food->delete();
          Session::flash('flash_message', 'Food successfully deleted!');
      }
      return redirect()->back();
    }
    public function datatable() {

        return Datatables::of(Food::select('id','food_name','vegetarian','created_at'))
                        ->addColumn('check', '<input type="checkbox" class="checkboxes" name="ids[]" value="{{ $id }}" />', 0)
                        ->addColumn('actions', '<a class="btn btn-small btn-info" href="{{ URL::route(\'admin.food.edit\',["id"=>$id]) }}"><span class="glyphicon glyphicon-pencil"></a>
                                {!! Form::open(["method" => "DELETE","route" => ["admin.food.destroy", $id],"class" => "inline deleteaction"]) !!}<button class="btn btn-danger btn-small"><span class="glyphicon glyphicon-trash"></button>{!! Form::close() !!}', 2)
                        ->make(true);
    }
}
