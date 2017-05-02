<?php $__env->startSection('title','Karyawan'); ?>
<?php $__env->startSection('content'); ?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <?php
           $no=1;
          ?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data karyawan</strong></h3><?php echo Auth::user()->level == 'hrd' ? ' &nbsp; &nbsp; &nbsp; <a href="'.route('karyawan.tambah').'"><button class="btn btn-default"><i class="fa fa-plus"></i> Tambah Data</button></a>': ''; ?>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10vh">No</th>
                  <th>Kode Karyawan</th>
                  <th>Nama Karyawan</th>
                  <th>Jabatan</th>
                  <th>Cabang</th>
                  <th align="center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                  <td><?php echo e($no++); ?></td>
                  <td><?php echo e($user->karyawan_id); ?></td>
                  <td><?php echo e($user->detail->nama); ?></td>
                  <td><?php echo e($user->detail->jabatan->name); ?></td>
                  <td><?php echo e($user->cabang->name); ?></td>
                  <td align="center"><a href="<?php echo e(route('karyawan.edit', ['id' => $user->id])); ?>"><button class="btn btn-warning"><i class="fa fa-edit"></i></button></a>&nbsp;<button class="btn btn-danger hapus-user" value="<?php echo e($user->id); ?>"><i class="fa fa-trash"></i></button>
                  <a href="<?php echo e(route('absen.detail', ['id' => $user->id])); ?>" class="btn btn-default"><i class="fa fa-calendar-o"></i> Lihat Absensi</a>
                  <a href="<?php echo e(route('rekap.list', ['id' => $user->id])); ?>" class="btn btn-default"><i class="fa fa-book"></i> Rekap Absensi</a>
                  </td>
                </tr>
                 <?php endforeach; ?>
                <!-- disini -->
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"><?php echo $users->links(); ?></div>
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
   $('.hapus-user').click(function(){
        var id = $(this).attr("value");
        swal({
            title: "Anda Yakin?",
            text: "",
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
                type: "POST",
                url: "<?php echo e(route('karyawan.hapus')); ?>",
                data : { act: 'del', id : id, _token: "<?php echo e(csrf_token()); ?>"},
                success: function(msg) {
                    if (msg == '0') {
                      swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
                    } else if (msg == '1') {
                      swal("Berhasil!", "Data karyawan dihapus.", "success");
                    } else {
                      swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
                    }
                     location.reload();
                }
              });
            }, 2000);
          });
      });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>