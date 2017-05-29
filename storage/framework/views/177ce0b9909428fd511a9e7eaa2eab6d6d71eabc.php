<?php $__env->startSection('title', 'Cuti'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  
  <div class="col-md-10">
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title">Informasi</h3>
      </div>
      <div class="box-body">
        <p>SISA CUTI SAYA : <b><i><?php echo e($cuti->qty); ?> Hari</i></b></p>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <div class="col-md-10">
    
    <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Tambah Pengajuan Cuti</h3>
      </div>
      <div class="box-body">
        <!-- Date -->
        <form action="<?php echo e(route('cuti.add_temp')); ?>" method="post">
          <?php echo e(csrf_field()); ?>

        <div class="form-group">
          <label>Jenis Cuti:</label>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-sort-alpha-asc"></i>
            </div>
            <select name="type" id="" class="form-control" required="1">
             
              <?php foreach($jenis_cuti as $jenis): ?>
                <?php if($jenis->id == '0'): ?>
                   <option value="<?php echo e($jenis->id); ?>"><?php echo e($jenis->name); ?> (limit : <?php echo e($cuti->qty); ?> hari kerja)</option>
                <?php else: ?>
                  <option value="<?php echo e($jenis->id); ?>"><?php echo e($jenis->name); ?> (limit: <?php echo e($jenis->day_limit); ?> hari kerja)</option>
                <?php endif; ?>
                
              <?php endforeach; ?>
            </select>
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group">
          <label>Tanggal Cuti:</label>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" placeholder="Format: bln/tgl/thn - bln/tgl/thn. Cth: 17/04/2016 - 25/04/2016" id="reservation" required="1" name="date">
          </div>
          <!-- /.input group -->
        </div>
        
        <div class="form-group">
          <label>Keperluan:</label>
          <textarea name="note" id="" rows="3" class="form-control" required="1"></textarea>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-default form-control pull-right"><i class="fa fa-plus"></i> Tambahkan</button></form>
      </div>
    </div>
  </div>
  <div class="col-md-10">
    <!-- /.box -->
  <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Daftar Pengajuan Cuti</h3>
      </div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-hover">
          <tbody><tr>
            <th >ID</th>
            <th width="150px">Nama Karyawan</th>
            <th>Jabatan</th>
            <th width="10vh">Lama Cuti</th>
            <th width="10vh">Dari Tanggal</th>
            <th width="10vh">Sampai Tanggal</th>
            <th>Jenis Cuti</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
          
          
          <?php if(!empty($temp_cuti)): ?>
          <?php foreach($temp_cuti as $temp): ?>
          <?php
              $date_from = explode('/', $temp->from);
              $from_temp = $date_from[1].'/'.$date_from[0].'/'.$date_from[2];
              $date_to = explode('/', $temp->to);
              $to_temp = $date_to[1].'/'.$date_to[0].'/'.$date_to[2];
          ?>
          <input type="hidden" value="<?php echo e($temp->id); ?>" name="id">
          <tr>
            <td><?php echo e($temp->kode); ?></td>
            <td><?php echo e($temp->user->detail->nama); ?></td>
            <td><?php echo e($temp->user->detail->jabatan->name); ?></td>
            <td><?php echo e($temp->qty); ?> Hari</td>
            <td><?php echo e($from_temp); ?></td>
            <td><?php echo e($to_temp); ?></td>
            <td><strong><i><?php echo e($temp->jenisCuti->name); ?></i></strong></td>
            <td><?php echo e($temp->note); ?></td>
            <td><button value="<?php echo e($temp->id); ?>" class="btn btn-danger batal-cuti"><i class="fa fa-trash"></i></button></td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody></table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <form action="<?php echo e(route('cuti.send_temp')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

        <button type="submit" class="btn btn-default form-control pull-right"><i class="fa fa-send"></i> Ajukan</button></form>
      </div>
    </div>
    <!-- /.box -->
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Riwayat Pengajuan Cuti</h3>
      </div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-hover">
          <tbody><tr>
            <th >ID</th>
            <th width="150px">Nama Karyawan</th>
            <th>Jabatan</th>
            <th width="10vh">Lama Cuti</th>
            <th width="10vh">Dari Tanggal</th>
            <th width="10vh">Sampai Tanggal</th>
            <th>Jenis Cuti</th>
            <th>Keterangan</th>
            <th>Status</th>
          </tr>
          
          <?php foreach($cuti_out as $c_out): ?>
          <?php
              $date_from = explode('/', $c_out->from);
              $from_out = $date_from[1].'/'.$date_from[0].'/'.$date_from[2];
              $date_to = explode('/', $c_out->to);
              $to_out = $date_to[1].'/'.$date_to[0].'/'.$date_to[2];
          ?>
          <tr>
            <td><?php echo e($c_out->kode); ?></td>
            <td><?php echo e($c_out->user->name); ?></td>
            <td><?php echo e($c_out->user->detail->jabatan->name); ?></td>
            <td><?php echo e($c_out->qty); ?> Hari</td>
            <td><?php echo e($from_out); ?></td>
            <td><?php echo e($to_out); ?></td>
            <td><b><i><?php echo e($c_out->jenisCuti->name); ?></i></b></td>
            <td><?php echo e($c_out->note); ?></td>
            <td>
              <?php if($c_out->status == 4): ?>
                <b class="btn btn-danger btn-block">Dibatalkan</b>
              <?php elseif($c_out->status == 3): ?>
                <b class="btn btn-primary btn-block">Pending</b>
              <?php elseif($c_out->status == 2): ?>
                <b class="btn btn-success btn-block">Wait : HRD</b>
              <?php elseif($c_out->status == 1): ?>
                <b class="btn btn-warning btn-block">ACC</b>
                <a href="<?php echo e(route('cuti_out.batal', ['c_out_id' => $c_out->id])); ?>" onClick="return confirm('Batalkan Cuti ?')" class="btn btn-danger btn-block btn-sm"  data-toggle="tooltip" data-placement="right" title="Klik untuk membatalkan cuti"><i class="glyphicon glyphicon-ban-circle"></i>  Batalkan Cuti</a>
              <?php elseif($c_out->status == 0): ?>
                <b class="btn btn-danger btn-block">Ditolak</b>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody></table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <?php echo $cuti_out->links(); ?>

      </div>
      
    </div>
    <!-- /.box -->
    
    
    
  </div>
  <!-- /.col (left) -->
  <div class="col-md-4">
    
  </div>
  <!-- /.col (right) -->
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
<script>
   $(document).ready(function() {
        $('.batal-cuti').click(function(){
          window.dataID = $.trim($(this).attr("value"));
          swal({
            title: "Batalkan?",
            text: "Anda yakin ingin membatalkan Pengajuan Cuti?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Ya",
            cancelButtonText: "Tutup",
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
          },
          function(){
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "<?php echo e(route('cuti.batal')); ?>",
                data : { cuti_id : window.dataID, _token : "<?php echo e(csrf_token()); ?>"},
                success: function(msg) {
                    if (msg.trim()  == '0') {
                      swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
                    } else if (msg.trim()  == '1') {
                      swal("Berhasil!", "Data telah dihapus.", "success");
                    } else {
                      swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
                    }
                     location.reload();
                }
              });
            }, 2000);
          });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>