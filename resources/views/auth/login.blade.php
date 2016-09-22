
@extends('main_views')

<section id='about'>

       @section('content')
       <div clas="container"  >

            <div class="row login-container column-seperation" >
              <div class="col-md-4 col-md-offset-4">

                  <br>
                    @if (count($errors) > 0)
                       <div class="row">
                        <div class="col-md-10 col-sm-12">
                            <div class="alert alert-danger">
                                <button class="close" data-dismiss="alert"></button>
                                <p><strong>Whoops!</strong> There were some problems with your input.</p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                           </div>
                        </div>
                         @endif

              <form id="login-form" class="login-form" role="form" method="POST" action="{{ url('/auth/login') }}" >
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label class="form-label">Username or E-mail</label>
                                <div class="controls">
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <!-- <input type="text" name="txtusername" id="txtusername" class="form-control">  -->
                                        <input type="text" class="form-control" name="username" value="{{ old('username') }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label class="form-label">Password</label>
                                <span class="help"></span>
                                <div class="controls">
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <!-- <input type="password" name="txtpassword" id="txtpassword" class="form-control">
                                        -->
                                        <input type="password" class="form-control" name="password">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="row">
                            <div class="control-group  col-md-10">
                                <div class="checkbox checkbox check-success">
                                    <a href="{{ url('/password/email') }}">Forget Your Password?</a>&nbsp;&nbsp;
                                    <input type="checkbox" id="checkbox1" value="1">
                                    <label for="checkbox1">{{trans('auth.Keep me Reminded')}} </label>
                                </div>
                            </div>
                        </div>
                      -->
                        <div class="row">
                            <div class="col-md-10">


                                <button class="btn btn-primary btn-cons pull-left" type="submit">Login</button>

                                  <!--
                               <div class="col-md-8 ">

                                <a class="btn btn-primary btn-cons pull-right" href="{{URL::to('/auth/register')}}">Register</a>

                               <button onclick="window.location.href='{{URL::to('/auth/register')}}'" class="btn btn-primary btn-cons pull-right">Register</button>



                            </div>
                             -->
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>


@endsection

</section>
