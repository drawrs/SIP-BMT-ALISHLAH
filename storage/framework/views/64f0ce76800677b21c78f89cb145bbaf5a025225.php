<?php $__env->startSection('title', 'Absensi'); ?>
<?php $__env->startSection('navigation'); ?>
<h1>
Absensi
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="">Dashboard</a></li>
  <li class="active">Tambah Berita</li>
</ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jangan lupa mengisi Absensi</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
      <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
      <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body table-responsive">

    <table class="table table-striped">
      <tbody><tr>

        <th>Keterangan</th>
        <th>Jam Masuk</th>
        <th>Jam Ijin</th>
        <th>Jam Kembali</th>
        <th>Jam Keluar</th>
      </tr>
      <tr>

        <td><?php echo e($info['msg']); ?></td>
        <td>
          <button type="submit" class="btn btn-warning <?php echo e($info['st_in']); ?> act" onclick="act('in')" <?php echo e($info['st_in']); ?> name="act" value="in">Absen</button>
        </td>
        <td>
          <button type="submit" class="btn btn-success <?php echo e($btn_ijin['out']); ?> " name="act" value="out_ijin" onclick="ijin_out()" <?php echo e($btn_ijin['out']); ?>>Ijin Keluar</button>
        </td>
        <td>
          <button type="submit" class="btn btn-success <?php echo e($btn_ijin['in']); ?>" name="act" value="in_ijin" onclick="act('in_ijin')" <?php echo e($btn_ijin['in']); ?>>Ijin Masuk</button>
        </td>
        <td><button type="submit" class="btn btn-danger <?php echo e($info['st_out']); ?> " name="act" value="out" onclick="act('out')" <?php echo e($btn['out']); ?> <?php echo e($info['st_out']); ?>>Absen</button></td>
      </tr>
      
    </tbody>
    </table>
    <a href="<?php echo e(route('absen.detail')); ?>"><button type="submit" class="btn btn-default"><i class="fa fa-book"></i> Lihat Data Absensiku</button></a>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    BMT Al-Ishlah
  </div>
  <!-- /.box-footer-->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::to('dist/sweetalert.min.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bottom-script'); ?>
<script>
  function act(val){
    $.ajax({
      type: "POST",
      url: "<?php echo e(route('absen.now')); ?>",
      data : {_token: "<?php echo e(csrf_token()); ?>", act: val},
      success: function (msg) {
        if (msg.trim() == 1) {
          swal({
            title: "Berhasil!",
            type : "success",
            text: "Absen berhasil.",
            timer: 2000,
            showConfirmButton: false
          });
        } else {
          swal({
          title: "Gagal!",
          type : "error",
          text: "Terjadi kesalahan.",
          timer: 2000,
          showConfirmButton: false
        });
        }
        location.reload();
      }
    });
  }
function ijin_out(){
    swal({
        title: "Keterangan",
        text: "Alasan ijin:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        showLoaderOnConfirm: true,
      },
      function(note){
        if (note === false) return false;
        
        if (note === "") {
          swal.showInputError("Kolom masih kosong!");
          return false
        }
        setTimeout(function(){
          $.ajax({
            type: "POST",
            url: "<?php echo e(route('absen.now')); ?>",
            data : {_token: "<?php echo e(csrf_token()); ?>", act: "out_ijin", kt_ijin: note},
            success: function(msg){

                if (msg.trim() == '1') {
                  swal({
                    timer: 2000,
                    title : "Berhasil!",
                    text : "",
                    type: "success"
                  });
                } else {
                  swal({
                    timer: 2000,
                    title : "Gagal!",
                    text : "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.",
                    type: "error"
                  });
                }
                 location.reload();
            }
          });
        }, 2000);
        
      });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>