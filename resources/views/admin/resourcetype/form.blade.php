@extends('admin.app')
@section('content')
@if ($resourcetype)
    {!! Breadcrumbs::render('admin.resourcetype.edit', $resourcetype) !!}
@else
    {!! Breadcrumbs::render('admin.resourcetype.create') !!}
@endif

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Add <span class="semi-bold">Food Taste</span></h4>
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
               {!! Form::model($resourcetype,['method' => $resourcetype ? 'PATCH':'POST','route' =>$resourcetype ? ['admin.resourcetype.update', $resourcetype->id]:'admin.resourcetype.store','id'=>'form_resourcetype', 'novalidate'=>"novalidate","enctype"=>"multipart/form-data"]) !!}
				<input type="hidden" name="resource_type" value="food">
				<div class="form-group row">
					 <div class="col-md-2 col-sm-8 text-right">
						 {!! Form::label('food_label', 'Food:', ['class' => 'form-label']) !!}
					 </div>
					 <div class="input-with-icon  right col-md-4 col-sm-8">

						 {!! Form::select('resourcetype_id', $food , Input::old('food_name')) !!}
					 </div>
					 <div class="col-md-1 col-sm-8 text-right">
						 {!! Form::label('taste_label', 'Taste:', ['class' => 'form-label']) !!}
					 </div>
						@if($resourcetype)
							<div class="input-with-icon  right col-md-4 col-sm-8">
								{!! Form::select('resourcetype_taste', $taste , Input::old('taste')) !!}
							</div>
						@else
							 <div class="input-with-icon  right col-md-4 col-sm-8">
								 @foreach ($taste as $tst)

								 <?php  $check = ""; //var_dump($food->ingrediants); ?>
								 
									<input type="checkbox" name="resourcetype_taste[]" value="{{$tst->id}}" <?php echo $check; ?> >
									{!! Form::label('checkbox_label', $tst->taste, ['class' => 'form-label']) !!}
								@endforeach
							 </div>
						@endif
				</div>
				
                <div class="form-actions">
                    <div class="pull-right">
                        {!! Form::submit($resourcetype ? 'Update':'Save', ['class' => 'btn btn-primary btn-cons','id' => 'btn-submit']) !!}
                        </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('#form_resourcetype').submit(function (event) {
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
