<?php $__env->startSection('title','Pilih Bulan Priode'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php
      $no=1;
      ?>
      <a class="btn btn-warning btn-flat" href="<?php echo e(route('rekap.posting')); ?>"><i class="fa fa-plus"></i> POSTING ABSENSI</a>
      <a class="btn btn-success btn-flat" onclick="return confirm('Batalkan rekap priode terakhir?')" href="<?php echo e(route('rekap.restore-all')); ?>"><i class="fa fa-refresh"></i> BATALKAN POSTING TERAKHIR</a>
      <a class="btn btn-default btn-flat" id="printRekap"><i class="fa fa-print"></i> PRINT REKAP GAJI</a>
      <a class="btn btn-default btn-flat" id="printRekapAbsen"><i class="fa fa-print"></i> PRINT REKAP ABSEN</a>
      <br/><br/>
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">PILIH BULAN</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <ul>
            <?php foreach($bulan as $data): ?>
            <li><b><a href="<?php echo e(route('rekap.bulan', ['id' => $data->bulan_id])); ?>"><?php echo e($data->nama_bln); ?> (<?php echo e($rekap->where('bulan_id', $data->bulan_id)->count()); ?>)</a></b></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
      </div>
      <!-- /.box -->
      
      
    </div>
    <!-- /.col -->
  </div>
  
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