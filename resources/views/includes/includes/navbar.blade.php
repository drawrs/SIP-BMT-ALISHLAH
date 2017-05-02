<div class="navigation">
    <div class="asdas">
        <nav class="navbar navbar-default">
         
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
              <div class="container" style="height: 0px;">
                  <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
                        <li><a href="{{ route('visi.misi') }}">Visi & Misi</a></li>
                        <li><a href="{{ route('struktur.organisasi') }}">Struktur Organisasi</a></li>
                      </ul>
                </li>

                <li><a href="{{route('products')}}">Product</a></li>
                <li><a href="">VIP Net</a></li>
                <li><a href="{{ route('kantor') }}">Kantor</a></li>
                <li><a href="{{route('baitulmaals')}}">Baitulmaal</a></li>
                <li><a href="">Login</a></li>
              </ul>
              </div>
              <div class="social-icons">
                <ul>
                    <li><a href="#" class="twi"></a></li>
                    <li><a href="#" class="fb"></a></li>
                    <li><a href="#" class="chec"></a></li>
                </ul>
              </div>
              <div class="clearfix"></div>
            </div><!-- /.navbar-collapse -->
        </nav>
    </div>
</div>