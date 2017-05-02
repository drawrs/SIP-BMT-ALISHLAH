<?php $__env->startSection('title','Absensiku'); ?>
<?php $__env->startSection('content'); ?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <?php if($cek == 0): ?>
          <strong>Tidak ada absensi untuk ditampilkan</strong>
          <?php endif; ?>
          <?php foreach($bulan as $bulan): ?>
          <?php
                $absen = DB::table('absen')
                          ->join('bulan','absen.bulan_id','=','bulan.id')
                          ->where('user_id', Auth::user()->id)
                          ->where('bulan_id', $bulan->id)
                          ->get();
                $no=1;
                ?>
          <?php if(!empty($absen)): ?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Absen Bulan <strong><?php echo e($bulan->nama_bln); ?></strong></h3>
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
                  <th width="400vh">Keterangan</th>
                </tr>
                </thead>
                <tbody>
                
                  <?php foreach($absen as $absen): ?>
                  <tr>
                    <td><?php echo e($no++); ?></td>
                    <td><?php echo e($absen->tgl); ?></td>
                    <td><?php echo e($absen->jam_in); ?></td>
                    <td><?php echo e($absen->jam_out); ?> <?php if(is_null($absen->jam_out)): ?> <i><strong>Belum Absen</strong></i> <?php endif; ?></td>
                    <td><?php echo e($absen->out_ijin); ?> <?php if(is_null($absen->out_ijin)): ?> <i><strong>Belum Ijin</strong></i> <?php endif; ?></td>
                    <td><?php echo e($absen->in_ijin); ?> <?php if(is_null($absen->in_ijin)): ?> <i><strong>Belum Ijin</strong></i> <?php endif; ?></td>
                    <td><?php echo e($absen->kt_ijin); ?> <?php if(is_null($absen->kt_ijin)): ?> <i><strong>-</strong></i> <?php endif; ?></td>
                  </tr>
                  <?php endforeach; ?>
                
                <!-- disini -->
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>