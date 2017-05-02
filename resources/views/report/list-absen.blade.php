@extends('layouts.masbar')
@section('title', 'Laporan Absensi')
@section('content')
<div class="row">
  
<div class="col-md-8">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Tampilkan Laporan Absensi Berdasarkan</h3>
    </div>
    <form action="{{route('absen.print-report')}}" method="POST">
      {{csrf_field()}}
      <div class="box-body">
        <!-- radio -->
        <div class="form-group">
          <div class="checkbox icheck">
              <label>
                  <input type="checkbox" name="opsi[1]" value="all"> Tampilkan Semua
              </label>
          </div> 
        </div>
        <!-- radio -->
        <div class="form-group">
          <div class="checkbox icheck">
              <label>
                  <input type="checkbox" name="opsi[2]" value="date"> Berdasarkan Tanggal
              </label>
          </div> 
          <input type="text" class="form-control pull-right" placeholder="Cth: 07/04/2016 - 10/04/2016" id="reservation" name="date">
        </div>
        <div class="form-group">
          <label>
            <div class="checkbox icheck">
              <label>
                  <input type="checkbox" name="opsi[3]" value="name"> Berdasarkan Nama
              </label>
          </div> 
          </label>
          <select class="form-control select2" name="user" id="user" style="width: 100%;">
          </select>
        </div>
        <div class="form-group">
          <label>
            <div class="checkbox icheck">
              <label>
                  <input type="checkbox" name="opsi[4]" value="cabang"> Berdasarkan Kantor Cabang
              </label>
          </div> 
          </label>
          <select class="form-control select2 cabang" name="cabang" id="cabang" style="width: 100%;">
          </select>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
      <button type="submit" class="btn btn-default form-control pull-right"><i class="fa fa-print"></i> Tampilkan</button></form>
    </div>
  </div>
</div>
<!-- /.col (left) -->

</div>
@endsection
@section('script')
<script src="{{URL::to('dist/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{URL::to('dist/sweetalert.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{URL::to('admin/plugins/iCheck/all.css')}}">
   <!-- Select2 -->
  <link rel="stylesheet" href="{{URL::to('admin/plugins/select2/select2.min.css')}}">
@endsection
@section('bottom-script')
<!-- iCheck 1.0.1 -->
<!-- Select2 -->
<script src="{{URL::to('admin/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::to('admin/plugins/iCheck/icheck.min.js')}}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{URL::to('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{URL::to('admin/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{URL::to('admin/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script>
  $(function(){
    var datauser = [
        @foreach($users as $user)
        { id: {{$user->id}}, text: '[{{$user->karyawan_id}}] {{$user->detail->nama}}'},
        @endforeach];
        var datacabang = [
        @foreach($cabangs as $cabang)
        { id: {{$cabang->id}}, text: '{{$cabang->name}}'},
        @endforeach];
    //Initialize Select2 Elements
    $("#user").select2({
      data: datauser
    });
    $("#cabang").select2({
      data: datacabang
    });
    $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
            });
  //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
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
</script>
@endsection