@extends('layouts.masbar')
@section('title','POTONGAN GAJI KARYAWAN')
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
                  <strong>POTONGAN GAJI KARYAWAN :</strong>
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
              <table id="example" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th width="10vh" rowspan="2" align="">No</th>
                  <th rowspan="2">Kode Karyawan</th>
                  <th rowspan="2">Nama Karyawan</th>
                  <th rowspan="2">KASBON</th>
                  <th rowspan="2">ANGSURAN</th>
                  <th rowspan="2">ANGSURAN PKP</th>
                  <th rowspan="2">SIMWA</th>
                  <th rowspan="2">BPJS</th>
                  <th rowspan="2">ARISAN</th>
                  <th rowspan="2">ZIS</th>
                  <th colspan="4" style="text-align:center">LAINNYA</th>
                  <th rowspan="2" align="center">Aksi</th>
                </tr>
                <tr>
                  <th>DONASI</th>
                  <th>VIPM</th>
                  <th>QH</th>
                  <th>DPLK</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{$no++}}</td>
                  <td><b>{{$user->karyawan_id}}</b></td>
                  <td><a href="{{route('karyawan.edit', ['id' => $user->id])}}">{{$user->detail->nama}}</a></td>
                  <td>{{rupiah($user->potongan->kasbon)}}</td>
                  <td>{{rupiah($user->potongan->angs)}}</td>
                  <td>{{rupiah($user->potongan->angs_pkp)}}</td>
                  <td>{{rupiah($user->potongan->simwa)}}</td>
                  <td>{{rupiah($user->potongan->bpjs)}}</td>
                  <td>{{rupiah($user->potongan->arisan)}}</td>
                  <td><strong><u>{{$user->potongan->zis}}%</u></strong></td>
                  <td><i>{{rupiah($user->potongan->donasi)}}</i></td>
                  <td><i>{{rupiah($user->potongan->vipm)}}</i></td>
                  <td><i>{{rupiah($user->potongan->qh)}}</i></td>
                  <td><i>{{rupiah($user->potongan->dplk)}}</i></td>
                  <td align="center">
                  <button class="btn btn-primary" onclick="editGaji('{{$user->potongan->id}}','{{$user->potongan->kasbon}}','{{$user->potongan->angs}}','{{$user->potongan->angs_pkp}}','{{$user->potongan->simwa}}','{{$user->potongan->bpjs}}','{{$user->potongan->arisan}}','{{$user->potongan->zis}}', '{{$user->potongan->donasi}}', '{{$user->potongan->vipm}}', '{{$user->potongan->qh}}', '{{$user->potongan->dplk}}')">Edit</button>
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
          <label for="">KASBON</label>
          <input type="number" class="form-control pull-right" placeholder="Gaji Pokok" id="kasbon" required="1" name="kasbon">
          </div>
          <div class="form-group">
          <label for="">ANGSURAN</label>
          <input type="number" class="form-control pull-right" name="angs" id="angs" required="1">
          </div>
           <div class="form-group">
          <label for="">ANGSURAN PKP</label>
          <input type="number" class="form-control pull-right" name="angs_pkp" id="angs_pkp" required="1">
          </div>
          <div class="form-group">
          <label for="">SIMPANAN WAJIB</label>
          <input type="number" class="form-control pull-right" name="simwa" id="simwa" required="1">
          </div>
          <div class="form-group">
          <label for="">BPJS</label>
          <input type="number" class="form-control pull-right" name="bpjs" id="bpjs" required="1">
          </div>
          <div class="form-group">
          <label for="">ARISAN</label>
          <input type="number" class="form-control pull-right" name="arisan" id="arisan" required="1">
          </div>
          <div class="form-group">
          <label for="">ZIS</label>
          <div class="input-group date">
            <input type="float" class="form-control pull-left active" id="zis" required="1" name="zis">
            <div class="input-group-addon">
              %
            </div>
          </div>
          </div>
          <div class="form-group">
          <label for="">DONASI</label>
          <input type="number" class="form-control pull-right" name="donasi" id="donasi" required="1">
          </div>
         <div class="form-group">
          <label for="">VIPM</label>
          <input type="number" class="form-control pull-right" name="vipm" id="vipm" required="1">
          </div>
          <div class="form-group">
          <label for="">QH</label>
          <input type="number" class="form-control pull-right" name="qh" id="qh" required="1">
          </div>
          <div class="form-group">
          <label for="">DPLK</label>
          <input type="number" class="form-control pull-right" name="dplk" id="dplk" required="1">
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
   function editGaji(user_id, kasbon, angs,angs_pkp ,simwa,bpjs,arisan,zis,donasi, vipm, qh, dplk){
        var user_id = $('#user_id').val($.trim(user_id));
        var kasbon = $('#kasbon').val($.trim(kasbon));
        var angs = $('#angs').val($.trim(angs));
        var angs_pkp = $('#angs_pkp').val($.trim(angs_pkp));
        var simwa = $('#simwa').val($.trim(simwa));
        var bpjs = $('#bpjs').val($.trim(bpjs));
        var arisan = $('#arisan').val($.trim(arisan));
        var zis = $('#zis').val($.trim(zis));
        var donasi = $('#donasi').val($.trim(donasi));
        var vipm = $('#vipm').val($.trim(vipm));
        var qh = $('#qh').val($.trim(qh));
        var dplk = $('#dplk').val($.trim(dplk));
       

        $('#modal-edit').modal('show');
   }
   function saveGaji(user_id, kasbon, angs, angs_pkp,simwa,bpjs,arisan,zis,donasi, vipm, qh, dplk){
       $.ajax({
           url: '{{url('potongan/edit')}}',
           type: 'POST',
           data: {_token: '{{csrf_token()}}',
                    user_id: user_id,
                    kasbon: kasbon,
                    angs: angs,
                    angs_pkp: angs_pkp,
                    simwa: simwa,
                    bpjs: bpjs,
                    arisan: arisan,
                    zis: zis,
                    donasi : donasi,
                    vipm : vipm,
                    qh : qh,
                    dplk : dplk
                   },
            success: function(msg){
              console.log(msg);
                if (msg == 1) {
                    var result = "Berhasil Disimpan";
                } else {
                    var result = "Gagal Menyimpan! Silahkan Hubungi Administrator.";
                }
                alert(result);
                location.reload();
            }
       });
       
   }
</script>
<script>

    $(function() {
        
        $('#btnSave').click(function(event) {
          $('#btnSave').prop('disabled', true);
            var user_id = $('#user_id').val();
            var kasbon = $('#kasbon').val();
            var angs = $('#angs').val();
            var angs_pkp = $('#angs_pkp').val();
            var simwa = $('#simwa').val();
            var bpjs = $('#bpjs').val();
            var arisan = $('#arisan').val();
            var zis = $('#zis').val();
            var donasi = $('#donasi').val();
            var vipm = $('#vipm').val();
            var qh = $('#qh').val();
            var dplk = $('#dplk').val();
            if (kasbon.length === 0 || angs.length === 0 || angs_pkp.length === 0 || simwa.length === 0 || bpjs.length === 0 || arisan.length === 0 || zis.length === 0 || donasi.length === 0 || vipm.length === 0 || qh.length === 0 || dplk.length === 0 ){
                alert("SEMUA KOLOM WAJID DI ISI!");
                $('#btnSave').prop('disabled', false);
                return;
            }

            saveGaji(user_id, kasbon, angs, angs_pkp,simwa,bpjs,arisan,zis,donasi, vipm, qh, dplk);
            //location.reload();
        });
        $('#opsiCab').change(function(event) {
            var opsi = $('#opsiCab').val();
            document.location = '{{url('potongan?opsi=')}}' + opsi;
        });
    });
</script>
@endsection
