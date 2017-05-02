<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BMT AL-ISHLAH | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin/plugins/iCheck/all.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::to('admin/plugins/iCheck/square/blue.css')); ?>">
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href=""><b>Attandance</b>BMT</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg"></p> 
                <form method="POST" action="<?php echo e(url('/login')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group has-feedback <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                        <?php endif; ?>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                        <input type="password" class="form-control"  name="password" value="<?php echo e(old('email')); ?>" placeholder="Password">
                        <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                        <?php endif; ?>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links
                <a href="#">I forgot my password</a><br>
                <a href="register.html" class="text-center">Register a new membership</a> -->
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <script src="<?php echo e(URL::to('admin/plugins/jQuery/jQuery-2.2.0.min.js')); ?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo e(URL::to('admin/bootstrap/js/bootstrap.min.js')); ?>"></script>
        <!-- SlimScroll -->
        <script src="<?php echo e(URL::to('admin/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
        <script src="<?php echo e(URL::to('admin/plugins/iCheck/icheck.min.js')); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo e(URL::to('admin/dist/js/app.min.js')); ?>"></script>
        <script>
        $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
            });
        });
        </script>
        <!-- </body></html> -->
    </body>
</html>