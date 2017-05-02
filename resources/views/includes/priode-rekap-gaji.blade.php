
<tr bgcolor=white>
  <td>{{$no}}</td>
  <td>{{$data_rekap->user->detail->nama}}</td>
  <td>{{$data_rekap->user->detail->jabatan->name}}</td>
  <td class="curr">{{rupiah($data_rekap->gaji_pokok)}}</td>
  <td class="curr">{{rupiah($data_rekap->tunjab)}}</td>
  <td class="curr">{{rupiah($data_rekap->uang_transport)}}</td>
  <td class="curr">{{rupiah($data_rekap->uang_makan)}}</td>
  <td class="curr">{{rupiah($tunkel)}}</td>
  <td class="curr">{{rupiah($data_rekap->pensiun)}}</td>
  <td class="curr">{{rupiah($data_rekap->bpjs_kes)}}</td>
  <td class="curr">{{rupiah($data_rekap->bpjs_tk)}}</td>
  <td class="curr">{{rupiah($gaji_total)}}</td>
  <td class="curr">{{rupiah($data_rekap->p_kasbon)}}</td>
  <td class="curr">{{rupiah($data_rekap->p_angs)}}</td>
  <td class="curr">{{rupiah($data_rekap->p_simwa)}}</td>
  <td class="curr">{{rupiah($data_rekap->p_bpjs)}}</td>
  <td class="curr">{{rupiah($data_rekap->p_arisan)}}</td>
  <td class="curr">{{rupiah($lainnya)}}</td>
  <td class="curr">{{rupiah($zis)}}</td>
  <td class="curr">{{rupiah($jml_pot)}}</td>
  <td class="curr">{{rupiah($jml_diterima)}}</td>
</tr>