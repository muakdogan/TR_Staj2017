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
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">             
        <script src="{{asset('js/ilan/ajax-crud-firmabilgilerim.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
        <link href="{{asset('css/multi-select.css')}}" media="screen" rel="stylesheet" type="text/css"></link>
        <link rel="stylesheet" type="text/css" href="{{asset('css/firmaProfil.css')}}"/>
        <style>
            .popup, .popup2, .bMulti {
            background-color: #fff;
            border-radius: 10px 10px 10px 10px;
            box-shadow: 0 0 25px 5px #999;
            color: #111;
            display: none;
            min-width: 450px;
            padding: 25px;
            text-align: center;
            }
            .popup, .bMulti {
                min-height: 150px;
            }
            .button.b-close, .button.bClose {
                border-radius: 7px 7px 7px 7px;
                box-shadow: none;
                font: bold 131% sans-serif;
                padding: 0 6px 2px;
                position: absolute;
                right: -7px;
                top: -7px;
            }
            .button {
                background-color: #2b91af;
                border-radius: 10px;
                box-shadow: 0 2px 3px rgba(0,0,0,0.3);
                color: #fff;
                cursor: pointer;
                display: inline-block;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
            }
            
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
        
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

    <div class="container">
        <br>
        <br>
          @include('layouts.alt_menu') 
        @if(count($ilan) == 0)  
            <h2>İlan Oluştur</h2>
        @else
            <h2>İlan Düzenle</h2>
        @endif    
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8" >
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>İlan Bilgilerim</strong></a>
                                 <?php 
                                  $kullanici_id= Auth::user()->kullanici_id;
                                  $firma_id=$firma->id;
                                    $rol_id  = App\FirmaKullanici::where( 'kullanici_id', '=', $kullanici_id)
                                            ->where( 'firma_id', '=', $firma_id)
                                            ->select('rol_id')->get();
                                            $rol_id=$rol_id->toArray();
                                    $querys = App\Rol::join('firma_kullanicilar', 'firma_kullanicilar.rol_id', '=', 'roller.id')
                                    ->where( 'firma_kullanicilar.rol_id', '=', $rol_id[0]['rol_id'])
                                    ->select('roller.adi as rolAdi')->get();
                                    $querys=$querys->toArray();
                                    $rol=$querys[0]['rolAdi'];
                                ?>
                                @if ( $rol !== 'Satış')
                                   <button style="float:right" id="btn-add-ilanBilgileri" name="btn-add-ilanBilgileri" class="btn btn-primary btn-xs" onclick="populateDD()">Ekle / Düzenle</button>
                                @endif
                            </h4>
                        </div>
                        <div id="collapse2" >
                            <div class="panel-body">
                                <table class="table" >
                                    <thead id="tasks-list" name="tasks-list">
                                        <tr id="firma{{$firma->id}}">
                                            <tr>
                                                <td width="25%"><strong>Firma Adı</strong></td>
                                            <?php
                                            $firma->firma_sektorler = new App\FirmaSektor();
                                            $firma->firma_sektorler->sektorler = new App\Sektor();
                                             if (!$ilan){
                                                $ilan = new App\Ilan();
                                             
                                             }

                                            if($ilan->goster=="Göster"){
                                            ?>
                                                <td width="75%"><strong>:</strong> {{$firma->adi}}</td>
                                            <?php
                                            }
                                            else if($ilan->goster=="Gizle"){    
                                            ?>
                                            <td width="75%"><strong>:</strong> {{$firma->adi}}(GİZLİ)</td>
                                            <?php
                                            }
                                            ?>

                                        </tr>

                                        <tr>
                                            <td><strong>İlan Adı</strong></td>
                                           
                                            <td><strong>:</strong> {{$ilan->adi}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>İlan Sektor</strong></td>
                                        
                                             <td><strong>:</strong> @foreach($sektorler as $ilanSektor)<?php
                                                if($ilanSektor->id == $ilan->firma_sektor){
                                                    ?> {{$ilanSektor->adi}} <?php }?>
                                                    @endforeach 
                                             </td>
                                                    
                                        </tr>
                                        <tr>
                                            <td><strong>İlan Yayınlama Tarihi</strong></td>
                                            <td><strong>:</strong>@if($ilan->yayin_tarihi != null) {{date('d- m -Y', strtotime($ilan->yayin_tarihi))}} @endif</td>
                                        </tr>
                                        <tr>
                                            <td><strong>İlan Kapanma </strong></td>
                                            <td><strong>:</strong>@if($ilan->kapanma_tarihi != null) {{date('d- m -Y', strtotime($ilan->kapanma_tarihi))}} @endif</td>
                                        </tr>
                                        <tr>
                                            <td><strong>İlan Açıklaması</strong></td>
                                            <td><strong>:</strong> <?php echo $ilan->aciklama; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>İlan Türü</strong></td>
                                            <td><strong>:</strong> @if($ilan->ilan_turu=="1") Mal @elseif ($ilan->ilan_turu=="2")Hizmet @elseif ($ilan->ilan_turu=="3") Yapım İşi @endif</td>
                                        </tr>
                                        <tr>
                                            <td><strong>İlan Usulü</strong></td>
                                            <td><strong>:</strong> @if($ilan->usulu=="1") Tamrekabet @elseif ($ilan->usulu=="2") Belirli İstekliler Arasında @elseif ($ilan->usulu=="3") Sadece Başvuru @endif</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sözleşme Türü</strong></td>
                                              <td><strong>:</strong> @if($ilan->sozlesme_turu=="0") Birim Fiyatlı @elseif ($ilan->sozlesme_turu=="1") Götürü Bedel @endif</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Teknik Şartname</strong></td>
                                            <td><strong>:</strong>  {{$ilan->teknik_sartname}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Yaklaşık Maliyet</strong></td>
                                            <td><strong>:</strong>  {{$ilan->yaklasik_maliyet}}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Teslim Yeri</strong></td>
                                            <?php
                                            if ($ilan->teslim_yeri_satici_firma == NULL) {
                                                ?>  
                                                <?php
                                            } else {
                                                ?>
                                                <td><strong>:</strong>  {{$ilan->teslim_yeri_satici_firma}}</td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td><strong>İşin Süresi</strong></td>
                                            <td><strong>:</strong> {{$ilan->isin_suresi}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>İş Başlama Tarihi</strong></td>
                                            <td><strong>:</strong>@if($ilan->is_baslama_tarihi != null){{date('d- m -Y', strtotime($ilan->is_baslama_tarihi))}} @endif</td>
                                        </tr>
                                        <tr>
                                            <td><strong>İş Bitiş Tarihi</strong></td>
                                            
                                            <td><strong>:</strong>@if($ilan->is_bitis_tarihi != null){{date('d- m -Y', strtotime($ilan->is_bitis_tarihi))}} @endif</td>
                                        </tr>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="modal fade" id="myModal-ilanBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div style="width:900px" class="modal-dialog">
                                         <script src="{{asset('js/jquery.multi-select.js')}}" type="text/javascript"></script>
                                         <script type="text/javascript" src="{{asset('js/jquery.quicksearch.js')}}"></script>
                                         
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>İlan Bilgileri</strong></h4>
                                                
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(array('id'=>'valid','url'=>'firmaIlanOlustur/ilanBilgileri/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                                
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Firma Adı Göster</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                               
                                                                 <input type="checkbox" class="filled-in firma_goster"  name="firma_adi_gizli[]" value="1" data-validation="checkbox_group" data-validation-error-msg="Lütfen birini seçiniz!"  data-validation-qty="min1"/>Göster  
                                                                 <input type="checkbox" data-toggle="tooltip" data-placement="bottom" title="İlanda firma 
                                                                        isminin gözükmemesi satıcı firma tarafında 
                                                                        belirsizlikler yaratabilir!" 
                                                                        class="filled-in test firma_goster"  name="firma_adi_gizli[]" value="0" data-validation-error-msg="Lütfen  birini seçiniz!" data-validation="checkbox_group"  data-validation-qty="min1" />Gizli
                                                             
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Adı</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="ilan_adi" name="ilan_adi" placeholder="İlan Adı" value="{{$ilan->adi}}" data-validation="required" 
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Sektör</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                              
                                                                <select class="form-control selectpicker" style="height:20px" data-live-search="true"  name="firma_sektor" id="firma_sektor" data-validation="required" 
                                                                data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option  style="color:#eee"selected disabled>Seçiniz</option>
                                                                    @foreach($sektorler as $sektor)
                                                                    <option style="font-size:12px" value="{{$sektor->id}}" >{{$sektor->adi}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Yayınlama Tarihi</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                               <input class="form-control date" id="yayinlanma_tarihi" name="yayinlanma_tarihi" value="{{$ilan->yayin_tarihi}}" placeholder="Yayinlanma Tarihi" type="text" data-validation="required" 
                                                                data-validation-error-msg="Lütfen bu alanı doldurunuz!" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Kapanma Tarihi</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control date" id="kapanma_tarihi" name="kapanma_tarihi" placeholder="Kapanma Tarihi" value="{{$ilan->kapanma_tarihi}}" data-validation="required" 
                                                                data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Açıklama</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px" class=" col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <!--input type="text" class="form-control " id="aciklama" name="aciklama" placeholder="Açıklama" value=""-->
                                                                <textarea id="aciklama" name="aciklama" rows="5" class="form-control ckeditor" placeholder="Lütfen Açıklamayı buraya yazınız.."  value="{{$ilan->aciklama}}" data-validation="required" 
                                                                data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                             <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Türü</label>
                                                             <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px" class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control"  name="ilan_turu" id="ilan_turu" data-validation="required" 
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option  value="1">Mal</option>
                                                                    <option  value="2">Hizmet</option>
                                                                    <option  value="3">Yapım İşi</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Rekabet Şekli</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="rekabet_sekli" id="rekabet_sekli" data-validation="required" 
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option  value="1">Tamrekabet</option>
                                                                    <option  value="2">Belirli İstekliler Arasında</option>
                                                                    <option  value="3"> Sadece Başvuru</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"  id="belirli-istekliler">
                                                           <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Firma Seçiniz</label>
                                                           <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                           <div   class="col-sm-9 ezgi">
                                                               <div   class="col-sm-2 "></div>
                                                               <div style="padding-right:3px;padding-left:1px"  class="col-sm-10 ">
                                                                    <select id='custom-headers' multiple='multiple' name="belirli_istekli[]" id="belirli_istekli[]" >
                                                                    </select>
                                                               </div>

                                                           </div>
                                                        </div> 
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Sözleşme Türü</label>
                                                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="sozlesme_turu" id="sozlesme_turu" data-validation="required" 
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option   value="0">Birim Fiyatlı</option>
                                                                    <option  value="1">Götürü Bedel</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teknik Şartname</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <div class="control-group">
                                                                    <div class="controls">
                                                                        {!! Form::file('teknik',array(
                                                                           'data-toggle'=>'tooltip',
                                                                           'data-placement'=>'bottom',
                                                                           'title'=>'Yüklenebilir dosya türü:.pdf',
                                                                           'class'=>'test'))!!}
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
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Yaklaşık Maliyet</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="yaklasik_maliyet" id="yaklasik_maliyet" data-validation="required" 
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled>Seçiniz</option>
                                                                    @foreach($maliyetler as $maliyet)
                                                                    <option name="{{$maliyet->aralik}}" value="{{$maliyet->miktar}}" >{{$maliyet->aralik}}</option>

                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" id="maliyet" name="maliyet" value=""></input>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Yeri</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="teslim_yeri" id="teslim_yeri" data-validation="required" 
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option   value="Satıcı Firma">Satıcı Firma</option>
                                                                    <option  value="Adrese Teslim">Adrese Teslim</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group error teslim_il">
                                                            <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Yeri İl</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control " name="il_id" id="il_id" >
                                                                    <option selected disabled>Seçiniz</option>
                                                                     <?php $iller_query= DB::select(DB::raw("SELECT * 
                                                                        FROM  `iller` 
                                                                        WHERE adi = 'İstanbul'
                                                                        OR adi =  'İzmir'
                                                                        OR adi =  'Ankara'
                                                                        UNION 
                                                                        SELECT * 
                                                                        FROM iller"));
                                                                      ?>
                                                                    @foreach($iller_query as $il)
                                                                    <option  value="{{$il->id}}" >{{$il->adi}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group error teslim_ilce">
                                                            <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Yeri İlçe</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="ilce_id" id="ilce_id" >
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İşin Süresi</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="isin_suresi" id="isin_suresi" data-validation="required" 
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option value="Tek Seferde">Tek Seferde</option>
                                                                    <option value="Zamana Yayılarak">Zamana Yayılarak</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İş Başlama Tarihi</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control date" id="is_baslama_tarihi" name="is_baslama_tarihi" placeholder="İş Başlama Tarihi" value="{{$ilan->is_baslama_tarihi}}" data-validation="required" 
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İş Bitiş Tarihi</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control date" id="is_bitis_tarihi" name="is_bitis_tarihi" placeholder="İş Bitiş Tarihi" value="{{$ilan->is_bitis_tarihi}}" data-validation="required" 
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-danger" url="firmaIlanOlustur/ilanBilgileri/'.$firma->id"  style="float:right" type="submit">Kaydet</button>
                                                {!! Form::close() !!}
                                            </div>
                                            <br>
                                            <br>
                                            <div class="modal-footer">                                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><strong>Fiyatlandırma Bigileri</strong></a>
                                
                                @if ( $rol === 'Yönetici' || $rol ==='Satın Alma' || $rol ==='Satın Alma / Satış' )
                                    <button  style="float:right"id="btn-add-fiyatlandırmaBilgileri" name="btn-add-fiyatlandırmaBilgileri" onclick="populateDD()" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                                @endif
                            </h4>
                        </div>
                        <div id="collapse3" >
                            <div class="panel-body">
                                <table class="table" >
                                    <thead id="tasks-list" name="tasks-list">
                                        <tr id="firma{{$firma->id}}">
                                       
                                        <tr>
                                            <td width="25%"><strong>Ödeme Türü</strong></td>
                                            
                                            <td width="75%"><strong>:</strong><?php if($ilan->odeme_turu_id != NULL)
                                            {?> {{$ilan->odeme_turleri->adi}}<?php }?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><strong>Para Birimi</strong></td>
                                            
                                            <td><strong>:</strong>  <?php if($ilan->para_birimi_id != NULL)
                                            {
                                            ?> {{$ilan->para_birimleri->adi}} <?php }?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><strong>Fiyatlandırma Şekli</strong></td>
                                            <td><strong>:</strong> 
                                                @if($ilan->fiyatlandırma_sekli != null)
                                                    @if($ilan->fiyatlandirma_sekli==1)
                                                        Kısmş Fiyat Teklifine Açık
                                                    @elseif($ilan->fiyatlandirma_sekli==0)
                                                        Kısmi Fiyat Teklifine Kapalı
                                                    @endif
                                                @endif  
                                            </td> 
                                        </tr>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="modal fade" id="myModal-fiyatlandırmaBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Fiyatlandırma Bilgileri</strong></h4>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(array('url'=>'firmaIlanOlustur/fiyatlandırmaBilgileri/'.$firma->id.'/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                <div class="form-group">
                                                   
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Ödeme Türü</label>
                                                     <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="odeme_turu" id="odeme_turu" data-validation="required" 
                                                      data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($odeme_turleri as $odeme_turu)
                                                            <option  value="{{$odeme_turu->id}}" >{{$odeme_turu->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Para Birimi</label>
                                                     <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="para_birimi" id="para_birimi" data-validation="required" 
                                                      data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($para_birimleri as $para_birimi)
                                                            <option  value="{{$para_birimi->id}}" >{{$para_birimi->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Fiyatlandırma Şekli</label>
                                                     <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="kismi_fiyat" id="kismi_fiyat" data-validation="required" 
                                                      data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            <option selected disabled value="Seçiniz">Seçiniz</option>
                                                            <option   value="1">Kısmi Fiyat Teklifine Açık</option>
                                                            <option  value="0">Kısmi Fiyat Teklifine Kapalı</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/fiyatlandırmaBilgileri/'.$firma->id.'/'.$ilan->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                {!! Form::close() !!}
                                            </div>
                                            <br>
                                            <br>
                                            <div class="modal-footer">                                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="mal"   class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><strong>Fiyat İstenen Kalemler Listesi</strong></a>
                                <button  style="float:right" id="btn-add-mal" name="btn-add-mal" class="btn btn-primary btn-xs" >Ekle</button>
                            </h4>
                        </div>
                        <div id="collapse4" >
                            <div class="panel-body">
                                <table class="table" >
                                    <thead id="tasks-list" name="tasks-list">
                                        <tr id="firma{{$firma->id}}">
                                            <?php
                                            if (!$ilan)
                                                $ilan = new App\Ilan();
                                            if (!$ilan->ilan_mallar)
                                                $ilan->ilan_mallar = new App\IlanMal();

                                               $i=1;
                                            ?>
                                        <tr>
                                            <th>Sıra</th>
                                            <th>Marka</th>
                                            <th>Model</th>
                                            <th>Adı</th>
                                            <th>Ambalaj</th>
                                            <th>Miktar</th>
                                            <th>Birim</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @foreach($ilan->ilan_mallar as $ilan_mal)
                                        <tr>
                                            <td>
                                                 {{$i}}
                                            </td>

                                               <?php $i++?>

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
                                                       {{ Form::open(array('url'=>'mal/'.$ilan_mal->id,'method' => 'DELETE', 'files'=>true)) }}
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
                                                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'kalemlerListesiMalUpdate/'.$ilan_mal->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Marka</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="marka" name="marka" placeholder="Marka" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Model</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="model" name="model" placeholder="Model" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Ambalaj</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="ambalaj" name="ambalaj" placeholder="ambalaj" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Miktar</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Birim</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="birim" id="birim" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                        <option selected disabled>Seçiniz</option>
                                                                        @foreach($birimler as $birim)
                                                                        <option  value="{{$birim->id}}" >{{$birim->adi}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  

                                                                {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiMalUpdate/'.$ilan_mal->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
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
                                                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'kalemlerListesiMal/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Marka</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="marka" name="marka" placeholder="Marka" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Model</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="model" name="model" placeholder="Model" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Ambalaj</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="ambalaj" name="ambalaj" placeholder="ambalaj" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Miktar</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Birim</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="birim" id="birim" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                        <option selected disabled>Seçiniz</option>
                                                                        @foreach($birimler as $birimleri)
                                                                        <option  value="{{$birimleri->id}}" >{{$birimleri->adi}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiMal/'.$ilan->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                         <br>
                                                         <br>
                                                        <div class="modal-footer">                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                          </div>
                                    </div>
                            </div>
                    <div  id="hizmet"   class="panel panel-default ">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><strong>Fiyat İstenen Kalemler Listesi</strong></a>
                                 <button style="float:right" id="btn-add-hizmet" name="btn-add-hizmet" class="btn btn-primary btn-xs" >Ekle</button>
                            </h4>
                        </div>
                        <div id="collapse5" >
                            <div class="panel-body">
                                <table class="table" >
                                    <thead id="tasks-list" name="tasks-list">
                                        <tr id="firma{{$firma->id}}">
                                            <?php
                                            if (!$ilan)
                                                $ilan = new App\Ilan();
                                            if (!$ilan->ilan_hizmetler)
                                                $ilan->ilan_hizmetler = new App\IlanHizmet();
                                            $j=0;
                                            ?>
                                        <tr>
                                            <th>Sıra</th>
                                            <th>Adı</th>
                                            <th>Fiyat Standartı</th>
                                            <th>Fiyat Standartı Birimi</th>
                                            <th>Miktar</th>
                                            <th>Miktar Birimi</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @foreach($ilan->ilan_hizmetler as $ilan_hizmet)
                                        <tr>
                                            <td>
                                                {{$j}}
                                            </td>
                                            {{$j++}}

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
                                                {{ Form::open(array('url'=>'hizmet/'.$ilan_hizmet->id,'method' => 'DELETE', 'files'=>true)) }}
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
                                                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'kalemlerListesiHizmetUpdate/'.$ilan_hizmet->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                            <div class="form-group">
                                                                <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="{{$ilan_hizmet->adi}}" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Fiyat Standartı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="fiyat_standardi" name="fiyat_standardi" placeholder="Fiyat Standartı" value="{{$ilan_hizmet->fiyat_standardi}}" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">F .S Birimi</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="fiyat_standardi_birimi" id="fiyat_standardi_birimi" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                        <option selected disabled>Seçiniz</option>
                                                                        @foreach($birimler as $fiyat_birimi)
                                                                        <option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Miktar</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value=" {{$ilan_hizmet->miktar}}" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Miktar Birimi</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="miktar_birim_id" id="miktar_birim_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                        <option selected disabled>Seçiniz</option>
                                                                        @foreach($birimler as $miktar_birim)
                                                                        <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  

                                                                {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiHizmetUpdate/'.$ilan_hizmet->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                                {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">                                                            
                                                        </div>
                                                        <br>
                                                        <br>
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
                                                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'kalemlerListesiHizmet/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}


                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Fiyat Standartı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="fiyat_standardi" name="fiyat_standardi" placeholder="Fiyat Standartı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Fiyat Standartı Birimi</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="fiyat_standardi_birimi" id="fiyat_standardi_birimi" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!" >
                                                                        <option selected disabled>Seçiniz</option>
                                                                        @foreach($birimler as $fiyat_birimi)
                                                                        <option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Miktar</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Miktar Birimi</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="miktar_birim_id" id="miktar_birim_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                        <option selected disabled>Seçiniz</option>
                                                                        @foreach($birimler as $birimi)
                                                                        <option  value="{{$birimi->id}}" >{{$birimi->adi}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiHizmet/'.$ilan->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">                                                            
                                                        </div>
                                                        <br>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>

                                           
                                            </div>
                                            </div>
                                            </div>
                    <div  id="goturu" class="panel panel-default ">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6"><strong>Fiyat İstenen Kalemler Listesi</strong></a>
                                 <button  style="float:right" id="btn-add-goturu_bedeller" name="btn-add-goturu_bedeller" class="btn btn-primary btn-xs" >Ekle</button>
                            </h4>
                        </div>
                        <div id="collapse6" >
                            <div class="panel-body">
                                <table class="table" >
                                    <thead id="tasks-list" name="tasks-list">
                                        <tr id="firma{{$firma->id}}">
                                            <?php
                                            if (!$ilan)
                                                $ilan = new App\Ilan();
                                            if (!$ilan->ilan_goturu_bedeller)
                                                $ilan->ilan_goturu_bedeller = new App\IlanGoturuBedel ();

                                            $k=0;
                                            ?>
                                        <tr>
                                            <th>Sıra</th>
                                            <th>İşin Adı</th>
                                            <th>Miktar Türü</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @foreach($ilan->ilan_goturu_bedeller as $ilan_goturu_bedel)
                                        <tr>
                                            <td>
                                                {{$k}}
                                            </td>

                                            {{$k++}}

                                            <td>
                                                {{$ilan_goturu_bedel->isin_adi}}
                                            </td>
                                            <td>
                                                {{$ilan_goturu_bedel->miktar_turu}}
                                            </td>

                                            <td> <button name="open-modal-goturu-bedel"  value="{{$ilan_goturu_bedel->id}}" class="btn btn-primary btn-xs open-modal-goturu-bedel" >Düzenle</button></td>
                                            <td>
                                                {{ Form::open(array('url'=>'goturu/'.$ilan_goturu_bedel->id,'method' => 'DELETE', 'files'=>true)) }}
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
                                                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'kalemlerListesiGoturuUpdate/'.$ilan_goturu_bedel->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}


                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">İşin Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="isin_adi" name="isin_adi" placeholder=" İşin Adı" value="{{$ilan_goturu_bedel->isin_adi}}" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Miktar Türü</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="miktar_turu" name="miktar_turu" placeholder="Miktar Türü" value="{{$ilan_goturu_bedel->miktar_turu}}" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  


                                                                {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiGoturuUpdate/'.$ilan_goturu_bedel->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                                {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">                                                            
                                                        </div>
                                                        <br>
                                                        <br>
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
                                                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'kalemlerListesiGoturu/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}


                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">İşin Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="isin_adi" name="isin_adi" placeholder=" İşin Adı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Miktar Türü</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="miktar_turu" name="miktar_turu" placeholder="Miktar Türü" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>


                                                            {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiGoturu/'.$ilan->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                    <div id="yapim"  class="panel panel-default ">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse7"><strong>Fiyat İstenen Kalemler Listesi</strong></a>
                                 <button style="float:right" id="btn-add-yapim_isleri" name="btn-add-yapim_isleri" class="btn btn-primary btn-xs" >Ekle</button>
                            </h4>
                        </div>
                        <div id="collapse7" >
                            <div class="panel-body">
                                <table class="table" >
                                    <thead id="tasks-list" name="tasks-list">
                                        <tr id="firma{{$firma->id}}">
                                            <?php
                                            if (!$ilan)
                                                $ilan = new App\Ilan();
                                            if (!$ilan->ilan_yapim_isleri)
                                                $ilan->ilan_yapim_isleri = new App\IlanYapimIsi();
                                            $y=0;
                                            ?>
                                        <tr>
                                            <th>Sıra:</th>
                                            <th>Adı:</th>
                                            <th>Miktar:</th>
                                            <th>Birim:</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @foreach($ilan->ilan_yapim_isleri as $ilan_yapim_isi)
                                        <tr>
                                            <td>
                                                {{$y}}
                                            </td>
                                            {{$y++}}       

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
                                                {{ Form::open(array('url'=>'yapim/'.$ilan_yapim_isi->id,'method' => 'DELETE', 'files'=>true)) }}
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
                                                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'kalemlerListesiYapimİsiUpdate/'.$ilan_yapim_isi->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}



                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value=" {{$ilan_yapim_isi->adi}}" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Miktar</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value=" {{$ilan_yapim_isi->miktar}}" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Birim</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="birim" id="birim" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                        <option selected disabled>Seçiniz</option>
                                                                        @foreach($birimler as $birim)
                                                                        <option  value="{{$birim->id}}" >{{$birim->adi}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">  

                                                                {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiYapimİsiUpdate/'.$ilan_yapim_isi->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                                {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">                                                            
                                                        </div>
                                                        <br>
                                                        <br>
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
                                                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'kalemlerListesiYapim/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}


                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Miktar</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                                                <label for="inputEmail3" class="col-sm-1 control-label">Birim</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="birim" id="birim" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                        <option selected disabled>Seçiniz</option>
                                                                        @foreach($birimler as $yapim_birim)
                                                                        <option  value="{{$yapim_birim->id}}" >{{$yapim_birim->adi}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiYapim/'.$ilan->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                 </div>
                </div>
            </div>
            <div class="col-sm-4">
                
            </div>
        </div>
         <div id="mesaj" class="popup">
            <span class="button b-close"><span>X</span></span>
            <h2 style="color:red;font-size:14px"> Dikkat!!</h2>
            <h3 style="font-size:12px">Lütfen Rekabet Şeklini Seçmeden Önce İlan Sektörü Seçimi Yapınız.</h3>
        </div>
    </div>

    <script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<!--script src="{{asset('js/selectDD.js')}}"></script-->  
<script charset="utf-8"> 
    var firmaCount = 0;
    var multiselectCount=0;
 $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
     
       $.fn.datepicker.dates['tr'] = {
            days: ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi", "Pazar"],
            daysShort: ["Pz", "Pzt", "Sal", "Çrş", "Prş", "Cu", "Cts", "Pz"],
            daysMin: ["Pz", "Pzt", "Sa", "Çr", "Pr", "Cu", "Ct", "Pz"],
            months: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
            monthsShort: ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"],
            today: "Bugün"
	};
        var date_input=$('input[class="form-control date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd-mm-yyyy',
            language:"tr",
            container: container,
            weekStart:1,
            todayHighlight: true,
            autoclose: true
        }).on('change', function() {
            $(this).validate();  // triggers the validation test
        // '$(this)' refers to '$("#datepicker")'
        });
        
        
        $('#il_id').on('change', function (e) {
            var il_id = e.target.value;
            GetIlce(il_id);
            //popDropDown('ilce_id', 'ajax-subcat?il_id=', il_id);
            //$("#semt_id")[0].selectedIndex=0;
        });
});



 $.validate({
    modules : 'location, date, security, file',
    onModulesLoaded : function() {
      $('#country').suggestCountry();
    }
  });
  $('#presentation').restrictLength( $('#pres-max-length') );
  
function GetIlce(il_id) {
        if (il_id > 0) {
            $("#ilce_id").get(0).options.length = 0;
            $("#ilce_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 

            $.ajax({
                type: "GET",
                url: "{{asset('ajax-subcat')}}",
                data:{il_id:il_id},
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
function populateDD(){
    GetIlce({{$ilan->teslim_yeri_il_id}});
    $("#il_id").val({{$ilan->teslim_yeri_il_id}});
    if("{{$ilan->teslim_yeri_ilce_id}}" !== "" ){
      
        $("#ilce_id").val({{$ilan->teslim_yeri_ilce_id}});
    }else{
        
        $("#ilce_id").prop("selected".true);
    }
    $("#firma_sektor").val({{$ilan->firma_sektor}});
    $("#ilan_turu").val({{$ilan->ilan_turu}});
    $("#rekabet_sekli").val({{$ilan->usulu}});
    $("#sozlesme_turu").val({{$ilan->sozlesme_turu}});
    $("#yaklasik_maliyet").val({{$ilan->komisyon_miktari}});
    if("{{$ilan->teslim_yeri_satici_firma}}" !== "" ){
        $("#teslim_yeri").val("{{$ilan->teslim_yeri_satici_firma}}");
    }
    if("{{$ilan->isin_suresi}}" !== "" ){
        $("#isin_suresi").val("{{$ilan->isin_suresi}}");
    }
}
      

var sektor=0;
    
$(function() {
    $("#yaklasik_maliyet").change(function(){
        var option = $('option:selected', this).attr('name');
        $('#maliyet').val(option);   
    });
});
    var select_count=0;
    var multiselectCount=0;
$(function() {
    $("#firma_sektor").change(function(){
      sektor = $('option:selected', this).attr('value');
      select_count++;
      alert("girdi:"+select_count);
      if(select_count>1){
          
      }
      $('#custom-headers').multiSelect('deselect_all');
      //$('#custom-headers').multiSelect().remove();
   
      funcBelirliIstekler();
      
    });
});
function funcBelirliIstekler(){             
    $.ajax({
        type:"GET",
        url: "{{asset('belirli')}}",
        data:{sektorBelirli:sektor },
        cache: false,
        success: function(data){
           console.log(data);
           $("#custom-headers option").remove();
            for(var c=0; c<multiselectCount; c++){
                $("#"+(c+48)+"-selectable").remove();
            }
                   
           for(var key=0; key <Object.keys(data).length;key++)
            {
                multiselectCount++;
                $('#custom-headers').multiSelect('addOption', { value: key, text: data[key].adi, index:key }); 
               
            } 
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        }
    });
}
$(function() {
    $("#rekabet_sekli").change(function(){
        var option = $('option:selected', this).attr('value');
        if(sektor!==0){
            alert(option);
            if(option==="2"){
                $('#belirli-istekliler').show();
            }
            else
            {
                 $('#belirli-istekliler').hide();            
            }
        }
        else
        {
             $('#mesaj').bPopup({
                 speed: 650,
                 transition: 'slideIn',
                 transitionClose: 'slideBack',
                 autoClose: 5000 
             });
        }
    });
});
$('#custom-headers').multiSelect({
  selectableHeader: "<input style='width:115px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
  selectionHeader: "<input  style='width:115px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(values){
       firmaCount++;
       if( firmaCount>2){
              $('#custom-headers').multiSelect('deselect', values);
       }
       
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
      firmaCount--;
    this.qs1.cache();
    this.qs2.cache();
  }
 
});

var ilan_turu;
var sozlesme_turu;

$('#ilan_turu').on('change', function (e) {
        ilan_turu = e.target.value;
        if(ilan_turu=="1" && sozlesme_turu=="0")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                  
                }
             else if(ilan_turu=="2" && sozlesme_turu=="0")
                {
                   $('#mal').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                }
             else if(sozlesme_turu=="1")
                {
                   $('#hizmet').hide()
                   $('#mal').hide()
                   $('#yapim').hide();
                }
            else if(ilan_turu=="3")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#mal').hide()
                }
 
});

$('#sozlesme_turu').on('change', function (e) {
             sozlesme_turu = e.target.value;
             if(ilan_turu=="1" && sozlesme_turu=="0")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                  
                }
             else if(ilan_turu=="2" && sozlesme_turu=="0")
                {
                   $('#mal').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                }
             else if(sozlesme_turu=="1")
                {
                   $('#hizmet').hide()
                   $('#mal').hide()
                   $('#yapim').hide();
                }
            else if(ilan_turu=="3")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#mal').hide()
                }
 });

$( document ).ready(function() {
    $('#belirli-istekliler').hide();
    var ilan_turu='{{$ilan->ilan_turu}}';
    var sozlesme_turu='{{$ilan->sozlesme_turu}}';
            if(ilan_turu=="") 
             {
                          $('#hizmet').hide()
                          $('#mal').hide()
                          $('#goturu').hide()
                          $('#yapim').hide()
             }
            else if(ilan_turu=="1" && sozlesme_turu=="0")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                  
                }
             else if(ilan_turu=="2" && sozlesme_turu=="0")
                {
                   $('#mal').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                }
             else if(sozlesme_turu=="1")
                {
                   $('#hizmet').hide()
                   $('#mal').hide()
                   $('#yapim').hide();
                }
            else if(ilan_turu=="3")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#mal').hide()
                }
});

$( "#teslim_yeri" ).change(function() {
        var teslim_yeri= $('#teslim_yeri').val();
        if(teslim_yeri=="Satıcı Firma"){
            $('.teslim_il').hide();
            $('.teslim_ilce').hide();
        }
        else if(teslim_yeri=="Adrese Teslim"){
             $('.teslim_il').show();
            $('.teslim_ilce').show();
        }
        else{}
        
       
});
$('.firma_goster').click(function() {
    $(this).siblings('input:checkbox').prop('checked', false);
});
$(function() {
  $('.selectpicker').selectpicker();
});

</script>
</body>
</html>
@endsection
