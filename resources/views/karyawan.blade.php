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
              <h3 class="box-title">Data karyawan</strong></h3>{!!Auth::user()->level == 'hrd' ? ' &nbsp; &nbsp; &nbsp; <a href="'.route('karyawan.tambah').'"><button class="btn btn-default"><i class="fa fa-plus"></i> Tambah Data</button></a>': ''!!}
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10vh">No</th>
                  <th>Kode Karyawan</th>
                  <th>Nama Karyawan</th>
                  <th>Jabatan</th>
                  <th>Cabang</th>
                  <th align="center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$user->karyawan_id}}</td>
                  <td>{{$user->detail->nama}}</td>
                  <td>{{$user->detail->jabatan->name}}</td>
                  <td>{{$user->cabang->name}}</td>
                  <td align="center"><a href="{{route('karyawan.edit', ['id' => $user->id])}}"><button class="btn btn-warning"><i class="fa fa-edit"></i></button></a>&nbsp;<button class="btn btn-danger hapus-user" value="{{$user->id}}"><i class="fa fa-trash"></i></button>
                  <a href="{{route('absen.detail', ['id' => $user->id])}}" class="btn btn-default"><i class="fa fa-calendar-o"></i> Lihat Absensi</a>
                  <a href="{{route('rekap.list', ['id' => $user->id])}}" class="btn btn-default"><i class="fa fa-book"></i> Rekap Absensi</a>
                  </td>
                </tr>
                 @endforeach
                <!-- disini -->
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">{!!$users->links()!!}</div>
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
   $('.hapus-user').click(function(){
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
                url: "{{route('karyawan.hapus')}}",
                data : { act: 'del', id : id, _token: "{{csrf_token()}}"},
                success: function(msg) {
                    if (msg == '0') {
                      swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
                    } else if (msg == '1') {
                      swal("Berhasil!", "Data karyawan dihapus.", "success");
                    } else {
                      swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
                    }
                     location.reload();
                }
              });
            }, 2000);
          });
      });
</script>
@endsection
