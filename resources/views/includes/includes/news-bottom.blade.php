<div class="news-bottom">
    <div class="container"> 
        <div class="news-pad">
            <div class="row news-bot">
                <div class="col-md-3 news-grid">
                    <h3>Tentang</h3>
                    <ul>
                        <li><a href="{{ route('sejarah') }}">Sejarah BMT AL-ISHLAH</a></li>
                        <li><a href="{{ route('visi.misi') }}">Visi & Misi</a></li>
                        <li><a href="{{ route('struktur.organisasi') }}">Struktur Organisasi</a></li> 
                        <li><a href="{{ route('kantor') }}">Kantor </a></li>
                    </ul>         
                </div>
                <div class="col-md-3 news-grid">
                <?php
                $tags = App\Tag::orderByRaw("RAND()")->take(5)->get();
                ?>
                    <h3>Tag</h3>
                    <ul>
                        @foreach($tags as $tag)
                        <li><a href="{{ route('view.tag', ['tag' => str_slug($tag->name)]) }}">{{$tag->name}}</a></li>
                        @endforeach
                    </ul>                             
                </div>
                <div class="col-md-6 news-grid" style="text-align:center; color:#FFF">
                    <p style="color:#FFF; margin:50px 0;">
                        <p><b>UJKS BMT AL-ISHLAH CIREBON</b></p>
                        <p>Telepon : +(0312) 929312</p>
                        <p>Email : admin@bmtalishlah.com</p>
                        <p>Alamat : Jl.plumbon no 32</p>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>