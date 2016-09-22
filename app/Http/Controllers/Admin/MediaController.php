<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\Media;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Session,
    Input,
    DB,
    Debugbar,
    File;
class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media=Media::latest()->get();
        return view('admin.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$food  = DB::table('food')->orderBy('id', 'desc')->lists('food_name','id');
        
        return view('admin.media.create')->with('food',$food);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, Media::$rules);
      $input = $request->all();
        if (Input::file('media')) {
            $image = Input::file('media');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('uploads/media/' . $filename);

            if (!file_exists(public_path('uploads/')))
                File::makeDirectory(public_path('uploads/'));
            if (!file_exists(public_path('uploads/media/')))
                File::makeDirectory(public_path('uploads/media/'));

            $file = Image::make($image->getRealPath());
            $file->save($path);

            $input['media'] = $filename;

        }
		$ingrediant=Media::create($input);
		$ingrediant->save();
		return redirect('admin/media');
      
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
      //$container = Container::where('id', '=', $id)->firstOrFail();
	  $food  = DB::table('food')->orderBy('id', 'desc')->lists('food_name','id');
        
      $media = Media::findOrFail($id);

      return view('admin.media.edit')->with('media',$media)->with('food',$food);
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
		$media=Media::findOrFail($id);
		$input = $request->all();
		$this->validate($request, Media::$rules);

        if (Input::file('media')) {
            // Debugbar::addMessage('Heloo');
            $image = Input::file('media');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('uploads/media/' . $filename);

            if (!file_exists(public_path('uploads/')))
                File::makeDirectory(public_path('uploads/'));
            if (!file_exists(public_path('uploads/media/')))
                File::makeDirectory(public_path('uploads/media/'));

          $file = Image::make($image->getRealPath());
          $file->save($path);
          $input['media'] = $filename;
        } else {
            if(array_key_exists('media', $input) && $input['media'] == '' && file_exists('uploads/media/'.$media->media)){
                File::delete('uploads/media/'.$media->media);
            }else{
                unset($input['media']);
            }

        }
        $media->fill($input)->update();

        Session::flash('flash_message', 'Media successfully updated!');

        return redirect('admin/media');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $media = Media::findOrFail($id);

      if ($media) {
          $media->delete();
          Session::flash('flash_message', 'Media successfully deleted!');
      }
      return redirect()->back();
    }

    public function datatable() {

        return Datatables::of(Media::select('id','food_id','media','created_at'))
                        ->addColumn('check', '<input type="checkbox" class="checkboxes" name="ids[]" value="{{ $id }}" />', 0)
                        ->addColumn('actions', '<a class="btn btn-small btn-info" href="{{ URL::route(\'admin.media.edit\',["id"=>$id]) }}"><span class="glyphicon glyphicon-pencil"></a>
                                {!! Form::open(["method" => "DELETE","route" => ["admin.media.destroy", $id],"class" => "inline deleteaction"]) !!}<button class="btn btn-danger btn-small"><span class="glyphicon glyphicon-trash"></button>{!! Form::close() !!}', 2)
                        ->make(true);
    }
}
