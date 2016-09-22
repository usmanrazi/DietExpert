@extends('main_views')

@section('content')

<div class="container">

            <div class="row login-container column-seperation" >



                <div class="col-md-4 col-md-offset-4"> <br>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="login-form" role="form" method="POST" action="{{ url('/auth/register') }}">
                        {!! csrf_field() !!}

                        <div class='row'>
                            <div class="form-group col-md-8 ">
                                <label class="form-label">{{trans('auth.First Name')}}</label>
                                <div class="controls">
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-md-8 ">
                                <label class="form-label">{{trans('auth.Last Name')}}</label>
                                <div class="controls">
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-md-8 ">
                                <label class="form-label"> {{trans('auth.Username')}}</label>
                                <div class="controls">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-md-8 ">
                                <label class="form-label">{{trans('auth.E-mail Address')}}</label>
                                <div class="controls">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-md-8 ">
                                <label class="form-label">{{trans('auth.Password')}}</label>
                                <div class="controls">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="form-group col-md-8 ">
                                <label class="form-label">{{trans('auth.Confirm Password')}}</label>
                                <div class="controls">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <!-- <div class='row'>
                                <div class="form-group col-md-8 ">
                                        <label class="form-label">Profile Picture</label>
                                        <div class="controls">
                                                <input type="file" class="form-control" name="profile_picture" value="{{ old('profile_picture') }}">
                                        </div>
                                </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-8 ">
                                <button type="submit" class="btn btn-primary btn-cons pull-right">{{trans('auth.Register')}}</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
            </div>


        @endsection

 <div class="clear"></div>
