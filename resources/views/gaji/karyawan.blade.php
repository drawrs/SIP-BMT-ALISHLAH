@extends('layouts.masbar')
@section('title','TUNJANGAN GAJI KARYAWAN')
@section('content')
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <?php
           $no=1;
          ?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                  <strong>TUNJANGAN GAJI KARYAWAN :</strong>
                  <select id="opsiCab">
                      <option value="all">Semua Kantor</option>
                      @foreach($cabangs as $cab)
                        <?php
                        if ($get_opsi == $cab->id) {
                            $select = "SELECTED";
                        } else {
                            $select = "";
                        }
                        ?>
                        <option value="{{$cab->id}}"{{$select}}>{{$cab->name}}</option>
                      @endforeach
                  </select>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10vh">No</th>
                  <th>Kode Karyawan</th>
                  <th>Nama Karyawan</th>
                  <th>GAPOK</th>
                  <th>TUNJAB</th>
                  <th>TUNKEL</th>
                  <!-- <th>DPLK</th> -->
                  <th>PENSIUN</th>
                  <th>BPJSKS</th>
                  <th>BPJSTK</th>
                  <th>UM</th>
                  <th>TP</th>
                  <th align="center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{$no++}}</td>
                  <td><b>{{$user->karyawan_id}}</b></td>
                  <td><a href="{{route('karyawan.edit', ['id' => $user->id])}}">{{$user->detail->nama}}</a></td>
                  <td>{{rupiah($user->gaji->gapok)}}</td>
                  <td>{{rupiah($user->gaji->tunjab)}}</td>
                  <td>{{rupiah($user->gaji->tunkel)}}</td>
                  <!-- <td>{{rupiah($user->gaji->dplk)}}</td> -->
                  <td>{{rupiah($user->gaji->pensiun)}}</td>
                  <td>{{rupiah($user->gaji->bpjs_kes)}}</td>
                  <td>{{rupiah($user->gaji->bpjs_tk)}}</td>
                  <td>{{rupiah($user->gaji->um)}}</td>
                  <td>{{rupiah($user->gaji->transport)}}</td>
                  <td align="center">
                  <button class="btn btn-primary" onclick="editGaji('{{$user->gaji->id}}','{{$user->gaji->gapok}}','{{$user->gaji->tunjab}}','{{$user->gaji->tunkel}}',/*'{{$user->gaji->dplk}}',*/'{{$user->gaji->pensiun}}','{{$user->gaji->bpjs_kes}}', '{{$user->gaji->bpjs_tk}}','{{$user->gaji->um}}', '{{$user->gaji->transport}}')">Edit</button>
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
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span></button>
      <h4 class="modal-title">UBAH DATA GAJI</h4>
    </div>
    <div class="modal-body">
     
        <div class="box-body">
        
        <input type="hidden" name="user_id" id="user_id">
          <div class="form-group">
          
          <div class="form-group">
          <label for="">GAJI POKOK</label>
          <input type="number" class="form-control pull-right" placeholder="Gaji Pokok" id="gapok" required="1" name="gapok">
          </div>
          <div class="form-group">
          <label for="">TUNJANGAN JABATAN</label>
          <input type="number" class="form-control pull-right" name="tunjab" id="tunjab" required="1">
          </div>
          <div class="form-group">
          <label for="">TUNJANGAN KElUARGA</label>
          <input type="number" class="form-control pull-right" name="tunkel" id="tunkel" required="1">
          </div>
          <!-- <div class="form-group">
          <label for="">DANA PENSIUN LEMBAGA KEUANGAN</label>
          <input type="number" class="form-control pull-right" name="dplk" id="dplk" required="1">
          </div> -->
          <div class="form-group">
          <label for="">PENSIUN</label>
          <input type="number" class="form-control pull-right" name="pensiun" id="pensiun" required="1">
          </div>
          <div class="form-group">
          <label for="">BPJS KESEHATAN</label>
          <input type="number" class="form-control pull-right" name="bpjs_ks" id="bpjs_ks" required="1">
          </div>
          <div class="form-group">
          <label for="">BPJS TENAGA KERJA</label>
          <input type="number" class="form-control pull-right" name="bpjs_tk" id="bpjs_tk" required="1">
          </div>
          <div class="form-group">
          <label for="">UANG MAKAN</label>
          <input type="number" class="form-control pull-right" name="u_makan" id="u_makan" required="1">
          </div>
          <div class="form-group">
          <label for="">UANG TRANSPORT</label>
          <input type="number" class="form-control pull-right" name="u_transport" id="u_transport" required="1">
          </div>
          </div>
          <div class="info">
            <ul id="info">
              
            </ul>
        </div>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">BATAL</button>
      <button class="btn btn-primary" type="submit" id="btnSave">SIMPAN</button>
    
      <!-- <button class="btn btn-success" id="proses-posting">VALIDASI</button> -->
    </div>
  </div>
  <!-- /.modal-content -->
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
   function editGaji(user_id, gapok, tunjab,tunkel,/*dplk,*/pensiun,bpjs_kes,bpjs_tk,um,transport){
        var user_id = $('#user_id').val($.trim(user_id));
        var gapok = $('#gapok').val($.trim(gapok));
        var tunjab = $('#tunjab').val($.trim(tunjab));
        var tunkel = $('#tunkel').val($.trim(tunkel));
        /*var dplk = $('#dplk').val($.trim(dplk));*/
        var pensiun = $('#pensiun').val($.trim(pensiun));
        var bpjs_kes = $('#bpjs_ks').val($.trim(bpjs_kes));
        var bpjs_tk = $('#bpjs_tk').val($.trim(bpjs_tk));
        var um = $('#u_makan').val($.trim(um));
        var transport = $('#u_transport').val($.trim(transport));

        $('#modal-edit').modal('show');
   }
   function saveGaji(user_id, gapok, tunjab,tunkel,/*dplk,*/pensiun,bpjs_kes,bpjs_tk,um,transport){
       $.ajax({
           url: '{{url('gaji/edit')}}',
           type: 'POST',
           data: {_token: '{{csrf_token()}}',
                    user_id: user_id,
                    gapok: gapok,
                    tunjab: tunjab,
                    tunkel: tunkel,
                    /*dplk: dplk,*/
                    pensiun: pensiun,
                    bpjs_kes: bpjs_kes,
                    bpjs_tk : bpjs_tk,
                    um: um,
                    transport: transport},
            success: function(msg){
                if (msg == 1) {
                    var result = "Berhasil Disimpan";
                } else {
                    var result = "Gagal Menyimpan! Silahkan Hubungi Administrator.";
                }
                alert(result);
            }
       });
       
   }
</script>
<script>

    $(function() {
        
        $('#btnSave').click(function(event) {
          $('#btnSave').prop('disabled', true);
            var user_id = $('#user_id').val();
            var gapok = $('#gapok').val();
            var tunjab = $('#tunjab').val();
            var tunkel = $('#tunkel').val();
            /*var dplk = $('#dplk').val();*/
            var pensiun = $('#pensiun').val();
            var bpjs_kes = $('#bpjs_ks').val();
            var bpjs_tk = $('#bpjs_tk').val();
            var um = $('#u_makan').val();
            var transport = $('#u_transport').val();
            if (gapok.length === 0 || tunjab.length === 0 || tunkel.length === 0 || /*dplk.length === 0 ||*/ pensiun.length === 0 || bpjs_kes.length === 0 || bpjs_tk.length === 0 || um.length === 0 || transport.length === 0){
                alert("SEMUA KOLOM WAJID DI ISI!");
                $('#btnSave').prop('disabled', false);
                return;
            }
            saveGaji(user_id, gapok, tunjab,tunkel,/*dplk,*/pensiun,bpjs_kes,bpjs_tk,um,transport);
            location.reload();
        });
        $('#opsiCab').change(function(event) {
            var opsi = $('#opsiCab').val();
            document.location = '{{url('gaji?opsi=')}}' + opsi;
        });
    });
</script>
@endsection
