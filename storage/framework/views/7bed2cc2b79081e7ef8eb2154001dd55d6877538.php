<?php $__env->startSection('title','REKAP ABSENSI : '. $user->detail->nama); ?>
<?php $__env->startSection('content'); ?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php
           $no=1;
          ?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">REKAP ABSENSI : <strong><a href="<?php echo e(route('karyawan.edit', ['edit' => $user->id])); ?>"><?php echo e($user->detail->nama); ?></a> </strong></h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive">
            <form action="form">
              <div class="form-group">
                <label for="">Lihat Berdasarkan Tanggal</label>
                <input type="text" class="form-control" placeholder="Cth: 07/04/2016 - 10/04/2016" id="tgl-absen" required="1" name="tgl-absen" >
              </div>
            </form>
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10vh">NO</th>
                  <th>PRIODE</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
                <?php if($data_rekap->count()  == 0): ?>
                  <tr>
                    <td colspan="3" align="center"><b><i>TIDAK ADA DATA UNTUK DITAMPILKAN</i></b></td>
                  </tr>
                <?php endif; ?>
                <?php foreach($data_rekap as $data): ?>
                <tr>
                  <td><?php echo e($no++); ?></td>
                  <td>Priode  <strong><?php echo e($data->tgl_priode_awal); ?></strong> - <strong><?php echo e($data->tgl_priode_akhir); ?></strong></td>
                  
                  <td><a href="<?php echo e(route('rekap.priode', ['priode' => $data->id])); ?>"><button class="btn btn-default"><i class="fa fa-book"></i> Lihat</button></a>&nbsp;
                 <?php if(Auth::user()->level == 'hrd'): ?>
                  <a href="<?php echo e(route('rekap.restore', ['id' => $data->id])); ?>" onclick="return confirm('Kembalikan rekapan absensi ini?')"><button class="btn btn-success hapus-user" value="<?php echo e($data->id); ?>"><i class="fa fa-refresh"></i> Batalkan</button></a>
                 <?php endif; ?>
                  <!-- Tombol hapus dimatikan -->
                  <!-- <a href="<?php echo e(route('rekap.del', ['id' => $data->id])); ?>" onclick="return confirm('Hapus data ini?')"><button class="btn btn-danger hapus-user" value="<?php echo e($data->id); ?>"><i class="fa fa-trash"></i> Hapus</button></a> -->
                  
                  </td>
                </tr>
                 <?php endforeach; ?>
                <!-- disini -->
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"><?php echo $data_rekap->links(); ?> <?php echo e($user->id); ?> a</div>
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
<script src="<?php echo e(url('admin/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<script>
 $(document).ready(function() {
   $('#tgl-absen').daterangepicker();
   $('#tgl-absen').change(function(event) {
     /* Act on the event */
     var dateRange = $('#tgl-absen').val();
     var url = "<?php echo e(url("/rekap-gaji/priode-by-date")); ?>/<?php echo e($user->id); ?>?date_range=" + dateRange;
     window.location.href = url;
   });
 });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>