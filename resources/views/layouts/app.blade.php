
<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/heroic-features.css')}}" rel="stylesheet">
    {{-- <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script src="{{asset('js/kullaniciIslemleri.js')}}"></script>

    @yield('head') <!-- ic sayfalardan head bolumune kod eklenmek istenirse -->

    <style>
     div#header{
      width: 100%;
      height: 100px;
      background-image:url("{{asset('images/header.jpg')}}");
      margin: 0;
      padding: 5px;
      z-index:1080;
    }

    div#bs-example-navbar-collapse-1{
      background-color: #f5f5f5;
    }
    a#tamrekabet{
      background-color: #f5f5f5;
    }


    body.sticky div#header{
      position: fixed;
      top: 0;
      left: 50;
      box-shadow: 0 5px 10px rgba(0,0,0,0.3);
    }
    .yazi{
      font-family:"Times New Roman";
      background-color: #ccc;

     }


</style>
<script>

window.requestAnimationFrame = window.requestAnimationFrame
    || window.mozRequestAnimationFrame
    || window.webkitRequestAnimationFrame
    || window.msRequestAnimationFrame
    || function(f){return setTimeout(f, 1000/60)}


;(function($){ // enclose everything in a immediately invoked function to make all variables and functions local

    var $body,
    $target,
    targetoffsetTop,
    resizetimer,
    stickyclass= 'sticky' //class to add to BODY when header should be sticky

    function updateCoords(){
        targetoffsetTop = $target.offset().top
    }

    function makesticky(){
        var scrollTop = $(document).scrollTop()
        if (scrollTop >= targetoffsetTop){
            if (!$body.hasClass(stickyclass)){
                $body.addClass(stickyclass)
            }
        }
        else{
            if ($body.hasClass(stickyclass)){
                $body.removeClass(stickyclass)
            }
        }
    }

    $(window).on('load', function(){
        $body = $(document.body)
        $target = $('#header')
        updateCoords()
        $(window).on('scroll', function(){
            requestAnimationFrame(makesticky)
        })
        $(window).on('resize', function(){
            clearTimeout(resizetimer)
            resizetimer = setTimeout(function(){
                $body.removeClass(stickyclass)
                updateCoords()
                makesticky()
            }, 50)
        })
    })

})(jQuery)
</script>

</head>
<body id="app-layout" @yield('bodyAttributes')>

      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="tamrekabet"class="navbar-brand" href="{{ url('/') }}" style=" padding:25px 30px"><label style="color: #000">TamRekabet</label></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav" style="float:right">

                    @if (!Auth::check())

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
                               {{ session()->get('kullanici_adi') }} / {{$firmaAdi}}<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown yazi" style="display:block;padding: 3px 20px">Firma İşlemleri</li>
                                    <?php
                                        $kullanici = Auth::user();//onaylanmamış firmaların kullanıcı adı altında görünebilmesi için
                                        //$kullaniciF=$kullanici->firmalar()->where('onay',1)->get();
                                        $kullaniciF= $kullanici->firmalar()->get();
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
    @include('layouts.footer_menu')
    <!-- JavaScripts -->
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
   {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
<script>
      var selected;
      var count;
      var click=0;
      var session_value;

    $( document ).ready(function() {

        @if(Auth::guest())

        @else

            count = '{{$kullanici->firmalar()->count()}}';
            session_value = "{{$firmaAdi}}";

            selected='{{$kullanicifirma->id}}';
            funcLocations();

        @endif
    });

    $('.firmaSec').on('click', function() {
        selected = $(this).attr('name');
        click=1;
        funcLocations();
    });

    function funcLocations(){
       if(click === 1){ //// sayfa her yüklendiğinde çalışmasın diye bu kontrol gerekli
           $.ajax({
                type:"GET",
                url: "{{asset('set_session')}}",
                data: { role: selected },
                }).done(function(data){
                    console.log(data);
                    click=0;
                    location.href="{{asset('firmaIslemleri')}}"+"/"+selected;

                }).fail(function(){
                    alert('Yüklenemiyor !!!  ');
           });
       }
    }
    </script>
</body>
</html>