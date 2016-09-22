<!DOCTYPE html>
<html lang="en">
    <head>

        <meta http-equiv="content-type" content="text/html;charset=UTF-8">

        <meta charset="utf-8">
        <title>Diet Expert | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta content="" name="description">
        <meta content="" name="author">
        <meta name="_token" content="{!! csrf_token() !!}"/>

        <!-- BEGIN PLUGIN CSS -->
        <link href="{{ asset('assets/admin/plugins/bootstrap-select2/select2.css')}}" rel="stylesheet" type="text/css" media="screen"/>
        <link href="{{ asset('assets/admin/plugins/jquery-datatable/css/jquery.dataTables.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/admin/plugins/datatables-responsive/css/datatables.responsive.css')}}" rel="stylesheet" type="text/css" media="screen"/>
        <link href="{{ asset('assets/admin/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" media="screen"/>
        <!-- END PLUGIN CSS -->
        <!-- BEGIN CORE CSS FRAMEWORK -->
        <link href="{{ asset('assets/admin/plugins/boostrapv3/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/admin/plugins/boostrapv3/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/admin/plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/admin/css/animate.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/admin/plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css"/>
        <!-- END CORE CSS FRAMEWORK -->
        <!-- BEGIN CSS TEMPLATE -->
        <link href="{{ asset('assets/admin/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/admin/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/admin/css/custom-icon-set.css')}}" rel="stylesheet" type="text/css"/>
        <!-- END CSS TEMPLATE -->
        <script src="{{ asset('assets/admin/plugins/jquery-1.8.3.min.js')}}" type="text/javascript"></script>
    </head>
    <body>

        @include('admin.header')
        <div class="page-container row-fluid">
            @include('admin.sidebar')
            <div class="page-content">
                <div class="content">
                    <div id="ajax-msg-div" class="alert alert-success" style="display: none">
                        <button class="close" id="ajax-msg-close" data-dismiss="alert"><span class="fa fa-times"></span></button>
                        <p id="ajax-msg"></p>
                    </div>
                    @yield('content')
                </div>
            </div>

            <!-- Scripts -->

        </div>
        <div id="progressbar" class="loading">
            <i class="fa fa-refresh fa-spin loadingimage"></i>
        </div>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
            });
        </script>
        <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/breakpoints.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
        <!-- END CORE JS FRAMEWORK -->

        <!-- BEGIN PAGE LEVEL JS -->
        <script src="{{ asset('assets/admin/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/jquery-block-ui/jqueryblockui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/jquery-numberAnimate/jquery.animateNumbers.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/bootstrap-select2/select2.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/plugins/jquery-datatable/js/jquery.dataTables.min_1.js')}}" type="text/javascript" ></script>
<!--        <script src="{{ asset('assets/admin/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js')}}" type="text/javascript" ></script>
        <script type="text/javascript" src="{{ asset('assets/admin/plugins/datatables-responsive/js/datatables.responsive.js')}}"></script>-->
        <script type="text/javascript" src="{{ asset('assets/admin/plugins/datatables-responsive/js/lodash.min.js')}}"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <script src="{{ asset('assets/admin/js/datatables.js')}}" type="text/javascript"></script>
        <!-- BEGIN CORE TEMPLATE JS -->
        <script src="{{ asset('assets/admin/js/core.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/js/custom.js')}}" type="text/javascript"></script>
    </body>
</html>
