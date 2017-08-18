<!DOCTYPE html>
<html lang="tr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href{{asset('semantic/out/semantic.min.css')}}">
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="{{asset('semantic/out/semantic.min.js')}}"></script>
    <title>Tamrekabet | Kayıt Ol </title>
</head>
<body id="app-layout">

      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}" style="padding:25px 30px">TamRekabet</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="float:right">

                    @if (Auth::guest())

                    <li>
                        <a href="{{ url('/firmaKayit') }}">ÜYE OL</a>
                    </li>
                    <li>
                        <a href="{{ url('/login') }}">ÜYE GİRİŞ</a>
                    </li>
                     <li>
                         <a href="#"><img src="{{asset('images/user.png')}}"></a>
                    </li>
                   @else


                        <li class="dropdown">
                            <?php $firmaAdi = session()->get('firma_adi');
                              $firmaId = session()->get('firma_id');
                            ?>
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false">
                               {{ session()->get('kullanici_adi') }}/ {{$firmaAdi}}<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown yazi" style="display:block;padding: 3px 20px">Firma İşlemleri</li>
                                    <?php
                                        $kullanici = App\Kullanici::find(Auth::user()->id);
                                        $kullaniciF=$kullanici->firmalar()->where('onay',1)->get();
                                    ?>
                                    @if(count($kullaniciF) != 0)
                                        @foreach($kullaniciF as $kullanicifirma)
                                            <ul style="list-style-type:square">
                                                <li ><a style="padding:0px" href="#" class="firmaSec" name="{{$kullanicifirma->id}}">{{$kullanicifirma->adi}}</a></li>
                                            </ul>
                                        @endforeach
                                    @endif
                                <li><a href="{{url('yeniFirmaKaydet/')}}" class="yazi"><i class="fa fa-btn fa-sign-out"></i>Yeni Firma Ekle</a></li>
                                <li><a href="{{ URL::to('kullaniciBilgileri', false)}}" class="yazi">Bilgilerim</a></li>
                                <li><a href="" class="yazi"><i class="fa fa-btn fa-sign-out"></i>Yardım</a></li>
                                <li><a href="{{ url('/sessionKill') }}" class="yazi"><i class="fa fa-btn fa-sign-out"></i>Çıkış</a></li>
                            </ul>
                        </li>
                      <li>
                          <a href="#"><img src="{{asset('images/user.png')}}"></a>
                     </li>
                @endif
                </ul>
                 <ul class="nav navbar-nav" style="padding-left: 30px" >
                    <li>

                        <a href="{{url('/ilanAra')}}">İLAN ARA</a>

                    </li>


                </ul>
            </div>

        </div>

    </nav>
    @yield('content')
    </body>
</html>
