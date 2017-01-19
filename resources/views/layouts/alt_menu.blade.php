<nav class="navbar navbar-inverse">
             <div class="container-fluid">
                 <div class="navbar-header">
                     <a class="navbar-brand" href="#"><img src='{{asset('images/anasayfa.png')}}'></a>
                 </div>
                 <ul class="nav navbar-nav">
                     
                     <li class=""><a href="{{ URL::to('firmaProfili', array($firma->id), false)}}">Firma Profili</a></li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">İlan İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="{{ URL::to('ilanlarim', array($firma->id), false)}}">İlanlarım</a></li>
                             
                             <li><a href="{{ URL::to('ilanEkle', array($firma->id,'0'), false)}}">İlan Oluştur</a></li>
                         </ul>
                     </li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Başvuru İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             
                            
                             <li><a href="{{ URL::to('basvurularim', array($firma->id), false)}}">Başvurularım</a></li>
                          
                             
                             <li><a href="{{url('ilanAra/')}}">Başvur</a></li>
                             
                         </ul>
                     </li>
                     <li><a href="#">Mesajlar</a></li>
                       <li><a href="{{ URL::to('kullaniciBilgileri', array($firma->id), false)}}">Bilgilerim</a></li>
                     <li><a href="{{ URL::to('kullaniciIslemleri', array($firma->id), false)}}">Kullanici İşlemleri</a></li>
                 </ul>
             </div>
</nav>
