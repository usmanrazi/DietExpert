<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\Resourcetype;
use App\models\Foodallergy;

use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;
class FoodallergyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	
      $foodallergy=Foodallergy::latest()->get();
      return view('admin.foodallergy.index', compact('foodallergy'));
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
        $allergy  = DB::table('allergies')->orderBy('id', 'desc')->select('allergy_name', 'id')->get();

		return view('admin.foodallergy.create')->with('food',$food)->with('allergies',$allergy);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, Foodallergy::$rules);
		$input=$request->all();
		$input_updated = array();
		$input_updated = $input;
		foreach( $input['allergy_id'] as $allergy ){
			$input_updated['allergy_id'] = $allergy;
			$resourcetype=Foodallergy::create($input_updated);
			$resourcetype->save();
		}
      
      return redirect('admin/foodallergies');
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
		$allergy = DB::table('allergies')->orderBy('id', 'desc')->lists('allergy_name','id');
        //$taste  = DB::table('taste')->orderBy('id', 'desc')->select('taste', 'id')->get();

      $foodallergies = Foodallergy::findOrFail($id); 

      return view('admin.foodallergy.edit')->with('foodallergies',$foodallergies)->with('food',$food)->with('allergies',$allergy);
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
      $this->validate($request, Foodallergy::$rules);
      $foodallergies=Foodallergy::findOrFail($id);
      $foodallergies->update($request->all());

      return redirect('admin/foodallergies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $foodallergies = Foodallergy::findOrFail($id);

      if ($foodallergies) {
          $foodallergies->delete();
          Session::flash('flash_message', 'Food Allergy successfully deleted!');
      }
      return redirect()->back();
    }

    public function datatable() {

        return Datatables::of(DB::table('food_allergies')
		->join('food', 'food_allergies.food_id', '=', 'food.id')
		->join('allergies', 'food_allergies.allergy_id', '=', 'allergies.id')
		->select('food_allergies.id',  'food.food_name', 'allergies.allergy_name', 'food_allergies.created_at'))
						->addColumn('check', '<input type="checkbox" class="checkboxes" name="ids[]" value="{{ $id }}" />', 0)
                        ->addColumn('actions', '<a class="btn btn-small btn-info" href="{{ URL::route(\'admin.foodallergies.edit\',["id"=>$id]) }}"><span class="glyphicon glyphicon-pencil"></a>
                                {!! Form::open(["method" => "DELETE","route" => ["admin.foodallergies.destroy", $id],"class" => "inline deleteaction"]) !!}<button class="btn btn-danger btn-small"><span class="glyphicon glyphicon-trash"></button>{!! Form::close() !!}', 2)
                        ->make(true);
		
    }
}
