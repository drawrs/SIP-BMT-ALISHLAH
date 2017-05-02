@extends('layouts.masbar')
@section('title','REKAP ABSENSI : '. $user->detail->nama)
@section('content')
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @include('includes.messages')
          <?php
           $no=1;
          ?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">REKAP ABSENSI : {{$user->detail->nama}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10vh">NO</th>
                  <th>PRIODE</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
                @if($data_rekap->count()  == 0)
                  <tr>
                    <td colspan="3" align="center"><b><i>TIDAK ADA DATA UNTUK DITAMPILKAN</i></b></td>
                  </tr>
                @endif
                @foreach($data_rekap as $data)
                <tr>
                  <td>{{$no++}}</td>
                  <td>Priode  <strong>{{$data->tgl_priode_awal}}</strong> - <strong>{{$data->tgl_priode_akhir}}</strong></td>
                  
                  <td><a href="{{route('rekap.priode', ['priode' => $data->id])}}"><button class="btn btn-default"><i class="fa fa-book"></i> Lihat</button></a>&nbsp;
                 @if(Auth::user()->level == 'hrd')
                  <a href="{{route('rekap.restore', ['id' => $data->id])}}" onclick="return confirm('Kembalikan rekapan absensi ini?')"><button class="btn btn-success hapus-user" value="{{$data->id}}"><i class="fa fa-refresh"></i> Batalkan</button></a>
                 @endif
                  <!-- Tombol hapus dimatikan -->
                  <!-- <a href="{{route('rekap.del', ['id' => $data->id])}}" onclick="return confirm('Hapus data ini?')"><button class="btn btn-danger hapus-user" value="{{$data->id}}"><i class="fa fa-trash"></i> Hapus</button></a> -->
                  
                  </td>
                </tr>
                 @endforeach
                <!-- disini -->
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">{!!$data_rekap->links()!!}</div>
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
<script>
  
</script>
@endsection
