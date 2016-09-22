@extends('admin.app')
@section('content')
@if ($people)
    {!! Breadcrumbs::render('admin.people.edit', $people) !!}
@else
    {!! Breadcrumbs::render('admin.people.create') !!}
@endif

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Add <span class="semi-bold">People</span></h4>
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
               {!! Form::model($people,['method' => $people ? 'PATCH':'POST','route' =>$people ? ['admin.people.update', $people->id]:'admin.people.store','id'=>'form_people', 'novalidate'=>"novalidate","enctype"=>"multipart/form-data"]) !!}
                 <div class="form-group row">
                    <div class="col-md-3 col-sm-12 text-right">
                        {!! Form::label('people_label', 'People Name:', ['class' => 'form-label']) !!}
                    </div>

                    <div class="input-with-icon  right col-md-6 col-sm-12">

                        {!! Form::text('people_name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 col-sm-12 text-right">
                        {!! Form::label('gender_label', 'Gender:', ['class' => 'form-label']) !!}
                    </div>

                    <div class="input-with-icon  right col-md-6 col-sm-12">

                        {!! Form::select('age', ['Under 18', '19 to 30', 'Over 30']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 col-sm-12 text-right">
                        {!! Form::label('height_label', 'Height:', ['class' => 'form-label']) !!}
                    </div>

                    <div class="input-with-icon  right col-md-6 col-sm-12">

                        {!! Form::text('height', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="pull-right">
                        {!! Form::submit($people ? 'Update':'Save', ['class' => 'btn btn-primary btn-cons','id' => 'btn-submit']) !!}
                        </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('#form_people').submit(function (event) {
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
