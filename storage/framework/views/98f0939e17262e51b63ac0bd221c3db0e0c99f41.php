<?php $__env->startSection('title','Edit Data Karyawan'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <?php
           $no=1;
          ?>
          <a href="<?php echo e(route('absen.detail', ['id' => $user->id])); ?>" class="btn btn-success btn-flat"><i class="fa fa-calendar-o"></i> Lihat Absensi</a>
         <?php if(Auth::user()->level == 'hrd'): ?>
          <a href="<?php echo e(route('rekap.list', ['id' => $user->id])); ?>" class="btn btn-warning  btn-flat"><i class="fa fa-book"></i> Rekap Absensi</a>
         <?php endif; ?>
          <br/><br/>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data karyawan</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

              <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('karyawan.edit-post', ['id' => $user->id])); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-3">
              <a href="#" class="thumbnail">
                <img src="<?php echo e(url($pathPhoto."/".$user->detail->foto)); ?>" alt="Foto" id="thumb_foto">
              </a>
            </div>
                        </div>
                        <?php if(count($errors->all()) > 0): ?>
                        <div class="form-group">
                        <ul>
                            <?php foreach($errors->all() as $error): ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <div class="form-group<?php echo e($errors->has('foto') ? ' has-error' : ''); ?>">
                            <label for="foto" class="col-md-4 control-label">Foto</label>

                            <div class="col-md-6">
                                <input type="file" name="foto">
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Alamat E-mail</label>

                            <div class="col-md-6">
                                <strong class="form-control"><?php echo e($user->email); ?></strong>
                            </div>
                        </div>
                        <?php if(Auth::user()->level == 'hrd'): ?>
                        <div class="form-group <?php echo e($errors->has('level') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Level</label>

                            <div class="col-md-6">
                                <select name="level" id="" class="form-control">
                                    <option value="user" <?php echo e($user->level == 'user' ? "SELECTED": ''); ?>>Karyawan</option>
                                    <option value="admin" <?php echo e($user->level == 'admin' ? "SELECTED": ''); ?>>Admin</option>
                                    <option value="pc" <?php echo e($user->level == 'pc' ? "SELECTED": ''); ?>>Pimpinan Cabang</option>
                                    <option value="hrd" <?php echo e($user->level == 'hrd' ? "SELECTED": ''); ?>>HRD</option>
                                </select>
    
                                <?php if($errors->has('level')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('level')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password"  class="col-md-4 control-label">Katasandi</label>

                            <div class="col-md-6">
                                <strong><a id="ubah_pwd" style="cursor:pointer;" data-toggle="modal" data-target="#modal-add">Ubah Katasandi</a></strong>
                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Nama Lengkap</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e($user->detail->nama); ?>">

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
                                <input id="ktp" type="text" class="form-control" name="ktp" value="<?php echo e($user->detail->ktp); ?>">

                                <?php if($errors->has('ktp')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('ktp')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('telp') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Nomor Hp</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control pull-left active" placeholder="Cth: 0812322121" id="reservation" name="telp" value="<?php echo e($user->detail->telp); ?>">
    
                                <?php if($errors->has('telp')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('telp')); ?></strong>
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
                                    <?php
                                    if ($i < 10) {
                                        $angka = '0'.$i;
                                    } else {
                                        $angka = $i;
                                    }
                                    ?>
                                    <option value="<?php echo e($angka); ?>" <?php echo e($angka == $tgl[2] ? "SELECTED" : ''); ?>><?php echo e($angka); ?></option>
                                    <?php endfor; ?>
                                </select>
                                </div>
                                <div class="col-md-2">
                                  <select name="bln" id="" class="form-control">
                                    <?php
                                    $bln = array('','Januari','Febuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                    ?>
                                    <?php for($i=1; $i <= 12 ; $i++): ?>
                                    <?php
                                    if ($i < 10) {
                                        $angka = '0'.$i;
                                    } else {
                                        $angka = $i;
                                    }
                                    ?>
                                    <option value="<?php echo e($angka); ?>" <?php echo e($angka == $tgl[1] ? "SELECTED" : ''); ?>><?php echo e($bln[$i]); ?></option>
                                    <?php endfor; ?>
                                </select>
                                </div>
                                <div class="col-md-2">
                                  <select name="thn" id="" class="form-control">
                                    <?php for($i=date("Y"); $i >= 1965 ; $i--): ?>
                                    <option value="<?php echo e($i); ?>" <?php echo e($i == $tgl[0] ? "SELECTED": ''); ?>><?php echo e($i); ?></option>
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
                                <input type="radio" name="jk" value="L" <?php echo e($user->detail->jk == 'L' ? "CHECKED": ''); ?>> Laki-Laki <input type="radio" name="jk" value="P" <?php echo e($user->detail->jk == 'P' ? "CHECKED": ''); ?>> Perempuan
    
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
                                    <option value="<?php echo e($jab->id); ?>" <?php echo e($jab->id == $user->detail->jabatan_id ? "SELECTED": ''); ?>><?php echo e($jab->name); ?></option>
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
                                    <option value="<?php echo e($st->id); ?>" <?php echo e($st->id == $user->detail->status_id ? "SELECTED": ''); ?>><?php echo e($st->name); ?></option>
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
                                    <option value="<?php echo e($stat->id); ?>" <?php echo e($stat->id == $user->detail->status_pr_id ? "SELECTED": ''); ?>><?php echo e($stat->name); ?></option>
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
                                <input type="number" class="form-control pull-left active" name="anak" value="<?php echo e($user->detail->anak); ?>">
    
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
                                <input type="text" class="form-control pull-left active" name="last_pd" value="<?php echo e($user->detail->last_pd); ?>">
    
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
                                <input type="text" class="form-control pull-left active" name="grade" value="<?php echo e($user->detail->grade); ?>">
    
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
                                    <option value="<?php echo e($jab->id); ?>" <?php echo e($jab->id == $user->cabang_id ? "SELECTED": ''); ?>><?php echo e($jab->name); ?></option>
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
                                  <input type="text" class="form-control pull-left active" placeholder="Jumlah Hari Cuti" id="reservation" required="1" name="cuti" value="<?php echo e($user->cuti->qty); ?>">
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
                                <textarea name="alamat" id="" rows="3" class="form-control"><?php echo e($user->detail->alamat); ?></textarea>
    
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
                                <input id="ktp" type="text" class="form-control" name="gapok" value="<?php echo e($user->gaji->gapok); ?>" placeholder="0">
                        
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
                                <input id="ktp" type="text" class="form-control" name="tunjab" value="<?php echo e($user->gaji->tunjab); ?>"  placeholder="0">
                        
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
                                <input id="ktp" type="text" class="form-control" name="tunkel" value="<?php echo e($user->gaji->tunkel); ?>" placeholder="0">
                        
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
                                <input id="ktp" type="text" class="form-control" name="dplk" value="<?php echo e($user->gaji->dplk); ?>" placeholder="0">
                        
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
                                <input id="ktp" type="text" class="form-control" name="pensiun" value="<?php echo e($user->gaji->pensiun); ?>" placeholder="0">
                        
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
                                <input id="ktp" type="text" class="form-control" name="bpjs_kes" value="<?php echo e($user->gaji->bpjs_kes); ?>" placeholder="0">
                        
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
                                <input id="ktp" type="text" class="form-control" name="bpjs_tk" value="<?php echo e($user->gaji->bpjs_tk); ?>" placeholder="0">
                        
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
                                <input id="ktp" type="text" class="form-control" name="um" value="<?php echo e($user->gaji->um); ?>" placeholder="0">
                        
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
                                <input id="ktp" type="text" class="form-control" name="transport" value="<?php echo e($user->gaji->transport); ?>" placeholder="0">
                        
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
                                    <i class="fa fa-btn fa-user"></i> Simpan
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
      <!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span></button>
      <h4 class="modal-title">Rubah Katasandi</h4>
    </div>
    <div class="modal-body">
      <form role="form" enctype="multipart/form-data" method="post" action="<?php echo e(route('karyawan.gantipw')); ?>">
      <?php echo e(csrf_field()); ?>

      <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Katasandi Baru</label>
            <input class="form-control" name="password" type="password">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Ulangi Katasandi</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
          </div>
        </div>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      <button type="submit" class="btn btn-primary">Simpan</button></form>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
</div>
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
<!-- Modal Lihat Foto -->
<div class="modal fade thumb-foto" role="dialog" tabindex="-1" id="modal_foto">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="thumbnail">
                <img src="<?php echo e(url($pathPhoto."/".$user->detail->foto)); ?>" alt="Lembaga Keuangan Mikro Syariah Bisa Tingkatkan Ekonomi Masyarakat Miskin" id="thumb_foto" width="100%">
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
    $(document).ready(function() {
        $('#thumb_foto').click(function(event) {
            /* Act on the event */
            $('#modal_foto').modal('show');
        });
    });
</script>
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