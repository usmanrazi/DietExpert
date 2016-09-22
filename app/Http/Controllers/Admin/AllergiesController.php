<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\Allergies;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;

class AllergiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allergies=Allergies::latest()->get();
      return view('admin.allergies.index', compact('allergies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.allergies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, Allergies::$rules);
      $input=$request->all();

      $Allergies=Allergies::create($input);
      $Allergies->save();
      return redirect('admin/allergies');
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
      $allergies = Allergies::findOrFail($id);

      return view('admin.allergies.edit')->with('allergies',$allergies);
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
      $this->validate($request, Allergies::$rules);
      $allergies=Allergies::findOrFail($id);
      $allergies->update($request->all());

      return redirect('admin/allergies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $allergies = Allergies::findOrFail($id);

      if ($allergies) {
          $allergies->delete();
          Session::flash('flash_message', 'Allergy successfully deleted!');
      }
      return redirect()->back();
    }

    public function datatable() {

        return Datatables::of(Allergies::select('id','allergy_name','created_at'))
                        ->addColumn('check', '<input type="checkbox" class="checkboxes" name="ids[]" value="{{ $id }}" />', 0)
                        ->addColumn('actions', '<a class="btn btn-small btn-info" href="{{ URL::route(\'admin.allergies.edit\',["id"=>$id]) }}"><span class="glyphicon glyphicon-pencil"></a>
                                {!! Form::open(["method" => "DELETE","route" => ["admin.allergies.destroy", $id],"class" => "inline deleteaction"]) !!}<button class="btn btn-danger btn-small"><span class="glyphicon glyphicon-trash"></button>{!! Form::close() !!}', 2)
                        ->make(true);
    }
}
