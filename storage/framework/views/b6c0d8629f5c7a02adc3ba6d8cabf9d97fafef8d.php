<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>REKAP GAJI PRIODE : <?php echo e($tgl_awal); ?> - <?php echo e($tgl_akhir); ?> | CABANG : <?php echo e($cabang_name); ?></title>
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
    @import  "<?php echo e(URL::to('report/export/media/css/demo_table_jui.css')); ?>";
    @import  "<?php echo e(URL::to('report/export/media/themes/sunny/jquery-ui-1.8.4.custom.css')); ?>";
    @import  "<?php echo e(URL::to('report/export/extras/TableTools/media/css/TableTools.css')); ?>";
  </style>      

  <script src="<?php echo e(URL::to('report/export/media/js/jquery.js')); ?>"></script>
  <script src="<?php echo e(URL::to('report/export/media/js/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(URL::to('report/export/extras/TableTools/media/js/ZeroClipboard.js')); ?>"></script>
  <script src="<?php echo e(URL::to('report/export/extras/TableTools/media/js/TableTools.js')); ?>"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      oTable = $('#contoh1').dataTable({      
       "bJQueryUI": true,
       "sPaginationType": "full_numbers",
       "sDom": 'T<"clear">lfrtip',
       "oTableTools": {
        "sSwfPath": "<?php echo e(URL::to('report/export/extras/TableTools/media/swf/copy_csv_xls_pdf.swf')); ?>"
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
        "sSwfPath": "<?php echo e(URL::to('report/export/extras/TableTools/media/swf/copy_csv_xls_pdf.swf')); ?>"
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
          <th scope="col">NAME</th>
          <th scope="col">TITLE</th>
          <th scope="col">GAPOK</th>
          <th  scope="col">TUNJAB</th>
          <th scope="col">TRANSPORT</th>
          <th scope="col">UM</th>
          <th scope="col">TUNKEL</th>
          <th scope="col">PENSIUN</th>
          <th scope="col">BPJSKES</th>
          <th scope="col">BPJSTK</th>
          <th scope="col">JML GAJI</th>
          <th scope="col">KASBON</th>
          <th scope="col">ANGS</th>
          <th scope="col">ANGS_PKP</th>
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
        $t_gapok = 0;
        $t_tunjab = 0;
        $t_transport = 0;
        $t_um = 0;
        $t_tunkel = 0;
        $t_jml_gaji = 0;
        $t_kasbon = 0;
        $t_angs = 0;
        $t_angs_pkp = 0;
        $t_simwa = 0;
        $t_bpjs = 0;
        $t_bpjs_kes = 0;
        $t_bpjs_tk = 0;
        $t_arisan = 0;
        $t_lainnya = 0;
        $t_zis = 0;
        $t_jml_pot = 0;
        $t_jml_terima = 0;
        $t_pensiun = 0;
        $no = 1;
        ?>
        <?php foreach($rekap as $data_rekap): ?>

        <?php
        $data_absen = $priode->where(['rekap_id' => $data_rekap->id])->get();
        $cek = $data_rekap->count();
        $cabang_user = $data_rekap->user->cabang->id;

        if ($data_rekap->user->detail->status_pr_id == '2') {
                            // tunkel * (jmlh anak + (suami+istri))
          $tunkel = $data_rekap->tunkel * ($data_rekap->user->detail->anak + 2);
        } elseif ($data_rekap->user->detail->status_pr_id == '3' || $data_rekap->user->detail->status_pr_id == '4') {
                            // duda / janda
                            // tunker * (jml anak + suami atau istri)
          $tunkel = $data_rekap->tunkel * ($data_rekap->user->detail->anak + 1);
        } else {
                            // klo blm nikah
          $tunkel = $data_rekap->tunkel;
        }
        
                          // total tunkelnya
        $total_tunkel = $tunkel + $data_rekap->pensiun + $data_rekap->bpjs_kes + $data_rekap->bpjs_tk;
        // dapetin gaji total
        $gaji_total = $data_rekap->gaji_pokok + $data_rekap->tunjab + $data_rekap->uang_transport + $data_rekap->uang_makan + $total_tunkel;

        //$zis = ($gaji_total*$data_rekap->p_zis)/100;
        $zis = hitung_zis($gaji_total, $data_rekap->p_zis);

        $lainnya = $data_rekap->p_donasi + $data_rekap->p_vipm + $data_rekap->p_qh + $data_rekap->p_dplk;
        $jml_pot = $data_rekap->p_kasbon + $data_rekap->p_angs + $data_rekap->p_angs_pkp + $data_rekap->p_simwa + $data_rekap->p_bpjs + $data_rekap->p_arisan + $zis + $lainnya;
        $jml_diterima = $gaji_total - $jml_pot;
        ?>
        <?php /* Perhitungan jika semua cabang*/ ?>
        <?php if($cab_id == 'all'): ?>
        <?php
            $t_gapok += $data_rekap->gaji_pokok;
            $t_tunjab += $data_rekap->tunjab;
            $t_transport += $data_rekap->uang_transport;
            $t_um += $data_rekap->uang_makan;
            $t_tunkel += $tunkel;
            $t_jml_gaji += $gaji_total;
            $t_kasbon += $data_rekap->p_kasbon;
            $t_angs += $data_rekap->p_angs;
            $t_angs_pkp += $data_rekap->p_angs_pkp;
            $t_simwa += $data_rekap->p_simwa;
            $t_bpjs +=$data_rekap->p_bpjs;
            $t_arisan += $data_rekap->p_arisan;
            $t_lainnya += $lainnya;
            $t_zis += $zis;
            $t_jml_pot += $jml_pot;
            $t_jml_terima += $jml_diterima;
                // bpjs
            $t_bpjs_tk += $data_rekap->bpjs_tk;
            $t_bpjs_kes += $data_rekap->bpjs_kes;

        ?>
        <?php else: ?>
        <?php /* Perhitungan jika satu cabang*/ ?>
        <?php if($cabang_user == $cab_id): ?> 
            <?php
            $t_gapok += $data_rekap->gaji_pokok;
            $t_tunjab += $data_rekap->tunjab;
            $t_transport += $data_rekap->uang_transport;
            $t_um += $data_rekap->uang_makan;
            $t_tunkel += $tunkel;
            $t_jml_gaji += $gaji_total;
            $t_kasbon += $data_rekap->p_kasbon;
            $t_angs += $data_rekap->p_angs;
            $t_angs_pkp += $data_rekap->p_angs_pkp;
            $t_simwa += $data_rekap->p_simwa;
            $t_bpjs +=$data_rekap->p_bpjs;
            $t_arisan += $data_rekap->p_arisan;
            $t_lainnya += $lainnya;
            $t_zis += $zis;
            $t_jml_pot += $jml_pot;
            $t_jml_terima += $jml_diterima;
            $t_pensiun += $data_rekap->pensiun;
                // bpjs
            $t_bpjs_tk += $data_rekap->bpjs_tk;
            $t_bpjs_kes += $data_rekap->bpjs_kes;
            ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php if($cab_id == 'all'): ?>
            <?php echo $__env->make('includes.priode-rekap-gaji', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
          <?php if($cabang_user == $cab_id): ?> 
            <?php echo $__env->make('includes.priode-rekap-gaji', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endif; ?>
        <?php endif; ?>

        <?php endforeach; ?>
        <tr bgcolor=white>
          <td><span style="display: none;">z</span></td>
          <td></td>
          <td><b>TOTAL</b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_gapok)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_tunjab)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_transport)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_um)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_tunkel)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_pensiun)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_bpjs_kes)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_bpjs_tk)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_jml_gaji)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_kasbon)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_angs)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_angs_pkp)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_simwa)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_bpjs)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_arisan)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_lainnya)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_zis)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_jml_pot)); ?></u></b></td>
          <td class="curr"><b><u><?php echo e(rupiah($t_jml_terima)); ?></u></b></td>
        </tr>

      </tbody>
    </table>
    <table id="contoh2" class="display" width="50%">
      <thead>
        <tr>
          <th colspan="6" scope="col">POTONGAN LAINNYA</th>
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

          <?php foreach($rekap as $data_rekap): ?>
          <?php
          $data_absen = $priode->where(['rekap_id' => $data_rekap->id])->get();
          $cek = $data_rekap->count();
          $cabang_user = $data_rekap->user->cabang->id;

          
          $lainnya = $data_rekap->p_donasi + $data_rekap->p_vipm + $data_rekap->p_qh + $data_rekap->p_dplk;
          ?>
          <?php if($cab_id == 'all'): ?>

          <?php echo $__env->make('includes.priode-rekap-gaji-lainnya', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php else: ?>
          <?php /* Jika cabang_id user == cabang id*/ ?>
          <?php if($cabang_user == $cab_id): ?>
          <?php echo $__env->make('includes.priode-rekap-gaji-lainnya', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endif; ?>
          <?php endif; ?>
          <?php endforeach; ?>
          <tr bgcolor=white>
            <td>z</td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>TOTAL</b></td>
            <td><?php echo e(rupiah($t_lainnya)); ?></td>
          </tr>


        </tbody>
      </table>
    </center>
    <script>
      $( "td.curr:contains('Rp. ')" ).each(function() {
        var text = $(this).text();
        $(this).text(text.replace('Rp. ', ''));
      });
      /*$( "td.curr:contains('.')" ).each(function() {
        var text = $(this).text();
        $(this).text(text.replace('.', ''));
      });*/
    </script>
  </body>
  <br/>
  <br/>
  <br/>
  <center>
    <input type="submit" name="button" class="DTTT_button" value="Print" onclick="print()" /></center>
    </html>

