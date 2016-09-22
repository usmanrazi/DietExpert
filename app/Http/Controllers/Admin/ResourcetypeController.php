<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\Resourcetype;
use App\models\Food;

use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;
class ResourcetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		/* $data = DB::table('resource_type')
		->join('taste', 'resource_type.resourcetype_taste', '=', 'taste.id')->join('food', 'resource_type.resourcetype_id', '=', 'food.id')
		->select('resource_type.id', 'food.food_name', 'taste.taste')
		->where('resource_type', '=', 'food')
		->get();
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		 die; */
      $resourcetype=Resourcetype::latest()->get();
      return view('admin.resourcetype.index', compact('resourcetype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$food = DB::table('food')->orderBy('id', 'desc')->lists('food_name','id');
		//$taste = DB::table('taste')->orderBy('id', 'desc')->lists('taste','id');
        $taste  = DB::table('taste')->orderBy('id', 'desc')->select('taste', 'id')->get();

		return view('admin.resourcetype.create')->with('food',$food)->with('taste',$taste);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, Resourcetype::$rules);
		$input=$request->all();
		$input_updated = array();
		$input_updated = $input;
		foreach( $input['resourcetype_taste'] as $taste ){
			$input_updated['resourcetype_taste'] = $taste;
			$resourcetype=Resourcetype::create($input_updated);
			$resourcetype->save();
		}
      
      return redirect('admin/resourcetype');
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
		$food = DB::table('food')->orderBy('id', 'desc')->lists('food_name','id');
		$taste = DB::table('taste')->orderBy('id', 'desc')->lists('taste','id');
        //$taste  = DB::table('taste')->orderBy('id', 'desc')->select('taste', 'id')->get();

      $resourcetype = Resourcetype::findOrFail($id); 

      return view('admin.resourcetype.edit')->with('resourcetype',$resourcetype)->with('food',$food)->with('taste',$taste);
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
      $this->validate($request, Resourcetype::$rules);
      $resourcetype=Resourcetype::findOrFail($id);
      $resourcetype->update($request->all());

      return redirect('admin/resourcetype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $resourcetype = Resourcetype::findOrFail($id);

      if ($resourcetype) {
          $resourcetype->delete();
          Session::flash('flash_message', 'Resource successfully deleted!');
      }
      return redirect()->back();
    }

    public function datatable() {

        return Datatables::of(DB::table('resource_type')
		->join('taste', 'resource_type.resourcetype_taste', '=', 'taste.id')
		->join('food', 'resource_type.resourcetype_id', '=', 'food.id')
		->select('resource_type.id',  'food.food_name', 'taste.taste', 'resource_type.created_at')
		->where('resource_type', '=', 'food'))
        //return Datatables::of(Resourcetype::select('id','resource_type','resourcetype_id','created_at')->where('resource_type', '=', 'food')->join('taste', 'resource_type.resourcetype_id', '=', 'taste.id'))
                        ->addColumn('check', '<input type="checkbox" class="checkboxes" name="ids[]" value="{{ $id }}" />', 0)
                        ->addColumn('actions', '<a class="btn btn-small btn-info" href="{{ URL::route(\'admin.resourcetype.edit\',["id"=>$id]) }}"><span class="glyphicon glyphicon-pencil"></a>
                                {!! Form::open(["method" => "DELETE","route" => ["admin.resourcetype.destroy", $id],"class" => "inline deleteaction"]) !!}<button class="btn btn-danger btn-small"><span class="glyphicon glyphicon-trash"></button>{!! Form::close() !!}', 2)
                        ->make(true);
		
    }
}
