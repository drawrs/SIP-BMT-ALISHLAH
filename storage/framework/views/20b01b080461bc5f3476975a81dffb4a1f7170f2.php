<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo e(URL::to('admin/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo e(Auth::user()->name); ?></p>
         <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Berita</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Tambah Berita</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Lihat semua berita</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Produk</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Tambah Produk</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Daftar Produk</a></li>
            </li>
          </ul>
        </li>
        
        <li><a href="<?php echo e(URL::to('/logout')); ?>">Keluar</a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>