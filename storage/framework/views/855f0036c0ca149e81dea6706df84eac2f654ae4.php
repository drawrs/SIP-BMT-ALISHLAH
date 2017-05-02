<?php $__env->startSection('title', 'Laporan Absensi'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  
<div class="col-md-8">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Tampilkan Data Berdasarkan</h3>
    </div>
    <form action="<?php echo e(route('karyawan.print-report')); ?>" method="POST">
      <?php echo e(csrf_field()); ?>

      <div class="box-body">
        <!-- radio -->
        <div class="form-group">
          <label>
            <input type="radio" name="opsi" class="flat-red" value="all"> Tampilkan Semua
          </label>
        </div>
        <div class="form-group">
          <label>
            <input type="radio" name="opsi" class="flat-red" value="name"> Berdasarkan Nama
          </label>
          <select class="form-control select2" name="user" style="width: 100%;">
          </select>
        </div>
        
      <!-- /.box-body -->
      <div class="box-footer">
        
      <button type="submit" class="btn btn-default form-control pull-right"><i class="fa fa-print"></i> Tampilkan</button></form>
    </div>
  </div>
</div>
<!-- /.col (left) -->

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::to('dist/sweetalert.min.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('dist/sweetalert.css')); ?>">
<!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo e(URL::to('admin/plugins/iCheck/all.css')); ?>">
   <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(URL::to('admin/plugins/select2/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bottom-script'); ?>
<!-- iCheck 1.0.1 -->
<!-- Select2 -->
<script src="<?php echo e(URL::to('admin/plugins/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('admin/plugins/iCheck/icheck.min.js')); ?>"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo e(URL::to('admin/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(URL::to('admin/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo e(URL::to('admin/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
<script>
  $(function(){
    var datauser = [
        <?php foreach($users as $user): ?>
        { id: <?php echo e($user->id); ?>, text: '[<?php echo e($user->karyawan_id); ?>] <?php echo e($user->detail->nama); ?>'},
        <?php endforeach; ?>];
        var datacabang = [
        <?php foreach($cabangs as $cabang): ?>
        { id: <?php echo e($cabang->id); ?>, text: '<?php echo e($cabang->name); ?>'},
        <?php endforeach; ?>];
    //Initialize Select2 Elements
    $(".select2").select2({
      data: datauser
    });
    $(".select2.cabang").select2({
      data: datacabang
    });

  //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
});


</script>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>