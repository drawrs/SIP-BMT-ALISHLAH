@extends('layouts.masbar')
@section('title','Karyawan')
@section('content')
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <?php
           $no=1;
          ?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Rekap Gaji</strong></h3>{!!Auth::user()->level == 'hrd' ? ' &nbsp; &nbsp; &nbsp; <a href="'.route('karyawan.tambah').'"><button class="btn btn-default"><i class="fa fa-plus"></i> Tambah Data</button></a>': ''!!}
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10vh">No</th>
                  <th>Tanggal Priode</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data_rekap as $data)
                <tr>
                  <td>{{$no++}}</td>
                  <td>Priode  <strong>{{$data->tgl_priode_awal}}</strong> - <strong>{{$data->tgl_priode_akhir}}</strong></td>
                  
                  <td><a href="{{route('karyawan.edit', ['id' => $data->id])}}"><button class="btn btn-default"><i class="fa fa-book"></i> Lihat</button></a>&nbsp;
                 <a href="{{route('karyawan.edit', ['id' => $data->id])}}"><button class="btn btn-default"><i class="fa fa-print"></i> Cetak</button></a>&nbsp;
                  <button class="btn btn-danger hapus-user" value="{{$data->id}}"><i class="fa fa-trash"></i> Hapus</button>
                  
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
