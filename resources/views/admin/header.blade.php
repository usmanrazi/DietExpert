

<div class="header navbar navbar-inverse ">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="header-seperation">
      <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
        <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" >
          <div class="iconset top-menu-toggle-white"></div>
          </a> </li>
      </ul>
      <!-- BEGIN LOGO -->
      <a href="{{url('/')}}"><img src="{{asset("assets/admin/img/logo.png")}}" class="logo" alt=""  data-src="{{asset("assets/admin/img/logo.png")}}" data-src-retina="{{asset("assets/admin/img/logo2x.png")}}" width="106" height="21"/></a>
      <!-- END LOGO -->
      <ul class="nav pull-right notifcation-center">
        <li class="dropdown" id="header_task_bar"> <a href="{{url('/')}}" class="dropdown-toggle active" data-toggle="">
          <div class="iconset top-home"></div>
          </a> </li>

      </ul>
    </div>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <div class="header-quick-nav" >
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="pull-left">
        <ul class="nav quick-section">
          <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
            <div class="iconset top-menu-toggle-dark"></div>
            </a> </li>
        </ul>
        <ul class="nav quick-section">

          <li class="m-r-10 input-prepend inside search-form no-boarder"> <span class="add-on"> <span class="iconset top-search"></span></span>
            <input name="" type="text"  class="no-boarder " placeholder="Search Dashboard" style="width:250px;">
          </li>
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
      <!-- BEGIN CHAT TOGGLER -->
      <div class="pull-right">
        <div class="chat-toggler">
          <div class="user-details">
            <div class="username"> <span class="bold">{{Auth::User()->username}}</span> </div>
          </div>
          <div class="iconset top-down"></div>


          <div class="profile-pic"> <img src="{{asset("uploads/users/".(Auth::User()->profile_picture ? Auth::User()->profile_picture : 'default.png'))}}"  alt="" width="35" height="35" /> </div>
        </div>
        <ul class="nav quick-section ">
          <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
            <div class="iconset top-settings-dark "></div>
            </a>
            <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
              <li><a href="{{url("/admin/users/".Auth::User()->id."/edit")}}"> My Account</a> </li>

              <li class="divider"></li>
              <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
            </ul>
          </li>

        </ul>
      </div>
      <!-- END CHAT TOGGLER -->
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>
