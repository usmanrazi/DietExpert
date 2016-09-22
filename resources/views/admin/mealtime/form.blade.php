@extends('admin.app')
@section('content')
@if ($mealtime)
    {!! Breadcrumbs::render('admin.taste.edit', $mealtime) !!}
@else
    {!! Breadcrumbs::render('admin.mealtime.create') !!}
@endif

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Add <span class="semi-bold">Meal Time</span></h4>
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
               {!! Form::model($mealtime,['method' => $mealtime ? 'PATCH':'POST','route' =>$mealtime ? ['admin.mealtime.update', $mealtime->id]:'admin.mealtime.store','id'=>'form_mealtime', 'novalidate'=>"novalidate","enctype"=>"multipart/form-data"]) !!}
                 <div class="form-group row">
                    <div class="col-md-3 col-sm-12 text-right">
                        {!! Form::label('mealtime_label', 'Meal Time:', ['class' => 'form-label']) !!}
                    </div>

                    <div class="input-with-icon  right col-md-6 col-sm-12">

                        {!! Form::text('mealtime_name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="pull-right">
                        {!! Form::submit($mealtime ? 'Update':'Save', ['class' => 'btn btn-primary btn-cons','id' => 'btn-submit']) !!}
                        </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('#form_mealtime').submit(function (event) {
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
