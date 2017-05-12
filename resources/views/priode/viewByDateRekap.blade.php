@extends('layouts.masbar')
@section('title','Data Absensi')
@section('content')

  <section class="content">
  @include('includes.messages')
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">DETAIL ABSENSI : <strong><a href="{{route('karyawan.edit', ['edit' => $user->id])}}">{{$user->detail->nama}}</a> </strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10vh">No</th>
                  <th>Tanggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
                  <th>Jam Ijin</th>
                  <th>Jam Kembali</th>
                  <th>Total Jam Kerja</th>
                  <th>Total Menit Kerja</th>
                  <th width="100vh">Keterangan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $total_menit_kerja =  0;
                  $total_jam_kerja =  0;
                  $total_hari_kerja = 0;
                  ?>
                  @foreach($data_absen as $data)
                  @php
                  $total_menit_kerja += $data->menit_kerja;
                  $total_jam_kerja +=  $data->jam_kerja;
                  $total_hari_kerja++;
                  @endphp
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{toDate($data->tgl)}}</td>
                    <td>{{$data->jam_in}}</td>
                    <td>{{$data->jam_out}} @if(is_null($data->jam_out)) <i><strong>Belum Absen</strong></i> @endif</td>
                    <td>{{$data->out_ijin}} @if(is_null($data->out_ijin)) <i><strong>Belum Ijin</strong></i> @endif</td>
                    <td>{{$data->in_ijin}} @if(is_null($data->in_ijin)) <i><strong>Belum Ijin</strong></i> @endif</td>
                    <td><strong>{{$data->jam_kerja}}</strong> @if(is_null($data->jam_kerja)) <i><strong>-</strong></i> @endif Jam</td>
                    <td><strong>{{$data->menit_kerja}}</strong> @if(is_null($data->menit_kerja)) <i><strong>-</strong></i> @endif Menit</td>
                    <td>{{$data->kt_ijin}} @if(is_null($data->kt_ijin)) <i><strong>-</strong></i> @endif</td>
                    
                  </tr>
                  @endforeach
                  <tr style="background-color: #caef58">
                    <td colspan="4"></td>
                    <td><b>TOTAL</b></td>
                    <td><strong>{{$total_hari_kerja}} Hari</strong></td>
                    <td><strong>{{$total_jam_kerja}}</strong> Jam</td>
                    <td><strong>{{$total_menit_kerja}}</strong> Menit</td>
                    <td></td>
                  </tr>
                
                <!-- disini -->
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span></button>
      <h4 class="modal-title">KONFIRMASI SEBELUM POSTING</h4>
    </div>
    <div class="modal-body">
     
        <div class="box-body">
          <div class="form-group">
          <label for="">MASUKAN TANGGAL (format: mm/dd/yyyy. Cth: 12/27/2017)</label>
          <input type="text" class="form-control pull-right" placeholder="Cth: 07/04/2016 - 10/04/2016" id="tgl-absen" required="1" name="tgl-absen">
          </div>
          <div class="form-group">
          <label for="">GAJI POKOK</label>
          <input type="text" class="form-control pull-right" name="gapok" id="gapok" required="1">
          </div>
          <div class="form-group">
          <label for="">UANG MAKAN</label>
          <input type="text" class="form-control pull-right" name="u_makan" id="u_makan" required="1">
          </div>
          <div class="form-group">
          <label for="">UANG TRANSPORT</label>
          <input type="text" class="form-control pull-right" name="u_transport" id="u_transport" required="1">
          </div>
          </div>
          <div id="info">
            <ul>
              
            </ul>
        </div>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      <button class="btn btn-success" id="proses-posting">Proses</button>
      <button class="btn btn-primary" id="simpan-posting" disabled="1">Simpan</button>
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


</script>
@endsection

