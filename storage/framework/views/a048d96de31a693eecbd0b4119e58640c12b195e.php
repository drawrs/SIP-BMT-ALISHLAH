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
                        <div class="form-group <?php echo e($errors->has('cabang') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Kantor Cabang</label>

                            <div class="col-md-6">
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
                        <!-- <div class="form-group<?php echo e($errors->has('karyawan_id') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">ID Karyawan</label>
                        
                            <div class="col-md-6">
                                <input id="karyawan_id" type="text" class="form-control" name="karyawan_id" value="<?php echo e(old('karyawan_id')); ?>">
                        
                                <?php if($errors->has('karyawan_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('karyawan_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div> -->
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>