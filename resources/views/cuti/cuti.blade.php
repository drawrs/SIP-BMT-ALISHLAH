@extends('layouts.masbar')
@section('title', 'Cuti')
@section('content')
<div class="row">
  
  <div class="col-md-10">
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title">Informasi</h3>
      </div>
      <div class="box-body">
        <p>SISA CUTI SAYA : <b><i>{{$cuti->qty}} Hari</i></b></p>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <div class="col-md-10">
    
    @include('includes.messages')
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Tambah Pengajuan Cuti</h3>
      </div>
      <div class="box-body">
        <!-- Date -->
        <form action="{{route('cuti.add_temp')}}" method="post">
          {{csrf_field()}}
        <div class="form-group">
          <label>Jenis Cuti:</label>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-sort-alpha-asc"></i>
            </div>
            <select name="type" id="" class="form-control" required="1">
             
              @foreach($jenis_cuti as $jenis)
                @if($jenis->id == '0')
                   <option value="{{$jenis->id}}">{{$jenis->name}} (limit : {{$cuti->qty}} hari kerja)</option>
                @else
                  <option value="{{$jenis->id}}">{{$jenis->name}} (limit: {{$jenis->day_limit}} hari kerja)</option>
                @endif
                
              @endforeach
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
          
          
          @if(!empty($temp_cuti))
          @foreach($temp_cuti as $temp)
          <?php
              $date_from = explode('/', $temp->from);
              $from_temp = $date_from[1].'/'.$date_from[0].'/'.$date_from[2];
              $date_to = explode('/', $temp->to);
              $to_temp = $date_to[1].'/'.$date_to[0].'/'.$date_to[2];
          ?>
          <input type="hidden" value="{{$temp->id}}" name="id">
          <tr>
            <td>{{$temp->kode}}</td>
            <td>{{$temp->user->detail->nama}}</td>
            <td>{{$temp->user->detail->jabatan->name}}</td>
            <td>{{$temp->qty}} Hari</td>
            <td>{{$from_temp}}</td>
            <td>{{$to_temp}}</td>
            <td><strong><i>{{$temp->jenisCuti->name}}</i></strong></td>
            <td>{{$temp->note}}</td>
            <td><button value="{{$temp->id}}" class="btn btn-danger batal-cuti"><i class="fa fa-trash"></i></button></td>
          </tr>
          @endforeach
          @endif
        </tbody></table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <form action="{{route('cuti.send_temp')}}" method="POST">
            {{csrf_field()}}
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
          
          @foreach($cuti_out as $c_out)
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
                <b class="btn btn-primary btn-block">Pending</b>
              @elseif($c_out->status == 2)
                <b class="btn btn-success btn-block">Wait : HRD</b>
              @elseif($c_out->status == 1)
                <b class="btn btn-warning btn-block">ACC</b>
              @elseif($c_out->status == 0)
                <b class="btn btn-danger btn-block">Ditolak</b>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody></table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {!! $cuti_out->links() !!}
      </div>
      
    </div>
    <!-- /.box -->
    
    
    
  </div>
  <!-- /.col (left) -->
  <div class="col-md-4">
    
  </div>
  <!-- /.col (right) -->
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
                url : "{{route('cuti.batal')}}",
                data : { cuti_id : window.dataID, _token : "{{ csrf_token() }}"},
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
@endsection