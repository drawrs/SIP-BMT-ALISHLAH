<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $__env->yieldContent('title'); ?> | BMT Al-Ishlah</title>
  <link href="<?php echo e(URL::to('/icon/favicon.ico')); ?>" rel="shortcut icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/admin/bootstrap/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/admin/plugins/daterangepicker/daterangepicker-bs3.css')); ?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/admin/plugins/datepicker/datepicker3.css')); ?>">
  <!-- iCheck for checkboxes and radio inputs -->

  
  <?php echo $__env->yieldContent('script'); ?>
  <link rel="stylesheet" href="<?php echo e(URL::to('/admin/dist/css/AdminLTE.min.css')); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/admin/dist/css/skins/_all-skins.min.css')); ?>">
  <!-- <script src="<?php echo e(URL::to('/js/jquery-3.0.0.min.js')); ?>"></script> -->
</head>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php echo $__env->make('includes.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sistem Informasi Pegawai
        <small>BMT Al-Ishlah</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <?php echo $__env->yieldContent('content'); ?>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
 <?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo e(URL::to('/admin/plugins/jQuery/jQuery-2.2.0.min.js')); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(URL::to('/admin/bootstrap/js/bootstrap.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(URL::to('/admin/dist/js/app.min.js')); ?>"></script>
<?php echo $__env->yieldContent('bottom-script'); ?>
<!-- </body></html> -->
</body>
</html>
