
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=1226">
        <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <title>Tamrekabet</title>  
 
    <!--link rel="shortcut icon" href="" mce_href="" /--sayfa köşesine koyulacak logo yeri-->
    <script src="{{asset('kariyerJS/one.js')}}"></script>
    <link href="{{asset('kariyerCss/five.css')}}" rel="stylesheet"/>
    <link href="{{asset('kariyerCss/one.css')}}" rel="stylesheet"/>
    <link href="{{asset('kariyerCss/two.css')}}" rel="stylesheet"/>
    <link href="{{asset('kariyerCss/three.css')}}" rel="stylesheet"/>
    <link href="{{asset('kariyerCss/four.css')}}" rel="stylesheet"/>
    <script src="{{asset('kariyeJS/two.js')}}"></script>


</head>




<body class="header-static">
 
    <header id="Header" class="header headerstyle7">
        <div id="adayLogin"></div>

        <div class="wrapper">
            <!-- logo -->
            <div class="logo">
              <!--img src="" height="45" width="195">TAMREKABET</img-->

              <a class="navbar-brand" href="{{ url('/') }}" style="padding:13px 30px;font-size:30px">TamRekabet</a>
                
            </div>
            <!-- menu -->
            <nav class="nav">
                <ul style="float:right">
                  @if (Auth::guest())
                    
                    <li class="is-ara">
                        <a href="{{url('ilanAra/')}}" >İLAN ARA</a>
                    </li>
               

                  <ul style="float:right">
                    <li >
                        <a href="{{ url('/firmaKayit') }}" >ÜYE OL</a>
                       
                    </li>
                    <li >
                        <a href="{{ url('/login') }}">ÜYE GİRİŞ</a>
                        
                    </li>
                    <li>
                        <a  href="#"><img src="{{asset('images/user.png')}}"></a>
                        
                    </li>
                  
                  </ul>
                   @else
                    <li class="is-ara">
                        <a href="{{url('ilanAra/')}}" >İLAN ARA</a>
                    </li>
                   
                    <li>
                       <a href="" onclick=""> {{ Auth::user()->name }}</a>
                       <ul>
                           <li>
                               <a href=""  onclick="">Firma İşlemleri</a>
                               <ul style="list-style-type:square">
                                   <?php
                                   $kullanici = App\Kullanici::find(Auth::user()->kullanici_id);
                                   ?>
                                   @foreach($kullanici->firmalar as $kullanicifirma)
                                   <li>
                                       <a href="{{ URL::to('firmaIslemleri', array($kullanicifirma->id), false)}}"  onclick="">{{$kullanicifirma->adi}}</a>
                                   </li>
                                   @endforeach

                               </ul>
                           </li>
                            <li>
                                <a href="{{url('yeniFirmaKaydet/'.$kullanici->id)}}" >Yeni Firma Ekle</a>
                            </li>
                          <li>
                               <a href="" target="_blank" onclick="">Yardım</a>
                           </li>
                           <li>
                               <a href="{{ url('/logout') }}" target="_blank" onclick="">Çıkış</a>
                           </li>

                       </ul>
                    </li>

                   
                    <li>
                        <a href="#"><img src="{{asset('images/user.png')}}"></a>
                    </li>
                @endif
                   
               </ul>
            </nav>
          
        </div>
      
    </header>

    
<!-- JOB SEARCH -->

    <section class="job-search" style="">
        <div class="wrapper">
            <!-- title -->
             <?php $ilan = DB::table('ilanlar')->count();?>
                    <h1>
                        Senin için  burada {{$ilan}} ilan var!
                    </h1>
            <!-- search area -->
            <div class="search-area">
                <!-- find job -->
                <div class="find-job">
                    <!-- search -->
                    <div class="search">
                        <!-- city combo -->
                        <div class="city-combo">
                            <div class="select disable-selected">
                                <select id="ulkesehirid1" name="" class="select2" data-placeholder="Şehir">
                                    <option value=""></option>
                                   
                                </select>
                                <input type="hidden" name="ulkesehirid" id="ulkesehirid" />
                            </div>
                        </div>
                        <!-- autocomplete -->
                        <div class="autocomplete">
                            <input name="" id="" type="text" placeholder="Pozisyon, firma adı, sektör">
                           
                        </div>
                    </div>
                    <!-- button -->
                    <div class="button">
                        <a id="btnFindWork" href="" onclick="">
                            İŞ BUL
                        </a>
                    </div>
                </div>
                <!-- detailed search -->
                <div class="detailed-search">
                    <a id="btnFindDetailWork" href="" onclick="">
                        DETAYLI ARA
                    </a>
                </div>
            </div>
        </div>
    </section>

<!-- FEATURED JOBS -->
    <section class="featured-jobs " >
        <div class=" wrapper">
        <!-- title -->
        <h2>ÖNE ÇIKAN İŞ İLANLARI</h2>
        <!-- rotator -->
        <div class="rotator">
         
            <!-- item -->
                <div class="item">
                    <!-- job -->
                    <a href="" target="_blank" class="job"></a>
                    <!-- firm -->
                    <a href="" onclick="" target="_blank" class=" firm">
                     
                    </a>
                    <!-- logo -->
                        <a href="" onclick="dataLayer.push({ 'Category': 'Anasayfa', 'Action': 'One Cikan Ilanlar', 'Label': 17192, 'event': 'gaEvent' }); dataLayer.push({'pageView': '/vp/funnel/one-cikanlar', 'event': 'virtualPageView' });" target="_blank" class="logo">
                            <!-- canlıya geçişte değiştiirlecek. -->
                            
                            <img class="grayscale grayscale-fade" src="" alt="">
                        </a>
                    
                </div>
             <div class="item">
                    <!-- job -->
                    <a href="" target="_blank" class="job"></a>
                    <!-- firm -->
                    <a href="" onclick="" target="_blank" class=" firm">
                     
                    </a>
                    <!-- logo -->
                        <a href="" onclick="dataLayer.push({ 'Category': 'Anasayfa', 'Action': 'One Cikan Ilanlar', 'Label': 17192, 'event': 'gaEvent' }); dataLayer.push({'pageView': '/vp/funnel/one-cikanlar', 'event': 'virtualPageView' });" target="_blank" class="logo">
                            <!-- canlıya geçişte değiştiirlecek. -->
                            
                            <img class="grayscale grayscale-fade" src="" alt="">
                        </a>
                    
                </div>
             <div class="item">
                    <!-- job -->
                    <a href="" target="_blank" class="job"></a>
                    <!-- firm -->
                    <a href="" onclick="" target="_blank" class=" firm">
                     
                    </a>
                    <!-- logo -->
                        <a href="" onclick="dataLayer.push({ 'Category': 'Anasayfa', 'Action': 'One Cikan Ilanlar', 'Label': 17192, 'event': 'gaEvent' }); dataLayer.push({'pageView': '/vp/funnel/one-cikanlar', 'event': 'virtualPageView' });" target="_blank" class="logo">
                            <!-- canlıya geçişte değiştiirlecek. -->
                            
                            <img class="grayscale grayscale-fade" src="" alt="">
                        </a>
                    
                </div>
             <div class="item">
                    <!-- job -->
                    <a href="" target="_blank" class="job"></a>
                    <!-- firm -->
                    <a href="" onclick="" target="_blank" class=" firm">
                     
                    </a>
                    <!-- logo -->
                        <a href="" onclick="dataLayer.push({ 'Category': 'Anasayfa', 'Action': 'One Cikan Ilanlar', 'Label': 17192, 'event': 'gaEvent' }); dataLayer.push({'pageView': '/vp/funnel/one-cikanlar', 'event': 'virtualPageView' });" target="_blank" class="logo">
                            <!-- canlıya geçişte değiştiirlecek. -->
                            
                            <img class="grayscale grayscale-fade" src="" alt="">
                        </a>
                    
                </div>
             <div class="item">
                    <!-- job -->
                    <a href="" target="_blank" class="job"></a>
                    <!-- firm -->
                    <a href="" onclick="" target="_blank" class=" firm">
                     
                    </a>
                    <!-- logo -->
                        <a href="" onclick="dataLayer.push({ 'Category': 'Anasayfa', 'Action': 'One Cikan Ilanlar', 'Label': 17192, 'event': 'gaEvent' }); dataLayer.push({'pageView': '/vp/funnel/one-cikanlar', 'event': 'virtualPageView' });" target="_blank" class="logo">
                            <!-- canlıya geçişte değiştiirlecek. -->
                            
                            <img class="grayscale grayscale-fade" src="" alt="">
                        </a>
                    
                </div>
             <div class="item">
                    <!-- job -->
                    <a href="" target="_blank" class="job"></a>
                    <!-- firm -->
                    <a href="" onclick="" target="_blank" class=" firm">
                     
                    </a>
                    <!-- logo -->
                        <a href="" onclick="dataLayer.push({ 'Category': 'Anasayfa', 'Action': 'One Cikan Ilanlar', 'Label': 17192, 'event': 'gaEvent' }); dataLayer.push({'pageView': '/vp/funnel/one-cikanlar', 'event': 'virtualPageView' });" target="_blank" class="logo">
                            <!-- canlıya geçişte değiştiirlecek. -->
                            
                            <img class="grayscale grayscale-fade" src="" alt="">
                        </a>
                    
                </div>
            <!-- item -->
        
        </div>
        </div>
    </section>
<!-- JOB CARDS -->

<section class="job-cards alternative">
    <div class="wrapper">
        <!-- bana uygun ilan -->
           <div class="item bana-uygun">
                <!-- text -->
                <div class="text">
                    <!-- title -->
                    <h3>BANA UYGUN İLANLAR</h3>
                    <!-- count -->
                    
                </div>
                <!-- image -->
                <div class="image">
                    <img src="" alt="">
                    <div class="mask"></div>
                </div>
                <!-- hidden link -->                
                <a href="" onclick="" class="hidden-link"></a>
            </div>
        <!-- uzman -->
        <div class="item uzman">
            <!-- hover -->
            <div class="hover"></div>
            <!-- text -->
            <div class="text">
                <!-- title -->
                <h3>UZMAN</h3>
                <!-- count -->
                <p class="count">22.589 İŞ İLANI</p>
                <!-- link: incelemek için tıkla -->
                <a href="" class="link" onclick="">İNCELEMEK İÇİN TIKLA</a>
            </div>
            <!-- image -->
            <img src="" alt="">
            <!-- hidden link -->
            <a href="" class=""></a>
        </div>
        <!-- yonetici -->
        <div class="item yonetici">
            <!-- hover -->
            <div class="hover"></div>
            <!-- text -->
            <div class="text">
                <!-- title -->
                <h3>YÖNETİCİ</h3>
                <!-- count -->
                <p class="count">4.693 İŞ İLANI</p>
                <!-- link: incelemek için tıkla -->
                <a href="" class="link" onclick="">İNCELEMEK İÇİN TIKLA</a>
            </div>
            <!-- image -->
            <img src="" alt="">
            <!-- hidden link -->
            <a href="" class="hidden-link" onclick=""></a>
        </div>
        <!-- yeni mezun -->
        <div class="item yeni-mezun">
            <!-- hover -->
            <div class="hover"></div>
            <!-- text -->
            <div class="text">
                <!-- title -->
                <h3>YENİ MEZUN</h3>
                <!-- count -->
                <p class="count">2.261 İŞ İLANI</p>
                <!-- link: incelemek için tıkla -->
                <a href="" class="link" onclick="">İNCELEMEK İÇİN TIKLA</a>
            </div>
            <!-- image -->
            <img src="" alt="">
            <!-- hidden link -->
            <a href="" class="hidden-link" onclick=""></a>
        </div>
        <!-- isci -->
        <div class="item isci">
            <!-- hover -->
            <div class="hover"></div>
            <!-- text -->
            <div class="text">
                <!-- title -->
                <h3>İŞÇİ</h3>
                <!-- count -->
                <p class="count">5.671 İŞ İLANI</p>
                <!-- link: incelemek için tıkla -->
                <a href="" class="link" onclick="">İNCELEMEK İÇİN TIKLA</a>
            </div>
            <!-- image -->
            <img src="" alt="">
            <!-- hidden link -->
            <a href="" class="hidden-link" onclick=""></a>
        </div>
        <!-- hizmet personeli -->
        <div class="item hizmet-personeli">
            <!-- hover -->
            <div class="hover"></div>
            <!-- text -->
            <div class="text">
                <!-- title -->
                <h3>HİZMET<br>PERSONELİ</h3>
                <!-- count -->
                <p class="count">1.784 İŞ İLANI</p>
                <!-- link: incelemek için tıkla -->
                <a href="" class="link" onclick="">
                    İNCELEMEK İÇİN TIKLA
                </a>
            </div>
            <!-- image -->
            <img src="" alt="">
            <!-- hidden link -->
            <a href="" class="hidden-link" onclick="">
            </a>
        </div>
    </div>
</section>
<!-- JOB LIST -->
<section class="job-list uclu-butonlar">
    <div class="wrapper">
        <!-- count list -->
        <div class="count-list">
            <!-- yayında olan -->
            <div class="box ilk ">
                <a href="" onclick="">
                    BUGÜN YAYINLANAN <span class="count">4.938 İLAN </span>
                </a>
            </div>
            <!-- sadece knet yayınlanan -->
            
            <!-- Öğrenci iş ilanları -->
            <div class="box sadece">
                <a href="" onclick="">
                    PART - TIME İŞ İLANLARI<span class="count">159 İLAN </span>
                </a>
            </div>
            <!-- ilk defa yayınlanan -->
            <div class="box yayinda">
                <a href="" onclick="">
                    STAJ İŞ İLANLARI <span class="count">678 İLAN</span>
                </a>
            </div>
        </div>
    </div>
</section>


<section class="job-list kategoriler">
    <div class="wrapper">
        <!-- text list -->
        <div class="text-list">
            <!-- kategorilerine göre ilanlar -->
            <div class="box">
                <!-- title -->
                <h5>Kategorilerine Göre İlanlar</h5>
                <!-- links -->
                <ul>
                        <li>
                           DOLDUR 
                        </li>
                      
                </ul>
            </div>
        </div>
    </div>
</section>



<!-- CAREER GUIDE -->
    <section class="career-guide ">
        <div class="wrapper">
            <h2>Onlar Kariyerini Nasıl Çizdi?</h2>
            <div class="rotator career-container">
                    <div class="item">
                        <div class="image">
                            <img src="" alt="">
                            <div class="mask"></div>
                        </div>
                        <div class="text">
                            <div class="quote">
                                <span><a href="" onclick="" target="_blank"></a></span>
                            </div>
                            <p class="name"></p>
                            <p class="title"></p>
                            <p class="msg"></p>
                            <div class="btn-container">
                                <a href="" onclick="dataLayer.push({ 'Category': 'Anasayfa', 'Action': 'Kariyer Rehberi', 'Label': 'Spor tutkunu adayları bekliyoruz', 'event': 'gaEvent' });" target="_blank">Daha fazlası i&#231;in Kariyer Rehberi&#39;ne git</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image">
                            <img src="" alt="">
                            <div class="mask"></div>
                        </div>
                        <div class="text">
                            <div class="quote">
                                <span><a href="" onclick="" target="_blank"></a></span>
                            </div>
                            <p class="name"></p>
                            <p class="title"></p>
                            <p class="msg"> </p>
                            <div class="btn-container">
                                <a href="" onclick=" " target="_blank">Daha fazlası i&#231;in Kariyer Rehberi&#39;ne git</a>
                            </div>
                        </div>
                    </div>
                    
            </div>
        </div>
    </section>

<!-- ACHIEVEMENTS -->


    <!-- FOOTER -->
<footer class="footer ">
    <div class="wrapper">
        <!-- top section -->
        <div class="top-section">
            <!-- nav -->
            
            <!-- social -->
            <div class="social">
                <ul>
                    <li>
                        <a class="twitter" href="" target="_blank" onclick=""></a>
                    </li>
                    <li>
                        <a class="facebook" href="" target="_blank" onclick=""></a>
                    </li>
                    <li>
                        <a class="gplus" href="" target="_blank" onclick=""></a>
                    </li>
                </ul>
            </div>
            <!-- mobile -->
            <div class="mobile">
                <ul>
                    <li>
                        <a href="" class="ios" target="_blank" onclick="">
                        </a>
                    </li>
                    <li>
                        <a href="" class="android" target="_blank" onclick=""></a>
                    </li>
                </ul>
            </div>
        </div>
      
    </div>
</footer>

    <script src="{{asset('kariyerJS/three.js')}}"></script> 
    <!--script src="{{asset('kariyerJS/four.js')}}"></script-->
    <!--script src="{{asset('kariyerJS/five.js')}}"></script-->
    <script src="{{asset('kariyerJS/six.js')}}"></script>

</body>
</html>
