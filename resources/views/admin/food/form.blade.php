@extends('admin.app')
@section('content')
@if ($food)
    {!! Breadcrumbs::render('admin.food.edit', $food) !!}
@else
    {!! Breadcrumbs::render('admin.food.create') !!}
@endif
<link href="{{ asset("assets/admin/css/bootstrap-fileupload.css") }}" rel="stylesheet" />
<link href="{{ asset("assets/admin/css/imgareaselect-default.css") }}" rel="stylesheet" />
<script src="{{ asset("assets/admin/js/jquery.imgareaselect.pack.js") }}"></script>

</script>
<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Add <span class="semi-bold">Food</span></h4>
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
               {!! Form::model($food,['method' => $food ? 'PATCH':'POST','route' =>$food ? ['admin.food.update', $food->id]:'admin.food.store','id'=>'form_food', 'novalidate'=>"novalidate","enctype"=>"multipart/form-data"]) !!}
                 <div class="form-group row">
                    <div class="col-md-2 col-sm-8 text-right">
                        {!! Form::label('food_label', 'Food:', ['class' => 'form-label']) !!}
                    </div>

                    <div class="input-with-icon  right col-md-4 col-sm-8">

                        {!! Form::text('food_name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-md-1 col-sm-8 text-right">
                        {!! Form::label('vegetarian_label', 'Vegetarian:', ['class' => 'form-label']) !!}
                    </div>

                    <div class="input-with-icon  right col-md-4 col-sm-8">

                      {!! Form::radio('vegetarian', 'Yes') !!}  {!! Form::label('checkbox_label', 'Yes:', ['class' => 'form-label']) !!}
                      {!! Form::radio('vegetarian', 'No', true) !!} {!! Form::label('checkbox_label', 'No:', ['class' => 'form-label']) !!}
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-2 col-sm-8 text-right">
                      {!! Form::label('calories_label', 'Calories:', ['class' => 'form-label']) !!}
                  </div>

                  <div class="input-with-icon  right col-md-4 col-sm-8">

                      {!! Form::input('number', 'calories', null, ['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-1 col-sm-8 text-right">
                      {!! Form::label('fat_label', 'Fat:', ['class' => 'form-label']) !!}
                  </div>

                  <div class="input-with-icon  right col-md-4 col-sm-8">

                      {!! Form::input('number', 'fat', null, ['class' => 'form-control']) !!}
                  </div>
               </div>
               <div class="form-group row">
                 <div class="col-md-2 col-sm-8 text-right">
                     {!! Form::label('cholestrol_label', 'Cholestrol:', ['class' => 'form-label']) !!}
                 </div>

                 <div class="input-with-icon  right col-md-4 col-sm-8">

                     {!! Form::input('number', 'cholestrol', null, ['class' => 'form-control']) !!}
                 </div>
                 <div class="col-md-1 col-sm-8 text-right">
                     {!! Form::label('sodium_label', 'Sodium:', ['class' => 'form-label']) !!}
                 </div>

                 <div class="input-with-icon  right col-md-4 col-sm-8">

                     {!! Form::input('number', 'sodium', null, ['class' => 'form-control']) !!}
                 </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2 col-sm-8 text-right">
                    {!! Form::label('carbohydrate_label', 'Carbohydrate:', ['class' => 'form-label']) !!}
                </div>

                <div class="input-with-icon  right col-md-4 col-sm-8">

                    {!! Form::input('number', 'carbohydrate', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-1 col-sm-8 text-right">
                    {!! Form::label('protein_label', 'Protein:', ['class' => 'form-label']) !!}
                </div>

                <div class="input-with-icon  right col-md-4 col-sm-8">

                    {!! Form::input('number', 'protein', null, ['class' => 'form-control']) !!}
                </div>
             </div>
             <div class="form-group row">
               <div class="col-md-2 col-sm-8 text-right">
                   {!! Form::label('calcium_label', 'Calcium:', ['class' => 'form-label']) !!}
               </div>

               <div class="input-with-icon  right col-md-4 col-sm-8">
                    {!! Form::input('number', 'calcium', null, ['class' => 'form-control']) !!}
               </div>
               <div class="col-md-1 col-sm-8 text-right">
                   {!! Form::label('vitamin_A_label', 'Vitamin A:', ['class' => 'form-label']) !!}
               </div>

               <div class="input-with-icon  right col-md-4 col-sm-8">

                   {!! Form::input('number', 'vitamin_A', null, ['class' => 'form-control']) !!}
               </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-sm-8 text-right">
                  {!! Form::label('fiber_label', 'Fiber:', ['class' => 'form-label']) !!}
              </div>
              <div class="input-with-icon  right col-md-4 col-sm-8">

                  {!! Form::input('number', 'fiber', null, ['class' => 'form-control']) !!}
              </div>
              <div class="col-md-1 col-sm-8 text-right">
                  {!! Form::label('cuisine_label', 'Cuisine:', ['class' => 'form-label']) !!}
              </div>

              <div class="input-with-icon  right col-md-4 col-sm-8">

                  {!! Form::select('cuisine_id', $cuisine , Input::old('cuisine_name')) !!}
              </div>
           </div>
           <div class="form-group row">
             <div class="col-md-2 col-sm-8 text-right">
                 {!! Form::label('course_label', 'Course:', ['class' => 'form-label']) !!}
             </div>
             <div class="input-with-icon  right col-md-4 col-sm-8">

                 {!! Form::select('course_id', $course , Input::old('course_name')) !!}
             </div>
			 <div class="col-md-1 col-sm-8 text-right">
                 {!! Form::label('events_label', 'Events:', ['class' => 'form-label']) !!}
             </div>

             <div class="input-with-icon  right col-md-4 col-sm-8">

                 {!! Form::select('event_id', $events , Input::old('event_name')) !!}
             </div>
          </div>
          <div class="form-group row">
			 <div class="col-md-2 col-sm-8 text-right">
                 {!! Form::label('diet_option_label', 'Diet Option:', ['class' => 'form-label']) !!}
             </div>
             <div class="input-with-icon  right col-md-4 col-sm-8"> 

                 {!! Form::select('diet_option', $diet_option , Input::old('dietoption_name')) !!}
             </div>
			 
             <div class="col-md-1 col-sm-8 text-right">
                 {!! Form::label('effort_label', 'Effort(Time in minutes):', ['class' => 'form-label']) !!}
             </div>

             <div class="input-with-icon  right col-md-4 col-sm-8">
                 {!! Form::input('number', 'effort', null, ['class' => 'form-control']) !!}
             </div>
          </div>
		  <div class="form-group row">
			 <div class="col-md-2 col-sm-8 text-right">
                 {!! Form::label('preparation_label', 'Preparation:', ['class' => 'form-label']) !!}
             </div>
			 <div class="input-with-icon  right col-md-6 col-sm-8">
				 {!! Form::textarea('preparation') !!}
			 </div>
		  </div>
          <div class="form-group row">
             <div class="col-md-2 col-sm-8 text-right">
                 {!! Form::label('ingrediants_label', 'Ingrediants:', ['class' => 'form-label']) !!}
             </div>

             <div class="input-with-icon  right col-md-9 col-sm-8">
                 @foreach ($ingrediants as $ingrediant)

                 <?php $check = ""; //var_dump($food->ingrediants); ?>
                 @if($food)
                    @foreach ($food->ingrediants as $food_ingrediant )
                      @if ($food_ingrediant == $ingrediant->id)
                          <?php $check = "checked='checked'"; ?>
                      @endif
                    @endforeach
                @endif
                    <input type="checkbox" name="ingrediants[]" value="{{$ingrediant->id}}" <?php echo $check; ?> >
                    {!! Form::label('checkbox_label', $ingrediant->ingrediant_name, ['class' => 'form-label']) !!}
                @endforeach
             </div>
         </div>

               <div class="form-actions">
                    <div class="pull-right">
                        {!! Form::submit($food ? 'Update':'Save', ['class' => 'btn btn-primary btn-cons','id' => 'btn-submit']) !!}
                        </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('#form_food').submit(function (event) {
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

  jQuery( document ).ready(function() {
    var ingrediants = '';

    /*
    $('input[type="checkbox"][name="ingrediants_list[]"]').change(function(){
      if(this.checked) {
        ingrediants += (this.value + ',' );
        $("#ingrediants").val(ingrediants);
      }else{
        ingrediants = removeValue(ingrediants, this.value, ',')
        $("#ingrediants").val(ingrediants);
      }
      //console.log(ingrediants);

      //console.log($("#ingrediants").val());
    });*/
    function removeValue(list, value, separator) {
      separator = separator || ",";
      var values = list.split(separator);
      for(var i = 0 ; i < values.length ; i++) {
        if(values[i] == value) {
          values.splice(i, 1);
          return values.join(separator);
        }
      }
      return list;
    }
});
</script>
<script src="{{ asset("assets/admin/plugins/blueimp/jquery.blueimp-gallery.min.js") }}"></script>
<script src="{{ asset("assets/admin/plugins/bootstrap/js/bootstrap-fileupload.js") }}"></script>

@endsection
