
<tr bgcolor=white>
  <td><?php echo e($no); ?></td>
  <td><?php echo e($data_rekap->user->detail->nama); ?></td>
  <td><?php echo e($data_rekap->user->detail->jabatan->name); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->gaji_pokok)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->tunjab)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->uang_transport)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->uang_makan)); ?></td>
  <td class="curr"><?php echo e(rupiah($tunkel)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->pensiun)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->bpjs_kes)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->bpjs_tk)); ?></td>
  <td class="curr"><?php echo e(rupiah($gaji_total)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->p_kasbon)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->p_angs)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->p_simwa)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->p_bpjs)); ?></td>
  <td class="curr"><?php echo e(rupiah($data_rekap->p_arisan)); ?></td>
  <td class="curr"><?php echo e(rupiah($lainnya)); ?></td>
  <td class="curr"><?php echo e(rupiah($zis)); ?></td>
  <td class="curr"><?php echo e(rupiah($jml_pot)); ?></td>
  <td class="curr"><?php echo e(rupiah($jml_diterima)); ?></td>
</tr>