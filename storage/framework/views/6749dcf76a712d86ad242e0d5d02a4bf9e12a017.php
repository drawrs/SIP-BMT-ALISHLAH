<tr bgcolor=white>
                                  <td><?php echo e($no++); ?></td>
                                  <td><?php echo e($data_rekap->user->detail->nama); ?></td>
                                  <td><?php echo e($data_rekap->user->detail->jabatan->name); ?></td>
                                  <td><?php echo e(rupiah($data_rekap->gaji_pokok)); ?></td>
                                  <td><?php echo e(rupiah($data_rekap->tunjab)); ?></td>
                                  <td><?php echo e(rupiah($data_rekap->uang_transport)); ?></td>
                                  <td><?php echo e(rupiah($data_rekap->uang_makan)); ?></td>
                                  <td><?php echo e(rupiah($tunkel)); ?></td>
                                  <td><?php echo e(rupiah($gaji_total)); ?></td>
                                  <td><?php echo e(rupiah($data_rekap->p_kasbon)); ?></td>
                                  <td><?php echo e(rupiah($data_rekap->p_angs)); ?></td>
                                  <td><?php echo e(rupiah($data_rekap->p_simwa)); ?></td>
                                  <td><?php echo e(rupiah($data_rekap->p_bpjs)); ?></td>
                                  <td><?php echo e(rupiah($data_rekap->p_arisan)); ?></td>
                                  <td><?php echo e(rupiah($lainnya)); ?></td>
                                  <td><?php echo e(rupiah($zis)); ?></td>
                                  <td><?php echo e(rupiah($jml_pot)); ?></td>
                                  <td><?php echo e(rupiah($jml_diterima)); ?></td>
                                </tr>