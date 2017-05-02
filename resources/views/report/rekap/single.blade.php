<?php
    $t_gapok += $data_rekap->gaji_pokok;
    $t_tunjab += $data_rekap->tunjab;
    $t_transport += $data_rekap->uang_transport;
    $t_um += $data_rekap->uang_makan;
    $t_tunkel += $data_rekap->tunkel;
    $t_jml_gaji += $gaji_total;
    $t_kasbon += $data_rekap->p_kasbon;
    $t_angs += $data_rekap->p_angs;
    $t_simwa += $data_rekap->p_simwa;
    $t_bpjs +=$data_rekap->p_bpjs;
    $t_arisan += $data_rekap->p_arisan;
    $t_lainnya += $lainnya;
    $t_zis += $zis;
    $t_jml_pot += $jml_pot;
    $t_jml_terima += $jml_diterima;


?>
    <tr bgcolor=white>
        <td>{{$no++}}</td>
        <td>{{$data_rekap->user->detail->nama}}</td>
        <td>{{$data_rekap->user->detail->jabatan->name}}</td>
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
