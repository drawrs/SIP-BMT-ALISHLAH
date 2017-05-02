<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{URL::to('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
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
            <li><a href="{{ route('dashboard.add-news') }}"><i class="fa fa-circle-o"></i> Tambah Berita</a></li>
            <li><a href="{{route('dashboard.list-news')}}"><i class="fa fa-circle-o"></i> Lihat semua berita</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Produk</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('dashboard.add-product') }}"><i class="fa fa-circle-o"></i> Tambah Produk</a></li>
            <li><a href="{{ route('dashboard.list-product') }}"><i class="fa fa-circle-o"></i> Daftar Produk</a></li>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Baitulmaal</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('dashboard.add-baitulmaal') }}"><i class="fa fa-circle-o"></i> Tambah</a></li>
            <li><a href="{{ route('dashboard.list-baitulmaal') }}"><i class="fa fa-circle-o"></i> Daftar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Profil</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('dashboard.sejarah') }}"><i class="fa fa-circle-o"></i> Sejarah</a></li>
            <li><a href="{{ route('dashboard.visi-misi') }}"><i class="fa fa-circle-o"></i> Visi & Misi</a></li>
            <li><a href="http:://{{ route('dashboard.struktur') }}"><i class="fa fa-circle-o"></i> Struktur Organisasi</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{route('dashboard.kantor')}}">
            <i class="fa fa-files-o"></i>
            <span>Kantor</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{route('dashboard.slide')}}">
            <i class="fa fa-files-o"></i>
            <span>Slider</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{route('dashboard.iklan')}}">
            <i class="fa fa-files-o"></i>
            <span>Iklan</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{route('dashboard.katalog')}}">
            <i class="fa fa-files-o"></i>
            <span>Katalog</span>
          </a>
        </li>
        
        <li><a href="{{ URL::to('/logout') }}">Keluar</a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>