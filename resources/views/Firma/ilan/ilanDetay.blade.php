@extends('layouts.app')
@section('content')
<?php use Carbon\Carbon;
    $dt = Carbon::today();
    $time = Carbon::parse($dt);
    $dt = $time->format('Y-m-d');
    ?>
    <script src="{{asset('js/noUiSlider/nouislider.js')}}"></script>
    <link href="{{asset('css/noUiSlider/nouislider.css')}}" rel="stylesheet"></link>
    <script src="{{asset('js/wNumb.js')}}"></script>
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
    .minFiyat{
        background: yellow;
    }
    .kismiKazanan{
        background: #1cff00;
    }
    .ajax-loader {
        visibility: hidden;
        background-color: rgba(255,255,255,0.7);
        position: absolute;
        z-index: +100 !important;
        width: 100%;
        height:100%;
    }

    .ajax-loader img {
        position: relative;
        top:50%;
        left:32%;
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
  background: #5bc0de;
  padding: .5em 1em;
  margin-top: 1em;
  color:white;
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

</style>
<body>

    <div class="container">
        <br>
        <br>
        @include('layouts.alt_menu')
        <div class="ajax-loader">
            <img src="{{asset('images/200w.gif')}}" class="img-responsive" />
        </div>
        <div class="panel panel-warning">
            <div class="panel-heading"><h4><strong>{{$ilan->adi}}</strong> ilanı </h4></div>
            <div class="panel-body">
                <div id="exTab2" class="col-lg-8">
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
                                 <td>{{date('d-m-Y', strtotime($ilan->yayin_tarihi))}}</td>
                             </tr>
                             <tr>
                                 <td>İlan Kapanma Tarihi:</td>
                                 <td>{{date('d-m-Y', strtotime($ilan->kapanma_tarihi))}}</td>
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
                                        else if($ilan->usulu == 2){
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
                                 <?php if($ilan->sozlesme_turu == 0){
                                            $ilansozlesme="Birim Fiyatlı";
                                        }
                                        else if($ilan->sozlesme_turu == 1){
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
                                 <td>{{date('d-m-Y', strtotime($ilan->is_baslama_tarihi))}}</td>
                             </tr>
                             <tr>
                                 <td>İş Bitiş Tarihi:</td>
                                 <td>{{date('d-m-Y', strtotime($ilan->is_bitis_tarihi))}}</td>
                             </tr>
                            </table>
                            @if($ilan->firma_id == session()->get('firma_id'))
                            <a href="{{ URL::to('ilanEkle', array($firma->id,$ilan->id), false) }}" style="float:right"><input  type="button" name="ilanDuzenle" class="btn btn-info" value="İlanı Düzenle" ></a>
                                @endif
                        </div>
                        <div class="tab-pane" id="2">
                            <?php $firma=$ilan->firmalar;?>
                                <h3>{{$firma->adi}}'nın {{$ilan->adi}} İlanına Teklif  Ver</h3>
                                <hr>
                            @if(session()->get('firma_id') != $firma->id )
                                @if($ilan->ilan_turu == 1 && $ilan->sozlesme_turu == 0)
                                       @include('Firma.ilan.malTeklif')
                                @elseif($ilan->ilan_turu == 2 && $ilan->sozlesme_turu == 0)
                                       @include('Firma.ilan.hizmetTeklif')
                                @elseif($ilan->ilan_turu == 3)
                                       @include('Firma.ilan.yapimIsiTeklif')
                                @else
                                       @include('Firma.ilan.goturuBedelTeklif')
                                @endif
                            @endif
                        </div>
                        <div class="tab-pane kismiRekabet" id="3">
                            @if($ilan->kismi_fiyat == 1)
                                @include('Firma.ilan.kismiRekabet')
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-warning" >
                        <div class="panel-heading">{{$ilan->firmalar->adi}} Profili</div>
                        <div class="panel-body">
                            <div class="" align="center"><img src="{{asset('uploads')}}/{{$ilan->firmalar->logo}}" alt="HTML5 Icon" style="width:128px;height:128px;"></div>
                            <div align="center">
                                <br>
                                <Strong>Firmaya ait ilan sayısı:</strong> {{$ilan->firmalar->ilanlar()->count()}}
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-warning kismiDiv">
                        <div class="panel-heading">Rekabet</div>
                        <div class="panel-body rekabet">
                            @include('Firma.ilan.rekabet')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <?php $j=0;$k=0;
          $kullanici = App\Kullanici::find(session()->get('kullanici_id'));
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
<script src="{{asset('js/sortAnimation.js')}}"></script>
<script src="{{asset('js/jquery.turkLirasi.min.js')}}"></script>
<script>
    var fiyat;
    var temp=0;
    var count=0;
    var toplamFiyat;
    var kdvsizToplamFiyat;
    var ilan_turu={{$ilan->ilan_turu}};
    var sozlesme_turu={{$ilan->sozlesme_turu}};
    $(function() {
    var updating = false;
    $("#toplamFiyatLabel").on('fnLabelChanged', function(){
        console.log('changed');
    });
    function voteClick(table) {
    		if (!updating) {
            updating = true;
            $("html").trigger('startUpdate');

           sortTable(table, function() {
                updating = false;
                $("html").trigger('stopUpdate');
            }); //callback
        }
    }

    function makeClickable(table) {
        $('.up', table).each(function() {
            $(this).css('cursor', 'pointer').click(function() {
                voteClick(table);
            });
        });
        $('.down', table).each(function() {
            $(this).css('cursor', 'pointer').click(function() {
                voteClick(table);
            });
        });
        $('thead tr th').each(function() {
            $(this).css('cursor', 'pointer').click(function() {
                updating = true;
                $("html").trigger('startUpdate');

                //Current sort
                $(".anim\\:sort", $(this).parent()).removeClass("anim:sort");
                $(this).addClass("anim:sort");

                sortTable(table, function() {
                    updating = false;
                    $("html").trigger('stopUpdate');
                }); //callback
            })
        });
    }

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    var inverse = false;

    function compareCells(a, b) {

        var b = $.text([b]);
        var a = $.text([a]);

        var arrA = a.split(' ');
        var arrB = b.split(' ');

            a = arrA[0];
            b = arrB[0];

        if (isNumber(a) && isNumber(b)) {
            return parseInt(b) - parseInt(a);
        } else {
            return a.localeCompare(b);
        }
    }

    /**
     * Update the ranks (1-n) of a table
     * @param table A jQuery table object
     * @param index The row index to put the positions in
     */

    function updateRank(table, index) {
        var position = 1;
        if (!index) index = 1;

        $("tbody tr", table).each(function() {
            var cell = $("td:nth-child(" + index + ")", this);
            if (parseInt(cell.text()) != position) cell.text(position); //only change if needed
            position++;
        });
    }

    /**
     * jQuery compare arrays
     */
    jQuery.fn.compare = function(t) {
        if (this.length != t.length) {
            return false;
        }
        var a = this,
            b = t;
        for (var i = 0; t[i]; i++) {
            if (a[i] !== b[i]) {
                return false;
            }
        }
        return true;
    };

    /**
     * Sort a provided table by a row
     * @param currentTable A jQuery table object
     * @param index The row index to sort on
     */

    function sortTable(currentTable, callback) {
        var newTable = currentTable.clone();
        newTable.hide();
        $('.demo').append(newTable);

        //What one are we ordering on?
        var sortIndex = $(newTable).find(".anim\\:sort").index();

        //Old table order
        var idIndex = $(newTable).find(".anim\\:id").index();
        var startList = newTable.find('td').filter(function() {
            return $(this).index() === idIndex;
        });

        //Sort the list
        newTable.find('td').filter(function() {
            return $(this).index() === sortIndex;
        }).sortElements(compareCells, function() { // parentNode is the element we want to move
            return this.parentNode;
        });

        //New table order
        var idIndex = $(newTable).find(".anim\\:id").index();
        var endList = newTable.find('td').filter(function() {
            return $(this).index() === idIndex;
        });

        if (!$(startList).compare(endList)) { //has the order actually changed?
            makeClickable(newTable);
            updateRank(newTable);
            if (!callback) currentTable.rankingTableUpdate(newTable);
            else {
                currentTable.rankingTableUpdate(newTable, {
                    onComplete: callback
                });
            }
        } else {
            callback(); //we're done
        }
    }

    // Do the work!

    $('.kdv').on('input', function() {
        var kdv=parseFloat(this.value);
        var result;
        if($(this).parent().next().children().val() !== '')
        {
            var miktar = 1;
            if(ilan_turu === 1 && sozlesme_turu == 0){  /// mal
                miktar = parseFloat($(this).parent().prev().prev().text());
            }else if(ilan_turu === 2 && sozlesme_turu == 0){  ///hizmet
                miktar = parseFloat($(this).parent().prev().prev().text());
            }else if(ilan_turu === 3){     //yapim işi
                miktar = parseFloat($(this).parent().prev().prev().text());
            }else{

            }
            fiyat=parseFloat($(this).parent().next().children().val());
            if(isNaN(fiyat)) {
                fiyat = 0;
            }
            result=((fiyat+(fiyat*kdv)/100)*miktar).toFixed(2);
            $(this).parent().next().next().next().children().html(result);
            toplamFiyat=0;
            $("span.kalem_toplam").each(function(){
                var n = new Number($(this).html());
                toplamFiyat += n;
            });
            kdvsizToplamFiyat=0;
            var y = 0;
            $(".kdvsizFiyat").each(function(){
                var n = new Number($(this).val());
                if(n == 0){
                    y = 1
                }
                parseFloat(n);
                kdvsizToplamFiyat += ((n.toFixed(2))*miktar);
            });
            alert(kdvsizToplamFiyat);
            if(y == 0 && {{$ilan->kismi_fiyat}} == 1){
                $('#iskontoLabel').text(" İskonto Ver");
                $('#iskonto').prop("type", "checkbox");
            }
            else if(y == 1 && {{$ilan->kismi_fiyat}} == 1){
                $('#iskontoLabel').text("");
                $('#iskonto').prop("type", "hidden");
                $('#iskonto').attr('checked', false);
                canselIskontoVal();
            }
            if($('#iskonto').is(":checked")) {
                $('#iskontoVal').trigger('input');
            }
            var parabirimi = "{{$ilan->para_birimleri->adi}}";
            var symbolP;
            console.log(parabirimi);
            if(parabirimi.indexOf("Lirası") !== -1){
                symbolP = String.fromCharCode(8378);
            }
            else if(parabirimi === "Dolar"){
                symbolP= String.fromCharCode(36);
            }
            else{
                symbolP= String.fromCharCode(8364);
            }
            $("#toplamFiyatLabel").text("KDV Dahil Toplam Fiyat: " + toplamFiyat.toFixed(2)+" "+symbolP);
            $("#toplamFiyatL").text("KDV Hariç Toplam Fiyat: "+kdvsizToplamFiyat.toFixed(2)+" "+symbolP);
            $(".firmaFiyat").html("<strong>"+toplamFiyat.toFixed(2)+"</strong>"+" "+symbolP);
            voteClick($('#table'));
            $("#toplamFiyat").val(toplamFiyat.toFixed(2));
            $("#toplamFiyatKdvsiz").val(kdvsizToplamFiyat.toFixed(2));
        }
    });

    $('.fiyat').on('input', function() {
        var fiyat=parseFloat(this.value);
        if(isNaN(fiyat)) {
            fiyat = 0;
        }
        var result;
        if($(this).parent().prev().children().val() !== null)
        {
            var miktar = 1;
            if(ilan_turu === 1 && sozlesme_turu == 0){  /// mal
                miktar = parseFloat($(this).parent().prev().prev().prev().text());
            }else if(ilan_turu === 2 && sozlesme_turu == 0){  ///hizmet
                miktar = parseFloat($(this).parent().prev().prev().prev().text());
            }else if(ilan_turu === 3){     //yapim işi
                miktar = parseFloat($(this).parent().prev().prev().prev().text());
            }else{

            }
            kdv=parseFloat($(this).parent().prev().children().val());
            if(isNaN(fiyat)) {
                fiyat = 0;
            }
            result=((fiyat+(fiyat*kdv)/100)*miktar).toFixed(2);
            toplamFiyat += result;
            $(this).parent().next().next().children().html(result);
            toplamFiyat=0;
            $("span.kalem_toplam").each(function(){
                var n = new Number($(this).html());
                toplamFiyat += n;
            });
            kdvsizToplamFiyat=0;
            var y = 0;
            $(".kdvsizFiyat").each(function(){

                var miktarI = parseFloat($(this).parent().prev().prev().prev().text());
                var n = new Number($(this).val());
                if(n == 0){
                    y = 1
                }
                parseFloat(n);
                kdvsizToplamFiyat += ((n.toFixed(2))*miktar);
            });
            if(y == 0 && {{$ilan->kismi_fiyat}} == 1){
                $('#iskontoLabel').text(" İskonto Ver");
                $('#iskonto').prop("type", "checkbox");
            }
            else if(y == 1 && {{$ilan->kismi_fiyat}} == 1){
                $('#iskontoLabel').text("");
                $('#iskonto').prop("type", "hidden");
                $('#iskonto').attr('checked', false);
                canselIskontoVal();
            }
            if($('#iskonto').is(":checked")) {
                $('#iskontoVal').trigger('input');
            }
            var parabirimi = "{{$ilan->para_birimleri->adi}}";
            var symbolP;
            if(parabirimi.indexOf("Lirası") !== -1){
                symbolP = String.fromCharCode(8378);
            }
            else if(parabirimi === "Dolar"){
                symbolP= String.fromCharCode(36);
            }
            else{
                symbolP= String.fromCharCode(8364);
            }
            $("#toplamFiyatLabel").text("KDV Dahil Toplam Fiyat: " + toplamFiyat.toFixed(2)+" "+symbolP);
            $(".firmaFiyat").html("<strong>"+toplamFiyat.toFixed(2)+"</strong>"+" "+symbolP);
            voteClick($('#table'));
            $("#toplamFiyatL").text("KDV Hariç Toplam Fiyat: "+kdvsizToplamFiyat.toFixed(2)+" "+symbolP);
            $("#toplamFiyat").val(toplamFiyat.toFixed(2));
            $("#toplamFiyatKdvsiz").val(kdvsizToplamFiyat.toFixed(2));
        }
    });

});
    //$("#turkLirasi").turkLirasi();

    $('#iskontoVal').on('input',function(){
        var iskontoOrani = parseInt($(this).val());

        if(isNaN(iskontoOrani)) {
            iskontoOrani = 0;
        }
        alert("dif");
        var iskontoluToplamFiyatKdvsiz = kdvsizToplamFiyat.toFixed(2)- (kdvsizToplamFiyat.toFixed(2)* iskontoOrani)/100;
        var iskontoluToplamFiyatKdvli = toplamFiyat.toFixed(2)- (toplamFiyat.toFixed(2)* iskontoOrani)/100;
        alert(iskontoluToplamFiyatKdvsiz);
        $("#iskontoluToplamFiyatLabel").text("İskontolu KDV Dahil Toplam Fiyat: " + iskontoluToplamFiyatKdvli.toFixed(2));
        $("#iskontoluToplamFiyatL").text("İskontolu KDV Hariç Toplam Fiyat: "+iskontoluToplamFiyatKdvsiz.toFixed(2));
        $("#iskontoluToplamFiyatKdvli").val(iskontoluToplamFiyatKdvli.toFixed(2));
        $("#iskontoluToplamFiyatKdvsiz").val(iskontoluToplamFiyatKdvsiz.toFixed(2));
    });

    $('.teklifGonder').on('click', function() {
        alert('Bu ilana teklif vermek istediğinize emin misiniz ? ');
    });
    $('.firmaButton').on('click', function() {
       var selected = $("#radioDiv input[type='radio']:checked").val();
        $.ajax({
            type:"GET",
            url: "{{asset('set_session')}}",
            data: { role: selected },
            }).done(function(data){
                $('#myModalSirketListe').modal('toggle');
                location.reload();
            }).fail(function(){
                alert('Yüklenemiyor !!!  ');
            });
    });
    (function($) {
        var element = $('.kismiDiv'),
            originalY = element.offset().top;

        // Space between element and top of screen (when scrolling)
        var topMargin = 20;

        // Should probably be set in CSS; but here just for emphasis
        element.css('position', 'relative');
        element.css('z-index', '4');
        $(window).on('scroll', function(event) {
            var scrollTop = $(window).scrollTop()+80;

            element.stop(false, false).animate({
                top: scrollTop < originalY
                        ? 0
                        : scrollTop - originalY + topMargin
            }, 300);
        });
    })(jQuery);

    $(document).ready(function() {
        var firmaId = "{{session()->get('firma_id')}}";
        if(firmaId === ""){
            $('#myModalSirketListe').modal({
                show: 'true'
            });
        }
        var k=0;
        $('.kdv').each( function() {
            $("#kdv"+k).trigger('input');
            k++;
        });
        $("#iskonto").click(function() {
            if($(this).is(":checked")) {
                $('#iskontoVal').prop("type", "text");
            }
            else{
                canselIskontoVal();
            }
        });

        $("#teklifForm").submit(function(e)
        {
            var postData = $(this).serialize();
            var formURL = $(this).attr('action');
            var ilan_id = {{$ilan->id}};
            //console.log($(this).attr("url"));
            $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    $.ajax(
                        {
                            url : "{{asset('rekabet')}}" + ilan_id,
                            type: "GET",
                            success:function(data, textStatus, jqXHR)
                            {
                                $('.rekabet').html(data);
                                $('.ajax-loader').css("visibility", "hidden");
                            },
                            error: function(jqXHR, textStatus, errorThrown)
                            {
                                alert(textStatus + "," + errorThrown);
                            }
                        });
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
            e.preventDefault(); //STOP default action
        });
    });
    function canselIskontoVal(){
        $('#iskontoVal').prop("type", "hidden");
        $('#iskontoVal').val(null);
        $("#iskontoluToplamFiyatLabel").text("");
        $("#iskontoluToplamFiyatL").text("");
    }


</script>
@endsection
