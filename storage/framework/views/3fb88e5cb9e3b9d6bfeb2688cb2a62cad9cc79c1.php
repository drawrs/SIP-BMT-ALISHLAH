<?php $__env->startSection('title','Tambah Absensi'); ?>
<?php $__env->startSection('content'); ?>
  <section class="content">
      <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="row">
        <div class="col-xs-12">

          <h4>Absensi : <strong><?php echo e($user->detail->nama); ?></strong></h4>
         
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Data Absen <strong></strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Taggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
                  <th>Jam Ijin</th>
                  <th>Jam Kembali</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                 <form action="<?php echo e(route('absen.post-add', ['id' => $user->id])); ?>" method="POST">
                 <?php echo e(csrf_field()); ?>

                  <tr>
                    <td><input type="text" class="form-control" name="tgl" placeholder="Cth: 15/05/2016" value="<?php echo e(old('tgl')); ?>"></td>
                    <td><input type="text" name="jam_in" class="form-control" placeholder="Cth: 08:20:00" value="<?php echo e(old('jam_in')); ?>"></td>
                    <td><input type="text" name="jam_out" class="form-control" placeholder="Cth: 16:20:00" value="<?php echo e(old('jam_out')); ?>"></td>
                    <td><input type="text" name="out_ijin" class="form-control" placeholder="Cth: 09:00:00" value="<?php echo e(old('out_ijin')); ?>"></td>
                    <td><input type="text" name="in_ijin" class="form-control" placeholder="Cth: 12:24:00" value="<?php echo e(old('in_ijin')); ?>"></td>
                    
                    <td><input type="text" value="<?php echo e(old('kt_ijin')); ?>" name="kt_ijin" class="form-control"></td>
                    
                  </tr>
                  <tr>
                    <td colspan="8">
                     <strong>*)Note : Kosongkan bila tidak perlu</strong> <br>
                    <button type="submit" class="btn btn-default">Simpan</button></td>
                  </tr>
                  
                </form>
                <!-- disini -->
                </tfoot>
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::to('dist/sweetalert.min.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bottom-script'); ?>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo e(URL::to('admin/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(URL::to('admin/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo e(URL::to('admin/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>


<!-- Page script -->
<script>
  $(function () {
   //Date picker
    $('#datepicker').datepicker({
      autoclose: true
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>