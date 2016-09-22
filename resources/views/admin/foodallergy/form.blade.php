@extends('admin.app')
@section('content')
@if ($foodallergies)
    {!! Breadcrumbs::render('admin.foodallergies.edit', $foodallergies) !!}
@else
    {!! Breadcrumbs::render('admin.foodallergies.create') !!}
@endif

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Add <span class="semi-bold">Food Allergies</span></h4>
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
               {!! Form::model($foodallergies,['method' => $foodallergies ? 'PATCH':'POST','route' =>$foodallergies ? ['admin.foodallergies.update', $foodallergies->id]:'admin.foodallergies.store','id'=>'form_foodallergies', 'novalidate'=>"novalidate","enctype"=>"multipart/form-data"]) !!}
                <div class="form-group row">
					 <div class="col-md-2 col-sm-8 text-right">
						 {!! Form::label('food_label', 'Food:', ['class' => 'form-label']) !!}
					 </div>
					 <div class="input-with-icon  right col-md-4 col-sm-8">

						 {!! Form::select('food_id', $food , Input::old('food_name')) !!}
					 </div>
					 <div class="col-md-1 col-sm-8 text-right">
						 {!! Form::label('allergies_label', 'Allergies:', ['class' => 'form-label']) !!}
					 </div>
						@if($foodallergies)
							<div class="input-with-icon  right col-md-4 col-sm-8">
								{!! Form::select('allergy_id', $allergies , Input::old('taste')) !!}
							</div>
						@else
							 <div class="input-with-icon  right col-md-4 col-sm-8">
								 @foreach ($allergies as $allergy)

								 <?php  $check = ""; //var_dump($food->ingrediants); ?>
								 
									<input type="checkbox" name="allergy_id[]" value="{{$allergy->id}}" <?php echo $check; ?> >
									{!! Form::label('checkbox_label', $allergy->allergy_name, ['class' => 'form-label']) !!}
								@endforeach
							 </div>
						@endif
				</div>
                <div class="form-actions">
                    <div class="pull-right">
                        {!! Form::submit($foodallergies ? 'Update':'Save', ['class' => 'btn btn-primary btn-cons','id' => 'btn-submit']) !!}
                        </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('#form_foodallergies').submit(function (event) {
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
