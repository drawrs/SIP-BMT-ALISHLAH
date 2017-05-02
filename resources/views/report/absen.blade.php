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
<div id="logo"><img src="{{URL::to('report/logo.png')}}" alt="" width="120" height="120" /></div>
<div id="judul">
<br />
<br />
<?php 
echo"<font size='+3'>BMT AL ISHLAH</font><br />
Jalan Raya Ottista No.17 Plumbon Cirebon Barat<br />
Telp. (0231) 325-975<br />
Email : pusat@bmtalishlah.com Website : www.bmtalishlah.com";
?>
<hr size="1" color="#000000" />    
    <h3>LAPORAN DATA ABSENSI </h3>
</div>

<center>
</center>
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
                    oTable = $('#contoh').dataTable({      
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
<table id="contoh" class="display">
  <thead>
    <tr>
      <th width="2%" scope="col">No</th>
      <th width="5%" scope="col">Tanggal Absensi</th>
      <th width="5%" scope="col">Kode Karyawan</th>
      <th width="10%" scope="col">Nama Karyawan</th>
      <th width="10%" scope="col">Jam Datang</th>
      <th width="10%" scope="col">Jam Izin</th>
      <th width="10%" scope="col">Jam Kembali</th>
      <th width="10%" scope="col">Keperluan</th>
      <th width="5%" scope="col">Jam Pulang</th>
      <th width="5%" scope="col">Jam Kerja</th>
      
      
    </tr>
  </thead>
  <tbody>
    <?php $no=1; ?>
    @foreach($absens as $absen)
    <tr bgcolor=white>
      <td align=center>{{$no++}}</td>
      <td align=center >{{$absen->tgl}}</td>
      <td align=center >{{$absen->user->karyawan_id}}</td>
      <td align=left >{{$absen->user->detail->nama}}</td>
      <td align=center >{{$absen->jam_in}}  @if(is_null($absen->jam_in)) <i><strong>Belum Absen</strong></i> @endif</td>
      <td align=center >{{$absen->out_ijin}} @if(is_null($absen->out_ijin)) <i><strong>-</strong></i> @endif</td>
      <td align=center >{{$absen->in_ijin}} @if(is_null($absen->in_ijin)) <i><strong>-</strong></i> @endif</td>
      <td align=center >{{$absen->kt_ijin}} @if(is_null($absen->kt_ijin)) <i><strong>-</strong></i> @endif</td>
      <td align=center >{{$absen->jam_out}} @if(is_null($absen->jam_out)) <i><strong>Belum Absen</strong></i> @endif</td>
      <td align=center><strong>{{ $absen->jam_kerja !== NULL ? $absen->jam_kerja .' Jam': 'null' }} </strong></td>
    </td>
  </tr>
    @endforeach
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

