<?php $__env->startSection('title','Absensiku'); ?>
<?php $__env->startSection('content'); ?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <?php
           $no=1;
          ?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data karyawan</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('karyawan.tambah-post')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Alamat E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('level') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Level</label>

                            <div class="col-md-6">
                                <select name="level" id="" class="form-control">
                                    <option value="user">Karyawan</option>
                                    <option value="admin">Admin</option>
                                    <option value="pc">Pimpinan Cabang</option>
                                    <option value="hrd">HRD</option>
                                </select>
    
                                <?php if($errors->has('level')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('level')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Katasandi</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                            <label for="password-confirm" class="col-md-4 control-label">Konfirmasi Katasandi</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Nama Lengkap</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>">

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('ktp') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">Nomor KTP</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="ktp" value="<?php echo e(old('ktp')); ?>">

                                <?php if($errors->has('ktp')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('ktp')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('tgl') ? ' has-error' : ''); ?>">
                            <label for="tgl" class="col-md-4 control-label">Tanggal Lahir</label>

                            <div class="">
                                <div class="col-md-2">
                                  <select name="tgl" id="" class="form-control">
                                    <?php for($i=1; $i <= 31 ; $i++): ?>
                                    <option value="<?php echo e($i < 10 ? '0'.$i: $i); ?>"><?php echo e($i < 10 ? '0'.$i: $i); ?></option>
                                    <?php endfor; ?>
                                </select>
                                </div>
                                <div class="col-md-2">
                                  <select name="bln" id="" class="form-control">
                                    <?php
                                    $bln = array('','Januari','Febuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                    ?>
                                    <?php for($i=1; $i <= 12 ; $i++): ?>
                                    <option value="<?php echo e($i < 10 ? '0'.$i: $i); ?>"><?php echo e($bln[$i]); ?></option>
                                    <?php endfor; ?>
                                </select>
                                </div>
                                <div class="col-md-2">
                                  <select name="thn" id="" class="form-control">
                                    <?php for($i=date("Y"); $i >= 1965 ; $i--): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
                                </div>
    
                                <?php if($errors->has('tgl')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('tgl')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('jk') ? ' has-error' : ''); ?>">
                            <label for="jk" class="col-md-4 control-label">Jenis Kelamin</label>

                            <div class="col-md-6">
                                <input type="radio" name="jk" value="L"> Laki-Laki <input type="radio" name="jk" value="P"> Perempuan
    
                                <?php if($errors->has('jk')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('jk')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php echo e($errors->has('jabatan') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Jabatan</label>

                            <div class="col-md-6">
                            <a style="cursor:pointer" onclick="tambah_jab()"><strong><u>Tambah Jabatan</u></strong></a> | <a style="cursor:pointer" id="list-jab" data-toggle="modal" data-target=".jabatan"><strong><u>Hapus Jabatan</u></strong></a>
                                <select name="jabatan" id="" class="form-control">
                                    <?php foreach($jabs as $jab): ?>
                                    <option value="<?php echo e($jab->id); ?>"><?php echo e($jab->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
    
                                <?php if($errors->has('jabatan')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('jabatan')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('status_pg') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Status Pegawai</label>

                            <div class="col-md-6">
                            <a style="cursor:pointer" onclick="tambah_st()"><strong><u>Tambah Status</u></strong></a> | <a style="cursor:pointer" id="list-st" data-toggle="modal" data-target=".status"><strong><u>Hapus Status</u></strong></a>
                                <select name="status_pg" id="" class="form-control">
                                    <?php foreach($stats as $st): ?>
                                    <option value="<?php echo e($st->id); ?>"><?php echo e($st->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
    
                                <?php if($errors->has('status_pg')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('status_pg')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('status_pr') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Status Pernikahan</label>
                            <div class="col-md-6">
                                <select  class="form-control pull-left active" name="status_pr">
                                <?php foreach($stat_pr as $stat): ?>
                                    <option value="<?php echo e($stat->id); ?>"><?php echo e($stat->name); ?></option>
                                <?php endforeach; ?>
                                </select>
    
                                <?php if($errors->has('status_pr')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('status_pr')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('anak') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Jumlah Anak</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control pull-left active" name="anak">
    
                                <?php if($errors->has('anak')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('anak')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('last_pd') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Pendidikan Terakhir</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control pull-left active" name="last_pd">
    
                                <?php if($errors->has('last_pd')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('last_pd')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('grade') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Grade</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control pull-left active" name="grade">
    
                                <?php if($errors->has('grade')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('grade')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('cabang') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Kantor Cabang</label>

                            <div class="col-md-6">
                            <a style="cursor:pointer" onclick="tambah_cabang()"><strong><u>Tambah Cabang</u></strong></a> | <a style="cursor:pointer" id="list-tag" data-toggle="modal" data-target=".cabang"><strong><u>Hapus Cabang</u></strong></a>
                                <select name="cabang" id="" class="form-control">
                                    <?php foreach($cabs as $jab): ?>
                                    <option value="<?php echo e($jab->id); ?>"><?php echo e($jab->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
    
                                <?php if($errors->has('cabang')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('cabang')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('cuti') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Jatah Cuti</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                  <input type="text" class="form-control pull-left active" placeholder="Jumlah Hari Cuti" id="reservation" required="1" name="cuti" value="10">
                                  <div class="input-group-addon">
                                    Hari
                                  </div>
                                </div>
    
                                <?php if($errors->has('cuti')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('cuti')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('alamat') ? ' has-error' : ''); ?>">
                            <label for="alamat" class="col-md-4 control-label">Alamat Lengkap</label>

                            <div class="col-md-6">
                                <textarea name="alamat" id="" rows="3" class="form-control"><?php echo e(old('alamat')); ?></textarea>
    
                                <?php if($errors->has('alamat')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('alamat')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- <div class="form-group<?php echo e($errors->has('gapok') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">Gaji Pokok</label>
                        
                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="gapok" value="0" placeholder="0">
                        
                                <?php if($errors->has('gapok')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('gapok')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('tunjab') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">Tunjangan Jabatan</label>
                        
                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="tunjab" value="0"  placeholder="0">
                        
                                <?php if($errors->has('tunjab')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('tunjab')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('tunkel') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">Tunjangan Keluarga</label>
                        
                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="tunkel" value="0" placeholder="0">
                        
                                <?php if($errors->has('tunkel')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('tunkel')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('dplk') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">DPLK</label>
                        
                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="dplk" value="0" placeholder="0">
                        
                                <?php if($errors->has('dplk')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('dplk')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('pensiun') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">Pensiun</label>
                        
                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="pensiun" value="0" placeholder="0">
                        
                                <?php if($errors->has('pensiun')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('pensiun')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('bpjs_kes') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">BPJS Kesehatan</label>
                        
                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="bpjs_kes" value="0" placeholder="0">
                        
                                <?php if($errors->has('bpjs_kes')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('bpjs_kes')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('bpjs_tk') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">BPJS Tenaga kerja</label>
                        
                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="bpjs_tk" value="0" placeholder="0">
                        
                                <?php if($errors->has('bpjs_tk')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('bpjs_tk')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('um') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">Uang Makan</label>
                        
                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="um" value="0" placeholder="0">
                        
                                <?php if($errors->has('um')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('um')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('transport') ? ' has-error' : ''); ?>">
                            <label for="ktp" class="col-md-4 control-label">Transport</label>
                        
                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="transport" value="0" placeholder="0">
                        
                                <?php if($errors->has('transport')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('transport')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Daftar
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
         
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Tag Modal Cabang -->
<div class="modal fade bs-example-modal-sm cabang" tabindex="-1" role="dialog" aria-labelledby="tag-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#FFF">&times;</span> <small style="color:#FFF">tutup</small></button>
    </div>
    <div class="modal-content">
      <div class="container">
      <div class="col-sm-3">
        <table class="table">
        <tr>
          <th width="180px">Nama Cabang</th>
          <th>Aksi</th>
        </tr>
        <?php foreach($cabs as $tag): ?>
        <tr>
          <td><?php echo e($tag->name); ?></td>
          <td align="right"><a value="<?php echo e($tag->id); ?>" style="cursor:pointer" onclick="hapus_tag(<?php echo e($tag->id); ?>)">Hapus <i class="fa fa-trash"></i></a></td>
        </tr>
        <?php endforeach; ?>
      </table>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- Tag Modal  Jabatan-->
<div class="modal fade bs-example-modal-sm jabatan" id="list-jab" tabindex="-1" role="dialog" aria-labelledby="tag-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#FFF">&times;</span> <small style="color:#FFF">tutup</small></button>
    </div>
    <div class="modal-content">
      <div class="container">
      <div class="col-sm-3">
        <table class="table">
        <tr>
          <th width="180px">Nama Jabatan</th>
          <th>Aksi</th>
        </tr>
        <?php foreach($jabs as $jab): ?>
        <tr>
          <td><?php echo e($jab->name); ?></td>
          <td align="right"><a value="<?php echo e($jab->id); ?>" style="cursor:pointer" onclick="hapus_jab(<?php echo e($jab->id); ?>)">Hapus <i class="fa fa-trash"></i></a></td>
        </tr>
        <?php endforeach; ?>
      </table>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- Tag Modal  Status-->
<div class="modal fade bs-example-modal-sm status" id="list-st" tabindex="-1" role="dialog" aria-labelledby="st-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#FFF">&times;</span> <small style="color:#FFF">tutup</small></button>
    </div>
    <div class="modal-content">
      <div class="container">
      <div class="col-sm-3">
        <table class="table">
        <tr>
          <th width="180px">Nama Status</th>
          <th>Aksi</th>
        </tr>
        <?php foreach($stats as $st): ?>
        <tr>
          <td><?php echo e($st->name); ?></td>
          <td align="right"><a value="<?php echo e($st->id); ?>" style="cursor:pointer" onclick="hapus_st(<?php echo e($st->id); ?>)">Hapus <i class="fa fa-trash"></i></a></td>
        </tr>
        <?php endforeach; ?>
      </table>
      </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::to('dist/sweetalert.min.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bottom-script'); ?>
<script>
    function tambah_cabang(){
        swal({
            title: "Tambah Cabang",
            text: "Ketikan nama cabang di bawah ini:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            showLoaderOnConfirm: true,
          },
          function(tag){
            if (tag === false) return false;
            
            if (tag === "") {
              swal.showInputError("Kolom masih kosong!");
              return false
            }
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "<?php echo e(route('cabang.add')); ?>",
                data : { name : tag, _token : "<?php echo e(csrf_token()); ?>"},
                success: function(msg){
                    if (msg == '1') {
                      swal({
                        timer: 2000,
                        title : "Disimpan!",
                        text : "Cabang telah ditambahkan.",
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
            /*swal("Nice!", "You wrote: " + inputValue, "success");*/
          });
}
function hapus_tag(id){
          window.tagID = id;
          swal({
            title: "Hapus Cabang Ini ?",
            text: "Semua Karyawan Terkait Juga Akan Terhapus!",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
          },
          function(){
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "<?php echo e(route('cabang.del')); ?>",
                data : { id : window.tagID, _token : "<?php echo e(csrf_token()); ?>"},
                success: function(msg) {
                    if (msg == '0') {
                      swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
                    } else if (msg == '1') {
                      swal("Berhasil!", "Cabang & Karyawan Terkait telah dihapus.", "success");
                    } else {
                      swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
                    }
                     location.reload();
                }
              });
            }, 2000);
          });
}
function tambah_jab ()
{
    swal({
            title: "Tambah Jabatan",
            text: "Ketikan nama jabatan di bawah ini:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            showLoaderOnConfirm: true,
          },
          function(tag){
            if (tag === false) return false;
            
            if (tag === "") {
              swal.showInputError("Kolom masih kosong!");
              return false
            }
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "<?php echo e(route('jabatan.add')); ?>",
                data : { name : tag, _token : "<?php echo e(csrf_token()); ?>"},
                success: function(msg){
                    if (msg == '1') {
                      swal({
                        timer: 2000,
                        title : "Disimpan!",
                        text : "Jabatan telah ditambahkan.",
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
            /*swal("Nice!", "You wrote: " + inputValue, "success");*/
          });
}
function hapus_jab(id){
          window.jabID = id;
          swal({
            title: "Hapus Jabatan Ini ?",
            text: "",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
          },
          function(){
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "<?php echo e(route('jabatan.del')); ?>",
                data : { id : window.jabID, _token : "<?php echo e(csrf_token()); ?>"},
                success: function(msg) {
                    if (msg == '0') {
                      swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
                    } else if (msg == '1') {
                      swal("Berhasil!", "Jabatan telah dihapus.", "success");
                    } else {
                      swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
                    }
                     location.reload();
                }
              });
            }, 2000);
          });
}
// Status
function tambah_st ()
{
    swal({
            title: "Tambah Status",
            text: "Ketikan status di bawah ini:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            showLoaderOnConfirm: true,
          },
          function(tag){
            if (tag === false) return false;
            
            if (tag === "") {
              swal.showInputError("Kolom masih kosong!");
              return false
            }
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "<?php echo e(route('status.add')); ?>",
                data : { name : tag, _token : "<?php echo e(csrf_token()); ?>"},
                success: function(msg){
                    if (msg == '1') {
                      swal({
                        timer: 2000,
                        title : "Disimpan!",
                        text : "Status telah ditambahkan.",
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
            /*swal("Nice!", "You wrote: " + inputValue, "success");*/
          });
}
function hapus_st(id){
          window.stID = id;
          swal({
            title: "Hapus Status Ini ?",
            text: "",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
          },
          function(){
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "<?php echo e(route('status.del')); ?>",
                data : { id : window.stID, _token : "<?php echo e(csrf_token()); ?>"},
                success: function(msg) {
                    if (msg == '0') {
                      swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
                    } else if (msg == '1') {
                      swal("Berhasil!", "Status telah dihapus.", "success");
                    } else {
                      swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
                    }
                     location.reload();
                }
              });
            }, 2000);
          });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>