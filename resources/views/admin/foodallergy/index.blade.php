@extends('admin.app')
@section('content')
<link href="{{ asset('assets/admin/plugins/jquery-notifications/css/messenger.css')}}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ asset('assets/admin/plugins/jquery-notifications/css/messenger-theme-flat.css')}}" rel="stylesheet" type="text/css" media="screen"/>
@if(Session::has('flash_message'))
<div class="alert {{ (Session::has('flash_message_status'))?'alert-error':'alert-success'}}">
    <button class="close" data-dismiss="alert"></button>
    {!! Session::get('flash_message') !!}
</div>
@endif
{!! Breadcrumbs::render('admin.foodallergies.index') !!}
<div class="page-title"> <i class="icon-custom-left"></i>
    <h3>Food Allergy - <span class="semi-bold">List</span></h3>
</div>
<div class='control'>
    <a href="{{ URL::to('admin/foodallergies/create') }}" class="btn btn-primary">Create a Food Allergy</a>

</div>
<br>
<div class="grid simple vertical green">
    <div class="grid-title no-border">
        <h4>All <span class="semi-bold">Food Allergies</span></h4>
        <div class="tools">
            <a class="collapse" href="javascript:;"></a>
            <a class="reload" href="javascript:;"></a>
        </div>
    </div>
    <div class="grid-body no-border">
        <table class="table table-hover table-condensed" id="datatable-example" >
            <thead>
                <tr>
                    <th><input type="checkbox" class="group-checkable" data-set="#datatable-example .checkboxes" /></th>
                    <th>Id</th>
                    <th>Food Name </th>
                    <th>Allergy Name </th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
{!! Form::open([
'method' => 'POST',
'class' => 'inline',
'id'=> 'bulkaction'
]) !!}
<input type="hidden" value="" name="ids" id="ids" />
{!! Form::close() !!}


<script type="text/javascript" language="javascript" class="init">
    jQuery(document).ready(function ($) {
        //$('#example tbody').on('click', '.deleteaction', function () {

        $(document).on('submit', '.deleteaction', function () {
            // e.preventDefault();
            var ret = confirm("Are you sure you want to delete?");

            if (ret) {
                $("#progressbar").show();
                return true;
            }
            return false;
        });


        $('#datatable-example').DataTable({
            processing: true,
            serverSide: true,
            "order": [[1, "desc"]],
            ajax: {
                "url": "{{ URL::to('admin/foodallergies/datatable') }}",
                "type": "POST"
            },
            columns: [
                {data: 'check', name: 'check'},
                {data: 'id', name: 'id'},
                {data: 'food_name', name: 'food_name'},
                {data: 'allergy_name', name: 'allergy_name'},
                {data: 'actions', name: 'actions'}

            ],
            "columnDefs": [
                {
                    "targets": [1],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [0, 1, 2, 3, 4],
                    "orderable": false
                }
            ]
        });

        $('#datatable-example_wrapper .dataTables_filter input').addClass("input-medium "); // modify table search input
        $('#datatable-example_wrapper .dataTables_length select').addClass("select2-wrapper span12"); // modify table per page dropdown
        $('#datatable-example_wrapper .dataTables_length select').removeClass("form-control");



        $('#datatable-example input').click(function () {
            $(this).parent().parent().parent().toggleClass('row_selected');
        });


        $(".select2-wrapper").select2({minimumResultsForSearch: -1});

    });
</script>

<script src="{{ asset('assets/admin/plugins/jquery-notifications/js/messenger.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-notifications/js/messenger-theme-future.js')}}" type="text/javascript"></script>
@endsection
