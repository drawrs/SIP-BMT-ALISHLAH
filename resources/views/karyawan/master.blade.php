@extends('layouts.masbar-master')
@section('title','Master')
@section('content')
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <?php
           $no=1;
          ?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data karyawan</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form class="form-horizontal" role="form" method="POST" action="{{ route('karyawan.master-post') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Alamat E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('level') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Level</label>

                            <div class="col-md-6">
                                <select name="level" id="" class="form-control">
                                    <option value="user">Karyawan</option>
                                    <option value="admin">Admin</option>
                                    <option value="pc">Pimpinan Cabang</option>
                                    <option value="hrd">HRD</option>
                                </select>
    
                                @if ($errors->has('level'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Katasandi</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Konfirmasi Katasandi</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Lengkap</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ktp') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">Nomor KTP</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="ktp" value="{{ old('ktp') }}">

                                @if ($errors->has('ktp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ktp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('tgl') ? ' has-error' : '' }}">
                            <label for="tgl" class="col-md-4 control-label">Tanggal Lahir</label>

                            <div class="">
                                <div class="col-md-2">
                                  <select name="tgl" id="" class="form-control">
                                    @for ($i=1; $i <= 31 ; $i++)
                                    <option value="{{$i < 10 ? '0'.$i: $i}}">{{$i < 10 ? '0'.$i: $i}}</option>
                                    @endfor
                                </select>
                                </div>
                                <div class="col-md-2">
                                  <select name="bln" id="" class="form-control">
                                    <?php
                                    $bln = array('','Januari','Febuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                    ?>
                                    @for ($i=1; $i <= 12 ; $i++)
                                    <option value="{{$i < 10 ? '0'.$i: $i}}">{{$bln[$i]}}</option>
                                    @endfor
                                </select>
                                </div>
                                <div class="col-md-2">
                                  <select name="thn" id="" class="form-control">
                                    @for ($i=date("Y"); $i >= 1965 ; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                </div>
    
                                @if ($errors->has('tgl'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('jk') ? ' has-error' : '' }}">
                            <label for="jk" class="col-md-4 control-label">Jenis Kelamin</label>

                            <div class="col-md-6">
                                <input type="radio" name="jk" value="L"> Laki-Laki <input type="radio" name="jk" value="P"> Perempuan
    
                                @if ($errors->has('jk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('jabatan') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Jabatan</label>

                            <div class="col-md-6">
                            <a style="cursor:pointer" onclick="tambah_jab()"><strong><u>Tambah Jabatan</u></strong></a> | <a style="cursor:pointer" id="list-jab" data-toggle="modal" data-target=".jabatan"><strong><u>Hapus Jabatan</u></strong></a>
                                <select name="jabatan" id="" class="form-control">
                                    @foreach($jabs as $jab)
                                    <option value="{{$jab->id}}">{{$jab->name}}</option>
                                    @endforeach
                                </select>
    
                                @if ($errors->has('jabatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jabatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('cabang') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Kantor Cabang</label>

                            <div class="col-md-6">
                            <a style="cursor:pointer" onclick="tambah_cabang()"><strong><u>Tambah Cabang</u></strong></a> | <a style="cursor:pointer" id="list-tag" data-toggle="modal" data-target=".cabang"><strong><u>Hapus Cabang</u></strong></a>
                                <select name="cabang" id="" class="form-control">
                                    @foreach($cabs as $jab)
                                    <option value="{{$jab->id}}">{{$jab->name}}</option>
                                    @endforeach
                                </select>
    
                                @if ($errors->has('cabang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cabang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('cuti') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Jatah Cuti</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                  <input type="text" class="form-control pull-left active" placeholder="Jumlah Hari Cuti" id="reservation" required="1" name="cuti" value="10">
                                  <div class="input-group-addon">
                                    Hari
                                  </div>
                                </div>
    
                                @if ($errors->has('cuti'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cuti') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-4 control-label">Alamat Lengkap</label>

                            <div class="col-md-6">
                                <textarea name="alamat" id="" rows="3" class="form-control">{{old('alamat')}}</textarea>
    
                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('gapok') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">Gaji Pokok</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="gapok" value="0" placeholder="0">

                                @if ($errors->has('gapok'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gapok') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tunjab') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">Tunjangan Jabatan</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="tunjab" value="0"  placeholder="0">

                                @if ($errors->has('tunjab'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tunjab') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tunkel') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">Tunjangan Keluarga</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="tunkel" value="0" placeholder="0">

                                @if ($errors->has('tunkel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tunkel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dplk') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">DPLK</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="dplk" value="0" placeholder="0">

                                @if ($errors->has('dplk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dplk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('pensiun') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">Pensiun</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="pensiun" value="0" placeholder="0">

                                @if ($errors->has('pensiun'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pensiun') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('bpjs_kes') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">BPJS Kesehatan</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="bpjs_kes" value="0" placeholder="0">

                                @if ($errors->has('bpjs_kes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bpjs_kes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('bpjs_tk') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">BPJS Tenaga kerja</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="bpjs_tk" value="0" placeholder="0">

                                @if ($errors->has('bpjs_tk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bpjs_tk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('um') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">Uang Makan</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="um" value="0" placeholder="0">

                                @if ($errors->has('um'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('um') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('transport') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">Transport</label>

                            <div class="col-md-6">
                                <input id="ktp" type="text" class="form-control" name="transport" value="0" placeholder="0">

                                @if ($errors->has('transport'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transport') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Daftar
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
         
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Tag Modal Cabang -->
<div class="modal fade bs-example-modal-sm cabang" tabindex="-1" role="dialog" aria-labelledby="tag-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#FFF">&times;</span> <small style="color:#FFF">tutup</small></button>
    </div>
    <div class="modal-content">
      <div class="container">
      <div class="col-sm-3">
        <table class="table">
        <tr>
          <th width="180px">Nama Cabang</th>
          <th>Aksi</th>
        </tr>
        @foreach($cabs as $tag)
        <tr>
          <td>{{ $tag->name }}</td>
          <td align="right"><a value="{{ $tag->id }}" style="cursor:pointer" onclick="hapus_tag({{ $tag->id }})">Hapus <i class="fa fa-trash"></i></a></td>
        </tr>
        @endforeach
      </table>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- Tag Modal  Jabatan-->
<div class="modal fade bs-example-modal-sm jabatan" id="list-jab" tabindex="-1" role="dialog" aria-labelledby="tag-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#FFF">&times;</span> <small style="color:#FFF">tutup</small></button>
    </div>
    <div class="modal-content">
      <div class="container">
      <div class="col-sm-3">
        <table class="table">
        <tr>
          <th width="180px">Nama Jabatan</th>
          <th>Aksi</th>
        </tr>
        @foreach($jabs as $jab)
        <tr>
          <td>{{ $jab->name }}</td>
          <td align="right"><a value="{{ $jab->id }}" style="cursor:pointer" onclick="hapus_jab({{ $jab->id }})">Hapus <i class="fa fa-trash"></i></a></td>
        </tr>
        @endforeach
      </table>
      </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script src="{{URL::to('dist/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{URL::to('dist/sweetalert.css')}}">
@endsection
@section('bottom-script')
<script>
    function tambah_cabang(){
        swal({
            title: "Tambah Cabang",
            text: "Ketikan nama cabang di bawah ini:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            showLoaderOnConfirm: true,
          },
          function(tag){
            if (tag === false) return false;
            
            if (tag === "") {
              swal.showInputError("Kolom masih kosong!");
              return false
            }
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "{{route('cabang.add')}}",
                data : { name : tag, _token : "{{ csrf_token() }}"},
                success: function(msg){
                    if (msg == '1') {
                      swal({
                        timer: 2000,
                        title : "Disimpan!",
                        text : "Cabang telah ditambahkan.",
                        type: "success"
                      });
                    } else {
                      swal({
                        timer: 2000,
                        title : "Gagal!",
                        text : "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.",
                        type: "error"
                      });
                    }
                     location.reload();
                }
              });
            }, 2000);
            /*swal("Nice!", "You wrote: " + inputValue, "success");*/
          });
}
function hapus_tag(id){
          window.tagID = id;
          swal({
            title: "Hapus Cabang Ini ?",
            text: "Semua Karyawan Terkait Juga Akan Terhapus!",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
          },
          function(){
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "{{route('cabang.del')}}",
                data : { id : window.tagID, _token : "{{ csrf_token() }}"},
                success: function(msg) {
                    if (msg == '0') {
                      swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
                    } else if (msg == '1') {
                      swal("Berhasil!", "Cabang & Karyawan Terkait telah dihapus.", "success");
                    } else {
                      swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
                    }
                     location.reload();
                }
              });
            }, 2000);
          });
}
function tambah_jab ()
{
    swal({
            title: "Tambah Jabatan",
            text: "Ketikan nama jabatan di bawah ini:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            showLoaderOnConfirm: true,
          },
          function(tag){
            if (tag === false) return false;
            
            if (tag === "") {
              swal.showInputError("Kolom masih kosong!");
              return false
            }
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "{{route('jabatan.add')}}",
                data : { name : tag, _token : "{{ csrf_token() }}"},
                success: function(msg){
                    if (msg == '1') {
                      swal({
                        timer: 2000,
                        title : "Disimpan!",
                        text : "Jabatan telah ditambahkan.",
                        type: "success"
                      });
                    } else {
                      swal({
                        timer: 2000,
                        title : "Gagal!",
                        text : "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.",
                        type: "error"
                      });
                    }
                     location.reload();
                }
              });
            }, 2000);
            /*swal("Nice!", "You wrote: " + inputValue, "success");*/
          });
}
function hapus_jab(id){
          window.jabID = id;
          swal({
            title: "Hapus Jabatan Ini ?",
            text: "",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
          },
          function(){
            setTimeout(function(){
              $.ajax({
                type : "POST",
                url : "{{route('jabatan.del')}}",
                data : { id : window.jabID, _token : "{{ csrf_token() }}"},
                success: function(msg) {
                    if (msg == '0') {
                      swal("Data tidak ditemukan!", "Data tidak ditemukan! Silahkan refresh halaman.", "error");
                    } else if (msg == '1') {
                      swal("Berhasil!", "Jabatan telah dihapus.", "success");
                    } else {
                      swal("Gagal!", "Terjadi kesalahan, silahkan hubungi Admin atau Webmaster.", "error");
                    }
                     location.reload();
                }
              });
            }, 2000);
          });
}
</script>
@endsection
