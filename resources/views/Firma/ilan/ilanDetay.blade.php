@extends('layouts.app')
@section('content')
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
        width: 140px;
        height:65px;
        border-radius: 3px;
        position: relative;
        margin: auto;
        margin-left:8px;
        text-align: center;
        color: white;
    }
    point { 
        display: block;
        font-size: 1.49em;
        margin-top: 0.1em;
        margin-bottom: 1em;
        margin-left: 0;
        margin-right: 0;
        font-weight: bold;
    }
    .highlight{
        background:#faebcc;
    }
</style>
<body>
    <div class="container">
       <br>
       <br>
        <div class="panel panel-warning col-lg-12">
            <div class="panel-heading"><h4><strong>{{$ilan->adi}}</strong> ilanı </h4></div>
            <div class="panel-body" style="height:95px">
                <div id="exTab2" class="col-lg-10">	
                    <ul class="nav nav-tabs">
                        <li class="active"><a  href="#1" data-toggle="tab">İlan Bilgileri</a>
                        </li>
                        <li><a href="#2" data-toggle="tab">Kalem Listesi</a>
                        </li>
                        <li><a href="#3" data-toggle="tab">Rekabet</a>
                        </li>
                    </ul>
                    <div class="tab-content ">
                        <div class="tab-pane active" id="1">
                            <table class="table" >
                                
                            <?php $firma = $ilan->firmalar; ?>
                           
                             <tr>
                                 <td>Firma Adı:</td>
                                 <?php

                                 $firma->firma_sektorler = new App\FirmaSektor();
                                 $firma->firma_sektorler->sektorler = new App\Sektor();

                                 if($firma->goster=="Göster"){
                                 ?>
                                  <td>{{$firma->adi}}</td>
                                 <?php
                                 }
                                 else if($firma->goster=="Gizle"){    
                                 ?>
                                 <td>{{$firma->adi}}(GİZLİ)</td>
                                 <?php
                                 }
                                 ?>

                             </tr>

                             <tr>
                                 <td>İlan Adı:</td>

                                 <?php
                                 $firmaAdres = $firma->adresler()->first();
                                 if (!$firma->ilanlar)
                                     $firma->ilanlar = new App\Ilan();

                                 if (!$firmaAdres) {
                                     $firmaAdres = new Adres();
                                     $firmaAdres->iller = new Il();
                                     $firmaAdres->ilceler = new Ilce();
                                     $firmaAdres->semtler = new Semt();
                                 }
                                 ?>
                                 <td>{{$ilan->adi}}</td>
                             </tr>
                             <tr>
                                 <td>İlan Sektor:</td>
                                 <?php $sektorler = App\Sektor::all();?>
                                  @foreach($sektorler as $ilanSektor)
                                      <?php
                                if($ilanSektor->id == $ilan->firma_sektor){
                                    ?>
                                       <td>{{$ilanSektor->adi}}</td>
                                       <?php
                                }
                                ?>
                                @endforeach
                             </tr>
                             <tr>
                                 <td>İlan Yayınlama Tarihi:</td>
                                 <td>{{$ilan->yayin_tarihi}}</td>
                             </tr>
                             <tr>
                                 <td>İlan Kapanma Tarihi:</td>
                                 <td>{{$ilan->kapanma_tarihi}}</td>
                             </tr>
                             <tr>
                                 <td>İlan Açıklaması:</td>
                                 <td>{{$ilan->aciklama}}</td>
                             </tr>
                             <tr>
                                 <td>ilan Türü:</td>
                                 <?php if($ilan->ilan_turu == 1){
                                            $ilanturu="Mal";
                                        }
                                        else if($ilan->ilan_turu == 2){
                                            $ilanturu="Hizmet";
                                        }
                                        else{
                                            $ilanturu="Yapım İşi";
                                        }
                                 ?>
                                 <td>{{$ilanturu}}</td>
                             </tr>
                             <tr>
                                 <td>İlan Usulü:</td>
                                 <?php if($ilan->usulu == 1){
                                            $ilanusulu="Tamrekabet";
                                        }
                                        else if($ilan->ilan_turu == 2){
                                            $ilanusulu="Belirli İstekliler Arasında";
                                        }
                                        else{
                                            $ilanusulu="Sadece Başvuru";
                                        }
                                 ?>
                                 <td>{{$ilanusulu}}</td>
                             </tr>
                             <tr>
                                 <td>Sözleşme Türü:</td>
                                 <?php if($ilan->usulu == 0){
                                            $ilansozlesme="Birim Fiyatlı";
                                        }
                                        else if($ilan->ilan_turu == 1){
                                            $ilansozlesme="Götürü Bedel";
                                        }
                                 ?>
                                 <td>{{$ilansozlesme}}</td>
                             </tr>
                             <tr>
                                 <td>Teknik Şartname:</td>
                                 <td>{{$ilan->teknik_sartname}}</td>
                             </tr>
                             <tr>
                                 <td>Yaklaşık Maliyet:</td>
                                 <td>{{$ilan->yaklasik_maliyet}}</td>
                             </tr>
                             <tr>
                                 <td>Teslim Yeri:</td>
                                 <?php
                                 if ($ilan->teslim_yeri_satici_firma == NULL) {
                                     ?>  


                                     <?php
                                 } else {
                                     ?>
                                     <td>{{$ilan->teslim_yeri_satici_firma}}</td>
                                     <?php
                                 }
                                 ?>


                             </tr>
                             <tr>
                                 <td>İşin Süresi:</td>
                                 <td>{{$ilan->isin_suresi}}</td>
                             </tr>
                             <tr>
                                 <td>İş Başlama Tarihi:</td>
                                 <td>{{$ilan->is_baslama_tarihi}}</td>
                             </tr>
                             <tr>
                                 <td>İş Bitiş Tarihi:</td>
                                 <td>{{$ilan->is_bitis_tarihi}}</td>
                             </tr>
                      
                                
                            </table>
                        </div>
                        <div class="tab-pane" id="2">
                            <?php $firma=$ilan->firmalar;?>
                                      

                                      <h3>{{$firma->adi}}'nın {{$ilan->adi}} İlanına Teklif  Ver</h3>
                                        <hr>
                                <div class="panel-group" id="accordion">
                                           @include('Firma.ilan.malTeklif')  
                                </div>    
                        </div>
                        
                        <div class="tab-pane" id="3">
                              <?php $teklifler= App\Teklif::where('ilan_id',$ilan->id)->get();
                                    $tekliflerCount = App\Teklif::where('ilan_id',$ilan->id)->count();    
                              $i=0; $j=0; $ilanSahibi=0;?>
                            
                            <table class="table"> 
                                <thead>
                                    
                                    <tr>
                                        <td  width="10%">Sıra</td>
                                        <td  width="20%">Firma Adı</td>
                                        <td  width="20%">Verilen Fiyat({{$ilan->para_birimleri->adi}})</td>
                                        <td  width="50%"></td>
                                    </tr>
                                </thead>
                                <br>
                                
                                <tbody>
                                    @foreach($teklifler as $teklif)
                                        <?php $firmaAdi = App\Firma::find($teklif->firma_id);?>
                                        <?php $j++; ?>
                                        <tr>
                                            <?php $verilenFiyat = $teklif->teklif_hareketler()->orderBy('tarih','desc')->limit(1)->get();?>
                                            
                                            @if(session()->get('firma_id') == $firmaAdi->id)
                                                <td class="highlight">{{$j}}</td>
                                                <td class="highlight">{{$firmaAdi->adi}}:</td>
                                                <td class="highlight" style="text-align: right"><strong>{{$verilenFiyat[0]['kdv_dahil_fiyat']}}</strong></td>
                                                <td class="highlight"></td>
                                            <?php $sessionF= session()->get('firma_id'); $sahibF=$ilan->firmalar->id; ?>
                                            @elseif(session()->get('firma_id') == $ilan->firmalar->id)
                                                <?php $ilanSahibi= 1;?>
                                                <td>{{$j}}</td>
                                                <td>{{$firmaAdi->adi}}:</td>
                                                <td  style="text-align: right"><strong>{{$verilenFiyat[0]['kdv_dahil_fiyat']}}</strong></td>
                                                <td><button name="kazanan" style="float:right" type="button" class="btn btn-info">Kazanan</button></td>
                                                
                                            @else
                                                <?php $i++; ?>
                                                <td>{{$j}}</td>
                                                <td>X Firması :</td>
                                                <td style="text-align: right"><strong>{{$verilenFiyat[0]['kdv_dahil_fiyat']}}</strong></td>
                                                <td></td>
                                            @endif    
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>    
                           
                           
                        </div>
                    </div>
                </div>
                <div class="panel panel-warning col-lg-2">
                    <div class="panel-heading">{{$ilan->firmalar->adi}} Profili</div>
                    <div class="panel-body">
                        <div class="" ><img src="/22.11.2016tamrekabet/public/uploads/{{$ilan->firmalar->logo}}" alt="HTML5 Icon" style="width:128px;height:128px;"></div>
                        <div>
                            <br>
                            <Strong>Firmaya ait ilan sayısı:</strong> {{$ilan->firmalar->ilanlar()->count()}}
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
     <?php $j=0;$k=0;
          $kullanici = App\Kullanici::find(Auth::user()->kullanici_id);
      ?>
        <div class="modal fade" id="myModalSirketListe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                     <h4 class="modal-title" id="myModalLabel">Lütfen Şirket Seçiniz!</h4>
                </div>
                <div class="modal-body">
                    <p style="font-weight:bold;text-align: center;font-size:x-large">{{ Auth::user()->name }}  </p>
                    <hr>
                    <div id="radioDiv">
                        @foreach($kullanici->firmalar as $kullanicifirma)
                        <input type="radio" name="firmaSec" value="{{$kullanicifirma->id}}"> {{$kullanicifirma->adi}}<br>   
                        @endforeach
                    </div>
                    <button  style='float:right' type='button' class="firmaButton" class='btn btn-info'>Firma Seçiniz</button><br><br>
                </div>
                <div class="modal-footer">                                                            
                </div>
             </div>
            </div>
        </div>
        <br>
        <br>                                     
       <hr>     
        
</body>
<script>
    var fiyat;
    var temp=0;
    var count=0;
    var toplamFiyat;
    var kdvsizToplamFiyat;

    $('.kdv').on('input', function() {
        var kdv=parseFloat(this.value);
        var result;
        if($(this).parent().next().children().val() !== '')
        {
            var miktar = parseFloat($(this).parent().prev().prev().text());
            fiyat=parseFloat($(this).parent().next().children().val()); 
            result=((fiyat+(fiyat*kdv)/100)*miktar).toFixed(2);
            $(this).parent().next().next().next().children().html(result);
            toplamFiyat=0;
            $("span.kalem_toplam").each(function(){
                var n = new Number($(this).html());
                toplamFiyat += n;
            });
            kdvsizToplamFiyat=0;
            $(".kdvsizFiyat").each(function(){
                var n = new Number($(this).val());
                parseFloat(n);
                alert(n.toFixed(2));
                kdvsizToplamFiyat += ((n.toFixed(2))*miktar);
            });
            
            $("#toplamFiyatLabel").text("KDV Dahil Toplam Fiyat: " + toplamFiyat.toFixed(2));
            $("#toplamFiyatL").text("KDV Hariç Toplam Fiyat: "+kdvsizToplamFiyat.toFixed(2));
            $("#toplamFiyat").val(toplamFiyat.toFixed(2));
            $("#toplamFiyatKdvsiz").val(kdvsizToplamFiyat.toFixed(2));
        }  
    });

    $('.fiyat').on('input', function() {
        var fiyat=parseFloat(this.value);
        var result;
        if($(this).parent().prev().children().val() !== null)
        {
            var miktar = parseFloat($(this).parent().prev().prev().prev().text());
            kdv=parseFloat($(this).parent().prev().children().val());
            result=((fiyat+(fiyat*kdv)/100)*miktar).toFixed(2);
            toplamFiyat += result;
            $(this).parent().next().next().children().html(result);
            toplamFiyat=0;
            $("span.kalem_toplam").each(function(){
                var n = new Number($(this).html());
                toplamFiyat += n;
            });
            $("#toplamFiyatLabel").text("Toplam Fiyat: " + toplamFiyat);
            $("#toplamFiyatL").text(toplamFiyat);
            $("#toplamFiyat").val(toplamFiyat);
        }
    });

    $('.teklifGonder').on('click', function() {
        alert('Bu ilana teklif vermek istediğinize emin misiniz ? ');
    });
    $('.firmaButton').on('click', function() {
       var selected = $("#radioDiv input[type='radio']:checked").val();
        $.ajax({
            type:"GET",
            url: "../set_session",
            data: { role: selected },
            }).done(function(data){
                $('#myModalSirketListe').modal('toggle');
                location.reload();
            }).fail(function(){ 
                alert('Yüklenemiyor !!!  ');
            });
    });
    $(document).ready(function() {
        var firmaId = "{{session()->get('firma_id')}}";
        if(firmaId === ""){
            $('#myModalSirketListe').modal({
                show: 'true'
            });
        }
        var ilan_turu={{$ilan->ilan_turu}};
        var sozlesme_turu={{$ilan->sozlesme_turu}};    
        if(ilan_turu === "") 
        {
            $('#hizmet').hide();
            $('#mal').hide();
            $('#goturu').hide();
            $('#yapim').hide();
        }
        else if(ilan_turu === 1 && sozlesme_turu === 0)
            {
               $('#hizmet').hide();
               $('#goturu').hide();
               $('#yapim').hide();
            }
         else if(ilan_turu === 2 && sozlesme_turu === 0)
            {
               $('#mal').hide();
               $('#goturu').hide();
               $('#yapim').hide();
            }
         else if(sozlesme_turu === 1)
            {
               $('#hizmet').hide();
               $('#mal').hide();
               $('#yapim').hide();
            }
        else if(ilan_turu=== 3)
            {
               $('#hizmet').hide();
               $('#goturu').hide();
               $('#mal').hide();
            } 
        var tcount ={{$tekliflerCount}};
        var i = {{$i}};
        var ilanSahibi = {{$ilanSahibi}};
        if(tcount === i && ilanSahibi !== 1) {
            $('#3').hide();
        }
        var k=0;
        $('.kdv').each( function() {
            $("#kdv"+k).trigger('input');
            k++;
        });
        
    });
    
    
    
</script>
@endsection