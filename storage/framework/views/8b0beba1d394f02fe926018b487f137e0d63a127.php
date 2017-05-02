<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title'); ?> | DASHBOARD BMT AL ISHLAH</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo e(URL::to('admin/bootstrap/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(URL::to('admin/dist/css/AdminLTE.min.css')); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo e(URL::to('admin/dist/css/skins/_all-skins.min.css')); ?>">

    <script src='https://code.jquery.com/jquery-3.0.0.min.js'></script>
    <?php echo $__env->yieldContent('script'); ?>
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
      <?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!-- =============================================== -->
      <!-- Left side column. contains the sidebar -->
      <?php echo $__env->make('includes.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php echo $__env->yieldContent('navigation'); ?>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          
            <?php echo $__env->yieldContent('content'); ?>
          
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <!-- ./wrapper -->
    <?php echo $__env->yieldContent('bottom-script'); ?>
    <!-- jQuery 2.2.0 -->
    <script src="<?php echo e(URL::to('admin/plugins/jQuery/jQuery-2.2.0.min.js')); ?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo e(URL::to('admin/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo e(URL::to('admin/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(URL::to('admin/dist/js/app.min.js')); ?>"></script>
    <!-- AdminLTE for demo purposes
  --></body>
</html>