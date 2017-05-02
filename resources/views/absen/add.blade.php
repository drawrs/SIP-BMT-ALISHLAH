@extends('layouts.masbar')
@section('title','Tambah Absensi')
@section('content')
  <section class="content">
      @include('includes.messages')
      @include('includes.errors')
      <div class="row">
        <div class="col-xs-12">

          <h4>Absensi : <strong>{{$user->detail->nama}}</strong></h4>
         
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Data Absen <strong></strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Taggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
                  <th>Jam Ijin</th>
                  <th>Jam Kembali</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                 <form action="{{route('absen.post-add', ['id' => $user->id])}}" method="POST">
                 {{csrf_field()}}
                  <tr>
                    <td><input type="text" class="form-control" name="tgl" placeholder="Cth: 15/05/2016" value="{{old('tgl')}}"></td>
                    <td><input type="text" name="jam_in" class="form-control" placeholder="Cth: 08:20:00" value="{{old('jam_in')}}"></td>
                    <td><input type="text" name="jam_out" class="form-control" placeholder="Cth: 16:20:00" value="{{old('jam_out')}}"></td>
                    <td><input type="text" name="out_ijin" class="form-control" placeholder="Cth: 09:00:00" value="{{old('out_ijin')}}"></td>
                    <td><input type="text" name="in_ijin" class="form-control" placeholder="Cth: 12:24:00" value="{{old('in_ijin')}}"></td>
                    
                    <td><input type="text" value="{{old('kt_ijin')}}" name="kt_ijin" class="form-control"></td>
                    
                  </tr>
                  <tr>
                    <td colspan="8">
                     <strong>*)Note : Kosongkan bila tidak perlu</strong> <br>
                    <button type="submit" class="btn btn-default">Simpan</button></td>
                  </tr>
                  
                </form>
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
   //Date picker
    $('#datepicker').datepicker({
      autoclose: true
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
@endsection