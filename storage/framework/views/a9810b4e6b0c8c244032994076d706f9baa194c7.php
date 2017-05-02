<?php $__env->startSection('title','POTONGAN GAJI KARYAWAN'); ?>
<?php $__env->startSection('content'); ?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <?php
           $no=1;
          ?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                  <strong>POTONGAN GAJI KARYAWAN :</strong>
                  <select id="opsiCab">
                      <option value="all">Semua Kantor</option>
                      <?php foreach($cabangs as $cab): ?>
                        <?php
                        if ($get_opsi == $cab->id) {
                            $select = "SELECTED";
                        } else {
                            $select = "";
                        }
                        ?>
                        <option value="<?php echo e($cab->id); ?>"<?php echo e($select); ?>><?php echo e($cab->name); ?></option>
                      <?php endforeach; ?>
                  </select>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th width="10vh" rowspan="2" align="">No</th>
                  <th rowspan="2">Kode Karyawan</th>
                  <th rowspan="2">Nama Karyawan</th>
                  <th rowspan="2">KASBON</th>
                  <th rowspan="2">ANGSURAN</th>
                  <th rowspan="2">SIMWA</th>
                  <th rowspan="2">BPJS</th>
                  <th rowspan="2">ARISAN</th>
                  <th rowspan="2">ZIS</th>
                  <th colspan="4" style="text-align:center">LAINNYA</th>
                  <th rowspan="2" align="center">Aksi</th>
                </tr>
                <tr>
                  <th>DONASI</th>
                  <th>VIPM</th>
                  <th>QH</th>
                  <th>DPLK</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                  <td><?php echo e($no++); ?></td>
                  <td><b><?php echo e($user->karyawan_id); ?></b></td>
                  <td><a href="<?php echo e(route('karyawan.edit', ['id' => $user->id])); ?>"><?php echo e($user->detail->nama); ?></a></td>
                  <td><?php echo e(rupiah($user->potongan->kasbon)); ?></td>
                  <td><?php echo e(rupiah($user->potongan->angs)); ?></td>
                  <td><?php echo e(rupiah($user->potongan->simwa)); ?></td>
                  <td><?php echo e(rupiah($user->potongan->bpjs)); ?></td>
                  <td><?php echo e(rupiah($user->potongan->arisan)); ?></td>
                  <td><strong><u><?php echo e($user->potongan->zis); ?>%</u></strong></td>
                  <td><i><?php echo e(rupiah($user->potongan->donasi)); ?></i></td>
                  <td><i><?php echo e(rupiah($user->potongan->vipm)); ?></i></td>
                  <td><i><?php echo e(rupiah($user->potongan->qh)); ?></i></td>
                  <td><i><?php echo e(rupiah($user->potongan->dplk)); ?></i></td>
                  <td align="center">
                  <button class="btn btn-primary" onclick="editGaji('<?php echo e($user->potongan->id); ?>','<?php echo e($user->potongan->kasbon); ?>','<?php echo e($user->potongan->angs); ?>','<?php echo e($user->potongan->simwa); ?>','<?php echo e($user->potongan->bpjs); ?>','<?php echo e($user->potongan->arisan); ?>','<?php echo e($user->potongan->zis); ?>', '<?php echo e($user->potongan->donasi); ?>', '<?php echo e($user->potongan->vipm); ?>', '<?php echo e($user->potongan->qh); ?>', '<?php echo e($user->potongan->dplk); ?>')">Edit</button>
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
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span></button>
      <h4 class="modal-title">UBAH DATA GAJI</h4>
    </div>
    <div class="modal-body">
     
        <div class="box-body">
        
        <input type="hidden" name="user_id" id="user_id">
          <div class="form-group">
          
          <div class="form-group">
          <label for="">KASBON</label>
          <input type="number" class="form-control pull-right" placeholder="Gaji Pokok" id="kasbon" required="1" name="kasbon">
          </div>
          <div class="form-group">
          <label for="">ANGSURAN</label>
          <input type="number" class="form-control pull-right" name="angs" id="angs" required="1">
          </div>
          <div class="form-group">
          <label for="">SIMPANAN WAJIB</label>
          <input type="number" class="form-control pull-right" name="simwa" id="simwa" required="1">
          </div>
          <div class="form-group">
          <label for="">BPJS</label>
          <input type="number" class="form-control pull-right" name="bpjs" id="bpjs" required="1">
          </div>
          <div class="form-group">
          <label for="">ARISAN</label>
          <input type="number" class="form-control pull-right" name="arisan" id="arisan" required="1">
          </div>
          <div class="form-group">
          <label for="">ZIS</label>
          <div class="input-group date">
            <input type="float" class="form-control pull-left active" id="zis" required="1" name="zis">
            <div class="input-group-addon">
              %
            </div>
          </div>
          </div>
          <div class="form-group">
          <label for="">DONASI</label>
          <input type="number" class="form-control pull-right" name="donasi" id="donasi" required="1">
          </div>
         <div class="form-group">
          <label for="">VIPM</label>
          <input type="number" class="form-control pull-right" name="vipm" id="vipm" required="1">
          </div>
          <div class="form-group">
          <label for="">QH</label>
          <input type="number" class="form-control pull-right" name="qh" id="qh" required="1">
          </div>
          <div class="form-group">
          <label for="">DPLK</label>
          <input type="number" class="form-control pull-right" name="dplk" id="dplk" required="1">
          </div>
          </div>
          <div class="info">
            <ul id="info">
              
            </ul>
        </div>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">BATAL</button>
      <button class="btn btn-primary" type="submit" id="btnSave">SIMPAN</button>
    
      <!-- <button class="btn btn-success" id="proses-posting">VALIDASI</button> -->
    </div>
  </div>
  <!-- /.modal-content -->
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
   function editGaji(user_id, kasbon, angs,simwa,bpjs,arisan,zis,donasi, vipm, qh, dplk){
        var user_id = $('#user_id').val($.trim(user_id));
        var kasbon = $('#kasbon').val($.trim(kasbon));
        var angs = $('#angs').val($.trim(angs));
        var simwa = $('#simwa').val($.trim(simwa));
        var bpjs = $('#bpjs').val($.trim(bpjs));
        var arisan = $('#arisan').val($.trim(arisan));
        var zis = $('#zis').val($.trim(zis));
        var donasi = $('#donasi').val($.trim(donasi));
        var vipm = $('#vipm').val($.trim(vipm));
        var qh = $('#qh').val($.trim(qh));
        var dplk = $('#dplk').val($.trim(dplk));
       

        $('#modal-edit').modal('show');
   }
   function saveGaji(user_id, kasbon, angs,simwa,bpjs,arisan,zis,donasi, vipm, qh, dplk){
       $.ajax({
           url: '<?php echo e(url('potongan/edit')); ?>',
           type: 'POST',
           data: {_token: '<?php echo e(csrf_token()); ?>',
                    user_id: user_id,
                    kasbon: kasbon,
                    angs: angs,
                    simwa: simwa,
                    bpjs: bpjs,
                    arisan: arisan,
                    zis: zis,
                    donasi : donasi,
                    vipm : vipm,
                    qh : qh,
                    dplk : dplk
                   },
            success: function(msg){
              console.log(msg);
                if (msg == 1) {
                    var result = "Berhasil Disimpan";
                } else {
                    var result = "Gagal Menyimpan! Silahkan Hubungi Administrator.";
                }
                alert(result);
                location.reload();
            }
       });
       
   }
</script>
<script>

    $(function() {
        
        $('#btnSave').click(function(event) {
          $('#btnSave').prop('disabled', true);
            var user_id = $('#user_id').val();
            var kasbon = $('#kasbon').val();
            var angs = $('#angs').val();
            var simwa = $('#simwa').val();
            var bpjs = $('#bpjs').val();
            var arisan = $('#arisan').val();
            var zis = $('#zis').val();
            var donasi = $('#donasi').val();
            var vipm = $('#vipm').val();
            var qh = $('#qh').val();
            var dplk = $('#dplk').val();
            if (kasbon.length === 0 || angs.length === 0 || simwa.length === 0 || bpjs.length === 0 || arisan.length === 0 || zis.length === 0 || donasi.length === 0 || vipm.length === 0 || qh.length === 0 || dplk.length === 0 ){
                alert("SEMUA KOLOM WAJID DI ISI!");
                $('#btnSave').prop('disabled', false);
                return;
            }

            saveGaji(user_id, kasbon, angs,simwa,bpjs,arisan,zis,donasi, vipm, qh, dplk);
            //location.reload();
        });
        $('#opsiCab').change(function(event) {
            var opsi = $('#opsiCab').val();
            document.location = '<?php echo e(url('potongan?opsi=')); ?>' + opsi;
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>