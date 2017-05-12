<?php $__env->startSection('title','Posting Absensi'); ?>
<?php $__env->startSection('content'); ?>

  <section class="content">
  <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
          <div class="form-group">
          <label for="">PILIH BULAN</label>
          <select name="bulan" id="bulan" class="form-control pull-right">
            <?php foreach($bulan as $bln): ?>
              <option value="<?php echo e($bln->bulan_id); ?>"><?php echo e($bln->nama_bln); ?></option>
            <?php endforeach; ?>
          </select>
          <div class="form-group">
          <label for="">MASUKAN TANGGAL (format: mm/dd/yyyy. Cth: 12/27/2017)</label>
          <input type="text" class="form-control pull-right" placeholder="Cth: 07/04/2016 - 10/04/2016" id="tgl-absen" required="1" name="tgl-absen">
          </div>
          <div class="form-group">
          <label for="">POSTING UNTUK</label>
          <select name="user" id="user" class="form-control pull-right">
            <option value="all">Semua Karyawan</option>
            <?php foreach($users as $user): ?>
              <option value="<?php echo e($user->id); ?>"><?php echo e($user->detail->nama); ?> -- <b><?php echo e($user->karyawan_id); ?></option>
            <?php endforeach; ?>
          </select>
          </div>
          
          </div>
          <div class="info">
           <img src="<?php echo e(url('loading.svg')); ?>" style="display: none;" id="loader">
            <ul id="info">
              
            </ul>
        </div>
            <!-- /.box-body -->
          </div>
          <div class="box-footer">
            <button class="btn btn-success" id="proses-posting">VALIDASI</button>
            <button class="btn btn-primary" id="simpan-posting" disabled="1">POSTING</button>
            &nbsp;&nbsp;&nbsp;<span id="conf_null" style="display: none;"><input type="checkbox" id="check_null"> Abaikan Absensi Kosong</span>
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
    $('#tgl-absen').daterangepicker();
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
function refresh(user_id){
  var id = user_id;
  $('#btnRefresh').html("Processing..");
  $('#btnRefresh').prop('disabled', true);
  $('#rfStatus').show('1000');
  $.ajax({
    url: '<?php echo e(route('refresh.absen')); ?>',
    type: 'POST',
    data: {_token: '<?php echo e(csrf_token()); ?>', act: 'refresh', user_id: id},
    success: function(data){
        var msg = $.parseJSON(data);
        // Parsing data
        $(msg).each(function(index, el) {
            // tampilkan
            var type = el.type;
            var message = el.message;
            $('#rfMessage').html("<strong>"+type+"</strong> : "+message);
            
        });
    }
  })
  .done(function() {
    $('#btnRefresh').html("<i class='fa fa-refresh'></i> Refresh selesai");
    $('#btnRefresh').prop('disabled', false);
    $('#rfStatus').hide('1000');
    reload_interval(2000);
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  
}
function reload_interval(time){
  setInterval(function(){
                
                   location.reload();
                  }, time);
}
function p_awal(){
    $('#proses-posting').html("Memproses..");
    $('#info').html("Sedang memproses mohon tunggu..");
    $('#loader').show('1000');
    $('#proses-posting').prop("disabled", true);
    $('body').css('cursor', 'progress');
}
function p_akhir(){
  $('#loader').hide('1000');
  $('#proses-posting').html("Proses");
  $('#proses-posting').prop("disabled", false);
  $('body').css('cursor', 'default');
}
  var user_id = $.trim(user_id);
  var gapok = $.trim(gapok);
  var u_makan = $.trim(u_makan);
  var u_transport = $.trim(u_transport);
/*cek posting*/
  $('#proses-posting').click(function(){
    if ($('#tgl-absen').val() == '') {
      alert("Silahkan pilih tanggal priode!");
      return;
    }
    p_awal();
    var tgl = $('#tgl-absen').val();
    var user = $('#user').val();
    // Kirim Data POST dengan AJAX
    $.ajax({
      url: '/rekap-gaji/posting_all',
      type: 'POST',
      data: {_token: '<?php echo e(csrf_token()); ?>',
             
              act: 'cek',
              tgl: tgl,
              user : user},
      success : function(data){
        /*var result = jQuery.parseJSON(msg);*/
        var msg = $.parseJSON(data);
        // Parsing data
        $(msg).each(function(index, el) {
            // tampilkan
            var null_data = el.null_data;
            var status = el.status;
            var type = el.contents.type;
            var message = el.contents.message;
            $('#info').html("<strong>"+type+"</strong> : "+message);
            //alert(status);
            if (null_data  > 0) {
              $('#conf_null').show('1000');
              $('#check_null').click(function(event) {
                $('#simpan-posting').prop("disabled", false);
              });
            }
            if (status == 0 && null_data == 0) {
              $('#simpan-posting').prop("disabled", false);
            }
              p_akhir();
        });
       
      }
    });
    
  });
  /*simpan posting*/
  $('#simpan-posting').click(function(){
    if ($('#tgl-absen').val() == '') {
      alert("Silahkan pilih tanggal priode!");
      return;
    }
    p_awal();
    var tgl = $('#tgl-absen').val();
    var bln = $('#bulan').val();
    var user = $('#user').val();
    // Kirim Data POST dengan AJAX
    $.ajax({
      url: '/rekap-gaji/posting_all',
      type: 'POST',
      data: {_token: '<?php echo e(csrf_token()); ?>',
              act: 'post',
              tgl: tgl,
              bln : bln,
              user : user
              },
      success : function(data){
        /*var result = jQuery.parseJSON(msg);*/
        var msg = $.parseJSON(data);
        // Parsing data
        $(msg).each(function(index, el) {
            // tampilkan
            var null_data = el.null_data;
            var status = el.status;
            var save = el.save;
            var type = el.contents.type;
            var message = el.contents.message;
            $('#info').html("<strong>"+type+"</strong> : "+message);
            if (save > 0 ) {
              // enable tombol simpan
              $('#simpan-posting').prop("disabled", true);
              $('#conf_null').hide('1000');
              alert("Berhasil disimpan");
              reload_interval(2000);
            } else {
              alert("Gagal Menyimpan");
              $('#simpan-posting').prop("disabled", false);
            }
              p_akhir();
        });
       
      }
    })
    .done(function() {
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    });
    
  });


</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.masbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>