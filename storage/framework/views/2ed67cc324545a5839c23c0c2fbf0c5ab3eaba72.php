<?php $__env->startSection('title', 'Pegawai'); ?>
<?php $__env->startSection('navigation'); ?>
<h1>
Absensi
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="">Dashboard</a></li>
  <li class="active">Tambah Berita</li>
</ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Anda Belum Absen hari ini</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
      <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
      <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <table class="table table-striped">
      <tbody><tr>
        <th style="width: 10px">Status</th>
        <th>Keterangan</th>
        <th>Absen Masuk</th>
        <th>Absen Keluar</th>
      </tr>
      <tr>
        <td>#</td>
        <td>Anda Belum Mengisi Absen Hari Ini</td>
        <td>
          <button type="button" class="btn btn-warning">Absen</button>
        </td>
        <td><button type="button" class="btn btn-warning">Absen</button></td>
      </tr>
      
    </tbody></table>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    Footer
  </div>
  <!-- /.box-footer-->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>