<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\Taste;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;
class TasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $taste=Taste::latest()->get();
      return view('admin.taste.index', compact('taste'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.taste.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, Taste::$rules);
      $input=$request->all();

      $cuisine=Taste::create($input);
      $cuisine->save();
      return redirect('admin/taste');
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
      $taste = Taste::findOrFail($id);

      return view('admin.taste.edit')->with('taste',$taste);
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
      $this->validate($request, Taste::$rules);
      $taste=Taste::findOrFail($id);
      $taste->update($request->all());

      return redirect('admin/taste');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $taste = Taste::findOrFail($id);

      if ($taste) {
          $taste->delete();
          Session::flash('flash_message', 'Taste successfully deleted!');
      }
      return redirect()->back();
    }

    public function datatable() {

        return Datatables::of(Taste::select('id','taste','created_at'))
                        ->addColumn('check', '<input type="checkbox" class="checkboxes" name="ids[]" value="{{ $id }}" />', 0)
                        ->addColumn('actions', '<a class="btn btn-small btn-info" href="{{ URL::route(\'admin.taste.edit\',["id"=>$id]) }}"><span class="glyphicon glyphicon-pencil"></a>
                                {!! Form::open(["method" => "DELETE","route" => ["admin.taste.destroy", $id],"class" => "inline deleteaction"]) !!}<button class="btn btn-danger btn-small"><span class="glyphicon glyphicon-trash"></button>{!! Form::close() !!}', 2)
                        ->make(true);
    }
}
