<header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>MT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>BMT AL</b>-Ishlah</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You Fake messages</li>
              <li>
                inner menu: contains the actual data
                <ul class="menu">
                  <li>start message
                    <a href="#">
                      <div class="pull-left">
                        <img src="" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        User
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>message</p>
                    </a>
                  </li>
                  end message
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{url("upload/foto_pegawai/".Auth::user()->detail->foto)}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->detail->nama}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{url("upload/foto_pegawai/".Auth::user()->detail->foto)}}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->detail->jabatan->name}} - {{ Auth::user()->cabang->name}}
                  <small>{{ Auth::user()->detail->alamat}}</small>
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="{{URL::to('/logout')}}" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
            
        </ul>
      </div>
    </nav>
  </header>