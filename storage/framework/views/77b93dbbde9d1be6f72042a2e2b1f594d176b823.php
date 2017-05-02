<!DOCTYPE html>
<html>
<head>
  <title>REKAP ABSENSI PRIODE <?php echo e($tgl_awal); ?> - <?php echo e($tgl_akhir); ?></title>
  <style>
  body {
        font-size: 11px;
        font-family: arial;
  }
    table {
      width: 430px;
      margin: 10px;
      /* float: left; */
      display: inline;
    }
    thead {
      background: #DDD;
    }
    th, td {
      /* max-width: 50px; */
    }
    .row {
      max-width: 430px;
      display: inline-block;
    }
    td.name {
      max-width: 110px;
      text-transform: uppercase;
    }
    caption {
      font-size: 14px;
      font-weight: bold;
      text-align: left;
    }
    h1 {
      margin: 2px;
      font-size: 14px;
    }
    tr:nth-child(even) {
          background-color: #DDD;
      }
    @media  print{    
        table {
          font-size: 10px;
          width: 300px;
          font-family: arial;
        }
        tr:nth-child(even) {
            background-color: #DDD;
        }
    }
  </style>
</head>
<body>
<h1>REKAP ABSENSI PRIODE <?php echo e($tgl_awal); ?> - <?php echo e($tgl_akhir); ?></h1>
  <?php
  $tgl = null;
  ?>
    <?php foreach($rekap as $data): ?>
    <?php if($tgl !== $data->tgl): ?>
     </tbody>
</table>
    <?php
    $day_name = $carbon->parse($data->tgl)->formatLocalized('%A, %d %B %Y');
    $no = 1;
    ?>
      <table border="1" cellspacing="0" style="border-width: 1px;" >
  <thead>
    <caption><?php echo e($day_name); ?></caption>
    <tr bgcolor="#e5e9f7">
      <th>No</th>
      <th>Nama</th>

      <th>Dtng</th>
      <th>Klr</th>
      <th>Blk</th>
      <th>Plg</th>
      <th>Jml</th>
      <th>Paraf</th>
    </tr>
  </thead>
  <tbody>

    <?php endif; ?>
    <?php
    $tgl = $data->tgl;
    ?>
    <tr>
      <td><?php echo e($no++); ?></td>
      <td class="name"><?php echo e($data->user->detail->nama); ?></td>
      <td><?php echo e($data->jam_in); ?></td>
      <td><?php echo e($data->out_ijin); ?></td>
      <td><?php echo e($data->in_ijin); ?></td>
      <td><?php echo e($data->jam_out); ?></td>
      <td><?php echo e(diff_hm($data->tgl, $data->jam_in, $data->jam_out)); ?></td>
      <td></td>
    </tr>

    <?php endforeach; ?>

</div>

</body>
</html>