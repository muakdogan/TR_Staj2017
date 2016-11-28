
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
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('js/ilan/ajax-crud-firmabilgilerim.js')}}"></script>
      
    <style>
        .yazi{
            font-family:"Times New Roman";
            
            background-color: #ccc;
                
        }
        
    </style>
    

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
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false">
                               {{ Auth::user()->name }}<span class="caret"></span>
                            </a>
                           
                            <ul class="dropdown-menu">
                                <li class="dropdown"><a class="dropdown-toggle yazi" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Firma İşlemleri</a>
                                    <?php 
                                   
                                     $kullanici = App\Kullanici::find(Auth::user()->kullanici_id);
                                     $kullaniciF=$kullanici->firmalar()->where('onay','onay')->get();
                                    ?>
                                    @foreach($kullaniciF as $kullanicifirma)
                                        <ul style="list-style-type:square">
                                        <li ><a href="{{ URL::to('firmaIslemleri', array($kullanicifirma->id,$kullanici->id), false)}}">{{$kullanicifirma->adi}}</a></li>
                                        
                                        </ul>
                                    @endforeach
                                <li><a href="{{url('yeniFirmaKaydet/'.$kullanici->id)}}" class="yazi"><i class="fa fa-btn fa-sign-out"></i>Yeni Firma Ekle</a></li>
                                <li><a href="" class="yazi"><i class="fa fa-btn fa-sign-out"></i>Yardım</a></li>
                                <li><a href="{{ url('/logout') }}" class="yazi"><i class="fa fa-btn fa-sign-out"></i>Çıkış</a></li>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
