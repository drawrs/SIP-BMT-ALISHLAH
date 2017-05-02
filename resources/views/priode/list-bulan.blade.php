@extends('layouts.masbar')
@section('title','Pilih Bulan Priode')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      @include('includes.messages')
      <?php
      $no=1;
      ?>
      <a class="btn btn-warning btn-flat" href="{{route('rekap.posting')}}"><i class="fa fa-plus"></i> POSTING ABSENSI</a>
      <a class="btn btn-success btn-flat" onclick="return confirm('Batalkan rekap priode terakhir?')" href="{{route('rekap.restore-all')}}"><i class="fa fa-refresh"></i> BATALKAN POSTING TERAKHIR</a>
      <a class="btn btn-default btn-flat" id="printRekap"><i class="fa fa-print"></i> PRINT REKAP GAJI</a>
      <a class="btn btn-default btn-flat" id="printRekapAbsen"><i class="fa fa-print"></i> PRINT REKAP ABSEN</a>
      <br/><br/>
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">PILIH BULAN</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <ul>
            @foreach($bulan as $data)
            <li><b><a href="{{route('rekap.bulan', ['id' => $data->bulan_id])}}">{{$data->nama_bln}} ({{$rekap->where('bulan_id', $data->bulan_id)->count()}})</a></b></li>
            @endforeach
          </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
      </div>
      <!-- /.box -->
      
      
    </div>
    <!-- /.col -->
  </div>
  
      <div class="modal fade" id="modal-print-absen">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">PILIH TANGGAL PRIODE</h4>
            </div>
            <div class="modal-body">
            <form action="{{route('rekap.priode.print-absen')}}" method="GET">
             <div class="form-group">
                  <label for="">MASUKAN TANGGAL (format: mm/dd/yyyy. Cth: 12/27/2017)</label>
                  <input type="text" class="form-control pull-right" placeholder="Cth: 07/04/2016 - 10/04/2016" id="tgl-priode-absen" required="1" name="tgl">
                </div>

               
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">TAMPILKAN</button></form>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- /.row -->
  <div class="modal fade" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">PRINT REKAP GAJI</h4>
        </div>
        <div class="modal-body">
          <form action="{{route('rekap.priode.print')}}" method="GET">
            <div class="box-body">
              <div class="form-group">
                <div class="form-group">
                  <label for="">MASUKAN TANGGAL (format: mm/dd/yyyy. Cth: 12/27/2017)</label>
                  <input type="text" class="form-control pull-right" placeholder="Cth: 07/04/2016 - 10/04/2016" id="tgl-priode" required="1" name="tgl">
                </div>
                <div class="form-group">
                  <label for="">PILIH KANTOR CABANG</label>
                  <select name="cab" id="" class="form-control">
                  <option value="all">Semua Kantor</option>
                    @foreach($cabang as $cab)
                    <option value="{{$cab->id}}">{{$cab->name}}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="info">
                  <ul id="info">
                    
                  </ul>
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">BATAL</button>
                <button class="btn btn-success" type="submit" id="proses-posting">PRINT</button>
              </form>
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
      $('#tgl-priode').daterangepicker();
      $('#tgl-priode-absen').daterangepicker();
      
      $('#printRekap').click(function(event) {
      /* Act on the event */
      $('#modal-print').modal('show');
      });
      $('#printRekapAbsen').click(function(event) {
      /* Act on the event */
      $('#modal-print-absen').modal('show');
      });
      });
      </script>
      @endsection