<?php
    use App\Adres;
    use App\Il;
    use App\Ilce;
    use App\IletisimBilgisi;
    use App\Semt;
?>
@extends('layouts.app')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{asset('css/firmaDetayProfil.css')}}"/>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            text-align: left;
            padding: 5px;
        }
        .button {
            background-color: #555555; /* Green */
            border: none;
            color: white;
            padding: 10px 22px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            margin: 4px 2px;
            cursor: pointer;
            float:right;
        }
        .button1 {
            background-color: #555555; /* Green */
            border: none;
            color: white;
            padding: 10px 22px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            margin: 4px 2px;
            cursor: pointer;
            float:left;
        }
        .puanlama {
            background: #dddddd;
            width: 49px;
            height:59px;
            border-radius: 3px;
            position: relative;
            margin: auto;
            margin-left:8px;
            text-align: center;
            color: white;
            display:inline-block;

        }
        point { 
            display: block;
            font-size: 26px;
            letter-spacing: -1px;
            margin-top: 0.1em;
            margin-bottom: 1em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
            
        }
            .bilgiEkle{
            text-align: center;
            height:67px;
            border-width:2px;
            border-style:dotted;
            border-color:#ddd
                
            }
            .test + .tooltip > .tooltip-inner {
            background-color: #73AD21; 
            color: #FFFFFF; 
            border: 1px solid green; 
            padding: 10px;
            font-size: 12px;
            }
            .test + .tooltip.bottom > .tooltip-arrow {
                border-bottom: 5px solid green;
            }
            .w3-right {
            float: right!important;
        }
        
        .w3-margin-right {
            margin-right: 16px!important;
        }
        
        .w3-badge {
            border-radius: 50%;
        }
        
        .w3-badge, .w3-tag {
            background-color: #000;
            color: #fff;
            display: inline-block;
            padding-left: 8px;
            padding-right: 8px;
            text-align: center;
        }
    </style>
@endsection

@section('content')

   <div class="container">
       <br>
      <div class="row">
        <div   class="col-sm-3">	
            <br>
            <br>
            <div class="row" align="center">
                  <img src="{{asset('uploads')}}/{{$firma->logo}}" alt="HTML5 Icon" style="width: 128px;height:128px">
            </div>
            <br>
            <div   class="row" align="center">  
                    <div class=" puanlama " >
                        <span  class="test" data-toggle="tooltip" data-placement="bottom" title="Ürün/Hizmet Kalitesi" style="font-size:10px;letter-spacing: 1px;">Kalite</span><point class="point">{{number_format($firma->kalite_puan_ort,1)}}</point>
                    </div>
                    <div class=" puanlama " >
                        <span class="test" data-toggle="tooltip" data-placement="bottom" title="Ürün Teslimatı" style="font-size:10px;letter-spacing: 1px;">Teslimat</span><point class="point">{{number_format($firma->teslimat_puan_ort,1)}}</point> 
                   </div>
                    <div class="puanlama " >
                        <span class="test" data-toggle="tooltip" data-placement="bottom" title="Teknik ve Yönetsel Yeterlilik" style="font-size:10px;letter-spacing: 1px;">Teknik</span><point class="point">{{number_format($firma->teknik_puan_ort,1)}}</point>
                   </div>
                    <div class=" puanlama  " >
                        <span  class="test" data-toggle="tooltip" data-placement="bottom" title="İletişim ve Esneklik" style="font-size:10px;letter-spacing: 1px;">Esneklik</span><point class="point">{{number_format($firma->esneklik_puan_ort,1)}}</point>
                    </div>
            </div>
        </div>
        <div  id="exTab2"  class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a  href="#1" data-toggle="tab"> <strong>{{$firma->adi}}</strong> Firma Profili</a>
                </li>
                <li><a href="#2" data-toggle="tab">Onaylı Tedarikciler &nbsp; <span class="w3-badge w3-right w3-margin-right">{{$firma->onayliTedarikciler->count()}}</span></a>
                </li>
                <li><a href="#3" data-toggle="tab">Yorumlar &nbsp;
                        <?php $toplamYorum = $firma->yorumlar->count(); ?>
                        @if($toplamYorum==0)
                           <span class="w3-badge w3-right w3-margin-right">0</span>
                        @else
                          <span class="w3-badge w3-right w3-margin-right">{{$toplamYorum}}</span>
                        @endif
                    </a>
                </li>
            </ul>
            <div class="tab-content ">
                <div class="tab-pane active" id="1">
                    <br>
                                <div  class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div style="padding: 0px;" class="panel-body">
                                            <h5 ><img src="{{asset('images/phone.png')}}">&nbsp;<strong>İletişim Bilgileri</strong></h5>
                                            <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">
                                                    <tr>
                                                        <td><strong>Adres</strong></td>
                                                        <td><strong>:</strong>  {{$firma->adresler[0]->adres}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td width="25%"><strong>İli</strong></td>
                                                        <td width="75%"><strong>:</strong>  {{$firma->adresler[0]->iller->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td><strong>İlçesi</strong></td>
                                                        <td><strong>:</strong>  {{$firma->adresler[0]->ilceler->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td><strong>Semt</strong></td>
                                                        <td><strong>:</strong>  {{$firma->adresler[0]->semtler->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td><strong>Telefon</strong></td>
                                                        <td><strong>:</strong>  {{$firma->iletisim_bilgileri->telefon}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td><strong>Fax</strong></td>
                                                        <td><strong>:</strong>  {{$firma->iletisim_bilgileri->fax}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td><strong>Web Sayfası</strong></td>
                                                        <td><strong>:</strong>  {{$firma->iletisim_bilgileri->web_sayfasi}}</td>

                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    @if($firma->tanitim_yazisi=="")
                                    @else
                                    <div class="panel panel-default">
                                        <div style="padding: 0px;" class="panel-body">
                                            <h5><img src="{{asset('images/yazi.png')}}">&nbsp;<strong>Firma Tanıtım Yazısı</strong></h5>
                                            <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">
                                                    <tr id="firma{{$firma->id}}">
                                                    <tr>
                                                        <td width="25%"><strong>Tanıtım Yazısı</strong></td>
                                                        <td width="75%"><strong>:</strong>
                                                            <?php echo $firma->tanitim_yazisi; ?>
                                                        </td>
                                                    </tr>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if(!$firma->mali_bilgiler)
                                    @else
                                    <div class="panel panel-default">
                                        <div  style="padding: 0px;" class="panel-body">
                                            <h5><img src="{{asset('images/mali.png')}}">&nbsp;<strong>Mali Bilgileri</strong></h5>
                                            <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">
                                                    <tr>
                                                        <td width="25%"><strong>Firma Ünvanı</strong></td>
                                                        <td width="75%"><strong>:</strong>{{$firma->mali_bilgiler->unvani}}</td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td><strong>Şirket Türü</strong></td>
                                                        @if($firma->sirket_turleri)
                                                            <td><strong>:</strong>  {{$firma->sirket_turleri->adi}}</td>
                                                        @endif
                                                    </tr>
                                                    @if ($firma->adresler[1])
                                                    <tr>
                                                        <td><strong>Fatura Adresi</strong></td>
                                                        <td><strong>:</strong>  {{$firma->adresler[1]->adres}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>İli</strong></td>
                                                        <td><strong>:</strong>  {{$firma->adresler[1]->iller->adi}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>İlçesi</strong></td>
                                                        <td><strong>:</strong>  {{$firma->adresler[1]->ilceler->adi}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Semt</strong></td>
                                                        <td><strong>:</strong>  {{$firma->adresler[1]->semtler->adi}}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td><strong>Vergi Dairesi</strong></td>                                                        
                                                        <td><strong>:</strong>  {{$firma->mali_bilgiler->vergi_daireleri->adi}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Vergi Numarası</strong></td>
                                                        <td><strong>:</strong>  {{$firma->mali_bilgiler->vergi_numarasi}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Yıllık Cirosu</strong></td>
                                                        <td><strong>:</strong>  {{$firma->mali_bilgiler->yillik_cirosu}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Sermayesi</strong></td>
                                                        <td><strong>:</strong>  {{$firma->mali_bilgiler->sermayesi}}</</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="panel panel-default">
                                        <div style="padding: 0px;" class="panel-body">
                                            <h5> <img src="{{asset('images/tl.png')}}">&nbsp;<strong>Ticari Bilgiler</strong></h5>
                                            @if (!$firma->ticari_bilgiler)
                                            @else
                                            <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">
                                                    <tr>
                                                        <td width="25%"><strong>Ticaret Sicil No</strong></td>
                                                        <td width="75%"><strong>:</strong>  {{$firma->ticari_bilgiler->tic_sicil_no}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Ticaret Odası</strong></td>
                                                        <td><strong>:</strong>  {{$firma->ticari_bilgiler->ticaret_odalari->adi}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Üst Sektör</strong></td>
                                                        <td><strong>:</strong> {{$firma->getUstSektor()}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Faliyet Sektör</strong></td>
                                                        <td><strong>:</strong>@foreach($firma->sektorler as $sektor)
                                                            {{$sektor->adi}}
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Firma Departmanları</strong></td>
                                                        <td><strong>:</strong>@foreach($firma->departmanlar as $departman)
                                                            {{$departman->adi}}
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Kuruluş Tarihi</strong></td>
                                                        @if($firma->kurulus_tarihi=="0000-00-00")
                                                            <td><strong>:</strong> </td>
                                                        @else
                                                            <td><strong>:</strong> {{$firma->kurulus_tarihi}}</td>
                                                        @endif
                                                    </tr> 
                                                    <tr>
                                                        <td><strong>Firma Faaliyet Türü</strong></td>
                                                        <td><strong>:</strong>
                                                            @foreach($firma->faaliyetler as $faaliyet)
                                                                {{$faaliyet->adi}}
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Firmanın Ürettiği Markalar</strong></td>
                                                        <td><strong>:</strong>
                                                            @foreach($firma->uretilen_markalar as $marka)
                                                                {{$marka->adi}}
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Firmanın Sattığı Markalar</strong></td>
                                                        <td id="sattıgı_id_td"><strong>:</strong>
                                                             @if(count($firma->firma_satilan_markalar) > 1)
                                                                 @foreach($firma->firma_satilan_markalar as $satMarka)
                                                                     {{$satMarka->satilan_marka_adi}}
                                                                 @endforeach
                                                             @endif 
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                 
                                    @if(!$firma->kalite_belgeleri)
                                    @else 
                                    <div class="panel panel-default">
                                        <div style="padding: 0px;" class="panel-body">
                                            <h5><img src="{{asset('images/kalite.png')}}">&nbsp;<strong>Kalite Belgeleri</strong></h5>
                                          
                                            <div class="panel-footer">
                                                <table class="table" >
                                                    <thead id="tasks-list" name="tasks-list">
                                                    <th>Kalite Belgesi:</th>
                                                    <th>Belge NO:</th>

                                                    @foreach($firma->kalite_belgeleri as $kalite_belgesi)
                                                    <tr>
                                                        <td>
                                                            {{$kalite_belgesi->adi}}
                                                        </td>
                                                        <td>
                                                            {{$kalite_belgesi->pivot->belge_no}}
                                                        </td>
                                                       
                                                     </tr>
                                                        @endforeach
                                                        </thead>
                                                </table>
                                            </div>
                                         </div>
                                    </div>
                                    @endif
                                    @if(!$firma->firma_referanslar)
                                    @else
                                    <div class="panel panel-default">
                                        <div  style="padding: 0px;" class="panel-body">
                                            <h5><img src="{{asset('images/kalite.png')}}">&nbsp;<strong>Referanslar</strong></h5>
                                         
                                            <div class="panel-footer ">
                                              
                                                <table class="table" >
                                                    <thead id="tasks-list" name="tasks-list">
                                                        <tr id="firma{{$firma->id}}">
                                                        <tr>
                                                            <th>Firma Adı:</th>
                                                            <th>Yapılan İşin Adı:</th>
                                                            <th>İşin Türü:</th>
                                                            <th>Çalişma Süresi:</th>
                                                            <th>Yetkili Kişi Adı:</th>
                                                            <th>Yetkili Kişi Email Adresi:</th>
                                                            <th>Yetkili Kişi Telefon:</th>
                                                            <th>Referans Türü:</th>
                                                            <th>İş Yılı:</th>
                                                            <th></th>
                                                        </tr>
                                                        @foreach($firma->firma_referanslar as $firmaReferans)
                                                        <tr>
                                                            <td>
                                                                {{$firmaReferans->adi}}
                                                            </td>
                                                            <td>
                                                                {{$firmaReferans->is_adi}}
                                                            </td>
                                                            <td>
                                                                {{$firmaReferans->is_turu}}
                                                            </td>
                                                            <td>
                                                                {{$firmaReferans->calisma_suresi}}
                                                            </td>
                                                            <td>
                                                                {{$firmaReferans->yetkili_adi}}
                                                            </td>
                                                            <td>
                                                                {{$firmaReferans->yetkili_email}}
                                                            </td>
                                                            <td>
                                                                {{$firmaReferans->yetkili_telefon}}
                                                            </td>
                                                            <td>
                                                                {{$firmaReferans->ref_turu}}
                                                            </td>
                                                            <td>
                                                                @if($firmaReferans->is_yili=="0000-00-00")

                                                                @else
                                                                {{$firmaReferans->is_yili}}
                                                                @endif
                                                            </td>
                                                        
                                                        <input type="hidden" name="ref_id"  id="ref_id" value="{{$firmaReferans->id}}"> 
                                                            </tr>
                                                            @endforeach

                                                      </thead>
                                                   </table>
                                                           
                                                  <input type="hidden" name="add"  id="add" value="add"> 
                                             </div>
                                        </div>
                                    </div>
                                    @endif
                                   
                                    @if(!$firma->firma_brosurler)
                                            
                                    @else
                                    <div class="panel panel-default">
                                        
                                        <div style="padding: 0px;" class="panel-body">
                                            <h5><img src="{{asset('images/brosur.png')}}">&nbsp;<strong>Firma Broşürü</strong></h5>
                                            <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">
                                                <th>Broşür Adı:</th>
                                                <th>Broşür Pdf:</th>

                                                @foreach($firma->firma_brosurler as $firmaBrosur)
                                                    <tr>   
                                                        <td>
                                                            {{$firmaBrosur->adi}}
                                                        </td>
                                                        <td>
                                                            <a href="{{ asset('brosur/'.$firmaBrosur->yolu) }}">{{$firmaBrosur->yolu}}</a>
                                                        </td>
                                                        <td>

                                                        <input type="hidden" name="brosur_id"  id="brosur_id" value="{{$firmaBrosur->id}}"> 
                                                    </tr>
                                               @endforeach
                                                </thead>
                                            </table>
                                       </div>
                                    </div>
                                     @endif
                                     
                                     @if(!$firma->firma_calisma_bilgileri)

                                     @else
                                    <div class="panel panel-default">
                                        <div style="padding: 0px;" class="panel-body">
                                             <h5><img src="{{asset('images/calisan.png')}}">&nbsp;<strong>Firma Çalışan Bilgileri</strong></h5>
                                           
                                            <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">
                                                    <tr id="firma{{$firma->id}}">
                                                    <tr>
                                                        <td width="25%"><strong>Çalışma Günleri</strong></td>
                                                        <td width="75%"><strong>:</strong>  {{$firma->firma_calisma_bilgileri->calisma_gunleri->adi}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Çalışma Saatleri</strong></td>
                                                        <td><strong>:</strong>  {{$firma->firma_calisma_bilgileri->calisma_saatleri}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Çalışan Profili</strong></td>
                                                        <td><strong>:</strong>  {{$firma->firma_calisma_bilgileri->calisan_profili}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Çalışan Sayısı</strong></td>
                                                        <td><strong>:</strong>  {{$firma->firma_calisma_bilgileri->calisan_sayisi}}</td>
                                                    </tr>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                   @endif
                                   @if($firma->bilgilendirme_tercihi==null)
                                   @else
                                    <div class="panel panel-default">
                                     
                                        <div  style="padding: 0px;" class="panel-body">
                                            <h5><strong><img src="{{asset('images/bilgilendirme.png')}}">&nbsp;Bilgilendirme Tercihi</strong></h5>
                                          
                                            <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">
                                                    <tr id="firma{{$firma->id}}">
                                                    <tr>
                                                        <td width="25%"><strong>Bilgilendirme Tercihi</strong></td>
                                                        <td width="75%"><strong>:</strong>  {{$firma->bilgilendirme_tercihi}}</td>
                                                    </tr>
                                                    </tr>
                                                </thead>
                                            </table>
                                           
                                        </div>
                                    </div>
                                @endif
                                </div>
                   
                </div>
                 <div class="tab-pane" id="2">
                     <br>
                     @foreach($firma->onayliTedarikciler as $onayli)
                        <a href="{{url('firmaDetay/'.$onayli->id)}}" ><p>{{$onayli->adi}}</p></a>
                     @endforeach
                </div>
                <div class="tab-pane" id="3">
                    <br>
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div style="background-color:#ddd;border-color: #ddd" class="panel-heading">
                                        <strong>Firmaya Yapılan Yorumlar &nbsp;
                                            @if($toplamYorum==0)
                                            
                                               (Henüz bu firma için yorum yapılmamıştır)
                                            @else
                                             ({{$toplamYorum}})
                                            @endif
                                           
                                        </strong>
                                    </div>
                                    @foreach($yorumlar as $yorum)
                                    
                                        <div style="border: 1px solid #ddd;" class="panel-body">
                                            <div class="row">
                                                 <div class="col-sm-4">
                                                    <div class="col-sm-12" >
                                                        <img src="{{asset('uploads')}}/{{$yorum->logo}}" alt="HTML5 Icon" style="width:50px;height:50px;">
                                                        <strong>{{$yorum->adi}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                   <div  style="font-size:10px"class="col-sm-3">Kalite:{{$yorum->kriter1}}</div>
                                                   <div style="font-size:10px" class="col-sm-3">Teslimat:{{$yorum->kriter2}}</div>
                                                   <div style="font-size:10px" class="col-sm-3">Teknik:{{$yorum->kriter3}}</div>
                                                   <div style="font-size:10px" class="col-sm-3">Esneklik:{{$yorum->kriter4}}</div>
                                               </div>
                                                <div class="col-sm-4">
                                                    <div style="float:right" class="col-sm-6" >{{$yorum->tarih}}</div>
                                                </div>
                                            </div>
                                            <div  style="text-align:center;"class="row">{{$yorum->yorum}}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                   </div> 
            </div>
        </div>
      </div> 
    </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });

        $(".puanlama").each(function(){
            
            var puan = $(this).children().next().text();
            if(puan > 0 && puan < 3){
                $(this).css("background", "#e65100");
            }
            else if (puan >= 3 && puan <= 5){
                $(this).css("background", "#e54100");
            }
            else if (puan > 5 && puan <= 6){
                $(this).css("background", "#f46f02");
            }
            else if (puan > 5 && puan <= 6){
                $(this).css("background", "#f46f02");
            }
            else if (puan > 6 && puan <= 7){
                $(this).css("background", "#ffba04");
            }
            else if (puan > 7 && puan <= 8){
                $(this).css("background", "#d6d036");
            }
            else if (puan > 8 && puan <= 9){
                $(this).css("background", "#a5c530");
            }
            else if (puan > 9 && puan <= 10){
                $(this).css("background", "#45c538");
            }
        });
    </script>
@endsection


