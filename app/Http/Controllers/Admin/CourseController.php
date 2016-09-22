<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\Course;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session,
    Input,
    DB,
    Debugbar,
    Image,
    File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $course=Course::latest()->get();
      return view('admin.course.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, Course::$rules);
      $input=$request->all();

      $course=Course::create($input);
      $course->save();
      return redirect('admin/course');
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
      $course = Course::findOrFail($id);

      return view('admin.course.edit')->with('course',$course);
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
      $this->validate($request, Course::$rules);
      $course=Course::findOrFail($id);
      $course->update($request->all());

      return redirect('admin/course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $course = Course::findOrFail($id);

      if ($course) {
          $course->delete();
          Session::flash('flash_message', 'Course successfully deleted!');
      }
      return redirect()->back();
    }

    public function datatable() {

        return Datatables::of(Course::select('id','course_name','created_at'))
                        ->addColumn('check', '<input type="checkbox" class="checkboxes" name="ids[]" value="{{ $id }}" />', 0)
                        ->addColumn('actions', '<a class="btn btn-small btn-info" href="{{ URL::route(\'admin.course.edit\',["id"=>$id]) }}"><span class="glyphicon glyphicon-pencil"></a>
                                {!! Form::open(["method" => "DELETE","route" => ["admin.course.destroy", $id],"class" => "inline deleteaction"]) !!}<button class="btn btn-danger btn-small"><span class="glyphicon glyphicon-trash"></button>{!! Form::close() !!}', 2)
                        ->make(true);
    }
}
