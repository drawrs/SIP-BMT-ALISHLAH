<?php $__env->startSection('title','REKAP ABSENSI : '.$bulan->nama_bln); ?>
<?php $__env->startSection('content'); ?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php
           $no=1;
          ?>
          <a class="btn btn-warning btn-flat" id="printRekap"><i class="fa fa-print"></i> PRINT REKAP GAJI</a>
          <a class="btn btn-success btn-flat" id="printRekapAbsen"><i class="fa fa-print"></i> PRINT REKAP ABSEN</a>
          <br/><br/>
          <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10vh">NO</th>
                  <th>PRIODE</th>
                  <th>KETERANGAN</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
                <?php if($data_rekap->count() < 1): ?>
                <tr>
                  <td colspan="4" align="center">
                    <i><b>TIDAK ADA DATA UNTUK DITAMPILKAN</b></i>
                  </td>
                </tr>
                <?php endif; ?>
                <?php foreach($data_rekap as $data): ?>
                <tr>
                  <td><?php echo e($no++); ?></td>
                  
                  <td>Priode  <strong><?php echo e($data->tgl_priode_awal); ?></strong> - <strong><?php echo e($data->tgl_priode_akhir); ?></strong></td>
                  <td>
                    <ul>
                      <li>NAMA PEGAWAI : <b><a href="<?php echo e(route('karyawan.edit', ['edit' => $data->user_id])); ?>"><?php echo e($data->user->detail->nama); ?></a></b></li>
                      <li><b><?php echo e($data->user->cabang->name); ?></b></li>
                    </ul>
                  </td>
                  <td><a href="<?php echo e(route('rekap.priode', ['priode' => $data->id])); ?>"><button class="btn btn-default"><i class="fa fa-book"></i> Lihat</button></a>&nbsp;
                  <a href="<?php echo e(route('rekap.restore', ['id' => $data->id])); ?>" onclick="return confirm('Kembalikan rekapan absensi ini?')"><button class="btn btn-success hapus-user" value="<?php echo e($data->id); ?>"><i class="fa fa-refresh"></i> Batalkan</button></a>
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
 <div class="modal fade" id="modal-print-absen">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">PILIH TANGGAL PRIODE</h4>
            </div>
            <div class="modal-body">
            <form action="<?php echo e(route('rekap.priode.print-absen')); ?>" method="GET">
             <div class="form-group">
                  <label for="">MASUKAN TANGGAL (format: mm/dd/yyyy. Cth: 12/27/2017)</label>
                  <input type="text" class="form-control pull-right" placeholder="Cth: 07/04/2016 - 10/04/2016" id="tgl-priode-absen" required="1" name="tgl">
                </div>

               
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">TAMPILKAN</button></form>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- /.row -->
  <div class="modal fade" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">PRINT REKAP GAJI</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo e(route('rekap.priode.print')); ?>" method="GET">
            <div class="box-body">
              <div class="form-group">
                <div class="form-group">
                  <label for="">MASUKAN TANGGAL (format: mm/dd/yyyy. Cth: 12/27/2017)</label>
                  <input type="text" class="form-control pull-right" placeholder="Cth: 07/04/2016 - 10/04/2016" id="tgl-priode" required="1" name="tgl">
                </div>
                <div class="form-group">
                  <label for="">PILIH KANTOR CABANG</label>
                  <select name="cab" id="" class="form-control">
                    <option value="all">Semua Kantor</option>
                    <?php foreach($cabang as $cab): ?>
                    <option value="<?php echo e($cab->id); ?>"><?php echo e($cab->name); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="info">
                  <ul id="info">
                    
                  </ul>
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">BATAL</button>
                <button class="btn btn-success" type="submit" id="proses-posting">PRINT</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
      </div>
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
      //Date range picker
      $('#tgl-priode').daterangepicker();
      $('#tgl-priode-absen').daterangepicker();
      
      $('#printRekap').click(function(event) {
      /* Act on the event */
      $('#modal-print').modal('show');
      });
      $('#printRekapAbsen').click(function(event) {
      /* Act on the event */
      $('#modal-print-absen').modal('show');
      });
      });
      </script>
      <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>