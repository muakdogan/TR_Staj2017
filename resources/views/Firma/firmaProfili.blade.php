<?php
    use App\Adres;
    use App\Il;
    use App\Ilce;
    use App\IletisimBilgisi;
    use App\Semt;
?>
@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="{{asset('js/ajax-crud.js')}}"></script>
        <script src="{{asset('js/ajax-crud-image.js')}}"></script>
        <script src="{{asset('js/ajax-crud-firmaTanitim.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
        <script src="{{asset('js/ajax-crud-malibilgiler.js')}}"></script>
        <script src="{{asset('js/ajax-crud-ticaribilgiler.js')}}"></script>
        <script src="{{asset('js/ajax-crud-bilgilendirmetercihi.js')}}"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <script src="{{asset('js/ajax-crud-referanslar.js')}}"></script>
        <script src="{{asset('js/ajax-crud-referanslarGecmis.js')}}"></script>
        <script src="{{asset('js/ajax-crud-kalite.js')}}"></script>
        <script src="{{asset('js/ajax-crud-firmacalisanlari.js')}}"></script>
        <script src="{{asset('js/ajax-crud-firmabrosur.js')}}"></script>
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
                           
        </style>
   </head>
   <body>
   <div class="container">
       <br>
       <br>
       <nav class="navbar navbar-inverse">
             <div class="container-fluid">
                 <div class="navbar-header">
                     <a class="navbar-brand" href="#"><img src='{{asset('images/anasayfa.png')}}'></a>
                 </div>
                 <ul class="nav navbar-nav">
                     <li class=""><a href="{{ url('firmaProfili/'.$firma->id)}}">Firma Profili</a></li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">İlan İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="{{ url('ilanlarim/'.$firma->id) }}">İlanlarım</a></li>
                             <li><a href="{{  URL::to('ilanEkle', array($firma->id,'0'), false)}}">İlan Oluştur</a></li>
                         </ul>
                     </li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Başvuru İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="#">Başvurularım</a></li>
                             <li><a href="#">Başvur</a></li>
                         </ul>
                     </li>
                     <li><a href="#">Mesajlar</a></li>
                     <li><a href="#">Kullanici İşlemleri</a></li>
                 </ul>
             </div>
         </nav>
       <h2>Firma Profili</h2>
       <div class="col-lg-6">
           <div class="form-group">
               <br>
               <div class="row">
                   <div class="col-sm-4" ><img src="/tamrekabet/public/uploads/{{$firma->logo}}" alt="HTML5 Icon" style="width:128px;height:128px;"></div>
                   <div class="col-sm-4" ><h3>{{$firma->adi}}</h3></div>
               </div>
               <div class="modal fade" id="myModal-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                               <h4 class="modal-title" id="myModalLabel">Resmini Güncelle</h4>
                           </div>
                           <div class="modal-body">
                               <div class="span7 offset1">
                                   @if(Session::has('success'))
                                   <div class="alert-box success">
                                       <h2>{!! Session::get('success') !!}</h2>
                                   </div>
                                   @endif
                                   <div class="secure">Yeni Bir Resim Yükleyin</div>
                                   {!! Form::open(array('url'=>'firmaProfili/uploadImage/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}
                                   <div class="control-group">
                                       <div class="controls">
                                           {!! Form::file('logo') !!}
                                           <p class="errors">{!!$errors->first('image')!!}</p>
                                           @if(Session::has('error'))
                                           <p class="errors">{!! Session::get('error') !!}</p>
                                           @endif
                                       </div>
                                   </div>
                                   <div id="success"> 
                                   </div>
                                   {!! Form::submit('Yükle', array('url'=>'firmaProfili/uploadImage'.$firma->id,'class'=>'btn btn-danger')) !!}
                                   {!! Form::close() !!}
                                   <br>
                                   {{ Form::open(array('url'=>'firmaProfili/deleteImage/'.$firma->id,'method' => 'DELETE', 'files'=>true)) }}
                                   {{ Form::hidden('id', $firma->logo) }}
                                   {{ Form::submit('Sil', ['class' => 'btn btn-danger']) }}
                                   {{ Form::close() }}
                               </div>
                           </div>
                           <div class="modal-footer">
                           </div>
                       </div>
                   </div>
               </div>
               <br>
               <button class="btn btn-primary btn-xs btn-detail " id="btn-add-image" onclick="" value="{{$firma->id}}">Düzenle</button>
           </div>
       </div>
   </div>
   <div class="container">
       <div class="panel-group" id="accordion">
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class=" medium material-icons">call</i>İletişim Bilgileri</a>
                   </h4>
               </div>
               <div id="collapse1" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr>
                                   <td>Adres:</td>
                                   <?php
                                   $firmaAdres = $firma->adresler()->where('tur_id', '=', '1')->first();
                                   if (!$firma->iletisim_bilgileri)
                                       $firma->iletisim_bilgileri = new IletisimBilgisi();
                                   if (!$firmaAdres) {
                                       $firmaAdres = new Adres();
                                       $firmaAdres->iller = new Il();
                                       $firmaAdres->ilceler = new Ilce();
                                       $firmaAdres->semtler = new Semt();
                                   }
                                   ?>
                                   <td>{{$firmaAdres->adres}}</td>

                               </tr>
                               <tr>
                                   <td>İli:</td>
                                   <td>{{$firmaAdres->iller->adi}}</td>

                               </tr>
                               <tr>
                                   <td>İlçesi:</td>
                                   <td>{{$firmaAdres->ilceler->adi}}</td>

                               </tr>
                               <tr>
                                   <td>Semt:</td>
                                   <td>{{$firmaAdres->semtler->adi}}</td>

                               </tr>
                               <tr>
                                   <td>Telefon:</td>
                                   <td>{{$firma->iletisim_bilgileri->telefon}}</td>

                               </tr>
                               <tr>
                                   <td>Fax</td>
                                   <td>{{$firma->iletisim_bilgileri->fax}}</td>

                               </tr>
                               <tr>
                                   <td>Web Sayfası:</td>
                                   <td>{{$firma->iletisim_bilgileri->web_sayfasi}}</td>

                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">İletişim Bilgileri</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaProfili/iletisimAdd/'.$firma->id, 'class' => 'form-horizontal', 'method' => 'POST')) !!}

                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-3 control-label">Şehir</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="il_id" id="il_id" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($iller as $il)
                                                   <option  value="{{$il->id}}" >{{$il->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-3 control-label">İlçe</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="ilce_id" id="ilce_id" required>
                                                   <option selected disabled>Seçiniz</option>
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-3 control-label">Semt</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="semt_id" id="semt_id" required>
                                                   <option selected disabled>Seçiniz</option>
                                               </select>
                                           </div>
                                       </div>                                                     
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Adres</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="adres" name="adres" placeholder="Adres" value="{{$firmaAdres->adres}}" required>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Telefon</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Telefon" value="{{$firma->iletisim_bilgileri->telefon}}" required>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Fax</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="fax" name="fax" placeholder="Fax" value="{{$firma->iletisim_bilgileri->fax}}" required>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Web Sayfası</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="web_sayfasi" name="web_sayfasi" placeholder="Web Sayfası" value="{{$firma->iletisim_bilgileri->web_sayfasi}}" required>
                                           </div>
                                       </div>
                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/iletisimAdd/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>                                                        
                                   <div class="modal-footer">
                                       <input type="hidden" id="iletisimbilgisi_id" name="iletisimbilgisi_id" value="{{$firma->iletisim_bilgileri->id}}">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add" name="btn-add" onclick="populateDD()" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Firma Tanıtım Yazısı</a>
                   </h4>
               </div>
               <div id="collapse2" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr id="firma{{$firma->id}}">
                               <tr>
                                   <td>Tanıtım Yazısı:</td>
                                   <td>{{$firma->tanitim_yazisi}}</td>
                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-tanıtımyazısı" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Firma Tanıtım Yazısı</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaProfili/tanitim/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}
                                       
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Tanıtım Yazısı</label>
                                           <div class="col-sm-9">
                                               <!--input type="text" class="form-control" id="tanıtım_yazısı" name="tanıtım_yazısı" placeholder="Tanıtım Yazısı" value=""-->
                                               <textarea id="tanitim_yazisi" name="tanitim_yazisi" rows="7" class="form-control ckeditor" placeholder="Lütfen tanıtım yazısını buraya yazınız.." required></textarea>
                                           </div>
                                       </div>

                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/tanitim/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">                                                            
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add-tanıtımyazısı" name="btn-add-tanıtımyazısı" class="btn btn-primary btn-xs" onclick="fillTanitim()">Ekle / Düzenle</button>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Mali Bilgileri</a>
                   </h4>
               </div>
               <div id="collapse3" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr>
                                   <td>Firma Ünvanı:</td>
                                   <?php
                                   $firmaFatura = $firma->adresler()->where('tur_id', '=', '2')->first();
                                   if (!$firma->mali_bilgiler) {
                                       $firma->mali_bilgiler = new App\MaliBilgi();
                                       $firma->mali_bilgiler->vergi_daireleri = new App\VergiDairesi();
                                       $firma->sirket_turleri = new App\SirketTuru();
                                   }
                                   if (!$firmaFatura) {
                                       $firmaFatura = new Adres();
                                       $firmaFatura->iller = new Il();
                                       $firmaFatura->ilceler = new Ilce();
                                       $firmaFatura->semtler = new Semt();
                                   }
                                   ?>
                                   <td>{{$firma->mali_bilgiler->unvani}}</td>
                               </tr>
                               <tr>
                                   <td>Şirket Türü:</td>
                                   @foreach($sirketTurleri as $sirket)<?php
                                   if($sirket->id == $firma->sirket_turu){
                                       ?>
                                          <td>{{$sirket->adi}}</td>
                                          <?php
                                   }
                                   ?>
                                   @endforeach
                               </tr>
                               <tr>
                                   <td>Fatura Adresi:</td>
                                   <td>{{$firmaFatura->adres}}</td>
                               </tr>
                               <tr>
                                   <td>İli:</td>
                                   <td>{{$firmaFatura->iller->adi}}</td>
                               </tr>
                               <tr>
                                   <td>İlçesi:</td>
                                   <td>{{$firmaFatura->ilceler->adi}}</td>
                               </tr>
                               <tr>
                                   <td>Semt:</td>
                                   <td>{{$firmaFatura->semtler->adi}}</td>
                               </tr>
                               <tr>
                                   <td>Vergi Dairesi:</td>                                                        
                                   <td>{{$firma->mali_bilgiler->vergi_daireleri->adi}}</td>
                               </tr>
                               <tr>
                                   <td>Vergi Numarası:</td>
                                   <td>{{$firma->mali_bilgiler->vergi_numarasi}}</td>
                               </tr>
                               <tr>
                                   <td>Yıllık Cirosu:</td>
                                   <td>{{$firma->mali_bilgiler->yillik_cirosu}}</td>
                               </tr>
                               <tr>
                                   <td>Sermayesi:</td>
                                   <td>{{$firma->mali_bilgiler->sermayesi}}</</td>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-malibilgiler" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Mali Bilgiler</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaProfili/malibilgi/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Fatura Adresi</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="fatura_adresi" name="fatura_adresi" placeholder="Fatura Adresi" value="" required>
                                           </div>
                                       </div>   
                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-3 control-label">Şehir</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="il_id" id="il_id" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($iller as $il)
                                                   <option  value="{{$il->id}}" >{{$il->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-3 control-label">İlçe</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="ilce_id" id="ilce_id" required>
                                                   <option selected disabled>Seçiniz</option>

                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-3 control-label">Semt</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="semt_id" id="semt_id" required>
                                                   <option selected disabled>Seçiniz</option>
                                               </select>
                                           </div>
                                       </div>    
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Firma Ünvanı</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="unvani" name="unvani" placeholder="Firma Ünvanı" value="{{$firma->mali_bilgiler->unvani}}" required>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Şirket Türü</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="sirket_turu" id="sirket_turu" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($sirketTurleri as $tur)
                                                   <option  value="{{$tur->id}}" >{{$tur->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Vergi Daireleri</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="vergi_dairesi_id" id="vergi_dairesi_id" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($vergiDaireleri as $vergiDaire)
                                                   <option  value="{{$vergiDaire->id}}" >{{$vergiDaire->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Vergi Numarası</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="vergi_numarasi" name="vergi_numarasi" placeholder="Vergi Numarası" value="" required>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Yıllık Cirosu</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="yillik_cirosu" name="yillik_cirosu" placeholder="Yıllık Cirosu" value="" required>
                                                   <input type="checkbox" class="form-control" id="ciro_goster" name="ciro_goster" >Göster<br></input>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Sermayesi</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="sermayesi" name="sermayesi" placeholder="Sermayesi" value="" required/>
                                                   <input type="checkbox" class="form-control" id="sermaye_goster" name="sermaye_goster" >Göster<br></input>
                                           </div>
                                       </div>
                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/malibilgi/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add-malibilgiler" name="btn-add-malibilgiler" class="btn btn-primary btn-xs">Ekle / Düzenle</button>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Ticari Bilgiler</a>
                   </h4>
               </div>
               <div id="collapse4" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr>
                                   <td>Ticaret Sicil No:</td>
                                   <?php
                                   $firmaFatura = $firma->adresler()->where('tur_id', '=', '2')->first();
                                   if (!$firma->ticari_bilgiler) {
                                       $firma->ticari_bilgiler = new App\TicariBilgi();
                                       $firma->ticari_bilgiler->ticaret_odalari = new App\TicaretOdasi();
                                       $firma->ticari_bilgiler->sektorler = new App\Sektor();

                                       $firma->firma_departmanlar = new App\FirmaDepartman();
                                       $firma->firma_departmanlar->departmanlar = new App\Departman();

                                       $firma->firma_sektorler = new App\FirmaSektor();
                                       $firma->firma_sektorler->sektorler = new App\Sektor();

                                       $firma->firma_satilan_markalar = new App\FirmaSatilanMarka();
                                       $firma->firma_satilan_markalar->satilan_markalar = new App\SatilanMarka();

                                       $firma->firma_faaliyetler = new App\FirmaFaaliyet();
                                       $firma->firma_faaliyetler->faaliyetler = new App\Faaliyet();
                                   }
                                   if (!$firma->uretilen_markalar) {
                                       $firma->uretilen_markalar = new App\UretilenMarka();
                                   }
                                   ?>
                                   <td>{{$firma->ticari_bilgiler->tic_sicil_no}}</td>
                               </tr>
                               <tr>
                                   <td>Ticaret Odası:</td>
                                   <td>{{$firma->ticari_bilgiler->ticaret_odalari->adi}}</td>
                               </tr>
                               <tr>
                                   <td>Üst Sektör:</td>
                                   <td>{{$firma->ticari_bilgiler->sektorler->adi}}</td>
                               </tr>
                               <tr>
                                   <td>Faliyet Sektör:</td>
                                   <td>@foreach($firma->sektorler as $sektor)
                                       {{$sektor->adi}}
                                       @endforeach
                                   </td>
                               </tr>
                               <tr>
                                   <td>Firma Departmanları:</td>
                                   <td>@foreach($firma->departmanlar as $departman)
                                       {{$departman->adi}}
                                       @endforeach
                                   </td>
                               </tr>
                               <tr>
                                   <td>Kuruluş Tarihi:</td>
                                   <td>{{$firma->kurulus_tarihi}}</td>
                               </tr>
                               <tr>
                                   <td>Firma Faaliyet Türü:</td>
                                   <td>@foreach($firma->faaliyetler as $faaliyet)
                                       {{$faaliyet->adi}}
                                       @endforeach
                                   </td>
                               </tr>
                               <tr>
                                   <td>Firmanın Ürettiği Markalar:</td>
                                   <td>
                                       <?php  $uretilenMarka = DB::table('uretilen_markalar')->where('firma_id', '=', $firma->id)->get(); ?>
                                       @foreach($uretilenMarka as $marka)
                                       {{$marka->adi}}
                                       @endforeach
                                   </td>
                               </tr>
                               <tr>
                                   <td>Firmanın Sattığı Markalar:</td>
                                   <td>@foreach($firma->satilan_markalar as $satMarka)
                                       {{$satMarka->adi}}
                                       @endforeach
                                   </td>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-ticaribilgiler" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Ticari Bilgiler</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaProfili/ticaribilgi/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Ticaret Sicil NO</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="ticaret_sicil_no" name="ticaret_sicil_no" placeholder="Ticaret Sicil No" value="{{$firma->ticari_bilgiler->tic_sicil_no}}" required>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Ticaret Odası</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="ticaret_odasi" id="ticaret_odasi" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($ticaretodasi as $ticaret)
                                                   <option  value="{{$ticaret->id}}" >{{$ticaret->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Üst Sektör</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="ust_sektor" id="ust_sektor" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($ustsektor as $ust)
                                                   <option  value="{{$ust->id}}" >{{$ust->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Faaliyet Sektörleri</label>
                                           <div class="col-sm-9">
                                               @foreach($ustsektor as $sektor)
                                               <input type="checkbox" name="faaliyet_sektorleri[]" value="{{$sektor->id}}" >{{$sektor->adi}}
                                                   @endforeach
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Firma Departmanları</label>
                                           <div class="col-sm-9">
                                               @foreach($departmanlar as $departman)
                                               <input type="checkbox" name="firma_departmanları[]" value="{{$departman->id}}" >{{$departman->adi}}
                                                   @endforeach
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Kuruluş Tarihi</label>
                                           <div class="col-sm-9">
                                               <input type="date" class="form-control datepicker" id="kurulus_tarihi" name="kurulus_tarihi" placeholder="Kuruluş Tarihi" value="{{$firma->kurulus_tarihi}}" required>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Firma Faaliyet Türü</label>
                                           <div class="col-sm-9">
                                               @foreach($faaliyetler as $faaliyet)
                                               <input type="checkbox" name="firma_faaliyet_turu[]" value="{{$faaliyet->id}}" >{{$faaliyet->adi}}
                                                @endforeach
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Üretilen Markalar</label>
                                           <div class="col-sm-9">
                                               <div class="input_fields_wrap">
                                                    <button  class="add_field_button">Ekle</button>
                                                    <div><input type="text" name="firmanin_urettigi_markalar[]" required></div>
                                                </div>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Firmanın Sattığı Markalari</label>
                                           <div class="col-sm-9">

                                               @foreach($markalar as $marka)
                                               <input type="checkbox" name="firmanin_sattıgı_markalar[]" value="{{$marka->id}}" >{{$marka->adi}}
                                                   @endforeach

                                           </div>
                                       </div>

                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/ticaribilgi/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add-ticaribilgiler" name="btn-add-ticaribilgiler" class="btn btn-primary btn-xs">Ekle / Düzenle</button>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Kalite Belgeleri ve Referanslar</a>
                   </h4>
               </div>
               <div id="collapse5" class="panel-collapse collapse">
                   <div class="panel-body">
                       <div class="panel-footer">Kalite Belgeleri
                           <table class="table" >
                               <thead id="tasks-list" name="tasks-list">
                                       <th>Kalite Belgesi:</th>
                                       <th>Belge NO:</th>
                                            <?php
                                            if (!$firma->kalite_belgeleri) {
                                                $firma->firma_kalite_belgeleri = new App\FirmaKaliteBelgesi();
                                                //$firma->firma_kalite_belgeleri->kalite_belgeleri = new App\KaliteBelgesi();
                                            }
                                           
                                            ?>
                                
                                   @foreach($firma->kalite_belgeleri as $kalite_belgesi)
                                    <tr>
                                       <td>
                                           {{$kalite_belgesi->adi}}
                                       </td>
                                       <td>
                                           {{$kalite_belgesi->pivot->belge_no}}
                                       </td>
                                       <td>
                                 
                                       <button name="open-modal-kaliteGuncelle"  value="{{$kalite_belgesi->id}}" class="btn btn-primary btn-xs open-modal-kaliteGuncelle" >Düzenle</button>
                                       </td>
                                      
                                        <td>
                                            
                                            {{ Form::open(array('url'=>'firmaProfili/kaliteSil/'.$kalite_belgesi->id,'method' => 'DELETE', 'files'=>true)) }}
                                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                            {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                                            {{ Form::close() }}
                                             
                                        </td>
                                       
                                   </tr>
                           <div class="modal fade" id="myModal-kaliteGuncelle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                           <h4 class="modal-title" id="myModalLabel">Kalite Belgeleri </h4>
                                       </div>
                                       <div class="modal-body">
                                           {!! Form::open(array('url'=>'firmaProfili/kaliteGuncelle/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Kalite Belgesi</label>
                                               <div class="col-sm-9">
                                                    <select class="form-control" name="kalite_belgeleri" id="kalite_belgeleri" required>
                                                        <option selected disabled>Seçiniz</option>
                                                        @foreach($kalite_belgeleri as $kalite)
                                                        <option  value="{{$kalite->id}}">{{$kalite->adi}}</option>
                                                        @endforeach
                                                    </select>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Belge No</label>
                                               <div class="col-sm-9">
                                                   <input type="text" class="form-control " id="belge_no" name="belge_no" placeholder="Belge No" value="{{$kalite_belgesi->pivot->belge_no}}" required/>
                                               </div>
                                           </div>
                                           <input type="hidden" name="kalite_id"  id="kalite_id" value="{{$kalite_belgesi->id}}"> 
                                           {!! Form::submit('Kaydet', array('url'=>'firmaProfili/kaliteGuncelle/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                           {!! Form::close() !!}
                                       </div>
                                       <div class="modal-footer">                                                            
                                       </div>
                                   </div>
                               </div>
                           </div>
                               @endforeach
                            </thead>
                           </table>
                           
                           <div class="modal fade" id="myModal-kalite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                           <h4 class="modal-title" id="myModalLabel">Kalite Belgeleri </h4>
                                       </div>
                                       <div class="modal-body">
                                           {!! Form::open(array('url'=>'firmaProfili/kalite/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Kalite Belgesi</label>
                                               <div class="col-sm-9">
                                                    <select class="form-control" name="kalite_belgeleri" id="kalite_belgeleri" required>
                                                        <option selected disabled>Seçiniz</option>
                                                        @foreach($kalite_belgeleri as $kalite)
                                                        <option  value="{{$kalite->id}}">{{$kalite->adi}}</option>
                                                        @endforeach
                                                    </select>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Belge No</label>
                                               <div class="col-sm-9">
                                                   <input type="text" class="form-control " id="belge_no" name="belge_no" placeholder="Belge No" value="" required/>
                                               </div>
                                           </div>
                                           {!! Form::submit('Kaydet', array('url'=>'firmaProfili/kalite/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                           {!! Form::close() !!}
                                       </div>
                                       <div class="modal-footer">                                                            
                                       </div>
                                       
                                   </div>
                               </div>
                           </div>
                           <button id="btn-add-kalite" name="btn-add-kalite" class="btn btn-primary btn-xs" >Ekle</button>
                       </div>
                       <div class="panel-footer ">Referanslar
                           <table class="table" >
                               <thead id="tasks-list" name="tasks-list">
                                   <tr id="firma{{$firma->id}}">
                                   <tr>
                                       <th>Firma Adı:</th>

                                            <?php
                                            if (!$firma->firma_referanslar) {
                                                $firma->firma_referanslar = new App\FirmaReferans();
                                            } else {
                                                $firmaReferanslar = $firma->firma_referanslar()->orderBy('ref_turu', 'desc')->orderBy('is_yili', 'desc')->get();
                                            }
                                            ?>
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
                                   @foreach($firmaReferanslar as $firmaReferans)
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
                                           {{$firmaReferans->is_yili}}
                                       </td>
                                       <td> <button name="open-modal-gecmis"  value="{{$firmaReferans->id}}" class="btn btn-primary btn-xs open-modal-gecmis" >Düzenle</button>
                                       </td>
                                        <td>
                                                {{ Form::open(array('url'=>'firmaProfili/referansSil/'.$firmaReferans->id,'method' => 'DELETE', 'files'=>true)) }}
                                                <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                             {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                                            {{ Form::close() }}
                                        </td>
                                        <input type="hidden" name="ref_id"  id="ref_id" value="{{$firmaReferans->id}}"> 
                                   </tr>
                                   <div class="modal fade" id="myModal-referanslarGecmis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                       <div class="modal-dialog">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                   <h4 class="modal-title" id="myModalLabel">Referanslar </h4>
                                               </div>
                                               <div class="modal-body">
                                                   {!! Form::open(array('url'=>'firmaProfili/referansUpdate/'. $firmaReferans->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                   <div class="form-group">
                                                       <label for="inputEmail3" class="col-sm-3 control-label">Referans Türü</label>
                                                       <div class="col-sm-9">
                                                           <select class="form-control" name="ref_turu" id="ref_turu" required>
                                                               <option selected disabled value="Seçiniz">Seçiniz</option>
                                                               <option   value="Geçmiş">Geçmiş</option>
                                                               <option  value="Şuan">Şuan</option>                                                  
                                                           </select>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="inputEmail3" class="col-sm-3 control-label">Firma Adı</label>
                                                       <div class="col-sm-9">
                                                           <input type="text" class="form-control " id="ref_firma_adi" name="ref_firma_adi" placeholder="Firma Adı" value="" required/>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="inputEmail3" class="col-sm-3 control-label">Yapım İşi Adı</label>
                                                       <div class="col-sm-9">
                                                           <input type="text" class="form-control " id="yapılan_isin_adi" name="yapılan_isin_adi" placeholder="Yapılan İşin Adı" value="" required/>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="inputEmail3" class="col-sm-3 control-label">İşin Türü</label>
                                                       <div class="col-sm-9">
                                                           <select class="form-control" name="isin_turu" id="isin_turu" required>
                                                               <option selected disabled value="Seçiniz">Seçiniz</option>
                                                               <option   value="Mal Satışı">Mal Satışı</option>
                                                               <option  value="Hizmet Satışı">Hizmet Satışı</option>
                                                               <option  value="Yapım İşi">Yapım İşi</option>
                                                           </select>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="inputEmail3" class="col-sm-3 control-label">İş Yılı</label>
                                                       <div class="col-sm-9">
                                                           <input type="text" class="form-control " id="is_yili" name="is_yili" placeholder="İş Yılı" value="" required/>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="inputEmail3" class="col-sm-3 control-label">Çalışma Süresi</label>
                                                       <div class="col-sm-9">
                                                           <input type="text" class="form-control " id="calısma_suresi" name="calısma_suresi" placeholder="Çalışma Süresi" value="" required/>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="inputEmail3" class="col-sm-3 control-label">Yetkili Kişi Adı</label>
                                                       <div class="col-sm-9">
                                                           <input type="text" class="form-control " id="yetkili_kisi_adi" name="yetkili_kisi_adi" placeholder="Yetkili Kişi Adı" value="" required/>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="inputEmail3" class="col-sm-3 control-label">Y.K Email Adresi</label>
                                                       <div class="col-sm-9">
                                                           <input type="email" class="form-control " id="yetkili_kisi_email" name="yetkili_kisi_email" placeholder="Yetkili Kişi Email Adresi" value="" required/>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="inputEmail3" class="col-sm-3 control-label">Y.K Telefon</label>
                                                       <div class="col-sm-9">
                                                           <input type="text" class="form-control " id="yetkili_kisi_telefon" name="yetkili_kisi_telefon" placeholder="Yetkili Kişi Telefon" value="" required/>
                                                       </div>
                                                   </div>
                                                   <input type="hidden" name="ref_id"  id="ref_id" value="{{$firmaReferans->id}}">

                                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/referansUpdate/'. $firmaReferans->id,'class'=>'btn btn-danger')) !!}
                                                       {!! Form::close() !!}
                                               </div>
                                               <div class="modal-footer">   
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   @endforeach
                                   
                                   </thead>
                           </table>
                           <div class="modal fade" id="myModal-referanslar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                           <h4 class="modal-title" id="myModalLabel">Referanslar </h4>
                                       </div>
                                       <div class="modal-body">
                                           {!! Form::open(array('url'=>'firmaProfili/referans/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Referans Türü</label>
                                               <div class="col-sm-9">
                                                   <select class="form-control" name="ref_turu" id="ref_turu" required>
                                                       <option selected disabled value="Seçiniz">Seçiniz</option>
                                                       <option   value="Geçmiş">Geçmiş</option>
                                                       <option  value="Şuan">Şuan</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Firma Adı</label>
                                               <div class="col-sm-9">
                                                   <input type="text" class="form-control " id="ref_firma_adi" name="ref_firma_adi" placeholder="Firma Adı" value="" required/>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Yapım İşi Adı</label>
                                               <div class="col-sm-9">
                                                   <input type="text" class="form-control " id="yapılan_isin_adi" name="yapılan_isin_adi" placeholder="Yapılan İşin Adı" value="" required/>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">İşin Türü</label>
                                               <div class="col-sm-9">
                                                   <select class="form-control" name="isin_turu" id="isin_turu" required>
                                                       <option selected disabled value="Seçiniz">Seçiniz</option>
                                                       <option   value="Mal Satışı">Mal Satışı</option>
                                                       <option  value="Hizmet Satışı">Hizmet Satışı</option>
                                                       <option  value="Yapım İşi">Yapım İşi</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">İş Yılı</label>
                                               <div class="col-sm-9">
                                                   <input type="text" class="form-control " id="is_yili" name="is_yili" placeholder="İş Yılı" value="" required/>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Çalışma Süresi</label>
                                               <div class="col-sm-9">
                                                   <input type="text" class="form-control " id="calısma_suresi" name="calısma_suresi" placeholder="Çalışma Süresi" value="" required/>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Yetkili Kişi Adı</label>
                                               <div class="col-sm-9">
                                                   <input type="text" class="form-control " id="yetkili_kisi_adi" name="yetkili_kisi_adi" placeholder="Yetkili Kişi Adı" value="" required/>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Yetkili Kişi Email Adresi</label>
                                               <div class="col-sm-9">
                                                   <input type="email" class="form-control " id="yetkili_kisi_email" name="yetkili_kisi_email" placeholder="Yetkili Kişi Email Adresi" value="" required/>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label for="inputEmail3" class="col-sm-3 control-label">Yetkili Kişi Telefon</label>
                                               <div class="col-sm-9">
                                                   <input type="text" class="form-control " id="yetkili_kisi_telefon" name="yetkili_kisi_telefon" placeholder="Yetkili Kişi Telefon" value="" required/>
                                               </div>
                                           </div>

                                           {!! Form::submit('Kaydet', array('url'=>'firmaProfili/referans/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                           {!! Form::close() !!}
                                       </div>
                                       <div class="modal-footer">                                                            
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <button id="btn-add-referanslar" name="btn-add-referanslar" class="btn btn-primary btn-xs" >Ekle</button>
                           <input type="hidden" name="add"  id="add" value="add"> 
                       </div>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Firma Broşürü</a>
                   </h4>
               </div>
               <div id="collapse6" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                                <th>Broşür Adı:</th>
                                <th>Broşür Pdf:</th>
                                        <?php
                                        if (!$firma->firma_brosurler) {
                                            $firma->firma_brosurler = new App\FirmaBrosur();
                                        }
                                        ?>
                                @foreach($firma->firma_brosurler as $firmaBrosur)
                                    <tr>   
                                       <td>
                                           {{$firmaBrosur->adi}}
                                       </td>
                                       <td>
                                           <a href="{{ asset('brosur/'.$firmaBrosur->yolu) }}">{{$firmaBrosur->yolu}}</a>
                                       </td>
                                  
                                   <td> <button   value="{{$firmaBrosur->id}}" class="btn btn-primary btn-xs open-modal-brosurGuncelle" >Düzenle</button>
                                   </td>
                                   <td>
                                   {{ Form::open(array('url'=>'firmaProfili/brosurSil/'.$firmaBrosur->id,'method' => 'DELETE', 'files'=>true)) }}
                                                <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                             {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                                            {{ Form::close() }}
                                  </td>
                                    <input type="hidden" name="brosur_id"  id="brosur_id" value="{{$firmaBrosur->id}}"> 
                                    </tr>
                                    <div class="modal fade" id="myModal-firmabrosurGuncelle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Firma Broşürü</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(array('url'=>'firmaProfili/firmaBrosurGuncelle/'.$firmaBrosur->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Broşür Adi</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control " id="brosur_adi" name="brosur_adi" placeholder="Broşür Adi" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Broşür PDF</label>
                                                        <div class="col-sm-9">
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    {!! Form::file('yolu') !!}
                                                                    <p class="errors">{!!$errors->first('image')!!}</p>
                                                                    @if(Session::has('error'))
                                                                    <p class="errors">{!! Session::get('error') !!}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div id="success"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <input type="hidden" name="brosur_id"  id="brosur_id" value="{{$firmaBrosur->id}}"> 
                                                    {!! Form::submit('Kaydet', array('url'=>'firmaProfili/firmaBrosurGuncelle/'.$firmaBrosur->id,'class'=>'btn btn-danger')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                                <div class="modal-footer">                                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   @endforeach
                                </thead>
                            </table>
                        <div class="modal fade" id="myModal-firmabrosurEkle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                              <h4 class="modal-title" id="myModalLabel">Firma Broşürü</h4>
                                          </div>
                                          <div class="modal-body">
                                              {!! Form::open(array('url'=>'firmaProfili/firmaBrosur/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                              <div class="form-group">
                                                  <label for="inputEmail3" class="col-sm-3 control-label">Broşür Adi</label>
                                                  <div class="col-sm-9">
                                                      <input type="text" class="form-control " id="brosur_adi" name="brosur_adi" placeholder="Broşür Adi" value="" required/>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputEmail3" class="col-sm-3 control-label">Broşür PDF</label>
                                                  <div class="col-sm-9">
                                                      <div class="control-group">
                                                          <div class="controls">
                                                              {!! Form::file('yolu') !!}
                                                              <p class="errors">{!!$errors->first('image')!!}</p>
                                                              @if(Session::has('error'))
                                                              <p class="errors">{!! Session::get('error') !!}</p>
                                                              @endif
                                                          </div>
                                                      </div>
                                                      <div id="success"> 
                                                      </div>
                                                  </div>
                                              </div>

                                              {!! Form::submit('Kaydet', array('url'=>'firmaProfili/firmaBrosur/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                              {!! Form::close() !!}
                                          </div>
                                          <div class="modal-footer">                                                            
                                          </div>
                                      </div>
                                  </div>
                              </div>

                       <button id="btn-add-firmabrosurEkle" name="btn-add-firmabrosurEkle" class="btn btn-primary btn-xs" >Ekle</button>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Firma Çalışan Bilgileri</a>
                   </h4>
               </div>
               <div id="collapse7" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr id="firma{{$firma->id}}">
                               <tr>
                                   <td>Çalışma Günleri:</td>
                                        <?php
                                        if (!$firma->firma_calisma_bilgileri) {
                                            $firma->firma_calisma_bilgileri = new App\FirmaCalismaBilgisi();
                                            $calismaGunu = '';
                                        }
                                        else $calismaGunu = $firma->firma_calisma_bilgileri->calisma_gunleri->adi;
                                        ?>

                                   <td>{{$calismaGunu}}</td>
                               </tr>
                               <tr>
                                   <td>Çalışma Saatleri:</td>
                                   <td>{{$firma->firma_calisma_bilgileri->calisma_saatleri}}</td>
                               </tr>
                               <tr>
                                   <td>Çalışan Profili:</td>
                                   <td> {{$firma->firma_calisma_bilgileri->calisan_profili}}</td>
                               </tr>
                               <tr>
                                   <td>Çalışan Sayısı:</td>
                                   <td>{{$firma->firma_calisma_bilgileri->calisan_sayisi}}</td>
                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-firmacalisanbilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Firma Broşürü</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaProfili/firmaCalisan/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Çalışma Günleri</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="calisma_gunleri" id="calisma_gunleri" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($calisma_günleri as $günleri)
                                                   <option  value="{{$günleri->id}}">{{$günleri->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Çalışma Saatleri</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control " id="calisma_saatleri" name="calisma_saatleri" placeholder="Çalışma Saatleri" value="{{$firma->firma_calisma_bilgileri->calisma_saatleri}}" required/>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Çalışma Profili</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control " id="calisma_profili" name="calisma_profili" placeholder="Çalışma Profili" value="{{$firma->firma_calisma_bilgileri->calisan_profili}}" required/>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Çalışan Sayısı</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control " id="calisma_sayisi" name="calisma_sayisi" placeholder="Çalışma Sayısı" value="{{$firma->firma_calisma_bilgileri->calisan_sayisi}}" required/>
                                           </div>
                                       </div>

                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/firmaCalisan/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">                                                            
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add-firmacalisanbilgileri" name="btn-add-firmacalisanbilgileri" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">Bilgilendirme Tercihi</a>
                   </h4>
               </div>
               <div id="collapse8" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr id="firma{{$firma->id}}">
                               <tr>
                                   <td>Bilgilendirme Tercihi:</td>
                                   <td>{{$firma->bilgilendirme_tercihi}}</td>
                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-bilgilendirmetercihi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Bilgilendirme Tercihi</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaProfili/bilgilendirmeTercihi/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Bilgilendirme Tercihi</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control " id="bilgilendirme_tercihi" name="bilgilendirme_tercihi" placeholder="Bilgilendirme Tercihi" value="{{$firma->bilgilendirme_tercihi}}" required/>
                                           </div>
                                       </div>
                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/bilgilendirmeTercihi/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">                                                            
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add-bilgilendirmetercihi" name="btn-add-bilgilendirmetercihi" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                   </div>
               </div>
           </div>
       </div>
   </div>       
<script>    
    $( document ).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" name="firmanin_urettigi_markalar_[]"/><a href="#" class="remove_field">Sil</a></div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        });

        $('#il_id').on('change', function (e) {
            var il_id = e.target.value;
            GetIlce(il_id);
            //popDropDown('ilce_id', 'ajax-subcat?il_id=', il_id);
            //$("#semt_id")[0].selectedIndex=0;
        });

        $('#ilce_id').on('change', function (e) {
            var ilce_id = e.target.value;
            GetSemt(ilce_id);
            //popDropDown('semt_id', 'ajax-subcatt?ilce_id=', ilce_id);
        });
    });
    function GetIlce(il_id) {
        if (il_id > 0) {
            $("#ilce_id").get(0).options.length = 0;
            $("#ilce_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 

            $.ajax({
                type: "GET",
                url: "/tamrekabet/public/index.php/ajax-subcat?il_id="+il_id,

                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    $("#ilce_id").get(0).options.length = 0;
                    $("#ilce_id").get(0).options[0] = new Option("Seçiniz", "-1");

                    $.each(msg, function(index, ilce) {
                        $("#ilce_id").get(0).options[$("#ilce_id").get(0).options.length] = new Option(ilce.adi, ilce.id);
                    });
                },
                async: false,
                error: function() {
                    $("#ilce_id").get(0).options.length = 0;
                    alert("İlçeler yükelenemedi!!!");
                }
            });
        }
        else {
            $("#ilce_id").get(0).options.length = 0;
        }
    }
    
    function GetSemt(ilce_id) {
        if (ilce_id > 0) {
            $("#semt_id").get(0).options.length = 0;
            $("#semt_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 

            $.ajax({
                type: "GET",
                url: "/tamrekabet/public/index.php/ajax-subcatt?ilce_id="+ilce_id,

                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    $("#semt_id").get(0).options.length = 0;
                    $("#semt_id").get(0).options[0] = new Option("Seçiniz", "-1");

                    $.each(msg, function(index, semt) {
                        $("#semt_id").get(0).options[$("#semt_id").get(0).options.length] = new Option(semt.adi, semt.id);
                    });
                },
                async: false,
                error: function() {
                    $("#semt_id").get(0).options.length = 0;
                    alert("Semtler yükelenemedi!!!");
                }
            });
        }
        else {
            $("#semt_id").get(0).options.length = 0;
        }
    }

    function populateDD(){
        GetIlce({{$firmaAdres->iller->id}});
        GetSemt({{$firmaAdres->ilceler->id}});
        $("#il_id").val({{$firmaAdres->iller->id}});
        $("#ilce_id").val({{$firmaAdres->ilceler->id}});
        $("#semt_id").val({{$firmaAdres->semtler->id}});
    }
</script>

</body>
</html>
@endsection