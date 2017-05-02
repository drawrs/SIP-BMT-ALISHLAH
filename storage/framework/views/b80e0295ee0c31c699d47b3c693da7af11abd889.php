<?php $__env->startSection('title','Edit Absensi'); ?>
<?php $__env->startSection('content'); ?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <h4>Absensi : <strong><?php echo e($absen->user->detail->nama); ?></strong></h4>
         
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Data Absen <strong></strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10vh">No</th>
                  <th>Taggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
                  <th>Jam Ijin</th>
                  <th>Jam Kembali</th>
                  <th>Total Jam Kerja</th>
                  <th width="400vh">Keterangan</th>
                </tr>
                </thead>
                <tbody>
                 <form action="<?php echo e(route('absen.post-edit')); ?>" method="POST">
                 <?php echo e(csrf_field()); ?>

                 <input type="hidden" name="user_id" value="<?php echo e($absen->user_id); ?>">
                 <input type="hidden" name="id" value="<?php echo e($absen->id); ?>">
                  <tr>
                    <td>#</td>
                    <td><strong><?php echo e($absen->tgl); ?></strong></td>
                    <td><input type="text" name="jam_in" class="form-control" value="<?php echo e($absen->jam_in); ?>"></td>
                    <td><input type="text" name="jam_out" class="form-control" value="<?php echo e($absen->jam_out); ?>"></td>
                    <td><input type="text" name="out_ijin" class="form-control" value="<?php echo e($absen->out_ijin); ?>"></td>
                    <td><input type="text" name="in_ijin" class="form-control" value="<?php echo e($absen->in_ijin); ?>"></td>
                    <td><strong><?php echo e($absen->jam_kerja); ?></strong> <?php if(is_null($absen->jam_kerja)): ?> <i><strong>-</strong></i> <?php endif; ?> Jam</td>
                    <td><input type="text" name="kt_ijin" class="form-control" value="<?php echo e($absen->kt_ijin); ?>"></td>
                    
                  </tr>
                  <tr>
                    <td colspan="8"><button type="submit" class="btn btn-default">Simpan</button></td>
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