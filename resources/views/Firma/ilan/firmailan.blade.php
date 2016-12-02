<?php
    use App\Adres;
    use App\Il;
    use App\Ilce;
    use App\Semt;
?>
@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
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
                             <li><a href="{{ URL::to('ilanEkle', array($firma->id,'0'), false)}} ">İlan Oluştur</a></li>
                         </ul>
                     </li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Başvuru İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="{{ URL::to('basvurularim', array($firma->id), false)}}">Başvurularım</a></li>
                             <li><a href="{{url('ilanAra/')}}">Başvur</a></li>
                         </ul>
                     </li>
                     <li><a href="#">Mesajlar</a></li>
                     <li><a href="#">Kullanici İşlemleri</a></li>
                 </ul>
             </div>
         </nav>
       <h2>İlanlarım</h2>
    </div>
    <div class="container">
         <div class="panel-group" id="accordion">

             <div class="panel panel-default">
                 <div class="panel-heading">
                     <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">İlan Bilgilerim</a>
                     </h4>
                 </div>
                 <div id="collapse2" class="panel-collapse collapse">
                     <div class="panel-body">
                         <table class="table" >
                             <thead id="tasks-list" name="tasks-list">
                                 <tr id="firma{{$firma->id}}">
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
                                     <td>{{$ilan->ilan_turu}}</td>
                                 </tr>
                                 <tr>
                                     <td>İlan Usulü:</td>
                                     <td>{{$ilan->usulu}}</td>
                                 </tr>
                                 <tr>
                                     <td>Sözleşme Türü:</td>
                                     <td>{{$ilan->sozlesme_turu}}</td>
                                 </tr>
                                 <tr>
                                     <td>Teknik Şartname:</td>
                                     <td>{{$ilan->teknik_sartname}}</td>
                                 </tr>
                                 <tr>
                                     <td>Yaklaşık Maliyet:</td>
                                     <td></td>
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
                                 </tr>
                             </thead>
                         </table>


                         <div class="modal fade" id="myModal-ilanBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                         <h4 class="modal-title" id="myModalLabel">İlan Bilgileri</h4>
                                     </div>
                                     <div class="modal-body">
                                         
                                         
                                         {!! Form::open(array('url'=>'firmaIlanOlustur/ilanBilgileriUpdate/'.$firma->id.'/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                          
                                           <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Firma Adı Göster</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="firma_adi_gizli" id="firma_adi_gizli" required>
                                                     <option selected disabled value="Seçiniz">Seçiniz</option>
                                                     <option   value="Göster">Göster</option>
                                                     <option  value="Gizle">Gizle</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">İlan Adı</label>
                                             <div class="col-sm-9">
                                                 <input type="text" class="form-control" id="ilan_adi" name="ilan_adi" placeholder="İlan Adı" value="{{$ilan->adi}}" required>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">İlan Sektör</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="firma_sektor" id="firma_sektor" required>
                                                     <option selected disabled>Seçiniz</option>
                                                     @foreach($sektorler as $sektor)
                                                     <option  value="{{$sektor->id}}" >{{$sektor->adi}}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Yayınlama Tarihi</label>
                                             <div class="col-sm-9">
                                                 <input type="date" class="form-control datepicker" id="yayinlama_tarihi" name="yayinlama_tarihi" placeholder="Yayınlama Tarihi" value="{{$ilan->yayin_tarihi}}" required>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Kapanma Tarihi</label>
                                             <div class="col-sm-9">
                                                 <input type="date" class="form-control datepicker" id="kapanma_tarihi" name="kapanma_tarihi" placeholder="Kapanma Tarihi" value="{{$ilan->kapanma_tarihi}}" required>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Açıklama</label>
                                             <div class="col-sm-9">
                                                 <!--input type="text" class="form-control " id="aciklama" name="aciklama" placeholder="Açıklama" value=""-->
                                                 <textarea id="aciklama" name="aciklama" rows="5" class="form-control ckeditor" placeholder="Lütfen Açıklamayı buraya yazınız.."  value="{{$ilan->aciklama}}" required></textarea>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">İlan Türü</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="ilan_turu" id="ilan_turu" required>
                                                     <option selected disabled value="Seçiniz">Seçiniz</option>
                                                     <option   value="Mal">Mal</option>
                                                     <option  value="Hizmet">Hizmet</option>
                                                     <option  value="Yapım İşi">Yapım İşi</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">İlan Usulü</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="ilan_usulu" id="ilan_usulu" required>
                                                     <option selected disabled value="Seçiniz">Seçiniz</option>
                                                     <option   value="Açık">Açık</option>
                                                     <option  value="Belirli İstekler Arasında">Belirli İstekler Arasında</option>
                                                     <option  value="Başvuru">Başvuru</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Sözleşme Türü</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="sozlesme_turu" id="sozlesme_turu" required>
                                                     <option selected disabled value="Seçiniz">Seçiniz</option>
                                                     <option   value="Birim Fiyatlı">Birim Fiyatlı</option>
                                                     <option  value="Götürü Bedel">Götürü Bedel</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Teknik Şartname</label>
                                             <div class="col-sm-9">

                                                 <div class="control-group">
                                                     <div class="controls">
                                                         {!! Form::file('teknik') !!}
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
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Yaklaşık Maliyet</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="yaklasik_maliyet" id="yaklasik_maliyet" required>
                                                     <option selected disabled>Seçiniz</option>
                                                     @foreach($maliyetler as $maliyet)
                                                     <option  value="{{$maliyet->id}}" >{{$maliyet->alt_deger}}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Teslim Yeri</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="teslim_yeri" id="teslim_yeri" required>
                                                     <option selected disabled value="Seçiniz">Seçiniz</option>
                                                     <option   value="Satıcı Firma">Satıcı Firma</option>
                                                     <option  value="Adrese Teslim">Adrese Teslim</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group error">
                                             <label for="inputTask" class="col-sm-3 control-label">Teslim Yeri İl</label>
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
                                             <label for="inputTask" class="col-sm-3 control-label">Teslim Yeri İlçe</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="ilce_id" id="ilce_id" required>
                                                     <option selected disabled>Seçiniz</option>

                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">İşin Süresi</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="isin_suresi" id="isin_suresi" required>
                                                     <option selected disabled value="Seçiniz">Seçiniz</option>
                                                     <option   value="Tek Seferde">Tek Seferde</option>
                                                     <option  value="Zamana Yayılarak">Zamana Yayılarak</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">İş Başlama Tarihi</label>
                                             <div class="col-sm-9">
                                                 <input type="date" class="form-control datepicker" id="is_baslama_tarihi" name="is_baslama_tarihi" placeholder="İş Başlama Tarihi" value="{{$ilan->is_baslama_tarihi}}" required>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">İş Bitiş Tarihi</label>
                                             <div class="col-sm-9">
                                                 <input type="date" class="form-control datepicker" id="is_bitis_tarihi" name="is_bitis_tarihi" placeholder="İş Bitiş Tarihi" value="{{$ilan->is_bitis_tarihi}}" required>
                                             </div>
                                         </div>



                                         {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/ilanBilgileriUpdate/'.$firma->id.'/'.$ilan->id,'class'=>'btn btn-danger')) !!}
                                         {!! Form::close() !!}
                                     </div>
                                     <div class="modal-footer">                                                            
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <button id="btn-add-ilanBilgileri" name="btn-add-ilanBilgileri" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                     </div>
                 </div>
             </div>
             <div class="panel panel-default">
                 <div class="panel-heading">
                     <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Fiyatlandırma Bigileri</a>
                     </h4>
                 </div>
                 <div id="collapse3" class="panel-collapse collapse">
                     <div class="panel-body">
                         <table class="table" >
                             <thead id="tasks-list" name="tasks-list">
                                 <tr id="firma{{$firma->id}}">
                                 <tr>
                                     
                                     <td>KDV:</td> 
                                            <?php
                                            if ($ilan->kdv_dahil == "on") {
                                           ?>
                                         <td>Kdv Dahil</td>
                                         <?php
                                     } else {
                                         ?>
                                         <td>Kdv Dahil Değil</td>
                                         <?php
                                     }
                                     ?>

                                 </tr>
                                 <tr>
                                     <td>Ödeme Türü:</td>
                                     <?php if($ilan->odeme_turu_id != NULL)
                                     {?>
                                     <td>{{$ilan->odeme_turleri->adi}}</td>
                                     <?php }?>
                                 </tr>
                                 <tr>
                                     <td>Para Birimi:</td>
                                      <?php if($ilan->para_birimi_id != NULL)
                                     {
                                     ?>
                                     <td>{{$ilan->para_birimleri->adi}}</td>
                                     <?php }?>
                                 </tr>
                                 </tr>
                             </thead>
                         </table>
                         <div class="modal fade" id="myModal-fiyatlandırmaBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                         <h4 class="modal-title" id="myModalLabel">Fiyatlandırma Bilgileri</h4>
                                     </div>
                                     <div class="modal-body">
                                         {!! Form::open(array('url'=>'firmaIlanOlustur/fiyatlandırmaBilgileriUpdate/'.$firma->id.'/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">KDV</label>
                                             <div class="col-sm-9">
                                                 <input type="checkbox" class="filled-in" id="filled-in-box" name="kdv" checked="checked"  required/>  
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Ödeme Türü</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="odeme_turu" id="odeme_turu" required>
                                                     <option selected disabled>Seçiniz</option>
                                                     @foreach($odeme_turleri as $odeme_turu)
                                                     <option  value="{{$odeme_turu->id}}" >{{$odeme_turu->adi}}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="inputEmail3" class="col-sm-3 control-label">Para Birimi</label>
                                             <div class="col-sm-9">
                                                 <select class="form-control" name="para_birimi" id="para_birimi" required>
                                                     <option selected disabled>Seçiniz</option>
                                                     @foreach($para_birimleri as $para_birimi)
                                                     <option  value="{{$para_birimi->id}}" >{{$para_birimi->adi}}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                         </div>
                                         {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/fiyatlandırmaBilgileriUpdate/'.$firma->id.'/'.$ilan->id,'class'=>'btn btn-danger')) !!}
                                         {!! Form::close() !!}
                                     </div>
                                     <div class="modal-footer">                                                            
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <button id="btn-add-fiyatlandırmaBilgileri" name="btn-add-fiyatlandırmaBilgileri" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>

                     </div>
                 </div>
             </div>

             <div id="mal"   class="panel panel-default">
                 <div class="panel-heading">
                     <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Fiyat İstenen Kalemler Listesi</a>
                     </h4>
                 </div>
                 <div id="collapse4" class="panel-collapse collapse">
                     <div class="panel-body">
                         <table class="table" >
                             <thead id="tasks-list" name="tasks-list">
                                 <tr id="firma{{$firma->id}}">
                                     <?php
                                     if (!$ilan)
                                         $ilan = new App\Ilan();
                                     if (!$ilan->ilan_mallar)
                                         $ilan->ilan_mallar = new App\IlanMal();
                                     ?>
                                 <tr>
                                     <th>Sıra:</th>
                                     <th>Marka:</th>
                                     <th>Model:</th>
                                     <th>Adı:</th>
                                     <th>Ambalaj:</th>
                                     <th>Miktar:</th>
                                     <th>Birim:</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                                 @foreach($ilan->ilan_mallar as $ilan_mal)
                                 <tr>
                                     <td>
                                         {{$ilan_mal->sira}}
                                     </td>
                                     <td>
                                         {{$ilan_mal->marka}}
                                     </td>
                                     <td>
                                         {{$ilan_mal->model}}
                                     </td>
                                     <td>
                                         {{$ilan_mal->adi}}
                                     </td>
                                     <td>
                                         {{$ilan_mal->ambalaj}}
                                     </td>
                                     <td>
                                         {{$ilan_mal->miktar}}
                                     </td>
                                     <td>
                                         {{$ilan_mal->birimler->adi}}
                                     </td>

                                     <td> <button name="open-modal-mal"  value="{{$ilan_mal->id}}" class="btn btn-primary btn-xs open-modal-mal" >Düzenle</button></td>
                                     <td>
                                                {{ Form::open(array('url'=>'firmaIlanOlustur/mal/'.$ilan_mal->id,'method' => 'DELETE', 'files'=>true)) }}
                                                <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                             {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                                            {{ Form::close() }}
                                 </td>
                                 <input type="hidden" name="ilan_mal_id"  id="ilan_mal_id" value="{{$ilan_mal->id}}"> 

                                     </tr>

                                     <div class="modal fade" id="myModal-mal_birimfiyat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kalemler Listesi</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('url'=>'firmaIlanOlustur/kalemlerListesiMalUpdate/'.$ilan_mal->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Sıra</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Marka</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="marka" name="marka" placeholder="Marka" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Model</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="model" name="model" placeholder="Model" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value=""required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Ambalaj</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="ambalaj" name="ambalaj" placeholder="ambalaj" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Birim</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="birim" id="birim" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($birimler as $birim)
                                                                 <option  value="{{$birim->id}}" >{{$birim->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>
                                                     <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  

                                                         {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/kalemlerListesiMalUpdate/'.$ilan_mal->id,'class'=>'btn btn-danger')) !!}
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
                                     <div class="modal fade" id="myModal-mal_birimfiyat_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kalemler Listesi</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('url'=>'firmaIlanOlustur/kalemlerListesiMal/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Sıra</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Marka</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="marka" name="marka" placeholder="Marka" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Model</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="model" name="model" placeholder="Model" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Ambalaj</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="ambalaj" name="ambalaj" placeholder="ambalaj" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Birim</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="birim" id="birim" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($birimler as $birimleri)
                                                                 <option  value="{{$birimleri->id}}" >{{$birimleri->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>

                                                     {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/kalemlerListesiMal/'.$ilan->id,'class'=>'btn btn-danger')) !!}
                                                     {!! Form::close() !!}
                                                 </div>
                                                 <div class="modal-footer">                                                            
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <button id="btn-add-mal" name="btn-add-mal" class="btn btn-primary btn-xs" >Ekle</button>
                                     </div>
                                     </div>
                                     </div>
             <div  id="hizmet"   class="panel panel-default ">
                 <div class="panel-heading">
                     <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Fiyat İstenen Kalemler Listesi</a>
                     </h4>
                 </div>
                 <div id="collapse5" class="panel-collapse collapse">
                     <div class="panel-body">
                         <table class="table" >
                             <thead id="tasks-list" name="tasks-list">
                                 <tr id="firma{{$firma->id}}">
                                     <?php
                                     if (!$ilan)
                                         $ilan = new App\Ilan();
                                     if (!$ilan->ilan_hizmetler)
                                         $ilan->ilan_hizmetler = new App\IlanHizmet();
                                     ?>
                                 <tr>
                                     <th>Sıra:</th>
                                     <th>Adı:</th>
                                     <th>Fiyat Standartı:</th>
                                     <th>Fiyat Standartı Birimi:</th>
                                     <th>Miktar:</th>
                                     <th>Miktar Birimi:</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                                 @foreach($ilan->ilan_hizmetler as $ilan_hizmet)
                                 <tr>
                                     <td>
                                         {{$ilan_hizmet->sira}}
                                     </td>

                                     <td>
                                         {{$ilan_hizmet->adi}}
                                     </td>
                                     <td>
                                         {{$ilan_hizmet->fiyat_standardi}}
                                     </td>
                                     <td>
                                         {{$ilan_hizmet->fiyat_birimler->adi}}
                                     </td>
                                     <td>
                                         {{$ilan_hizmet->miktar}}
                                     </td>
                                     <td>
                                         {{$ilan_hizmet->miktar_birimler->adi}}
                                     </td>

                                     <td> <button name="open-modal-hizmet"  value="{{$ilan_hizmet->id}}" class="btn btn-primary btn-xs open-modal-hizmet" >Düzenle</button></td>
                                     <td>
                                         {{ Form::open(array('url'=>'firmaIlanOlustur/hizmet/'.$ilan_hizmet->id,'method' => 'DELETE', 'files'=>true)) }}
                             <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                 {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                                 {{ Form::close() }}
                                 </td>
                                 <input type="hidden" name="ilan_hizmet_id"  id="ilan_hizmet_id" value="{{$ilan_hizmet->id}}"> 
                                     </tr>


                                     <div class="modal fade" id="myModal-hizmet_birimfiyat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kalemler Listesi</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('url'=>'firmaIlanOlustur/kalemlerListesiHizmetUpdate/'.$ilan_hizmet->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Sıra</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" value="{{$ilan_hizmet->sira}}" required>
                                                         </div>
                                                     </div>

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="{{$ilan_hizmet->adi}}" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Fiyat Standartı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="fiyat_standardi" name="fiyat_standardi" placeholder="Fiyat Standartı" value="{{$ilan_hizmet->fiyat_standardi}}" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">F .S Birimi</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="fiyat_standardi_birimi" id="fiyat_standardi_birimi" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($birimler as $fiyat_birimi)
                                                                 <option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value=" {{$ilan_hizmet->miktar}}" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar Birimi</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="miktar_birim_id" id="miktar_birim_id" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($birimler as $miktar_birim)
                                                                 <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>
                                                     <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  

                                                         {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/kalemlerListesiHizmetUpdate/'.$ilan_hizmet->id,'class'=>'btn btn-danger')) !!}
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
                                     <div class="modal fade" id="myModal-hizmet_birimfiyat_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kalemler Listesi</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('url'=>'firmaIlanOlustur/kalemlerListesiHizmet/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Sıra</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" value="" required>
                                                         </div>
                                                     </div>

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Fiyat Standartı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="fiyat_standardi" name="fiyat_standardi" placeholder="Fiyat Standartı" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Fiyat Standartı Birimi</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="fiyat_standardi_birimi" id="fiyat_standardi_birimi" required >
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($birimler as $fiyat_birimi)
                                                                 <option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar Birimi</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="miktar_birim_id" id="miktar_birim_id" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($birimler as $birimi)
                                                                 <option  value="{{$birimi->id}}" >{{$birimi->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>

                                                     {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/kalemlerListesiHizmet/'.$ilan->id,'class'=>'btn btn-danger')) !!}
                                                     {!! Form::close() !!}
                                                 </div>
                                                 <div class="modal-footer">                                                            
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <button id="btn-add-hizmet" name="btn-add-hizmet" class="btn btn-primary btn-xs" >Ekle</button>
                                     </div>
                                     </div>
                                     </div>
             <div  id="goturu" class="panel panel-default ">
                 <div class="panel-heading">
                     <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Fiyat İstenen Kalemler Listesi</a>
                     </h4>
                 </div>
                 <div id="collapse6" class="panel-collapse collapse">
                     <div class="panel-body">
                         <table class="table" >
                             <thead id="tasks-list" name="tasks-list">
                                 <tr id="firma{{$firma->id}}">
                                     <?php
                                     if (!$ilan)
                                         $ilan = new App\Ilan();
                                     if (!$ilan->ilan_goturu_bedeller)
                                         $ilan->ilan_goturu_bedeller = new App\IlanGoturuBedel ();
                                     ?>
                                 <tr>
                                     <th>Sıra:</th>
                                     <th>İşin Adı:</th>
                                     <th>Miktar Türü:</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                                 @foreach($ilan->ilan_goturu_bedeller as $ilan_goturu_bedel)
                                 <tr>
                                     <td>
                                         {{$ilan_goturu_bedel->sira}}
                                     </td>

                                     <td>
                                         {{$ilan_goturu_bedel->isin_adi}}
                                     </td>
                                     <td>
                                         {{$ilan_goturu_bedel->miktar_turu}}
                                     </td>

                                     <td> <button name="open-modal-goturu-bedel"  value="{{$ilan_goturu_bedel->id}}" class="btn btn-primary btn-xs open-modal-goturu-bedel" >Düzenle</button></td>
                                     <td>
                                         {{ Form::open(array('url'=>'firmaIlanOlustur/goturu/'.$ilan_goturu_bedel->id,'method' => 'DELETE', 'files'=>true)) }}
                             <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                 {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                                 {{ Form::close() }}
                                 </td>
                                 <input type="hidden" name="ilan_goturu_bedel_id"  id="ilan_goturu_bedel_id" value="{{$ilan_goturu_bedel->id}}"> 
                                     </tr>

                                     <div class="modal fade" id="myModal-goturu_bedeller" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kalemler Listesi</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('url'=>'firmaIlanOlustur/kalemlerListesiGoturuUpdate/'.$ilan_goturu_bedel->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Sıra</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" value="  {{$ilan_goturu_bedel->sira}}" required>
                                                         </div>
                                                     </div>

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">İşin Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="isin_adi" name="isin_adi" placeholder=" İşin Adı" value="{{$ilan_goturu_bedel->isin_adi}}" required>
                                                         </div>
                                                     </div>

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar Türü</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="miktar_turu" name="miktar_turu" placeholder="Miktar Türü" value="{{$ilan_goturu_bedel->miktar_turu}}" required>
                                                         </div>
                                                     </div>
                                                     <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  


                                                         {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/kalemlerListesiGoturuUpdate/'.$ilan_goturu_bedel->id,'class'=>'btn btn-danger')) !!}
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
                                     <div class="modal fade" id="myModal-goturu_bedeller_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kalemler Listesi</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('url'=>'firmaIlanOlustur/kalemlerListesiGoturu/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Sıra</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" value="">
                                                         </div>
                                                     </div>

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">İşin Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="isin_adi" name="isin_adi" placeholder=" İşin Adı" value="" required>
                                                         </div>
                                                     </div>

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar Türü</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="miktar_turu" name="miktar_turu" placeholder="Miktar Türü" value="" required>
                                                         </div>
                                                     </div>


                                                     {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/kalemlerListesiGoturu/'.$ilan->id,'class'=>'btn btn-danger')) !!}
                                                     {!! Form::close() !!}
                                                 </div>
                                                 <div class="modal-footer">                                                            
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <button id="btn-add-goturu_bedeller" name="btn-add-goturu_bedeller" class="btn btn-primary btn-xs" >Ekle</button>
                                     </div>
                                     </div>
                                     </div>
             <div id="yapim"  class="panel panel-default ">
                 <div class="panel-heading">
                     <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Fiyat İstenen Kalemler Listesi</a>
                     </h4>
                 </div>
                 <div id="collapse7" class="panel-collapse collapse">
                     <div class="panel-body">
                         <table class="table" >
                             <thead id="tasks-list" name="tasks-list">
                                 <tr id="firma{{$firma->id}}">
                                     <?php
                                     if (!$ilan)
                                         $ilan = new App\Ilan();
                                     if (!$ilan->ilan_yapim_isleri)
                                         $ilan->ilan_yapim_isleri = new App\IlanYapimIsi();
                                     ?>
                                 <tr>
                                     <th>Sıra:</th>
                                     <th>Adı:</th>
                                     <th>Miktar:</th>
                                     <th>Birim:</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                                 @foreach($firma->ilanlar->ilan_yapim_isleri as $ilan_yapim_isi)
                                 <tr>
                                     <td>
                                         {{$ilan_yapim_isi->sira}}
                                     </td>

                                     <td>
                                         {{$ilan_yapim_isi->adi}}
                                     </td>
                                     <td>
                                         {{$ilan_yapim_isi->miktar}}
                                     </td>
                                     <td>
                                         {{$ilan_yapim_isi->birimler->adi}}
                                     </td>

                                     <td> <button name="open-modal-yapim-isi"  value="{{$ilan_yapim_isi->id}}" class="btn btn-primary btn-xs open-modal-yapim-isi" >Düzenle</button></td>
                                     <td>
                                         {{ Form::open(array('url'=>'firmaIlanOlustur/yapim/'.$ilan_yapim_isi->id,'method' => 'DELETE', 'files'=>true)) }}
                             <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                 {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                                 {{ Form::close() }}
                                 </td>
                                 <input type="hidden" name="ilan_yapim_isi_id"  id="ilan_yapim_isi_id" value="{{$ilan_yapim_isi->id}}"> 
                                     </tr>


                                     <div class="modal fade" id="myModal-yapim_isleri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kalemler Listesi</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('url'=>'firmaIlanOlustur/kalemlerListesiYapimİsiUpdate/'.$ilan_yapim_isi->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Sıra</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" value="{{$ilan_yapim_isi->sira}}" required>
                                                         </div>
                                                     </div>

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value=" {{$ilan_yapim_isi->adi}}" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value=" {{$ilan_yapim_isi->miktar}}" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Birim</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="birim" id="birim" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($birimler as $birim)
                                                                 <option  value="{{$birim->id}}" >{{$birim->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>
                                                     <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  

                                                         {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/kalemlerListesiYapimİsiUpdate/'.$ilan_yapim_isi->id,'class'=>'btn btn-danger')) !!}
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
                                     <div class="modal fade" id="myModal-yapim_isleri_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">Kalemler Listesi</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     {!! Form::open(array('url'=>'firmaIlanOlustur/kalemlerListesiYapim/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Sıra</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" value="" required>
                                                         </div>
                                                     </div>

                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Adı</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Miktar</label>
                                                         <div class="col-sm-9">
                                                             <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" required>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmail3" class="col-sm-3 control-label">Birim</label>
                                                         <div class="col-sm-9">
                                                             <select class="form-control" name="birim" id="birim" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 @foreach($birimler as $yapim_birim)
                                                                 <option  value="{{$yapim_birim->id}}" >{{$yapim_birim->adi}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                     </div>

                                                     {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/kalemlerListesiYapim/'.$ilan->id,'class'=>'btn btn-danger')) !!}
                                                     {!! Form::close() !!}
                                                 </div>
                                                 <div class="modal-footer">                                                            
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <button id="btn-add-yapim_isleri" name="btn-add-yapim_isleri" class="btn btn-primary btn-xs" >Ekle</button>
                                     </div>
                                     </div>
                                     </div>

         </div>
    </div>

<script >

var ilan_turu;
var sozlesme_turu;
var ezgi="ö";
$('#ilan_turu').on('change', function (e) {
    ilan_turu = e.target.value;
        
    if(ilan_turu=="Mal" && sozlesme_turu=="Birim Fiyatlı")
    {
        $('#hizmet').hide()
        $('#goturu').hide()
        $('#yapim').hide()
                  
    }
    else if(ilan_turu=="Hizmet" && sozlesme_turu=="Birim Fiyatlı")
    {
        $('#mal').hide()
        $('#goturu').hide()
        $('#yapim').hide()
    }
    else if(sozlesme_turu=="Götürü Bedel")
    {
        $('#hizmet').hide()
        $('#mal').hide()
        $('#yapim').hide();
    }
    else if(ilan_turu=="Yapim İşi")
    {
        $('#hizmet').hide()
        $('#goturu').hide()
        $('#mal').hide()
    }
});

$('#sozlesme_turu').on('change', function (e) {
    sozlesme_turu = e.target.value;
    if(ilan_turu=="Mal" && sozlesme_turu=="Birim Fiyatlı")
    {
        $('#hizmet').hide()
        $('#goturu').hide()
        $('#yapim').hide()                  
    }
    else if(ilan_turu=="Hizmet" && sozlesme_turu=="Birim Fiyatlı")
    {
        $('#mal').hide()
        $('#goturu').hide()
        $('#yapim').hide()
    }
    else if(sozlesme_turu=="Götürü Bedel")
    {
        $('#hizmet').hide()
        $('#mal').hide()
        $('#yapim').hide();
    }
    else if(ilan_turu=="Yapim İşi")
    {
        $('#hizmet').hide()
        $('#goturu').hide()
        $('#mal').hide()
    }
 });
    var yayin_tarihi = '{{$ilan->yayin_tarihi}}';
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd='0'+dd
    } 

    if(mm<10) {
        mm='0'+mm
    } 

    today = yyyy+'-'+mm+'-'+dd;
   
$("#btn-add-ilanBilgileri").on('click',function(e){
    if(yayin_tarihi <= today){
        alert("Bu ilan şuanda yayında olduğu için güncellenemez !!!");   
    }
    else{
        $('#myModal-ilanBilgileri').modal('show');
    } 
});
$("#btn-add-fiyatlandırmaBilgileri").on('click',function(e){
    if(yayin_tarihi <= today){
        alert("Bu ilan şuanda yayında olduğu için güncellenemez !!!");   
    }
    else{
        $('#myModal-fiyatlandırmaBilgileri').modal('show');
    } 
});
$("#btn-add-mal").on('click',function(e){
    if(yayin_tarihi <= today){
        alert("Bu ilan şuanda yayında olduğu için güncellenemez !!!");   
    }
    else{
        $('#myModal-mal_birimfiyat_add').modal('show');
    } 
});


$( document ).ready(function() {
    
    
    var ilan_turu="{{$ilan->ilan_turu}}";
    var sozlesme_turu="{{$ilan->sozlesme_turu}}";
    
    if(sozlesme_turu!="Birim Fiyatlı")
    {
        sozlesme_turu="Götürü Bedel";
    }
    
    if(ilan_turu=="") 
    {
        $('#hizmet').hide()
        $('#mal').hide()
        $('#goturu').hide()
        $('#yapim').hide()
    }
    else if(ilan_turu=="Mal" && sozlesme_turu=="Birim Fiyatlı")
    {
        $('#hizmet').hide()
        $('#goturu').hide()
        $('#yapim').hide()              
    }
    else if(ilan_turu=="Hizmet" && sozlesme_turu=="Birim Fiyatlı")
    {
        $('#mal').hide()
        $('#goturu').hide()
        $('#yapim').hide()
    }
    else if(sozlesme_turu=="Götürü Bedel")
    {            
        $('#hizmet').hide()
        $('#mal').hide()
        $('#yapim').hide();
    }
    else if(ilan_turu=="Yapim İşi")
    {
        $('#hizmet').hide()
        $('#goturu').hide()
        $('#mal').hide()
    }
                 //alert(ilan_turu);
                // alert(sozlesme_turu);
                //alert(ezgi);
        
    
               
});

</script>
</body>
</html>
@endsection

