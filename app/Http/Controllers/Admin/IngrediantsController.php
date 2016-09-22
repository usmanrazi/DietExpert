<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\Ingrediants;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Session,
    Input,
    DB,
    Debugbar,
    File;
class IngrediantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ingrediant=Ingrediants::latest()->get();
      return view('admin.ingrediant.index', compact('ingradiant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ingrediant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
          'ingrediant_name' => 'required',
      ]);
      $input = $request->all();
        if (Input::file('ingrediant_picture')) {
            $image = Input::file('ingrediant_picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('uploads/ingrediant/' . $filename);

            if (!file_exists(public_path('uploads/')))
                File::makeDirectory(public_path('uploads/'));
            if (!file_exists(public_path('uploads/ingrediant/')))
                File::makeDirectory(public_path('uploads/ingrediant/'));

            $file = Image::make($image->getRealPath());
            $file->save($path);

            $input['ingrediant_picture'] = $filename;

            

        }
		$ingrediant=Ingrediants::create($input);
		$ingrediant->save();
		return redirect('admin/ingrediants');
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
      $ingrediant = Ingrediants::findOrFail($id);

      return view('admin.ingrediant.edit')->with('ingrediant',$ingrediant);
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
      $ingrediant=Ingrediants::findOrFail($id);
      $input = $request->all();

      $this->validate($request, [
          'ingrediant_name' => 'required',
      ]);

      if (Input::file('ingrediant_picture')) {
            // Debugbar::addMessage('Heloo');
            $image = Input::file('ingrediant_picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('uploads/ingrediant/' . $filename);

            if (!file_exists(public_path('uploads/')))
                File::makeDirectory(public_path('uploads/'));
            if (!file_exists(public_path('uploads/ingrediant/')))
                File::makeDirectory(public_path('uploads/ingrediant/'));

          $file = Image::make($image->getRealPath());
          $file->save($path);
          $input['ingrediant_picture'] = $filename;
        } else {
            if(array_key_exists('ingrediant_picture', $input) && $input['ingrediant_picture'] == '' && file_exists('uploads/ingrediant/'.$ingrediant->ingrediant_picture)){
                File::delete('uploads/ingrediant/'.$ingrediant->ingrediant_picture);
            }else{
                unset($input['ingrediant_picture']);
            }

        }
        $ingrediant->fill($input)->update();

        Session::flash('flash_message', 'Ingrediant successfully updated!');

        return redirect('admin/ingrediants');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $ingrediant = Ingrediants::findOrFail($id);

      if ($ingrediant) {
          $ingrediant->delete();
          Session::flash('flash_message', 'Ingrediant successfully deleted!');
      }
      return redirect()->back();
    }

    public function datatable() {

      return Datatables::of(Ingrediants::select('id','ingrediant_name','container','halal','created_at'))
                      ->addColumn('check', '<input type="checkbox" class="checkboxes" name="ids[]" value="{{ $id }}" />', 0)
                      ->addColumn('actions', '<a class="btn btn-small btn-info" href="{{ URL::route(\'admin.ingrediants.edit\',["id"=>$id]) }}"><span class="glyphicon glyphicon-pencil"></a>
                              {!! Form::open(["method" => "DELETE","route" => ["admin.ingrediants.destroy", $id],"class" => "inline deleteaction"]) !!}<button class="btn btn-danger btn-small"><span class="glyphicon glyphicon-trash"></button>{!! Form::close() !!}', 2)
                      ->make(true);
    }
}
