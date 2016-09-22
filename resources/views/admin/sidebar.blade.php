<div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
      <div class="user-info-wrapper">
        <div class="profile-wrapper">
          <img src="{{asset(Auth::User()->profile_picture ? "uploads/users/".Auth::User()->profile_picture : '/uploads/default.png')}}" width="69" height="69" />
        </div>
        <div class="user-info">
          <div class="greeting"></div>
          <div class="username"><span class="semi-bold">{{Auth::User()->username}}</span></div>

        </div>
      </div>
      <!-- END MINI-PROFILE -->
      <!-- BEGIN SIDEBAR MENU -->
      <p class="menu-title"></p><br>
      <!-- This is special extention of blade template comment tag. Here it is closed at start and started again after code so it does not confuse blade. -->
      {{-- */$url = Request::url();/* --}}
      {{-- */$fullUrl = Request::fullUrl();/* --}}

      <ul>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin')}}"> <i class="icon-custom-home"></i> <span class="title">Dashboard</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/container')}}"> <i class="icon-custom-home"></i> <span class="title">Container</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/ingrediants')}}"> <i class="icon-custom-home"></i> <span class="title">Ingrediants</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/food')}}"> <i class="icon-custom-home"></i> <span class="title">Food</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/course')}}"> <i class="icon-custom-home"></i> <span class="title">Course</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/allergies')}}"> <i class="icon-custom-home"></i> <span class="title">Allergies</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/events')}}"> <i class="icon-custom-home"></i> <span class="title">Events</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/dietoption')}}"> <i class="icon-custom-home"></i> <span class="title">Diet Option</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/cuisine')}}"> <i class="icon-custom-home"></i> <span class="title">Cuisine</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/taste')}}"> <i class="icon-custom-home"></i> <span class="title">Taste</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/mealtime')}}"> <i class="icon-custom-home"></i> <span class="title">Meal Time</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/people')}}"> <i class="icon-custom-home"></i> <span class="title">People</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/media')}}"> <i class="icon-custom-home"></i> <span class="title">Media</span> </a>         </li>
        <li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/resourcetype')}}"> <i class="icon-custom-home"></i> <span class="title">Resource Type</span> </a>         </li>
		<li class=" {{url('/admin')==$url}}"> <a href="{{url('/admin/foodallergies')}}"> <i class="icon-custom-home"></i> <span class="title">Food Allergies</span> </a>         </li>


      </ul>

      <div class="clearfix"></div>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
