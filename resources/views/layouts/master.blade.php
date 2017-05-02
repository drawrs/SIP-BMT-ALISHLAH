<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | DASHBOARD BMT AL ISHLAH</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link href="{{URL::to('/icon/favicon.ico')}}" rel="shortcut icon">
  <link rel="stylesheet" href="{{URL::to('/admin/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{URL::to('/admin/plugins/datatables/dataTables.bootstrap.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{URL::to('/admin/plugins/daterangepicker/daterangepicker-bs3.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{URL::to('/admin/plugins/datepicker/datepicker3.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/admin/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{URL::to('/admin/dist/css/skins/_all-skins.min.css')}}">

    <!-- <script src='{{ URL::to('/js/jquery-3.0.0.min.js') }}'></script> -->
    @yield('script')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      @include('includes.header')
      <!-- =============================================== -->
      <!-- Left side column. contains the sidebar -->
      @include('includes.sidebar')
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          @include('includes.errors')
          @include('includes.messages')
          @yield('navigation')
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          
            @yield('content')
          
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      @include('includes.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.0 -->
<script src="{{URL::to('/admin/plugins/jQuery/jQuery-2.2.0.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{URL::to('/admin/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{URL::to('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::to('/admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{URL::to('/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{URL::to('/admin/dist/js/app.min.js')}}"></script>
@yield('bottom-script')
   <!-- </body></html> -->
   </body>
</html>