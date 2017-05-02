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
              <h3 class="box-title">REKAP ABSENSI : <?php echo e($user->detail->nama); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
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
            <div class="box-footer"><?php echo $data_rekap->links(); ?></div>
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
<script>
  
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>