@extends('layouts.masbar')
@section('title', 'Permohonan Cuti')
@section('content')
<div class="row">
  
  <div class="col-md-12">
    <!-- /.box -->
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Permohonan Cuti</h3>
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
            <th>Aksi</th>
          </tr>
          
          @foreach($cuti as $c_out)
          <?php
              $date_from = explode('/', $c_out->from);
              $from_out = $date_from[1].'/'.$date_from[0].'/'.$date_from[2];
              $date_to = explode('/', $c_out->to);
              $to_out = $date_to[1].'/'.$date_to[0].'/'.$date_to[2];
          ?>
          <tr>
            <td>{{$c_out->kode}}</td>
            <td>{{$c_out->user->name}}</td>
            <td>{{$c_out->user->detail->jabatan->name}}</td>
            <td>{{$c_out->qty}} Hari</td>
            <td>{{$from_out}}</td>
            <td>{{$to_out}}</td>
            <td><b><i>{{$c_out->jenisCuti->name}}</i></b></td>
            <td>{{$c_out->note}}</td>
            <td>
              @if($c_out->status == 3)
              <b class="btn btn-danger btn-block">Pending</b>
              @elseif($c_out->status == 2)
              <b class="btn btn-warning btn-block">ACC Pimpinan cabang</b>
              @elseif($c_out->status == 1)
              <b class="btn btn-success btn-block">ACC</b>
              @elseif($c_out->status == 0)
              <b class="btn btn-danger btn-block">Ditolak</b>
              @endif
            </td>
            <td>
              <button class="btn btn-warning acc-cuti" value="{{$c_out->id}}"><i class="fa fa-check-square-o"></i> ACC</button>
              <button class="btn btn-danger dec-cuti"  value="{{$c_out->id}}"><i class="fa fa-minus-square"></i> DEC</button>
              <button class="btn btn-success" onclick="cuti_open('{{$c_out->from}} - {{$c_out->to}}', '{{$c_out->id}}', '{{$c_out->user_id}}')"><i class="fa fa-refresh"></i> UBAH CUTI</button>
            </td>
          </tr>
          @endforeach
        </tbody></table>
      </div>
      <!-- /.box-body -->
      <!-- <div class="box-footer">
        Footer
      </div> -->
      
    </div>
    <!-- /.box -->
    @if(Auth::user()->level == 'pc' || Auth::user()->level == 'hrd')
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Cuti Disetujui</h3>
      </div>
      <div class="box-body  table-responsive">
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
            <th>Aksi</th>
          </tr>
          
          @foreach($cuti_ok as $c_out)
          <?php
              $date_from = explode('/', $c_out->from);
              $from_ok = $date_from[1].'/'.$date_from[0].'/'.$date_from[2];
              $date_to = explode('/', $c_out->to);
              $to_ok = $date_to[1].'/'.$date_to[0].'/'.$date_to[2];
          ?>
          <tr>
            <td>{{$c_out->kode}}</td>
            <td>
              <a href='{{ route('karyawan.edit', ['id' => $c_out->user_id]) }}' target="blank">{{$c_out->user->name}}</a>
            </td>
            <td>{{$c_out->user->detail->jabatan->name}}</td>
            <td>{{$c_out->qty}} Hari</td>
            <td>{{$from_ok}}</td>
            <td>{{$to_ok}}</td>
            <td><b><i>{{$c_out->jenisCuti->name}}</i></b></td>
            <td>{{$c_out->note}}</td>
            <td>
              @if($c_out->status == 4)
                <b class="btn btn-danger btn-block">Dibatalkan</b>
              @elseif($c_out->status == 3)
              <b class="btn btn-danger btn-flat">Pending</b>
              @elseif($c_out->status == 2)
              <b class="btn btn-warning btn-flat">ACC Pimpinan cabang</b>
              @elseif($c_out->status == 1)
              <b class="btn btn-warning btn-flat btn-block" style="">ACC</b>
              <a href="{{ route('cuti_out.batal', ['c_out_id' => $c_out->id]) }}" onClick="return confirm('Batalkan Cuti ?')" class="btn btn-danger btn-block btn-sm"  data-toggle="tooltip" data-placement="right" title="Klik untuk membatalkan cuti"><i class="glyphicon glyphicon-ban-circle"></i>  Batalkan Cuti</a>
              @elseif($c_out->status == 0)
              <b class="btn btn-danger btn-flat">Ditolak</b>
              @endif
            </td>
            <td>
              <button class="btn btn-default" onclick="javascript:wincal=window.open('{{route('cuti.print-cuti', ['id' => $c_out->id])}}','Lihat Data','width=990,height=500,scrollbars=1');" {{ ($c_out->status == 4)? "disabled": ""}}><i class="fa fa-print"></i> Print</button>
            </td>
          </tr>
          @endforeach
        </tbody></table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {!! $cuti_ok->links() !!}
      </div>
      
    </div>
    <!-- /.box -->
    @endif
    
    
  </div>
  <!-- /.col (left) -->
  
  <!-- /.col (right) -->
</div>

<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span></button>
      <h4 class="modal-title">Perbaharui Tanggal</h4>
    </div>
    <div class="modal-body">
     
        <div class="box-body">
          <div class="form-group">
          <input type="text" class="form-control pull-right" placeholder="Cth: 07/04/2016 - 10/04/2016" id="tgl-cuti" required="1" name="date">
          </div>
        </div>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      <button class="btn btn-primary" id="simpan-cuti">Simpan</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
</div>
@endsection
@section('script')
<script src="{{URL::to('dist/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{URL::to('dist/sweetalert.css')}}">
@endsection
@section('bottom-script')
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{URL::to('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{URL::to('admin/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{URL::to('admin/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- Page script -->
<script>
$(function () {
    //Date range picker
    $('#tgl-cuti').daterangepicker();
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
function cuti_open(tgl, id, user_id) {
  var old_tgl = $.trim(tgl);
  var id = $.trim(id);
  var user_id = $.trim(user_id);
  $('#tgl-cuti').val(old_tgl);
  $('#modal-edit').modal('show');
  $('#simpan-cuti').click(function(){
    var new_tgl = $('#tgl-cuti').val();
    $.ajax({
      type: "POST",
      url: "{{route('cuti.update')}}",
      data: {id: id, date: new_tgl, user_id: user_id, _token: '{{csrf_token()}}'},
      success: function(msg){
        if (msg.trim()  == 0) {
          swal({
            title: "Terjadi Kesalahan",
            type: "error",
            timer: 2000
          });
          location.reload();
        } else if (msg.trim() == 'over') {
          swal({
            title: "Melebihi kouta Cuti!",
            type: "warning"
          });
        } else {
          location.reload();
        }
      }
    });
  });
}
$(document).ready(function() {
$('.acc-cuti').click(function(){
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
url: "{{route('cuti.aksi')}}",
data : { act: 'acc', id : id, _token: "{{csrf_token()}}"},
success: function(msg) {
if (msg.trim() == '0') {
swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
} else if (msg.trim() == '1') {
swal("Berhasil!", "Permohonan Cuti Di ACC.", "success");
} else {
swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
}
location.reload();
}
});
}, 2000);
});
});
$('.dec-cuti').click(function(){
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
url: "{{route('cuti.aksi')}}",
data : { act: 'dec', id : id, _token: "{{csrf_token()}}"},
success: function(msg) {
if (msg.trim() == '0') {
swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
} else if (msg.trim() == '1') {
swal("Berhasil!", "Permohonan cuti telah di tolak.", "success");
} else {
swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
}
location.reload();
}
});
}, 2000);
});
});

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
url : "{{route('cuti.batal')}}",
data : { cuti_id : window.dataID, _token : "{{ csrf_token() }}"},
success: function(msg) {
if (msg.trim() == '0') {
swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
} else if (msg.trim() == '1') {
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
@endsection