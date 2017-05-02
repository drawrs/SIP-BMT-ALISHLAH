<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo e(url("upload/foto_pegawai/".Auth::user()->detail->foto)); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo e(Auth::user()->name); ?></p>
         <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Absen</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-circle-o"></i> Absen</a></li>
            <li><a href="<?php echo e(route('absen.detail')); ?>"><i class="fa fa-circle-o"></i> Lihat Absensiku</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="<?php echo e(route('cuti')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Cuti</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo e(route('rekap.absensiku')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Rekap Abensiku</span>
          </a>
        </li>
        <?php if(Auth::user()->level == 'pc' || Auth::user()->level == 'hrd' ): ?>
        <li class="treeview">
          <a href="<?php echo e(route('cuti.request')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Permohonan Cuti</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo e(route('gaji')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Tunjangan Gaji</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo e(route('potongan')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Potongan Gaji</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo e(route('rekap.posting')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Posting Absensi</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo e(route('rekap.bulan')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Rekap Absensi</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo e(route('report.absen')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Laporan Absensi</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if(Auth::user()->level == 'admin' || Auth::user()->level == 'pc' || Auth::user()->level == 'hrd'): ?>
        
        <li class="treeview">
          <a href="<?php echo e(route('karyawan')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Karyawan</span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="<?php echo e(route('report.karyawan')); ?>">
            <i class="fa fa-files-o"></i>
            <span>Laporan Data Karyawan</span>
          </a>
        </li>
        <?php endif; ?>
        
        <li><a href="<?php echo e(URL::to('/logout')); ?>">Keluar</a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>