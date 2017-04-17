@extends('layouts.app')
<?php use Carbon\Carbon;
    $dt = Carbon::today();
    $time = Carbon::parse($dt);
    $dt = $time->format('Y-m-d');
    ?>
<br>
 <br>
 @section('content')
    <script src="{{asset('js/noUiSlider/nouislider.js')}}"></script>
    <script src="{{asset('js/wNumb.js')}}"></script>
    <link href="{{asset('css/noUiSlider/nouislider.css')}}" rel="stylesheet"></link>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css"></link>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    
 <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #fff;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #fff;
}
.div5{
    float:right;
}
.div6{
    float:left;
}
.button {
    background-color: #ccc; /* Green */
    border: none;
    color: white;
    padding: 6px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
}
.add
{
  transition: box-shadow .2s linear, margin .3s linear .5s;
}
.add.active
{
  margin:0 98px;
  transition: box-shadow .2s linear, margin .3s linear;
}
.button:link
{
  color: #eee;
  text-decoration: none;
}
.button:visited
{
  color: #eee;
}
.button:hover
{
  box-shadow:none;
}
.button:active,
.button.active {
  color: #eee;
  border-color: #C24032;
  box-shadow: 0px 0px 4px #C24032 inset;
}
nav ul li a:active {
  color: #eee;
}
nav ul li a.active {
  color: #eee;
}
.dialog {
  position: relative;
  text-align: center;
  background: #fff;
  margin: 13px 0 4px 4px;
  display: inline-block;
}
.dialog:after,
.dialog:before {
  bottom: 100%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}
.dialog:after {
  border-color: rgba(255, 255, 255, 0);
  border-bottom-color: #5C9CCE;
  border-width: 15px;
  left: 50%;
  margin-left: -15px;
}
.dialog:before {
  border-color: rgba(170, 170, 170, 0);
  border-width: 16px;
  left: 50%;
  margin-left: -16px;
}
.dialog .title {
  font-weight: bold;
  text-align: center;
  border: 1px solid #eeeeee;
  border-radius: 8px;
  border-width: 0px 0px 1px 0px;
  margin-left: 0;
  margin-right: 0;
  margin-bottom: 4px;
  margin-top: 8px;
  padding: 8px 16px;
  background: #fff;
  font-size: 16px;
  line-height:2em;
}
.dialog .title:first-child {
  margin-top: -4px;
}
form
{
  padding:16px;
  padding-top: 0;
}
label1{
    display: inline-block;
    font-size: 12px;
}
textarea,input[type=text],input[type=datetime-local],input[type=time],select,label1
{
  color: #000;
  border-width: 0px 0px 1px 0px;
  border-radius: 8px;
  border:0px solid #ccc;
  outline: 0;
  resize: none;
  margin: 0;
  margin-top: 1em;
  padding: .5em;
  width:100%;
  border-bottom: 1px dotted rgba(250, 250, 250, 0.4);
  background:#fff;
  box-shadow:inset 0 2px 2px rgb(119, 119, 119);
}
input[type=text]:focus,input[type=datetime-local]:focus,input[type=time]:focus {
  background-color: #ddd;
}
input[type=submit]
{
  border:none;
  background: #FAFEFF;
  padding: .5em 1em;
  margin-top: 1em;
  color:#4478a0;
}
input[type=submit]:active
{
  background: #E1E5E5;
}
input:-moz-placeholder, textarea:-moz-placeholder {
	color: #555;
}
input:-ms-input-placeholder, textarea:-ms-input-placeholder {
  color: #555;
}
input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
  	color:#555;
}
    .blink_text {

    animation:2s blinker linear infinite;
    -webkit-animation:2s blinker linear infinite;
    -moz-animation:2s blinker linear infinite;
    }

    @-moz-keyframes blinker {  
     0% { opacity: 1.0; }
     50% { opacity: 0.0; }
     100% { opacity: 1.0; }
     }

    @-webkit-keyframes blinker {  
     0% { opacity: 1.0; }
     50% { opacity: 0.0; }
     100% { opacity: 1.0; }
     }

    @keyframes blinker {  
     0% { opacity: 1.0; }
     50% { opacity: 0.0; }
     100% { opacity: 1.0; }
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
     @keyframes fontbulger {
        0%, 100% {
          font-size: 10px;
        }
        50% {
          font-size: 12px;
        }
    }
    #box {
       animation: fontbulger 2s infinite;
        font-weight: bold;
    }


</style>
     <div class="container">
           @include('layouts.alt_menu')
                         <?php 
                           $ilanlarFirma = $firma->ilanlar()->
                           orderBy('yayin_tarihi','desc')->limit('5')->get();
                           
                          $aktif_ilanlar= DB::select(DB::raw("SELECT * , i.id AS ilan_id, i.adi AS ilan_adi
                            FROM ilanlar i, firmalar f
                            WHERE f.id = i.firma_id
                            AND f.id ='$firma->id'
                            AND NOT 
                            EXISTS (

                            SELECT * 
                            FROM kismi_kapali_kazananlar kk
                            WHERE kk.ilan_id = i.id
                            )
                            AND NOT 
                            EXISTS (

                            SELECT * 
                            FROM kismi_acik_kazananlar ka
                            WHERE ka.ilan_id = i.id
                            )
                            ORDER BY i.kapanma_tarihi ASC "));
                           $aktif_count= DB::select(DB::raw("SELECT COUNT( i.id ) AS count
                                FROM ilanlar i, firmalar f
                                WHERE f.id = i.firma_id
                                AND f.id ='$firma->id'
                                AND NOT 
                                EXISTS (
                                SELECT * 
                                FROM kismi_acik_kazananlar ka, kismi_kapali_kazananlar kk
                                WHERE ka.ilan_id = i.id
                                OR kk.ilan_id = i.id
                                )"));
                        ?>
        <div class="row">
            <div class="col-sm-9">
                <div class="panel panel-default">
                     @foreach($aktif_count as $count)
                     <div class="panel-heading"><strong>Aktif İlanlarım &nbsp;({{$count->count}} İlan)</strong></div>
                    @endforeach
                    <div class="panel-body">
                        <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead style=" font-size: 12px;">
                            <tr>
                                <th>Sıra</th>
                                <th>İlan Adı</th>
                                <th>Kapanma Tarihi</th>
                                <th>Verilen Teklif Sayısı</th>
                                <th></th>
                               
                            </tr>
                        </thead>
                        <tbody style="font_size:12px">
                            <?php 
                                $ilanlarım = $firma->ilanlar()->orderBy('kapanma_tarihi','desc')->get();
                                $i=1;
                            ?>
                            @foreach($aktif_ilanlar as $aktif_ilan)
                            <?php  
                                $aIlan=  \App\Ilan::find($aktif_ilan->ilan_id);
                                $ilanTeklifsayisi = $aIlan->teklifler()->count();
                            ?>
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$aktif_ilan->ilan_adi}}</td>
                                
                                <td>{{date('d-m-Y', strtotime($aktif_ilan->kapanma_tarihi))}}</td>
                                <td>{{$ilanTeklifsayisi}}</td>
                                
                                @if($aktif_ilan->kapanma_tarihi > $dt || $ilanTeklifsayisi == 0)
                                   <td> <a href="{{ URL::to('teklifGor', array($firma->id,$aktif_ilan->ilan_id), false) }}"><button style="float:right;padding: 4px 12px;font-size:12px" type="button" class="btn btn-info">Detay/Teklif Gör</button></a></td>
                                @else
                                <td> <a href="{{ URL::to('teklifGor', array($firma->id,$aktif_ilan->ilan_id), false) }}"><button style="background-color:00ff00 ;float:right;padding: 4px 12px;font-size:12px;height:28px;width: 113px" type="button" class="btn btn-info"><span  id=box>Kazananı İlan Et</span></button></a></td>

                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                
                <?php 
                    $ilanlarım = $firma->ilanlar()->orderBy('kapanma_tarihi','desc')->get();
                    $sonuc_ilanlar=DB::select(DB::raw("SELECT i.id AS ilan_id, i.adi AS ilan_adi, i.kapanma_tarihi AS kapanma_tarihi
                     FROM ilanlar i, firmalar f, kismi_kapali_kazananlar kk
                     WHERE f.id = i.firma_id
                     AND kk.ilan_id = i.id
                     AND f.id ='$firma->id'
                     UNION 
                     SELECT i.id AS ilan_id, i.adi AS ilan_adi, i.kapanma_tarihi AS kapanma_tarihi
                     FROM ilanlar i, firmalar f, kismi_acik_kazananlar ka
                     WHERE f.id = i.firma_id
                     AND ka.ilan_id = i.id
                     AND f.id ='$firma->id'
                     ORDER BY kapanma_tarihi ASC "));

                     $sonuc_kapali = 0;
                     foreach($sonuc_ilanlar as $sonucIla){
                      $sonuc_kapali++;
                     }

                     $i=0;
                     $kullanici_id=Auth::user()->kullanici_id;
                     $firma_id = session()->get('firma_id');
                     $j=1;
                ?>
                
            
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Sonuçlanmış İlanlarım &nbsp;({{$sonuc_kapali}} İlan)</strong></div>
                    <div class="panel-body">
                        <table id="sonuc" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead style=" font-size:12px">
                            <tr>
                                <th>Sıra</th>
                                <th>İlan Adı</th>
                                <th>Tarihi Sonuclanma </th>
                                <th>Verilen Teklif Sayısı</th>
                                <th>Kazanan Fiyat</th>
                                <th>Kazanan Firma</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sonuc_ilanlar as $ilan)
                            <tr>
                                <?php 
                                    $sIlan =  \App\Ilan::find($ilan->ilan_id);
                                    if(count($sIlan)!= 0){
                                        $ilanTeklif= $sIlan->teklifler()->count();
                                    }
                                    else
                                    {
                                        $ilanTeklif=0;
                                    }
                                ?>
                                <td>{{ $j++}}</td>
                                <td>{{$ilan->ilan_adi}}</td>
                                @if($sIlan->kismi_fiyat == 1 ) <!--Kismi Açık -->
                                    <?php 
                                        $kazananFiyat=0;
                                        $sonucTarihi = App\KismiAcikKazanan::where('ilan_id',$ilan->ilan_id)->get();
                                    ?>
                                    @foreach($sonucTarihi as $sonuclanma)
                                        <?php $kazananFiyat+=$sonuclanma->kazanan_fiyat?>
                                    @endforeach
                                    
                                     <td>{{date('d-m-Y', strtotime($sonuclanma->sonuclanma_tarihi))}}</td>
                                    <?php 
                                         if(count($sonucTarihi)!= 0){
                                          $sonucFirma=  App\Firma::find($sonuclanma->kazanan_firma_id); 
                                         }
                                         else{
                                             $sonucTarihi=" ";
                                         }
                                    ?>
                                @else<!--Kismi Kapali -->
                                    <?php 
                                       $sonucTarihiKapali = App\KismiKapaliKazanan::where('ilan_id',$ilan->ilan_id)->get();
                                       $kontrol=$sonucTarihiKapali->count();
                                       if(count($sonucTarihiKapali)!=0)
                                       {
                                           foreach ($sonucTarihiKapali as $sonucKapali){
                                            $sonucFirma=  App\Firma::find($sonucKapali->kazanan_firma_id); 
                                           }
                                       }
                                       else
                                       {
                                          $sonucTarihiKapali=" "; 
                                       }
                                    ?>
                                    @foreach($sonucTarihiKapali as $sonucKapali)
                                    
                                    <td>{{date('d-m-Y', strtotime($sonucKapali->sonuclanma_tarihi))}}</td>
                                    @endforeach
                                @endif
                                <td>{{$ilanTeklif}}</td>
                               
                                @if($sIlan->kismi_fiyat == 1 )
                                    <td><strong> {{number_format($kazananFiyat,2,'.','')}}</strong> &#8378;</td>
                                    <td>Optimum Fiyat</td>
                                @else
                                    <td><strong> {{number_format($sonucKapali->kazanan_fiyat,2,'.','')}}</strong> &#8378;</td>
                                    <td>{{$sonucFirma->adi}}</td>
                                @endif
                                <?php $existYorum = \App\Yorum::where('ilan_id',$ilan->ilan_id)->where('firma_id',$sonucFirma)->get();  ///////////// Daha önce yorum
                                        $existPuan = \App\Puanlama::where('ilan_id',$ilan->ilan_id)->where('firma_id',$sonucFirma)->get(); ///////yapılmış mı onun kontrolü
                                  ?>
                                <td>
                                    @if(count($existPuan) != 0 || count($existYorum) != 0)
                                        @if($sIlan->kismi_fiyat == 1 )
                                          <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->ilan_id), false) }}"><button style="float:right;padding: 4px 12px;font-size:12px" type="button" class="btn btn-info add" id="{{$i}}">Puan Ver/Yorum Yap</button></a>
                                        @else
                                          <a><button style="float:right;padding: 4px 12px;font-size:12px" type="button" class="btn btn-info add" id="{{$i}}">Puan Ver/Yorum Yap</button></a>
                                        @endif
                                    @else
                                    <a><button style="float:right;padding: 4px 12px;font-size:12px" type="button" class="btn btn-info add" id="{{$i}}" disabled>Puan Ver/Yorum Yap</button></a>
                                    @endif
                                <div class="modal fade" id="modalForm{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div style="background-color: #fcf8e3;" class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 style="font-size:14px" class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Puanla/Yorum Yap</strong></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="dialog" id="dialog{{$i++}}" style="display:none">
                                                    
                                                    {!! Form::open(array('url'=>'yorumPuan/'.$firma->id.'/'.$sonucFirma.'/'.$ilan->ilan_id.'/'.$kullanici_id,'method'=>'POST', 'files'=>true)) !!}
                                                      <div class="row col-lg-12">
                                                        <div class="col-lg-3">
                                                            <label1 name="kriter1" type="text" >Ürün/hizmet kalitesi</label1>
                                                          <div id="puanlama">
                                                              <div class="sliders" id="k{{$i}}"></div>
                                                              <input type="hidden" id="puan1" name="puan1" value="5"/>
                                                          </div>
                                                        </div>  
                                                        <div class="col-lg-3" style="border-color:#ddd">
                                                            <label1 name="kriter2" type="text"><br>Teslimat</label1>
                                                          <div id="puanlama">
                                                              <div class="sliders" id="k{{$i+1}}"></div>
                                                              <input type="hidden" id="puan2" name="puan2" value="5"/>
                                                          </div>
                                                        </div> 
                                                        <div class="col-lg-3">
                                                            <label1 name="kriter3" type="text">Teknik ve Yönetsel Yeterlilik</label1>
                                                          <div id="puanlama">
                                                              <div class="sliders" id="k{{$i+2}}"></div>
                                                              <input type="hidden" id="puan3" name="puan3" value="5"/>
                                                          </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label1 name="kriter4" type="text" >İletişim ve Esneklik</label1>
                                                          <div id="puanlama">
                                                              <div class="sliders" id="k{{$i+3}}"></div>
                                                              <input type="hidden" id="puan4" name="puan4" value="5"/>
                                                          </div>
                                                        </div> 
                                                      </div>
                                                        <?php $i=$i+3; ?>
                                                      <textarea name="yorum" placeholder="Yorum" cols="30" rows="5" wrap="soft"></textarea>
                                                      <input type="submit" value="Ok"/>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                            <div class="modal-footer">                                                            
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                     </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                    <div class="panel panel-default">
                        <div  style="background-color:00ff00;text-align:center;color:#fff" class="panel-heading"><strong>KAZANANI BELİRLE</strong><span id="blinker"><img src="{{asset('images/unlem.png')}}"> <img src="{{asset('images/unlem.png')}}"><img src="{{asset('images/unlem.png')}}"></span></div>
                        <div style="background-color:#ccffb3" class="panel-body">
                            <table style="font-size:12px">
                                  <tr>
                                   
                                    <th>İlan Adı</th>
                                  </tr>
                                @foreach($aktif_ilanlar as $aktif_ilan)
                                  @if($aktif_ilan->kapanma_tarihi < $dt)
                                      <tr>
                                        <td><a href="{{ URL::to('teklifGor', array($firma->id,$aktif_ilan->ilan_id), false) }}" class="test" data-toggle="tooltip" data-placement="bottom" title="Bu ilanın henüz kazananını belirlemediniz lütfen ilanın kazananını belirlemek için tıklayınız!">{{$aktif_ilan->ilan_adi}}</a></td>
                                      </tr>
                                  @else 
                                  @endif
                                @endforeach
                         </table>
                        </div>
                    </div>
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>İstatistik</strong></div>
                        <div  class="panel-body">
                            @foreach($aktif_count as $count)
                                <p><strong>Aktif İlan Sayısı:</strong>&nbsp;{{$count->count}}</p>
                            @endforeach
                                <p><strong>Sonuçlanmış İlan Sayısı:</strong>&nbsp;{{$sonuc_kapali}}</p>
                            <?php $toplamIlan=$firma->ilanlar()->count(); ?>
                            <p><strong>Toplam İlan Sayısı:</strong>&nbsp;{{$toplamIlan}}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready( function() {

    $('[data-toggle="tooltip"]').tooltip();   
    $('#example').DataTable({  
        "language": {
            "sDecimal":        ",",
            "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
            "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "sInfoEmpty":      "Kayıt yok",
            "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ".",
            "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
            "sLoadingRecords": "Yükleniyor...",
            "sProcessing":     "İşleniyor...",
            "sSearch":         "Ara:",
            "sZeroRecords":    "Eşleşen kayıt bulunamadı",
            "oPaginate": {
                    "sFirst":    "<<",
                    "sLast":     ">>",
                    "sNext":     ">",
                    "sPrevious": "<"
            },
            "oAria": {
                    "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                    "sSortDescending": ": azalan sütun soralamasını aktifleştir"
            }
        },
        "bLengthChange": false, ///// Bu kodu kaldırınca Sayfada kayıt göster kısmı ekrana gelicek.
        "iDisplayLength": 10,
        "bInfo":false, //// Bu kodu kaldırınca 2 kayıttan 1 - 2 arasındaki kayıtlar gösteriliyor gibi kısın aktive edilecek.
        "sPaginationType": "full_numbers"
});
$('#sonuc').DataTable({  
        "language": {
            "sDecimal":        ",",
            "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
            "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "sInfoEmpty":      "Kayıt yok",
            "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ".",
            "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
            "sLoadingRecords": "Yükleniyor...",
            "sProcessing":     "İşleniyor...",
            "sSearch":         "Ara:",
            "sZeroRecords":    "Eşleşen kayıt bulunamadı",
            "oPaginate": {
                    "sFirst":    "<<",
                    "sLast":     ">>",
                    "sNext":     ">",
                    "sPrevious": "<"
            },
            "oAria": {
                    "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                    "sSortDescending": ": azalan sütun soralamasını aktifleştir"
            }
        },
        "bLengthChange": false, ///// Bu kodu kaldırınca Sayfada kayıt göster kısmı ekrana gelicek.
        "iDisplayLength": 10,
        "bInfo":false ,//// Bu kodu kaldırınca 2 kayıttan 1 - 2 arasındaki kayıtlar gösteriliyor gibi kısım aktive edilecek.
        "sPaginationType": "full_numbers"
});
var blink_speed = 1500;
var t = setInterval(function () { var ele = document.getElementById("blinker"); ele.style.visibility = (ele.style.visibility == 'hidden' ? '' : 'hidden'); }, blink_speed);

    
    var changeNumber="";
    var length={{$i}};
    for(var key=0; key<{{$i}}; key++){
        $('#'+key).click(function(e){
            var j = $(this).attr('id');
          e.stopPropagation();
         if ($(this).hasClass('active')){
             alert("girdi");
            $('#dialog'+j).fadeOut(200);
            $(this).removeClass('active');
         } else {
            $('#modalForm'+j).modal('show');
            $('#dialog'+j).delay(300).fadeIn(200);
            $(this).addClass('active');
         }
       });
    }   
    function closeMenu(){
      $('.dialog').fadeOut(200);
      $('.add').removeClass('active');  
    }

    $(document.body).click( function(e) {
         closeMenu();
    });

    $(".dialog").click( function(e) {
        e.stopPropagation();
    });
    var sliders = document.getElementsByClassName('sliders');
    var connect = document.getElementsByClassName('noUi-connect');
    var tooltip = document.getElementsByClassName('noUi-tooltip');
    console.log(tooltip);
    var value = document.getElementsByClassName('value');
    for ( var i = 0; i < sliders.length; i++ ) {
        noUiSlider.create(sliders[i], {
                start: 5,
                step:1,
                connect: [true, false],
                range: {
                        'min':[1],
                        'max':[10]
                },
                format: wNumb({
                    decimals:0
                }),
                tooltips:true

        });
        var deneme;
        sliders[i].noUiSlider.on('slide', function( values, handle ,e){
            var idCount=$(this.target.id).selector;
            idCount=idCount.substring(1);
            console.log($(this));
            deneme = values[handle];
            deneme = parseInt(deneme);
            if(idCount % 5 === 1){
                $("#puan1").val(deneme);
            }
            else if(idCount % 5 === 2){
                $("#puan2").val(deneme);
            }
            else if(idCount % 5 === 3){
                $("#puan3").val(deneme);
            }
            else if(idCount % 5 === 4){
                $("#puan4").val(deneme);
            }
            idCount = parseInt(idCount)-1;
            if(deneme <= 4){
                connect[idCount].style.backgroundColor = "#e65100";
                tooltip[idCount].style.backgroundColor = "#e65100";
                tooltip[idCount].style.border = "1px solid #e65100";
            }
            else if(deneme === 5){
                connect[idCount].style.backgroundColor = "#e54100";
                tooltip[idCount].style.backgroundColor = "#e54100";
                tooltip[idCount].style.backgroundColor = "#e54100";
            }
            else if(deneme === 6){
                connect[idCount].style.backgroundColor = "#f46f02";
                tooltip[idCount].style.backgroundColor = "#f46f02";
                tooltip[idCount].style.border = "1px solid #f46f02";
            }
            else if(deneme === 7){
                connect[idCount].style.backgroundColor = "#ffba04";
                tooltip[idCount].style.backgroundColor = "#ffba04";
                tooltip[idCount].style.border = "1px solid #ffba04";
            }
            else if(deneme === 8){
                connect[idCount].style.backgroundColor = "#d6d036";
                tooltip[idCount].style.backgroundColor = "#d6d036";
                tooltip[idCount].style.border = "1px solid #d6d036";
            }
            else if(deneme === 9){
                connect[idCount].style.backgroundColor = "#a5c530";
                tooltip[idCount].style.backgroundColor = "#a5c530";
                tooltip[idCount].style.border = "1px solid #a5c530";
            }
            else if(deneme === 10){
                connect[idCount].style.backgroundColor = "#45c538";
                tooltip[idCount].style.backgroundColor = "#45c538";
                tooltip[idCount].style.border = "1px solid #45c538";
            }
            
            
        });
    }
        
});




</script>
@endsection
