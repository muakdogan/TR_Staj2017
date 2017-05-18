@extends('layouts.app')
@section('content')
  <?php
      use App\Adres;
      use App\Il;
      use App\Ilce;
      use App\Semt;
  ?>
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

            text-align: center;
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
             
             /*custom font*/
             

                #msform {
                        width: 100%;
                        
                       
                        position: relative;
                }
                #msform fieldset {
                    
                }
                /*Hide all except first fieldset*/
                #msform fieldset:not(:first-of-type) {
                        display: none;
                }
        
                /*buttons*/
                #msform .action-button {
                        width: 100px;
                        background: #27AE60;
                        font-weight: bold;
                        color: white;
                        border: 0 none;
                        border-radius: 1px;
                        cursor: pointer;
                        padding: 10px 5px;
                        margin: 10px 5px;
                }
                #msform .action-button:hover, #msform .action-button:focus {
                        box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
                }
                /*headings*/
                .fs-title {
                        font-size: 15px;
                        text-transform: uppercase;
                        color: #2C3E50;
                        margin-bottom: 10px;
                }
                .fs-subtitle {
                        font-weight: normal;
                        font-size: 13px;
                        color: #666;
                        margin-bottom: 20px;
                }
                /*progressbar*/
                #progressbar {
                     
                        overflow: hidden;
                        /*CSS counters to number the steps*/
                        counter-reset: step;
                }
                #progressbar li {
                        list-style-type: none;
                        color: #27ae60;
                        text-transform: uppercase;
                        font-size: 9px;
                        width: 33.33%;
                        float: left;
                        position: relative;
                        text-align: center;
                }
                #progressbar li:before {
                        content: counter(step);
                        counter-increment: step;
                        width: 20px;
                        line-height: 20px;
                        display: block;
                        font-size: 10px;
                        color: #333;
                        background: white;
                        border-radius: 3px;
                        margin: 0 auto 5px auto;
                }
                /*progressbar connectors*/
                #progressbar li:after {
                        content: '';
                        width: 100%;
                        height: 2px;
                        background: #27ae60;
                        position: absolute;
                        left: -50%;
                        top: 9px;
                        z-index: -1; /*put it behind the numbers*/
                }
                #progressbar li:first-child:after {
                        content: none; 
                }
                #progressbar li.active:before,  #progressbar li.active:after{
                        background: #27AE60;
                        color: white;
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
        <h2>İlan Oluştur</h2>
        <button style="float:right" id="btn-add-ilanBilgileri" name="btn-add-ilanBilgileri" class="btn btn-primary btn-xs" onclick="">Ekle / Düzenle</button>
       
    </div>
    <div class="container">
             <div class="modal fade" id="myModal-ilanBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div style="width:1000px" class="modal-dialog">
                    <script src="{{asset('js/jquery.multi-select.js')}}" type="text/javascript"></script>
                    <script type="text/javascript" src="{{asset('js/jquery.quicksearch.js')}}"></script>

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>İlan Bilgileri</strong></h4>
                            
                                <ul  style="margin-bottom:0px;margin-top:0px" id="progressbar">
                                    <li class="active"><strong>İLAN BİLGİLERİ</strong></li>
                                        <li><strong>KALEM BİLGİLERİ</strong></li>
                                        <li><strong>ONAYLAMA</strong></li>
                                </ul>
                        </div>
                        <div class="modal-body">
                            <form id="msform">
                               
                                <fieldset>
                                        <h2 style=" text-align: center;margin-top:0px;margin-bottom:10px" class="fs-title"><strong>İLAN BİLGİLERİ OLUŞTUR</strong></h2>
                                        <br>
                                        <div class="row">
                                                    <div class="col-sm-6">
                                                         <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Firma Adı Göster</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">

                                                                 <input type="radio" class="filled-in firma_goster"  name="firma_adi_goster" value="1"  data-validation-error-msg="Lütfen birini seçiniz!" /> Göster
                                                                 <input type="radio" data-toggle="tooltip" data-placement="bottom" title="İlanda firma
                                                                        isminin gözükmemesi satıcı firma tarafında belirsizlikler yaratabilir!"
                                                                        class="filled-in test firma_goster"  name="firma_adi_goster" value="0" data-validation-error-msg="Lütfen birini seçiniz!" /> Gizle

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Adı</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="ilan_adi" name="ilan_adi" placeholder="İlan Adı" value="" data-validation="required"
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                             <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Türü</label>
                                                             <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px" class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control"  name="ilan_turu" id="ilan_turu" data-validation="required"
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option value="1">Mal</option>
                                                                    <option value="2">Hizmet</option>
                                                                    <option value="3">Yapım İşi</option>
                                                                </select>
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
                                                               <input class="form-control date" id="yayinlanma_tarihi" name="yayinlanma_tarihi" value="" placeholder="Yayinlanma Tarihi" type="text" data-validation="required"
                                                                data-validation-error-msg="Lütfen bu alanı doldurunuz!" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Kapanma Tarihi</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control date" id="kapanma_tarihi" name="kapanma_tarihi" placeholder="Kapanma Tarihi" value="" data-validation="required"
                                                                data-validation-error-msg="Lütfen bu alanı doldurunuz!">
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
                                                                <input type="text" class="form-control date" id="is_baslama_tarihi" name="is_baslama_tarihi" placeholder="İş Başlama Tarihi" value="" data-validation="required"
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İş Bitiş Tarihi</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control date" id="is_bitis_tarihi" name="is_bitis_tarihi" placeholder="İş Bitiş Tarihi" value="" data-validation="required"
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
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
                                                    </div>
                                                    <div class="col-sm-6">
                                                          <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Katılımcılar</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="katilimcilar" id="katilimcilar" data-validation="required"
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option value="1">Onaylı Tedarikçiler</option>
                                                                    <option value="2">Belirli Firmalar</option>
                                                                    <option value="3">Tüm Firmalar</option>
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
                                                                    <option value="1">Tamrekabet</option>
                                                                    <option value="2">Sadece Başvuru</option>
                                                                </select>
                                                            </div>
                                                        </div>
                               
                                                        <div class="form-group">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Sözleşme Türü</label>
                                                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="sozlesme_turu" id="sozlesme_turu" data-validation="required"
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option value="0">Birim Fiyatlı</option>
                                                                    <option value="1">Götürü Bedel</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3"   style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">FiyatlandırmaŞekli</label>
                                                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="kismi_fiyat" id="kismi_fiyat" data-validation="required"
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option   value="1">Kısmi Fiyat Teklifine Açık</option>
                                                                    <option  value="0">Kısmi Fiyat Teklifine Kapalı</option>
                                                                </select>
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
                                                            <label for="inputEmail3" class="col-sm-3 control-label">Ödeme Türü</label>
                                                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
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
                                                            <label for="inputEmail3" class="col-sm-3 control-label">Para Birimi</label>
                                                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
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
                                                            <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Ad. İli</label>
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
                                                            <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Ad. İlçesi</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name="ilce_id" id="ilce_id" >
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                   
                                                    </div>

                                                </div>
                                        <div class="row">
                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-1 control-label">Açıklama</label>
                                                <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px" class=" col-sm-1 control-label">:</label>
                                                <div class="col-sm-10">
                                                    <textarea id="aciklama" name="aciklama" rows="5" class="form-control ckeditor" placeholder="Lütfen Açıklamayı buraya yazınız.." data-validation="required"
                                                    data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                          <input type="button" name="next" class="next action-button" value="İleri" />
                                </fieldset>
                                 <fieldset>
                                        <h2   style=" text-align:center;margin-top:0px;margin-bottom:10px" class="fs-title"><strong>KALEM BİLGİLERİ OLUŞTUR</strong></h2>
                                        
                                            <div  id="mal"  >
                                             <table class="table" >
                                                 <thead id="tasks-list" name="tasks-list">
                                                <tr style="text-align:center">
                                                    <th>Sıra</th>
                                                    <th>Kalem Ekle</th>
                                                    <th>Marka</th>
                                                    <th>Model</th>
                                                    <th>Açıklama</th>
                                                    <th>Ambalaj</th>
                                                    <th>Miktar</th>
                                                    <th>Birim</th>
                                                    <th></th>

                                                </tr>
                                       
                                                <tr>
                                                    <td></td>
                                                    <td><input type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px" class="form-control" id="mal_kalem" name="mal_kalem" placeholder="Kalem Ekle" readonly  value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"> </td>
                                                    <td><input type="text" class="form-control" id="marka" name="marka" placeholder="Marka" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>
                                                    <td>
                                                       <input type="text" class="form-control" id="model" name="model" placeholder="Model" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                    </td>
                                                   
                                                    <td>
                                                        <textarea  rows="1" id="aciklama" name="aciklama" rows="5" class="form-control " placeholder="Açıklama" data-validation="required"
                                                                    data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea>
                                                    </td>
                                                    
                                                    <td> <input type="text" class="form-control" id="ambalaj" name="ambalaj" placeholder="ambalaj" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>

                                                    <td>
                                                        <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">

                                                    </td>
                                                    <td>
                                                        <select class="form-control" name="birim" id="birim" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($birimler as $birimleri)
                                                            <option  value="{{$birimleri->id}}" >{{$birimleri->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><a href="#"  id=""> <img src="{{asset("images/sil1.png")}}"></a></td>
                                               </tr>
                                          </thead>
                                        </table>               
                                  </div>
                                            
                                            <div id="hizmet" >
                                             <table class="table" >
                                               <thead id="tasks-list" name="tasks-list"
                                                <tr style="text-align:center">
                                                       
                                                    <th>Sıra</th>
                                                    <th>Kalem Ekle</th>
                                                    <th>Açıklama</th>
                                                    <th>Fiyat Standartı</th>
                                                    <th>Fiyat Standartı Birimi</th>
                                                    <th>Miktar</th>
                                                    <th>Birim</th>
                                                    <th></th>

                                                </tr>
                                                <tr>  
                                                    <td></td>
                                                    <td><input type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px" class="form-control" id="hizmet_kalem" name="hizmet_kalem" placeholder="Kalem Ekle" readonly  value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"> </td>
                                                      <td>
                                                         <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                     </td> 
                                                     <td>
                                                         <input type="text" class="form-control" id="fiyat_standardi" name="fiyat_standardi" placeholder="Fiyat Standartı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                     </td> 
                                                     <td>
                                                        <select class="form-control" name="fiyat_standardi_birimi" id="fiyat_standardi_birimi" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($birimler as $fiyat_birimi)
                                                            <option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                     </td>
                                                     <td>
                                                        <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                     </td>    
                                                     <td>
                                                        <select class="form-control" name="miktar_birim_id" id="miktar_birim_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($birimler as $miktar_birim)
                                                            <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                     </td> 
                                                     <td><a href="#"  id=""> <img src="{{asset("images/sil1.png")}}"></a></td>
                                                        <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                                </tr>
                                                 </thead>
                                              </table>
                                            </div>
                                            
                                            <div id="goturu" class="row">
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
                                                <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                            </div>
                                            
                                            <div id="yapim" class="row">
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
                                                            @foreach($birimler as $birim)
                                                            <option  value="{{$birim->id}}" >{{$birim->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                            </div>
                                        <input type="button" class="action-button" id="btn2" value="Kalem Ekle" />
                                        <input type="button" name="previous" class="previous action-button" value="Geri" />
                                        <input type="button" name="next" class="next action-button" value="İleri" />
                                </fieldset>
                                <fieldset>
                                        <input type="text" name="fname" placeholder="First Name" />
                                        <input type="text" name="lname" placeholder="Last Name" />
                                        <input type="text" name="phone" placeholder="Phone" />
                                        <textarea name="address" placeholder="Address"></textarea>
                                        <input type="button" name="previous" class="previous action-button" value="Geri" />
                                        <input type="submit" name="submit" class="submit action-button" value="Onayla ve Gönder />
                                </fieldset>
                           </form>
                        </div>
                            
                        <div class= "modal-footer" >
                        </div>
                    </div>
                </div>
           </div>
           <!--kalemler tree modalı -->
         <div class="modal fade" id="myModal-mal_birimfiyat_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
                    </div>
                    <div class="modal-body">

                    </div>
                     <br>
                     <br>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        
       
    </div>
     <!-- jQuery -->
   
    <!-- jQuery easing plugin -->
    <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

    <script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

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


var ilan_turu;
var sozlesme_turu;

$('#ilan_turu').on('change', function (e) {
        ilan_turu = e.target.value;
        alert(ilan_turu);
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
             alert(sozlesme_turu);
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

$("#btn2").click(function(){
    $("table").append(['<tr>','<td></td>','<td> <input type="text"  style="background:url({{asset("images/ekle.png")}}) no-repeat scroll ;padding-left:25px"class="form-control" id="mal_kalem" name="mal_kalem" placeholder="Kalem Ekle" readonly value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"> </td>',
                        '<td><input type="text" class="form-control" id="marka" name="marka" placeholder="Marka" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
                      ' <td><input type="text" class="form-control" id="model" name="model" placeholder="Model" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
                      '<td><textarea  rows="1" id="aciklama" name="aciklama" rows="5" class="form-control " placeholder="Açıklama" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea></td>',
                       ' <td> <input type="text" class="form-control" id="ambalaj" name="ambalaj" placeholder="ambalaj" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
                      '<td><input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
                       '<td><select class="form-control" name="birim" id="birim" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $birimleri) <option  value="{{$birimleri->id}}" >{{$birimleri->adi}}</option> @endforeach </select></td>',
                       '<td><a href="#"  id=""><img src="{{asset("images/sil1.png")}}"></a></td>','</tr>'].join(''));
});
$("#mal_kalem").click(function(){
    $('#myModal-mal_birimfiyat_add').modal('show');
});
   
    
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return false;
});


</script>
</body>
</html>
@endsection
