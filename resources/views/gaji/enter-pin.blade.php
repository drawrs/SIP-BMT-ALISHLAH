<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')Masukan PIN | BMT Al-Ishlah</title>
  <link href="{{URL::to('/icon/favicon.ico')}}" rel="shortcut icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::to('/admin/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{URL::to('/admin/plugins/daterangepicker/daterangepicker-bs3.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{URL::to('/admin/plugins/datepicker/datepicker3.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->

  
  @yield('script')
  <link rel="stylesheet" href="{{URL::to('/admin/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{URL::to('/admin/dist/css/skins/_all-skins.min.css')}}">
  <!-- <script src="{{URL::to('/js/jquery-3.0.0.min.js')}}"></script> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="/"><b>BMT</b>AL-Ishlah</a>
      </div>
      <!-- User name -->
      <div class="lockscreen-name">Masukan PIN</div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="{{URL::to('upload/foto_pegawai/user.png')}}" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" action="{{route('gaji')}}" method="POST">
          <div class="input-group">
          {{csrf_field()}}
            <input type="password" class="form-control" placeholder="password" name="pin">
            <div class="input-group-btn">
              <button class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center">
        @if(Session::has('message'))
        {{Session::get('message')}}
        @else
        Masukan PIN untuk dapat mengakses Halaman ini
        @endif
      </div>
      <div class="text-center">
        <!-- <a href="login.html">Or sign in as a different user</a> -->
      </div>
      <!-- <div class="lockscreen-footer text-center">
        Copyright &copy; 2016 <a href='http://fb.me/rizal.ofdraw'>Rizal Khilman</a>
      </div> -->
    </div><!-- /.center -->

<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="{{URL::to('/admin/plugins/jQuery/jQuery-2.2.0.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{URL::to('/admin/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::to('/admin/dist/js/app.min.js')}}"></script>
  </body>
</html>