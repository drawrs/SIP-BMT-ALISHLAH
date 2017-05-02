<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Absensi</title>
<style type="text/css">
#logo {
 width: 300px;
 height: 200px; 
 float:left;
}
#judul {
 margin-left : 90px;
 width:900px;
 text-align:center;
}


</style>
</head>

<body>

    <style type="text/css">                       
            @import "{{URL::to('report/export/media/css/demo_table_jui.css')}}";
            @import "{{URL::to('report/export/media/themes/sunny/jquery-ui-1.8.4.custom.css')}}";
            @import "{{URL::to('report/export/extras/TableTools/media/css/TableTools.css')}}";
        </style>      

        <script src="{{URL::to('report/export/media/js/jquery.js')}}"></script>
        <script src="{{URL::to('report/export/media/js/jquery.dataTables.js')}}"></script>
        <script src="{{URL::to('report/export/extras/TableTools/media/js/ZeroClipboard.js')}}"></script>
        <script src="{{URL::to('report/export/extras/TableTools/media/js/TableTools.js')}}"></script>
        <script type="text/javascript">
          $(document).ready(function(){
                    oTable = $('#contoh1').dataTable({      
                         "bJQueryUI": true,
                         "sPaginationType": "full_numbers",
                         "sDom": 'T<"clear">lfrtip',
               "oTableTools": {
                  "sSwfPath": "{{URL::to('report/export/extras/TableTools/media/swf/copy_csv_xls_pdf.swf')}}"
              },
               "oLanguage": {
                              "sLengthMenu": "Tampilan _MENU_ data",
                              "sSearch": "Cari: ", 
                              "sZeroRecords": "Tidak ditemukan data yang sesuai",
                              "sInfo": "_START_ sampai _END_ dari _TOTAL_ data",
                              "sInfoEmpty": "0 hingga 0 dari 0 entri",
                              "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                              "oPaginate": {
                                  "sFirst": "Awal",
                                  "sLast": "Akhir", 
                                  "sPrevious": "Balik", 
                                  "sNext": "Lanjut"
                           }
                      }
                    });
                    oTable = $('#contoh2').dataTable({      
                         "bJQueryUI": true,
                         "sPaginationType": "full_numbers",
                         "sDom": 'T<"clear">lfrtip',
               "oTableTools": {
                  "sSwfPath": "{{URL::to('report/export/extras/TableTools/media/swf/copy_csv_xls_pdf.swf')}}"
              },
               "oLanguage": {
                              "sLengthMenu": "Tampilan _MENU_ data",
                              "sSearch": "Cari: ", 
                              "sZeroRecords": "Tidak ditemukan data yang sesuai",
                              "sInfo": "_START_ sampai _END_ dari _TOTAL_ data",
                              "sInfoEmpty": "0 hingga 0 dari 0 entri",
                              "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                              "oPaginate": {
                                  "sFirst": "Awal",
                                  "sLast": "Akhir", 
                                  "sPrevious": "Balik", 
                                  "sNext": "Lanjut"
                           }
                      }
                    });
          })    
        </script>
    </head>
    <body>
<center>
<table id="contoh1" class="display">
  <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">FIRST NAME</th>
                        <th scope="col">TITLE</th>
                        <th scope="col">GAPOK</th>
                        <th  scope="col">TUNJAB</th>
                        <th scope="col">TRANSPORT</th>
                        <th scope="col">UM</th>
                        <th scope="col">TUNKEL</th>
                        <th scope="col">JML GAJI</th>
                        <th scope="col">KASBON</th>
                        <th scope="col">ANGS</th>
                        <th scope="col">SIMWA</th>
                        <th scope="col">BPJS</th>
                        <th scope="col">ARISAN</th>
                        <th scope="col">LAINNYA</th>
                        <th scope="col">ZIS</th>
                        <th scope="col">JML POT</th>
                        <th scope="col">JML DITERIMA</th>
                          </tr>
                      </thead>
                      <tbody>

     <?php
                    $gaji_total = $data_rekap->gaji_pokok + $data_rekap->tunjab + $data_rekap->uang_transport + $data_rekap->uang_makan + $data_rekap->tunkel;

                    //$zis = ($gaji_total*$data_rekap->p_zis)/100;
                    $zis = hitung_zis($gaji_total, $data_rekap->p_zis);
                    $jml_pot = $data_rekap->p_kasbon + $data_rekap->p_angs + $data_rekap->p_simwa + $data_rekap->p_bpjs + $data_rekap->p_arisan + $data_rekap->p_lain + $zis;
                    $jml_diterima = $gaji_total - $jml_pot;
                    $lainnya = $data_rekap->p_donasi + $data_rekap->p_vipm + $data_rekap->p_qh + $data_rekap->p_dplk;
                    ?>
      <tr bgcolor=white>
        <td>1</td>
        <td>{{$user->detail->nama}}</td>
        <td>{{$user->detail->jabatan->name}}</td>
        <td>{{rupiah($data_rekap->gaji_pokok)}}</td>
        <td>{{rupiah($data_rekap->tunjab)}}</td>
        <td>{{rupiah($data_rekap->uang_transport)}}</td>
        <td>{{rupiah($data_rekap->uang_makan)}}</td>
        <td>{{rupiah($data_rekap->tunkel)}}</td>
        <td>{{rupiah($gaji_total)}}</td>
        <td>{{rupiah($data_rekap->p_kasbon)}}</td>
        <td>{{rupiah($data_rekap->p_angs)}}</td>
        <td>{{rupiah($data_rekap->p_simwa)}}</td>
        <td>{{rupiah($data_rekap->p_bpjs)}}</td>
        <td>{{rupiah($data_rekap->p_arisan)}}</td>
        <td>{{rupiah($lainnya)}}</td>
        <td>{{rupiah($zis)}}</td>
        <td>{{rupiah($jml_pot)}}</td>
        <td>{{rupiah($jml_diterima)}}</td>
      </tr>

     </tbody>
</table>
<table id="contoh2" class="display" width="50%">
  <thead>
      <tr>
        <th colspan="6" scope="col">LAINNYA</th>
      </tr>
      <tr>  
          <th scope="col">NAMA</td>
          <th scope="col">DONASI</th>
          <th scope="col">VIPM</th>
          <th scope="col">QH</th>
          <th scope="col">DPLK</th>
          <th  scope="col">TOTAL</th>
            </tr>
        </thead>
        <tbody>
      <tr bgcolor=white>
        <td>{{$user->detail->jabatan->name}}</td>
        <td>{{rupiah($data_rekap->p_donasi)}}</td>
        <td>{{rupiah($data_rekap->p_vipm)}}</td>
        <td>{{rupiah($data_rekap->p_qh)}}</td>
        <td>{{rupiah($data_rekap->p_dplk)}}</td>
        <td>{{rupiah($lainnya)}}</td>
      </tr>

     </tbody>
</table>
</center>
</body>
<br/>
<br/>
<br/>
<center>
<input type="submit" name="button" class="DTTT_button" value="Print" onclick="print()" /></center>
</html>

