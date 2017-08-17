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
     <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        div#header{
          width: 100%;
          height: 100px;
          background-image:url("{{asset('images/header.jpg')}}");
          margin: 0;
          padding: 5px;
          z-index:1080;
        }
        div#contentarea{
          padding: 10px;
        }
        body.sticky div#header{
          position: fixed;
          top: 0;
          left: 0;
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
			stickyclass= 'sticky'

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

<body id="app-layout">
      <nav  class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="position: relative;top:-69px;margin-bottom:-69px" >
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
                <ul class="nav navbar-nav" style="float:right;z-index:2em">
                    
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
                            <?php
                              $firmaAdi = session()->get('firma_adi');
                              $firmaId = session()->get('firma_id');
                            ?>
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false">
                               {{session()->get('kullanici_adi') }} / {{$firmaAdi}}<span class="caret"></span>
                            </a>
                           
                            <ul class="dropdown-menu">
                                <li class="dropdown yazi" style="display:block;padding: 3px 20px">Firma İşlemleri</li>
                                    <?php                                   
                                        $kullanici = App\Kullanici::find(Auth::user()->id);
                                        $kullaniciF=$kullanici->firmalar()->where('onay',1)->get();
                                    ?>
                                    @foreach($kullaniciF as $kullanicifirma)
                                        <ul style="list-style-type:square">
                                            <li ><a  style="padding:0px" href="#" class="firmaSec" name="{{$kullanicifirma->id}}">{{$kullanicifirma->adi}}</a></li>
                                        </ul>
                                    @endforeach
                                <li><a href="{{url('yeniFirmaKaydet/')}}" class="yazi"><i class="fa fa-btn fa-sign-out"></i>Yeni Firma Ekle</a></li>
                                <li><a href="{{ URL::to('kullaniciBilgileri', false)}}" class="yazi"><i class="fa fa-btn fa-sign-out"></i>Bilgilerim</a></li>
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
                        <a href="{{url('ilanAra/')}}">İLAN ARA</a>
                    </li>
                </ul>
            </div>
         
        </div>
    
    </nav>

    @yield('content')
    <div class="container">
     <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2016</p>
                </div>
            </div>
    </footer>
    </div>
    <!-- JavaScripts -->
    <script src="{{ elixir('js/app.js') }}"></script> 
     
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
            if(count==1){
                   selected='{{$kullanicifirma->id}}';
                 
                   funcLocations();
            }

        @endif
    }); 
         
    $('.firmaSec').on('click', function() {

        selected = $(this).attr('name');
        funcLocations();
        click=1;

    });
    function funcLocations(){

            if(session_value === "" || click === 1){
                $.ajax({
                    type:"GET",
                     url: "{{asset('set_session')}}",
                     data: { role: selected },
                     }).done(function(data){
                                console.log(data); 

                                if(click==1 ){  
                                  location.href="{{asset('firmaIslemleri')}}"+"/"+selected;
                                }
                                }).fail(function(){ 
                                    alert('Yüklenemiyor !!!  ');
                                });

            }
     }

    </script>
</body>
</html>
