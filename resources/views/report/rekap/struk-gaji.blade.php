<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>STRUK GAJI : {{$data_rekap->user->detail->nama}} | PRIODE : {{$data_rekap->tgl_priode_awal}} - {{$data_rekap->tgl_priode_akhir}}</title>
    <style type="text/css">
    @media print{    
        table {
          font-size: 10px;
          width: 300px;
          font-family: arial;
        }
        tr:nth-child(even) {
            background-color: #DDD;
        }
    }
    body {
    text-align: center;
    width:500px;
    font-size: 15px;
    }
    table {
       text-align: left;
        width: 100%;
        color: #05235d;
    }
   .price {
      color: #111;
    }
    .header {
        position: relative;
    padding: 10px 0;
    border-bottom: 3px #3e5186 solid;
    text-shadow: 0px -1px 0px #FFF;
    }
    .total {
          border-top: 1px #4a6cad solid;
    }
    span.small {
    
    }
    span.address {
    font-size: 12px;
    }
    span.name {
      text-transform: uppercase;
      font-family: sans-serif;
      color: #000;
    }
    .tgl {
      text-align: right;
      font-size: smaller;
      padding: 5px;
      padding-right: 20px;
      color: #05235d;
    }
    .header span {
    display: block;
    }
    .header h1 {
    font-size: 20px;
    }
    .body {
      padding: 10px 0;
    }
    .body .title {
    font-size: 20px;
    text-decoration: underline;
    }
    .body .desc {
        font-style: italic;
        text-decoration: none;
        color: #7676c3;
    }
    .footer {
          border-top: 1px #4a6cad solid;
    }
    img.bmt, img.koperasi {
      width: 80px;
      position: absolute;
      z-index: -100;
    }
    img.bmt {
        left: 0;
    }
    img.koperasi {
        right: 0;
    }
    </style>
  </head>
  <body>
    <div class="header">
    <img src="{{url('bmt.jpg')}}" alt="" class="bmt" />
    <img src="{{url('koperasi.png')}}" alt="" class="koperasi" />
      <span class="small"><small>{{$nama_unit}}</small></span>
      <span><h1>BMT AL ISHLAH</h1></span>
      <span class="small"><strong>B.H : No. 9287/BH/PAD/KWK10/IV/1997 Tanggal 2 April 1997</strong></span>
      <span class="address"><small>{{ $alamat_kantor }} Telp : {{ $telp_kantor }}</small></span>
    </div>
    <div class="body">
      <p>
        <h1 class="title">STRUK GAJI</h1>
      <span class="desc">Untuk Kehadiran Mulai TGL : {{toDate($data_rekap->tgl_priode_awal)}} s.d {{toDate($data_rekap->tgl_priode_akhir)}}</span>
      </p>
      <?php 
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

                    $gaji_total = $data_rekap->gaji_pokok + $data_rekap->tunjab + $data_rekap->uang_transport + $data_rekap->uang_makan + $total_tunkel;

                    //$zis = ($gaji_total*$data_rekap->p_zis)/100;
                    $zis = hitung_zis($gaji_total, $data_rekap->p_zis);

                    $lainnya = $data_rekap->p_donasi + $data_rekap->p_vipm + $data_rekap->p_qh + $data_rekap->p_dplk;
                    $jml_pot = $data_rekap->p_kasbon + $data_rekap->p_angs + $data_rekap->p_simwa + $data_rekap->p_bpjs + $data_rekap->p_arisan + $zis + $lainnya;
                    $jml_diterima = $gaji_total - $jml_pot;
      $no = 0;
      ?>
      <table cellspacing="0" cellpadding="5px">
        <thead>
          <tr>
            <td coslpan="3">
              <b>Nama Karyawan :</b> <span class="name">{{$data_rekap->user->detail->nama}}</span> <br />
              <b>Jabatan :</b> <span class="name">{{$data_rekap->user->detail->jabatan->name}}</span>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Gaji Pokok</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->gaji_pokok)}}</td>
          </tr>
          <tr>
            <td>Tunjangan Jabatan</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->tunjab)}}</td>
          </tr>
          <tr>
            <td>Transport</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->uang_transport)}}</td>
          </tr>
          <tr>
            <td>Uang Makan</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->uang_makan)}}</td>
          </tr>
          <tr>
            <td>Tunjangan Keluarga
            <ol style="color: #000">
              <li>Tun. Keluarga : {{rupiah($tunkel)}}</li>
              <li>Pensiun : {{rupiah($data_rekap->pensiun)}}</li>
              <li>BPJS KES : {{rupiah($data_rekap->bpjs_kes)}}</li>
              <li>BPJS TK : {{rupiah($data_rekap->bpjs_tk)}}</li>
            </ol>
            </td>
            <td>Rp. </td>
            <td class="price">{{toMoney($total_tunkel)}}</td>
          </tr>
          <!-- <tr>
            <td>BPJS TK</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->bpjs)}}</td>
          </tr>
          <tr>
            <td>BPJS KES</td>
            <td>Rp. </td>
            <td class="price">?</td>
          </tr>
          <tr>
            <td>Pensiun</td>
            <td>Rp. </td>
            <td class="price">?</td>
          </tr> -->
          <tr>
            <td align="center">Jumlah Pendapatan</td>
            <td class="total">Rp. </td>
            <td class="total"><b class="price">{{toMoney($gaji_total)}}</b></td>
          </tr>
        </tbody>
      </table>
      <table  cellspacing="0" cellpadding="5px">
        <thead>
          <tr>
            <td coslpan="4">
              POTONGAN
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td width="10px">{{$no+=1}}</td>
            <td>Kasbon</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->p_kasbon)}}</td>
          </tr>
          <tr>
             <td>{{$no+=1}}</td>
            <td>Angsuran</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->p_angs)}}</td>
          </tr>
          <tr>
             <td>{{$no+=1}}</td>
            <td>Simp. Wajib</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->p_simwa)}}</td>
          </tr>
          <tr>
             <td>{{$no+=1}}</td>
            <td>BPJS</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->p_bpjs)}}</td>
          </tr>
          <tr>
             <td>{{$no+=1}}</td>
            <td>Arisan</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($data_rekap->p_arisan)}}</td>
          </tr>
          <tr>
             <td>{{$no+=1}}</td>
            <td>ZIS</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($zis)}}</td>
          </tr>
          <tr>
             <td>{{$no+=1}}</td>
            <td>Lainnya</td>
            <td>Rp. </td>
            <td class="price">{{toMoney($lainnya)}}</td>
          </tr>
          <tr>
            <td align="center" colspan="2">Jumlah Potongan</td>
            <td>Rp. </td>
            <td><b class="price">{{toMoney($jml_pot)}}</b></td>
          </tr>
          <tr>
            <td align="center" colspan="2"><b>Neto Penghasilan</b></td>
            <td class="total">Rp. </td>
            <td class="total"><b class="price">{{toMoney($jml_diterima)}}</b></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="footer">
      <div class="tgl">{{ $kota_cetak }}, {{ toDate(parseDate($data_rekap->created_at)->toDateString())}}</div>
      <table  cellspacing="8px">
        <tr align="center">
          <td>Yang Menerima</td>
          <td>HRD</td>
        </tr>
        <tr>
          <td colspan="2">
            <br /><br />
          </td>
        </tr>
        <tr align="center">
          <td><span class="name">{{$data_rekap->user->detail->nama}}</span></td>
          <td><span class="name">{{$nama_hrd}}</span></td>
        </tr>
      </table>
    </div>
  </body>
  
</html>