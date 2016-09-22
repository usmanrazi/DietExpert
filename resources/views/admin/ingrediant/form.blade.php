@extends('admin.app')
@section('content')
@if ($ingrediant)
    {!! Breadcrumbs::render('admin.ingrediants.edit', $ingrediant) !!}
@else
    {!! Breadcrumbs::render('admin.ingrediants.create') !!}
@endif
<link href="{{ asset("assets/admin/css/bootstrap-fileupload.css") }}" rel="stylesheet" />
<link href="{{ asset("assets/admin/css/imgareaselect-default.css") }}" rel="stylesheet" />
<script src="{{ asset("assets/admin/js/jquery.imgareaselect.pack.js") }}"></script>

</script>
<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Add <span class="semi-bold">Ingrediant</span></h4>
                <div class="tools">
                    <a class="collapse" href="javascript:;"></a>
                    <a class="reload" href="javascript:;"></a>
                </div>
            </div>
            <div class="grid-body no-border"> <br>
                @if($errors->any())
                <div class="row">
                    <div class="alert alert-error col-md-6 col-sm-12 col-md-offset-3">
                        <button data-dismiss="alert" class="close"></button>
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                @endif
               {!! Form::model($ingrediant,['method' => $ingrediant ? 'PATCH':'POST','route' =>$ingrediant ? ['admin.ingrediants.update', $ingrediant->id]:'admin.ingrediants.store','id'=>'form_ingrediants', 'novalidate'=>"novalidate","enctype"=>"multipart/form-data"]) !!}
                 <div class="form-group row">
                    <div class="col-md-3 col-sm-12 text-right">
                        {!! Form::label('ingrediant_label', 'Ingrediant:', ['class' => 'form-label']) !!}
                    </div>

                    <div class="input-with-icon  right col-md-6 col-sm-12">

                        {!! Form::text('ingrediant_name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                   <div class="col-md-3 col-sm-12 text-right">
                       {!! Form::label('halal_label', 'Halal:', ['class' => 'form-label']) !!}
                   </div>

                   <div class="input-with-icon  right col-md-6 col-sm-12">

                     {!! Form::radio('halal', 'yes') !!}  {!! Form::label('checkbox_label', 'Yes:', ['class' => 'form-label']) !!} <br>
                     {!! Form::radio('halal', 'no', true) !!} {!! Form::label('checkbox_label', 'No:', ['class' => 'form-label']) !!}
                   </div>

               </div>
			   <div class="form-group row">
					<div class="col-md-3 col-sm-12 text-right">
                       {!! Form::label('container_label', 'Container:', ['class' => 'form-label']) !!}
                    </div>

                    <div class="input-with-icon  right col-md-6 col-sm-12">
						{!! Form::select('container', array('pantry' => 'Pantry', 'refrigerator' => 'Refrigerator')) !!}
						
					</div>
			   </div>
               {{--*/ $return = $ingrediant ? $ingrediant->ingrediant_picture : '' /*--}}
                <div class="form-group row " >
                  <label class="col-md-3 col-xs-12 form-label text-right">Ingrediant Thumbnail Image </label>
                  <div class="col-md-6 col-xs-12 controls">
                      <div class="fileupload <?php echo ($return != '') ? 'fileupload-exists' : 'fileupload-new'; ?>" data-provides="fileupload">

                        <?php if ($return != '') { ?>
                            <div class="fileupload-preview fileupload-exists thumbnail" id="image1" style="max-width: 400px; max-height: 400px; line-height: 20px;">
                                <a data-gallery="" class="gallery-item" href="{{ asset('uploads/ingrediant/'. $ingrediant->ingrediant_picture)}}"><img src="{{ asset('uploads/ingrediant/'. $ingrediant->ingrediant_picture)}}" style="max-height:350px;" /></a>
                            </div>
                        <?php } else { ?>
                            <div style="max-width: 400px; max-height: 400px;" class="fileupload-new thumbnail">
                                <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" id="image1" style="max-width: 400px; max-height: 400px; line-height: 20px;">
                            </div>
                        <?php } ?>
                        <div>
                          <span class="btn btn-file">
                              <span class="fileupload-new">Select image</span>
                              <span class="fileupload-exists">Change</span>
                              {!! Form::file('ingrediant_picture', ['class' => '']) !!}
                          </span>
                          <a href="javascript:void(0)" class="btn remove_picture fileupload-exists" data-dismiss="fileupload" >Remove</a>
                          <p id="image1-dim" class="label label-success" style="display:none;">

                          </p>
                          <p id="image1-size" class="label label-success" style="display:none;">

                          </p>
                          <!-- <a  href="javascript:void(0)"  class="btn btn-primary" onclick="checkCropSize('#image1 .cropbox', 'x', 'y', 'w', 'h', 'image1-size');" >Check Crop Size</a> -->
                        </div>
                      </div>
                      <code>Max allowed size: </code> 1024KB <br>
                      <code>NOTE! </code>
                      Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only
                      <br>
                  </div>
                  <div class="img-container" class="input">
                      <input type="hidden" class="x" name="logo_x" id="x" />
                      <input type="hidden" class="y" name="logo_y" id="y"/>
                      <input type="hidden" class="w" name="logo_w" id="w"/>
                      <input type="hidden" class="h" name="logo_h" id="h"/>
                  </div>
                </div>
                <div class="form-actions">
                    <div class="pull-right">
                        {!! Form::submit($ingrediant ? 'Update':'Save', ['class' => 'btn btn-primary btn-cons','id' => 'btn-submit']) !!}
                        </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('#form_ingrediants').submit(function (event) {
        var pass = true;
        //some validations

        if (pass == false) {
            return false;
        }
        form = this;
        jQuery('#btn-submit').attr('disabled', 'disabled');
        event.preventDefault();
        setTimeout(function () {
            form.submit();
        }, 500);
        jQuery('#progressbar').show();

        return true;
    });
</script>
<script src="{{ asset("assets/admin/plugins/blueimp/jquery.blueimp-gallery.min.js") }}"></script>
<script src="{{ asset("assets/admin/plugins/bootstrap/js/bootstrap-fileupload.js") }}"></script>

@endsection
