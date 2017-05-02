<?php
include "../library/koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Transaksi</title>
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
<div id="logo"><img src="logo.png" alt="" width="115" height="110" /></div>
<div id="judul">
<br />
<br />
<?php 
echo"<font size='+3'>BMT AL ISHLAH</font><br />
Jl. Otto Iskandar Dinata No.17 Plumbon Kab. Cirebon<br />
Telp. 0231-325975<br />
Email : bmt_alishlah@yahoo.co.id Website : www.bmt-alishlah.com";
?>
<hr size="4" color="#000000" />    
    <h2>LAPORAN DATA KARYAWAN </h2>
</div>

<center>

	<?php
if($_POST['berdasar'] == "Semua Data"){
	//modus delete Semua Data
	$sql = "SELECT * FROM karyawan";
}

	else if($_POST['berdasar'] == "Pencarian Kata"){
	//modus berdasarkan kata
	$field = $_POST['field'];
	$kata = $_POST['kata'];
	
	$sql = "SELECT * FROM karyawan where $field like '%$kata%'";
				
	}
$query = mysql_query($sql);
?></center>




	<style type="text/css">                       
            @import "export/media/css/demo_table_jui.css";
            @import "export/media/themes/sunny/jquery-ui-1.8.4.custom.css";
            @import "export/extras/TableTools/media/css/TableTools.css";
        </style>      

        <script src="export/media/js/jquery.js"></script>
        <script src="export/media/js/jquery.dataTables.js"></script>
        <script src="export/extras/TableTools/media/js/ZeroClipboard.js"></script>
        <script src="export/extras/TableTools/media/js/TableTools.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
				    oTable = $('#contoh').dataTable({      
					     "bJQueryUI": true,
					     "sPaginationType": "full_numbers",
					     "sDom": 'T<"clear">lfrtip',
               "oTableTools": {
                  "sSwfPath": "export/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
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
        
        <th width="5%" scope="col">Kode Karyawan</th>
        <th width="5%" scope="col">No KTP</th>
        <th width="10%" scope="col">Nama Karyawan</th>
        <th width="5%" scope="col">Jabatan</th>
        <th width="20%" scope="col">Alamat</th>
       
        
                    </tr>
                </thead>
                <tbody>
      <?php
			   $i=1;
			  while ($data = mysql_fetch_array($query)){
			  
			echo "<tr bgcolor=white>
              <td align=center>$i</td>
              <td align=center >$data[karyawan_id]</td>
              <td align=center >$data[no_ktp]</td>
			  <td align=left >$data[karyawan_nama]</td>
    
              <td align=left >$data[jabatan_karyawan]</td>
              <td align=left >$data[alamat]</td>
              
              
			  </td>
            </tr>";
			$i++;
			}
			?>
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

