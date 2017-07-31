<nav style="background-color:#f5f5f5;border-color:#f5f5f5"class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a style="padding:0px"class="navbar-brand" href="{{ url('/admin')}}"><img src='{{asset('images/anasayfa.png')}}'></a>
        </div>
        <ul class="nav navbar-nav">
            <li class=""><a href="{{ url('/admin/firmaList')}}">Firma Onayı</a></li>
            <li class=""><a href="{{ url('/admin/yorumList')}}">Yorum Onayı</a></li>
            <li class=""><a href="{{ url('/admin/kullaniciLog')}}">Kullanıcı Hareketleri</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tablo İşlemleri <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/admin/tablesControl')}}">Admin Tablosu</a></li>
                    <li><a href="{{ url('/admin/kalemlerTablolari')}}">Kalemler Tabloları İşlemleri</a></li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
