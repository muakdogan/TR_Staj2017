@extends('layouts.app')

<?php
  use App\Adres;
  use App\Il;
  use App\Ilce;
  use App\Semt;
  use Barryvdh\Debugbar\Facade as Debugbar;
?>

@section('head')
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
        <link href="{{asset('css/multi-select.css')}}" media="screen" rel="stylesheet" type="text/css"></link>
        <link rel="stylesheet" type="text/css" href="{{asset('css/firmaProfil.css')}}"/>
        <!--kalem agacı -->
         <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="//cdn.jsdelivr.net/jquery.ui-contextmenu/1/jquery.ui-contextmenu.min.js"></script>
        <link href="{{asset('css/skin-bootstrap/ui.fancytree.css')}}" rel="stylesheet" class="skinswitcher">
        <script src="{{asset('js/jquery.fancytree.js')}}"></script>
        <script src="{{asset('js/jquery.fancytree.glyph.js')}}"></script>
        <script src="{{asset('js/jquery.fancytree.dnd.js')}}"></script>
        <script src="{{asset('js/jquery.fancytree.edit.js')}}"></script>
        <script src="{{asset('js/jquery.fancytree.filter.js')}}"></script>
        <script src="{{asset('js/jquery.fancytree.table.js')}}"></script>

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
                .action-button {
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
                .action-button:hover, #msform .action-button:focus {
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
                        z-index: 0;
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
                        width: 95%;
                        height: 3px;
                        background: white;
                        position: absolute;
                        left: -46.60%;
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
                .eula-container {
                        padding: 15px 20px;
                        height: 250px;
                        overflow: auto;
                        border: 2px solid #ebebeb;
                        color: #7B7B7B;
                        font-size: 12pt;
                        font-weight: 700;
                        background-color: #fff;
                        background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
                        background-image: -webkit-linear-gradient(top, rgba(231,231,231,0.55) 0%, rgba(255,255,255,0.63) 17%, #feffff 100%);
                        background-image: linear-gradient(to bottom, rgba(231,231,231,0.55) 0%, rgba(255,255,255,0.63) 17%, #feffff 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8ce7e7e7', endColorstr='#feffff',GradientType=0 );
                        background-clip: border-box;
                        border-radius: 4px;
                 }
                 .info-box {
                   margin: 0 0 15px;
                 }
                 .box h3{
                    text-align:center;
                          position:relative;
                          top:80px;
                  }
                  .box {
                          width:100%;
                          height:200px;
                          background:#FFF;
                          margin:40px auto;
                  }
                  .effect8
                    {
                            position:relative;
                        -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                           -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                                box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                    }
                    .effect8:before, .effect8:after
                    {
                            content:"";
                        position:absolute;
                        z-index:-1;
                        -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
                        -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
                        box-shadow:0 0 20px rgba(0,0,0,0.8);
                        top:10px;
                        bottom:10px;
                        left:0;
                        right:0;
                        -moz-border-radius:100px / 10px;
                        border-radius:100px / 10px;
                    }
                    .effect8:after
                    {
                            right:10px;
                        left:auto;
                        -webkit-transform:skew(8deg) rotate(3deg);
                           -moz-transform:skew(8deg) rotate(3deg);
                            -ms-transform:skew(8deg) rotate(3deg);
                             -o-transform:skew(8deg) rotate(3deg);
                                transform:skew(8deg) rotate(3deg);
                    }
        </style>
@endsection
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
    <script src="{{asset('js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/jquery.quicksearch.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/additional-methods.js')}}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/aciklama-tooltip.css')}}" />
    <div class="container">
        <br>
        <br>
         <?php $i=1;?>
         @include('layouts.alt_menu')
        <h2>İlan Oluştur</h2>

        <div class="box effect8">
            <h3><button style="font-size:30px;color: #337ab7;background-color: #ffffff;border-color: #ffffff;"  id="btn-add-ilanBilgileri" name="btn-add-ilanBilgileri" class="btn btn-primary btn-xs" onclick="">İlan Oluşturmaya Başlayın</button></h3>
        </div>
    </div>
    <div class="container">
             <div class="modal fade" id="myModal-ilanBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-y:scroll;">
                <div style="width:1050px" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>İlan Bilgileri</strong></h4>

                                <ul  style="margin-bottom:0px;margin-top:0px" id="progressbar">
                                    <li class="active"><strong>İLAN BİLGİLERİ</strong></li>
                                        <li><strong>KALEM BİLGİLERİ</strong></li>
                                        <li><strong>ONAYLAMA</strong></li>
                                </ul>
                        </div>
                        <div class="modal-body">
                        {!! Form::open(array('id'=>'msform','url'=>'ilanOlusturEkle/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}
                                <fieldset  id="ilan" >
                                        <h2 style=" text-align: center;margin-top:0px;margin-bottom:10px" class="fs-title"><strong>İLAN BİLGİLERİ OLUŞTUR</strong></h2>
                                        <br>

                                        <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Firma Adı Göster</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">

                                                                <input type="radio" class="filled-in firma_goster  required"  name="firma_adi_goster" value="1"  data-validation-error-msg="Lütfen birini seçiniz!" checked><label> Göster</label> </input>
                                                                 <input type="radio" data-placement="bottom" class="filled-in test firma_goster"  name="firma_adi_goster" value="0" data-validation-error-msg="Lütfen birini seçiniz!"><label>Gizle</label> </input>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                </div>
                                                                @if($errors->first('firma_adi_goster') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('firma_adi_goster') }}</span>
                                                                @endif
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Adı*</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control required" id="ilan_adi" name="ilan_adi" placeholder="İlan Adı" value="" >
                                                                @if($errors->first('ilan_adi') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('ilan_adi') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Satın almak istediğiniz mal veya hizmet için kısa ancak açıklayıcı bir ilan adı belirleyiniz.</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                             <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Türü*</label>
                                                             <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px" class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required"  name="ilan_turu" id="ilan_turu">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option value="1">Mal</option>
                                                                    <option value="2">Hizmet</option>
                                                                    <option value="3">Yapım İşi</option>
                                                                </select>
                                                                @if($errors->first('ilan_turu') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('ilan_turu') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Yapacağınız satın alımın türünü seçiniz. Seçenklerde belirtilen 3 türden yalnızca birini seçebilirsiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Sektör*</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">

                                                                <select class="form-control selectpicker required" style=" font-size:12px;height:20px" data-live-search="true"  name="firma_sektor" id="firma_sektor"  >
                                                                    <option  style="color:#eee"  selected disabled>Seçiniz</option>
                                                                </select>
                                                                @if($errors->first('firma_sektor') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('firma_sektor') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Aynı sektöre ait 2 farklı tür alım gerçekleştirecekseniz yeni bir ilan daha açmanız gerekecektir.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlanın Tarih Aralığı*</label>
                                                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" name="ilan_tarihi_araligi"  id="ilan_tarihi_araligi"  readonly value="" class="form-control  filled-in"
                                                                       data-placement="bottom"/>
                                                                       @if($errors->first('ilan_tarihi_araligi') != null)
                                                                         <span class="help-block" style="color:red">{{ $errors->first('ilan_tarihi_araligi') }}</span>
                                                                       @endif
                                                               <!--input class="form-control date" id="yayinlanma_tarihi"  readonly   name="yayinlanma_tarihi" value="" placeholder="Yayinlanma Tarihi" type="text" /-->
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">İlanın ne kadar süre yayında kalmasını istiyorsanız o tarih aralığını seçiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İşin Süresi*</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="isin_suresi" id="isin_suresi">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option value="Tek Seferde">Tek Seferde</option>
                                                                    <option value="Zamana Yayılarak">Zamana Yayılarak</option>
                                                                </select>
                                                                @if($errors->first('isin_suresi') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('isin_suresi') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Satın almak istediğiniz mal veya hizmet tek seferde gerçekleşecek ise Tek Seferde seçeneğini yoksa belirli bir zamanı kapsayacak şekilde tekrarlayarak belirli bir dönemde gerçekleşecek ise Zamana Yayılarak seçeneğini işaretleyiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İş Tarih Aralığı*</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" name="is_tarihi_araligi"  id="is_tarihi_araligi"  readonly value="" class="form-control filled-in"
                                                                       data-placement="bottom"/>
                                                                       @if($errors->first('is_tarihi_araligi') != null)
                                                                         <span class="help-block" style="color:red">{{ $errors->first('is_tarihi_araligi') }}</span>
                                                                       @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Satın almak istediğiniz mal veya hizmete ilişkin iş hangi tarihler arasında gerçekleşecekse o tarih aralığını seçiniz</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                                <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teknik Şartname</label>
                                                                <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                                <div id="sartname" class="col-md-7" style="background-color: #fcf8e3; margin-top: 2px;margin-bottom:2px;padding: 2px">
                                                                        {!! Form::file('teknik',array(
                                                                           'accept'=>'application/msword, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                                                           'id'=>'sartnameGozat'))!!}
                                                                        <a style="display: none;" id="sartnameVazgec" href="#"><span style="float: right; color: red">Vazgec</span></a>
                                                                        @if($errors->first('sartnameVazgec') != null)
                                                                          <span class="help-block" style="color:red">{{ $errors->first('sartnameVazgec') }}</span>
                                                                        @endif
                                                                </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Satın alım ilanınıza ilişkin bir teknik şartname dokümanınız var ise lütfen bu dokümanı yükleyiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Katılımcılar*^</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="katilimcilar" id="katilimcilar" data-validation="required"
                                                              data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option value="1">Onaylı Tedarikçiler</option>
                                                                    <option value="2">Belirli Firmalar</option>
                                                                    <option value="3">Tüm Firmalar</option>
                                                                </select>
                                                                @if($errors->first('katilimcilar') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('katilimcilar') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Satın alım ilanınıza katılmasını istediğiniz firmaları veya grupları seçiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group"  id="onayli_tedarikciler">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                   <div class="col-md-2"></div>
                                                                   <div style="padding-right:3px;padding-left:1px"  class="col-md-9">
                                                                        <select id='custom-headers' multiple='multiple' name="onayli_tedarikciler[]" id="onayli_tedarikciler[]" data-rule-multiselectOnay="true">
                                                                        </select>
                                                                        @if($errors->first('onayli_tedarikciler') != null)
                                                                          <span class="help-block" style="color:red">{{ $errors->first('onayli_tedarikciler') }}</span>
                                                                        @endif
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group"  id="belirli-istekliler">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                   <div class="col-md-2"></div>
                                                                   <div style="padding-right:3px;padding-left:1px"  class="col-md-9">
                                                                        <select id='belirliIstek' multiple='multiple' name="belirli_istekli[]" id="belirli_istekli[]" data-rule-multiselectOnay="true">
                                                                        </select>
                                                                        @if($errors->first('belirli_istekli') != null)
                                                                          <span class="help-block" style="color:red">{{ $errors->first('belirli_istekli') }}</span>
                                                                        @endif
                                                                   </div>
                                                                </div>
                                                           </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Rekabet Şekli*</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="rekabet_sekli" id="rekabet_sekli">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option value="1">Tamrekabet</option>
                                                                    <option value="2">Sadece Başvuru</option>
                                                                </select>
                                                                @if($errors->first('rekabet_sekli') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('rekabet_sekli') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Satın alım ilanınıza fiyat verecek firmaların aktif şekilde rekabet etmelerini ve birbirlerinin firmalarını görmeden sadece fiyatlarını görerek fiyat eksiltmelerini istiyorsanız Tamrekabet seçeneğini, katılacak firmalardan rekabet etmeksizin sistem üzerinden kapalı zaf usulü fiyat teklifi toplamak istiyorsanız Sadece Başvuru seçeneğini işaretleyiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Sözleşme Türü</label>
                                                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="sozlesme_turu" id="sozlesme_turu">
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option value="0">Birim Fiyatlı</option>
                                                                    <option value="1">Götürü Bedel</option>
                                                                </select>
                                                                @if($errors->first('sozlesme_turu') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('sozlesme_turu') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Satın alımı gerçekleştireceğiniz firmadan istediğiniz teklifte kalemleri fiyatlandırmadan işin tamamına dair bir teklif istiyorsanız Götürü Bedel seçeneğini, satın almak istediğiniz işe dair kalemlerin ayrı ayrı fiyatlandırılmasını istiyorsanız Birim Fiyatlı şeneğini işaretleyiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group fiyatlandirma row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3"   style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Fiyatlandırma Şekli*</label>
                                                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control  required" name="kismi_fiyat" id="kismi_fiyat" >
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option   value="1">Kısmi Fiyat Teklifine Açık</option>
                                                                    <option  value="0">Kısmi Fiyat Teklifine Kapalı</option>
                                                                </select>
                                                                @if($errors->first('kismi_fiyat') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('kismi_fiyat') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Satın alım ilanına ilişkin mal veya hizmetlerinize teklif verecek firmaların alımını gerçekleştireceğiniz kalemlerin tümüne fiyat vermesini istiyorsanız Birim Fiyat Teklifine Kapalı seçeneğini, eğer kalemlerin belli bir kısmına da firmaların teklif verebilmesini istiyorsanız Birim Fiyat Teklifine Açık seçeneğini işaretleyiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Yaklaşık Maliyet</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="yaklasik_maliyet" id="yaklasik_maliyet" >
                                                                    <option selected disabled>Seçiniz</option>
                                                                    @foreach($maliyetler as $maliyet)
                                                                        <option value="{{$maliyet->miktar}}" >{{$maliyet->aralik}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->first('yaklasik_maliyet') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('yaklasik_maliyet') }}</span>
                                                                @endif
                                                                <input type="hidden" id="maliyet" name="maliyet" value=""></input>
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Alım ilanınıza ilişkin, satın alacağınız mal veya hizmetlerin yaklaşık toplam maliyet aralığını işaretleyiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" class="col-sm-3 control-label">Ödeme Türü*</label>
                                                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="odeme_turu" id="odeme_turu" >
                                                                    <option selected disabled>Seçiniz</option>
                                                                    @foreach($odeme_turleri as $odeme_turu)
                                                                    <option value="{{$odeme_turu->id}}" >{{$odeme_turu->adi}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->first('odeme_turu') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('odeme_turu') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" class="col-sm-3 control-label">Para Birimi*</label>
                                                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="para_birimi" id="para_birimi" >
                                                                    <option selected disabled>Seçiniz</option>
                                                                    @foreach($para_birimleri as $para_birimi)
                                                                    <option  value="{{$para_birimi->id}}" >{{$para_birimi->adi}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->first('para_birimi') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('para_birimi') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip"></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-12">

                                                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Yeri*</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="teslim_yeri" id="teslim_yeri" >
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                    <option   value="Satıcı Firma">Satıcı Firma</option>
                                                                    <option  value="Adrese Teslim">Adrese Teslim</option>
                                                                </select>
                                                                @if($errors->first('teslim_yeri') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('teslim_yeri') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip">
                                                                    <img src="{{asset("images/soru-isareti.ico")}}" />
                                                                    <span class="tooltiptext">Alacağınız ürün ve hizmetler iş yapacağınız yere gelsin istiyorsanız Adrese Teslim seçeneğini, tedarikçinizin bulunduğu yerden almak istiyorsanız Satıcı Firma seçeneğini işaretleyiniz.</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group error teslim_il row">
                                                            <div class="col-md-12">

                                                            <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Ad. İli*</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="il_id" id="il_id" >
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
                                                                @if($errors->first('il_id') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('il_id') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group error teslim_ilce row">
                                                            <div class="col-md-12">

                                                            <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Ad. İlçesi*</label>
                                                             <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control required" name="ilce_id" id="ilce_id" >
                                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                </select>
                                                                @if($errors->first('ilce_id') != null)
                                                                  <span class="help-block" style="color:red">{{ $errors->first('ilce_id') }}</span>
                                                                @endif
                                                            </div>
                                                                <div class="col-md-1 aciklama-tooltip"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                        <div class="row">
                                          <div class="col-sm-12" >
                                            <div class="form-group">
                                                <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-1 control-label">Açıklama</label>
                                                <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px" class=" col-sm-1 control-label">:</label>
                                                <div class="col-sm-10" >

                                                    <textarea id="aciklama" name="aciklama" rows="5"  class="form-control ckeditor" placeholder="Lütfen Açıklamayı buraya yazınız.." ></textarea>
                                                    @if($errors->first('aciklama') != null)
                                                      <span class="help-block" style="color:red">{{ $errors->first('aciklama') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <input  style="float:right"  type="button" name="next" class="next action-button" value="İleri" />

                                </fieldset>
                                <fieldset id="kalem">
                                            <h2   style=" text-align:center;margin-top:0px;margin-bottom:10px" class="fs-title"><strong>KALEM BİLGİLERİ OLUŞTUR</strong></h2>

                                            <div id="mal">
                                             <table  id="mal_table" class="table" >
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
                                                 </thead>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>
                                                      <input type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px" class="form-control  mal_show required" id="mal_kalem0" name="mal_kalem[0]" placeholder="Kalem Ekle" readonly  value="">
                                                      <p class="help-block" style="color:red">{{ $errors->first('mal_kalem') }}</p>
                                                    </td>

                                                    <td><input type="text" class="form-control required" id="mal_marka" name="mal_marka[0]" placeholder="Marka" value="" ></td>
                                                    <td>
                                                       <input type="text" class="form-control required" id="mal_model" name="mal_model[0]" placeholder="Model" value="" >
                                                    </td>
                                                    <td>
                                                        <textarea id="mal_aciklama" name="mal_aciklama[0]" rows="2" class="form-control required" placeholder="Açıklama" ></textarea>
                                                    </td>
                                                    <td><input type="text" class="form-control required" id="mal_ambalaj" name="mal_ambalaj[0]" placeholder="Ambalaj" value="" ></td>

                                                    <td>
                                                        <input type="number" min="0" class="form-control  required" id="mal_miktar" name="mal_miktar[0]" placeholder="Miktar" value=""  >

                                                    </td>
                                                    <td>
                                                        <select class="form-control  selectpicker  required" name="mal_birim[0]" id="mal_birim" data-live-search="true"  >
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($birimler as $birimleri)
                                                            <option  value="{{$birimleri->id}}" >{{$birimleri->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a href="#"  class="sil"> <img src="{{asset("images/sil1.png")}}"></a> <input type="hidden" name="mal_id[0]"  id="mal_id0" value=""><!--agaçtan seçilen kalemin id -->
                                                    </td>
                                               </tr>

                                        </table>
                                             </div>
                                            <div id="hizmet">
                                             <table id="hizmet_table" class="table" >
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
                                                    <td>{{$i}}</td>
                                                    <td><input type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px" class="form-control hizmet_show required" id="hizmet_kalem0" name="hizmet_kalem[0]" placeholder="Kalem Ekle" readonly  value="" > </td>
                                                      <td>
                                                         <textarea id="hizmet_aciklama" name="hizmet_aciklama[0]" rows="2" class="form-control required" placeholder="Açıklama"  ></textarea>
                                                     </td>
                                                     <td>
                                                         <input type="text" class="form-control required" id="hizmet_fiyat_standardi" name="hizmet_fiyat_standardi[0]" placeholder="Fiyat Standartı" value="" >
                                                     </td>
                                                     <td>
                                                        <select class="form-control selectpicker required"  data-live-search="true"  name="hizmet_fiyat_standardi_birimi[0]" id="hizmet_fiyat_standardi_birimi" >
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($birimler as $fiyat_birimi)
                                                            <option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                     </td>
                                                     <td>
                                                        <input type="number" min="0" class="form-control required" id="hizmet_miktar0" name="hizmet_miktar[0]" placeholder="Miktar" value="" >
                                                     </td>
                                                     <td>
                                                        <select class="form-control selectpicker required"  data-live-search="true"  name="hizmet_miktar_birim_id[0]" id="hizmet_miktar_birim_id" >
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($birimler as $miktar_birim)
                                                            <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                     </td>
                                                     <td><a href="#"  class="sil"><img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="hizmet_id[0]"  id="hizmet_id0" value=""></td>
                                                </tr>
                                              </table>
                                            </div>

                                            <div id="goturu" >
                                                <table id="goturu_table" class="table" >
                                                <tr style="text-align:center">
                                                    <th>Sıra</th>
                                                    <th>Kalem Ekle</th>
                                                    <th>Açıklama</th>
                                                    <th>Miktar</th>
                                                    <th>Birim</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td><input type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px" class="form-control goturu_show required" id="goturu_kalem0" name="goturu_kalem[0]" placeholder="Kalem Ekle" readonly  value=""  > </td>
                                                      <td>
                                                         <textarea id="goturu_aciklama" name="goturu_aciklama[0]" rows="2" class="form-control required" placeholder="Açıklama" ></textarea>
                                                     </td>

                                                     <td>
                                                        <input type="number" class="form-control required" id="goturu_miktar" name="goturu_miktar[0]" placeholder="Miktar" value="" >
                                                     </td>
                                                     <td>
                                                        <select class="form-control selectpicker required"  data-live-search="true" name="goturu_miktar_birim_id[0]" id="goturu_miktar_birim_id" >
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($birimler as $miktar_birim)
                                                            <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                     </td>
                                                     <td><a href="#"  class="sil"> <img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="goturu_id[0]"  id="goturu_id0" value=""></td>

                                                </tr>
                                              </table>
                                            </div>

                                            <div id="yapim" >
                                              <table id="yapim_table" class="table" >
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
                                                    <td>{{$i}}</td>
                                                    <td><input type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px" class="form-control yapim_show required" id="yapim_kalem0" name="yapim_kalem[0]" placeholder="Kalem Ekle" readonly  value="" > </td>
                                                      <td>
                                                         <textarea id="yapim_aciklama" name="yapim_aciklama[0]" rows="2" class="form-control required" placeholder="Açıklama" ></textarea>
                                                     </td>
                                                     <td>
                                                         <input type="text" class="form-control required" id="yapim_fiyat_standardi" name="yapim_fiyat_standardi[0]" placeholder="Fiyat Standartı" value="" >
                                                     </td>
                                                     <td>
                                                        <select class="form-control selectpicker required" data-live-search="true"  name="yapim_fiyat_standardi_birimi[0]" id="yapim_fiyat_standardi_birimi" >
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($birimler as $fiyat_birimi)
                                                            <option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                     </td>
                                                     <td>
                                                        <input type="number" min="0" class="form-control required" id="yapim_miktar" name="yapim_miktar[0]" placeholder="Miktar" value="">
                                                     </td>
                                                     <td>
                                                        <select class="form-control selectpicker required"  data-live-search="true" name="yapim_miktar_birim_id[0]" id="yapim_miktar_birim_id" >
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach($birimler as $miktar_birim)
                                                            <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>
                                                            @endforeach
                                                        </select>
                                                     </td>
                                                     <td><a href="#" class="sil"> <img src="{{asset("images/sil1.png")}}"></a> <input type="hidden" name="yapim_id[0]"  id="yapim_id0" value=""></td>

                                                </tr>
                                              </table>
                                            </div>
                                        <input style="float:right" type="button" name="next" class="next action-button next2" value="İleri" />
                                        <input style="float:right" type="button" name="previous" class="previous action-button" value="Geri" />
                                        <input style="float:right" type="button" class="action-button" id="btn2" value="Kalem Ekle" />

                                </fieldset>
                                <fieldset id="onay">
                                        <h2   style=" text-align:center;margin-top:0px;margin-bottom:10px" class="fs-title"><strong>ONAYLA VE GÖNDER</strong></h2>
                                        <h2   style=" text-align:center;margin-top:0px;margin-bottom:10px" class="fs-title"><strong>Sözleşme-1</strong></h2>
                                        <div class="info-box eula-container ">
                                            <h3>İlan Bilgileri</h3>
                                        </div>
                                        <input type="checkbox"  id='sozlesme_onay' name="sozlesme_onay" value="1"><strong>Sözleşmeyi Okudum Onaylıyorum</strong>
                                        {!! Form::button('Onayla ve Gönder', array('id'=>'onayButton','style'=>'width:140px;float:right;font-size: 14px','class'=>'action-button, next')) !!}
                                        <input  style="float:right"  type="button" name="previous" class="previous action-button" value="Geri" />

                                </fieldset>
                        {!! Form::close() !!}
                        </div>

                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
           </div>
         <!--kalemler tree modalı -->
           @include('Firma.ilan.kalemAgaci')
            <!--div id="mesaj" class="popup">
                <span class="button b-close"><span>X</span></span>

                <h3>Lütfen Sözleşmeyi Okuyunuz ve Onaylayınız!</h3>
            </div-->
    </div>
    <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
    <script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script charset="utf-8">

    //FORM SUBMIT
    //Ilan guncelle buton
    $("#onayButton").unbind().click(function(e){
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
        var postData = new FormData($("#msform")[0]);
        var formURL = $("#msform").attr('action');
        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                contentType: false,
                processData: false,
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    var form = $('#msform');
                    // let the browser natively reset defaults
                    form[0].reset();
                    setTimeout(function(){
                        window.location = "{{asset('ilanlarim')}}/{{$firma->id}}";
                    }, 5);

                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                    $('.ajax-loader').css("visibility", "hidden");
                }
            });
        e.preventDefault(); //STOP default action
    });

    $('#btn-add-ilanBilgileri').click(function () {
        $('#btn-save-ilanBilgileri').val("add");
        $('#myModal-ilanBilgileri').modal('show');
    });

    $("#sartnameGozat").change(function (){
        $("#sartnameVazgec").show();
       });

    $("#sartnameVazgec").click(function(){
        $(this).hide();
        $("#sartnameGozat").val('');
    });
var findName;

$(".next2").click(function(){

    $(".info-box").append('<li style="list-style-type:circle">Firma Adi Göster: '+$("input[type='radio']:checked").next('label:first').html+'</li>');
    $(".info-box").append('<li style="list-style-type:circle">İlan Adı: '+$("#ilan_adi").val()+'</li>');
    $(".info-box").append('<li style="list-style-type:circle">İlan Türü: '+$( "#ilan_turu option:selected" ).text()+'</li>');
    $(".info-box").append('<li style="list-style-type:circle">İlan Sektörü: '+$( "#firma_sektor option:selected" ).text()+'</li>');
    $(".info-box").append('<li style="list-style-type:circle">İlan Yayın-Kapanma Tarihi: '+$( "#ilan_tarihi_araligi option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">İş Süresi: '+$( "#isin_suresi option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">İş Başlama-Bitiş Tarihi: '+$( "#is_tarihi_araligi option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">Teknik Şartname: '+$( "#teknik" ).val()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">Katılımcılar: '+$( "#katilimcilar option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">Rekabet Şekli: '+$( "#rekabet_sekli option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">Sözleşme Türü: '+$( "#sozlesme_turu option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">Fiyatlandırma Şekli: '+$( "#kismi_fiyat option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">Yaklaşık Maliyet: '+$( "#yaklasik_maliyet option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">Ödeme Türü: '+ $("#odeme_turu option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">Para Birimi: '+ $("#para_birimi option:selected" ).text()+'</li>');
     $(".info-box").append('<li style="list-style-type:circle">Teslim Yeri: '+ $( "#teslim_yeri option:selected" ).text()+'</li>');
});

var firmaCount = 0;
var sektor = 0;
var multiselectCount=0;
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";

$( ".box" ).click(function() {
   $('#cke_1_contents').each(function(){
       $('#cke_1_contents').css('height', '100px');
   });
});

$(document).ready(function(){
   $('#onayli_tedarikciler').hide();
   $('#belirli-istekliler').hide();
     $('#il_id').on('change', function (e) {
         var il_id = e.target.value;
         GetIlce(il_id);
         //popDropDown('ilce_id', 'ajax-subcat?il_id=', il_id);
         //$("#semt_id")[0].selectedIndex=0;
     });
    jQuery.validator.methods["date"] = function (value, element) { return true; };
    jQuery.validator.addMethod("multiselectOnay", function(value, element) {
        return $($('#'+$(element).attr('id')+' :selected')).length>0;
    }, 'En az bir tane firma seçmelisiniz!!');
    $('#myModal-ilanBilgileri').modal('show');
 });
var ilan_turu;
var sozlesme_turu;

$('#ilan_turu').on('change', function (e) {
        ilan_turu = e.target.value;
        getSektor(ilan_turu);
});

$('#sozlesme_turu').on('change', function (e) {
             sozlesme_turu = e.target.value;
               if(sozlesme_turu=="1")
                {
                   $('.fiyatlandirma').hide();

                }else if(sozlesme_turu=="0")
                 {
                    $('.fiyatlandirma').show();
                 }
 });
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
$(".next").click(function(){
    if(sozlesme_turu=="1")
    {
        $('#goturu').show();
        $('#hizmet').hide();
        $('#mal').hide();
        $('#yapim').hide();
    }
    else if(ilan_turu=="1")
    {
        $('#mal').show();
        $('#hizmet').hide();
        $('#goturu').hide();
        $('#yapim').hide();
    }
    else if(ilan_turu=="2")
    {
       $('#hizmet').show();
       $('#mal').hide();
       $('#goturu').hide();
       $('#yapim').hide();
    }
    else if(ilan_turu=="3")
    {
       $('#yapim').show();
       $('#hizmet').hide();
       $('#goturu').hide();
       $('#mal').hide();
    }
                 
    var form = $("#msform");
        form.validate({
                errorElement: 'span',
                errorClass: 'help-block',
                highlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').addClass("has-error");
                },
                unhighlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').removeClass("has-error");
                },
                rules: {
                        sozlesme_onay: {
                                required: true
                        },
                },

        });
        if (form.valid() === true){
                if ($('#ilan').is(":visible")){
                        current_fs = $('#ilan');
                        next_fs = $('#kalem');
                }else if($('#kalem').is(":visible")){
                        current_fs = $('#kalem');
                        next_fs = $('#onay');
                }
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                 next_fs.show();
                 current_fs.hide();
        }
});
$('.previous').click(function(){
        if($('#kalem').is(":visible")){
                current_fs = $('#kalem');
                next_fs = $('#ilan');
        }else if ($('#onay').is(":visible")){
                current_fs = $('#onay');
                next_fs = $('#kalem');
        }
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        next_fs.show();
        current_fs.hide();
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

$("#yaklasik_maliyet").change(function(){
    var option = $('option:selected', this).attr('name');
    $('#maliyet').val(option);
});

$('#custom-headers').multiSelect({
  selectableHeader: "<p style='font-size:12px;color:red'>Tüm Firmalar</p><input style='width:100px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
  selectionHeader: "<p style='font-size:12px;color:red'>Seçili Firmalar</p><input  style='width:100px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
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

$('#belirliIstek').multiSelect({
  selectableHeader: "<p style='font-size:12px;color:red'>Tüm Firmalar</p><input style='width:100px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
  selectionHeader: "<p style='font-size:12px;color:red'>Seçili Firmalar</p><input  style='width:100px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
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
var multiselectCount=0;
var option;

$("#firma_sektor").change(function(){
  sektor = $('option:selected', this).attr('value');
     $('select#katilimcilar option').removeAttr("selected");
     $("#katilimcilar option[value='Seçiniz']").prop('selected', true).trigger("change");;

});

function getBelirliIstekliler(){
    $.ajax({
        type:"GET",
        url: "{{asset('belirli')}}",
        data:{
            sektorOnayli:sektor
        },
        cache: false,
        success: function(data){
            $("#custom-headers option").remove();
            $('#custom-headers').multiSelect('refresh');
            $("#belirliIstek option").remove();
            $('#belirliIstek').multiSelect('refresh');

            for(var key=0; key <Object.keys(data).length;key++) {
                $('#belirliIstek').multiSelect('addOption', { value: data[key].id, text: data[key].adi, index:key});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus+" Error: " + errorThrown);
        }
    });
}

function getOnayliTedarikciler(){
    $.ajax({
        type:"GET",
        url: "{{asset('onayli')}}",
        data:{
            sektorOnayli:sektor
        },
        cache: false,
        success: function(data){
            $("#belirliIstek option").remove();
            $('#belirliIstek').multiSelect('refresh');
            $("#custom-headers option").remove();
            $('#custom-headers').multiSelect('refresh');

            for(var key=0; key <Object.keys(data.tumFirmalar).length;key++) {
                $('#custom-headers').multiSelect('addOption', { value: data.tumFirmalar[key].id, text: data.tumFirmalar[key].adi, index:key});
            }
            for(var key=0; key <Object.keys(data.onayliTedarikciler).length;key++){
                $('#custom-headers').multiSelect('select', (data.onayliTedarikciler[key].id));
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
    });
}

$("#katilimcilar").change(function(){
   option = $('option:selected', this).attr('value');
    if(sektor!==0){
        if(option==="1"){
            $('#custom-headers').multiSelect('deselect_all');
            getOnayliTedarikciler();
            $('#onayli_tedarikciler').show();
            $('#belirli-istekliler').hide();
        }
        else if (option==="2"){
            $('#belirliIstek').multiSelect('deselect_all');
            getBelirliIstekliler();
            $('#belirli-istekliler').show();
            $('#onayli_tedarikciler').hide();
        }
        else {
             $('#onayli_tedarikciler').hide();
             $('#belirli-istekliler').hide();
        }
    }
    else {
         $('#mesaj').bPopup({
             speed: 650,
             transition: 'slideIn',
             transitionClose: 'slideBack',
             autoClose: 5000
         });
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
$('.selectpicker').selectpicker({
  noneResultsText: 'Sonuç Bulunamadı'
});
var kalem_num=0;
var i="{{$i}}";
$("#btn2").click(function(){ //birden fazla kalem ekleme modal form içerisinde.

    if(ilan_turu=="1" &&sozlesme_turu=="0")
    {
        i = ($(".mal_show").length) +1;
        kalem_num = i-1;

        $("#mal_table").append(['<tr>','<td>'+i+'</td>','<td> <input type="text"  style="background:url({{asset("images/ekle.png")}}) no-repeat scroll ;padding-left:25px"class="form-control mal_show  required" id="mal_kalem'+kalem_num+'" name="mal_kalem['+kalem_num+']" placeholder="Kalem Ekle" readonly value="" > </td>',
                      '<td><input type="text" class="form-control required " id="mal_marka" name="mal_marka['+kalem_num+']" placeholder="Marka" value="" ></td>',
                      ' <td><input type="text" class="form-control required " id="mal_model" name="mal_model['+kalem_num+']" placeholder="Model" value="" ></td>',
                      '<td><textarea id="mal_aciklama" name="mal_aciklama['+kalem_num+']" rows="2" class="form-control required" placeholder="Açıklama" ></textarea></td>',
                      ' <td> <input type="text" class="form-control required" id="mal_ambalaj" name="mal_ambalaj['+kalem_num+']" placeholder="ambalaj" value="" ></td>',
                      '<td><input type="number" class="form-control required " id="mal_miktar'+kalem_num+'" name="mal_miktar['+kalem_num+']" placeholder="Miktar" value="" ></td>',
                      '<td><select class="form-control required " name="mal_birim['+kalem_num+']" id="mal_birim"><option selected disabled>Seçiniz</option>@foreach($birimler as $birimleri) <option  value="{{$birimleri->id}}" >{{$birimleri->adi}}</option> @endforeach </select></td>',
                      '<td><a href="#" class="sil" ><img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="mal_id['+kalem_num+']"  id="mal_id'+kalem_num+'" value=""></td>','</tr>'].join(''));

    }
    else if(ilan_turu=="2" && sozlesme_turu=="0"){

        i = ($(".hizmet_show").length) +1;
        kalem_num = i-1;

    $("#hizmet_table").append(['<tr>','<td>'+i+'</td>',
            '<td><input type="text" style="background:url({{asset("images/ekle.png")}}) no-repeat scroll ;padding-left:25px" class="form-control hizmet_show required" id="hizmet_kalem'+kalem_num+'" name="hizmet_kalem['+kalem_num+']" placeholder="Kalem Ekle" readonly  value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"> </td>',
            '<td><textarea id="hizmet_aciklama" name="hizmet_aciklama['+kalem_num+']" rows="2" class="form-control required" placeholder="Açıklama" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea></td>',
            '<td><input type="text" class="form-control required" id="hizmet_fiyat_standardi" name="hizmet_fiyat_standardi['+kalem_num+']" placeholder="Fiyat Standartı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
            '<td><select class="form-control required" name="hizmet_fiyat_standardi_birimi['+kalem_num+']" id="hizmet_fiyat_standardi_birimi" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $fiyat_birimi)<option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>@endforeach</select></td>',
            '<td><input type="number" class="form-control  required" id="hizmet_miktar'+kalem_num+'" name="hizmet_miktar['+kalem_num+']" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
            '<td><select class="form-control required" name="hizmet_miktar_birim_id['+kalem_num+']" id="hizmet_miktar_birim_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $miktar_birim) <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>@endforeach</select></td>',
            '<td><a href="#"  class="sil"> <img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="hizmet_id['+kalem_num+']"  id="hizmet_id'+kalem_num+'" value=""></td>','</tr>'].join(''));
    }
    else if(sozlesme_turu=="1"){

          i = ($(".goturu_show").length) +1;
          kalem_num = i-1;

     $("#goturu_table").append(['<tr>','<td>'+i+'</td>',
            '<td><input type="text" style="background:url({{asset("images/ekle.png")}}) no-repeat scroll ;padding-left:25px" class="form-control goturu_show required" id="goturu_kalem'+kalem_num+'" name="goturu_kalem['+kalem_num+']" placeholder="Kalem Ekle" readonly  value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"> </td>',

            '<td><textarea id="goturu_aciklama" name="goturu_aciklama['+kalem_num+']" rows="2" class="form-control required " placeholder="Açıklama" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea></td>',
            '<td><input type="text" class="form-control required" id="goturu_miktar" name="goturu_miktar['+kalem_num+']" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
            
            '<td><select class="form-control required" name="goturu_miktar_birim_id['+kalem_num+']" id="goturu_miktar_birim_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $miktar_birim) <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>@endforeach</select></td>',
            '<td><a href="#"  class="sil"> <img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="goturu_id['+kalem_num+']"  id="goturu_id'+kalem_num+'" value=""></td>','</tr>'].join(''));

    }
    else if(ilan_turu=="3"){

          i = ($(".yapim_show").length) +1;
          kalem_num = i-1;

      $("#yapim_table").append(['<tr>','<td>'+i+'</td>',
            '<td><input type="text" style="background:url({{asset("images/ekle.png")}}) no-repeat scroll ;padding-left:25px" class="form-control yapim_show required" id="yapim_kalem'+kalem_num+'" name="yapim_kalem['+kalem_num+']" placeholder="Kalem Ekle" readonly  value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"> </td>',
            '<td><textarea id="yapim_aciklama" name="yapim_aciklama['+kalem_num+']" rows="2" class="form-control required" placeholder="Açıklama" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea></td>',
            '<td><input type="text" class="form-control required" id="yapim_fiyat_standardi" name="yapim_fiyat_standardi['+kalem_num+']" placeholder="Fiyat Standartı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
            '<td><select class="form-control required" name="yapim_fiyat_standardi_birimi['+kalem_num+']" id="yapim_fiyat_standardi_birimi" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $fiyat_birimi)<option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>@endforeach</select></td>',
            '<td><input type="number" class="form-control required" id="yapim_miktar'+kalem_num+'" name="yapim_miktar['+kalem_num+']" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
            '<td><select class="form-control required" name="yapim_miktar_birim_id['+kalem_num+']" id="yapim_miktar_birim_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $miktar_birim) <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>@endforeach</select></td>',
            '<td><a href="#" class="sil" > <img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="yapim_id['+kalem_num+']"  id="yapim_id'+kalem_num+'" value=""></td>','</tr>'].join(''));
    }

});
//kalemleri silme
$('#mal_table').on('click', '.sil', function(e) {

    e.preventDefault();
    i = $(".mal_show").length;
    if(i > 1)
      $(this).parents('tr').first().remove();
});
$('#hizmet_table').on('click', '.sil', function(e) {

    e.preventDefault();
    i = $(".hizmet_show").length;
    if(i > 1)
      $(this).parents('tr').first().remove();
});
$('#goturu_table').on('click', '.sil', function(e) {

    e.preventDefault();
    i = $(".goturu_show").length;
    if(i > 1)
      $(this).parents('tr').first().remove();
});
$('#yapim_table').on('click', '.sil', function(e) {

    e.preventDefault();
    i = $(".yapim_show").length;
    if(i > 1)
      $(this).parents('tr').first().remove();
});
//kalem tree modaliını açma.
$('#mal_table').on('click', '.mal_show', function(event) {
     kalemAgaci();
  var input_id=event.target.id;
  $(".m_kalemAgaci #input_mal_id").val(input_id);
  $('.m_kalemAgaci').modal('show');
});
$('#hizmet_table').on('click', '.hizmet_show', function(event) {
     kalemAgaci();
    var input_id=event.target.id;
    $(".m_kalemAgaci #input_hizmet_id").val(input_id);
    $('.m_kalemAgaci').modal('show');
});
$('#goturu_table').on('click', '.goturu_show', function(event) {
     kalemAgaci();
    var input_id=event.target.id;
    $(".m_kalemAgaci #input_goturu_id").val(input_id);
    $('.m_kalemAgaci').modal('show');
});
$('#yapim_table').on('click', '.yapim_show', function(event) {
     kalemAgaci();
    var input_id=event.target.id;
    $(".m_kalemAgaci #input_yapim_id").val(input_id);
    $('.m_kalemAgaci').modal('show');
});
 function getSektor(mal_turu) {
        if (mal_turu > 0) {
            $("#firma_sektor").get(0).options.length = 0;
            $("#firma_sektor").get(0).options[0] = new Option("Yükleniyor", "-1");

            $.ajax({
                type: "GET",
                url: "{{asset('getSektorler')}}",
                data:{mal_turu:mal_turu},
                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    console.log(msg);
                    $("#firma_sektor").get(0).options.length = 0;
                    $("#firma_sektor").get(0).options[0] = new Option("Seçiniz", "-1");

                    $.each(msg, function(index, sektor) {
                        $("#firma_sektor").get(0).options[$("#firma_sektor").get(0).options.length] = new Option(sektor.adi, sektor.id);
                    });

                        $('.selectpicker').selectpicker('refresh');

                },
                async: false,
                error: function() {
                    $("#firma_sektor").get(0).options.length = 0;
                    alert("Sektörler  yükelenemedi!!!");
                }
            });
        }
        else {
            $("#firma_sektor").get(0).options.length = 0;
        }
    }
</script>
<script type="text/javascript"> //kalemAgacı scriptleri
glyph_opts = {
  map: {
    checkbox: "glyphicon glyphicon-unchecked",
    checkboxSelected: "glyphicon glyphicon-check",
    checkboxUnknown: "glyphicon glyphicon-share",
    dragHelper: "glyphicon glyphicon-play",
    dropMarker: "glyphicon glyphicon-arrow-right",
    error: "glyphicon glyphicon-warning-sign",
    expanderClosed: "glyphicon glyphicon-plus",
    expanderLazy: "glyphicon glyphicon-plus",  // glyphicon-plus-sign
    expanderOpen: "glyphicon glyphicon-minus",  // glyphicon-collapse-down
    //folder: "glyphicon glyphicon-plus",
    //folderOpen: "glyphicon glyphicon-minus",
    loading: "glyphicon glyphicon-refresh glyphicon-spin"
  }
};
function kalemAgaci(){

    $("#tree").remove();
    $(".ftree").append('<div id="tree"></div>');
  // Initialize Fancytree
  $("#tree").fancytree({
    extensions: ["filter", "glyph"],
    quicksearch: true,
    checkbox: true,
    glyph: glyph_opts,
    selectMode: 1,
    source: {
      data:{id:0},
      url: "{{asset('findChildrenTree')}}"+"/"+sektor,
      dataType:'json', debugDelay: 1000
    },
    filter: {
      autoApply: true,   // Re-apply last filter if lazy data is loaded
      autoExpand: true, // Expand all branches that contain matches while filtered
      counter: false,     // Show a badge with number of matching child nodes near parent icons
      fuzzy: false,      // Match single characters in order, e.g. 'fb' will match 'FooBar'
      hideExpandedCounter: true,  // Hide counter badge if parent is expanded
      hideExpanders: false,       // Hide expanders if all child nodes are hidden by filter
      highlight: true,   // Highlight matches by wrapping inside <mark> tags
      leavesOnly: false, // Match end nodes only
      nodata: true,      // Display a 'no data' status node if result is empty
      mode: "hide"       // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
    },
    toggleEffect: { effect: "drop", options: {direction: "left"}, duration: 200 },

    activate: function(event, data) {
   // alert("activate " + data.node);
    },
    lazyLoad: function(event, data){
		var node = data.node;

		console.log(node.key);

        data.result = {
		  url: "{{asset('findChildrenTree')}}"+"/"+sektor,

        debugDelay: 1000,
                    data: {id: node.key},
                    dataType:'json',
          cache: false
        }

      }
  });
  $(".fancytree-container").toggleClass("fancytree-connectors");
  $("input[name=search]").keyup(function(e){
    var n,
      tree = $.ui.fancytree.getTree(),
      args = "autoApply autoExpand fuzzy hideExpanders highlight leavesOnly nodata".split(" "),
      opts = {},
      filterFunc = $("#branchMode").is(":checked") ? tree.filterBranches : tree.filterNodes,
      match = $(this).val();

    $.each(args, function(i, o) {
      opts[o] = $("#" + o).is(":checked");
    });
    opts.mode = $("#hideMode").is(":checked") ? "hide" : "dimm";

    if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
      $("button#btnResetSearch").click();
      return;
    }
    if($("#regex").is(":checked")) {
      // Pass function to perform match
      n = filterFunc.call(tree, function(node) {
        return new RegExp(match, "i").test(node.title);
      }, opts);
    } else {
      // Pass a string to perform case insensitive matching
      n = filterFunc.call(tree, match, opts);
    }
    $("button#btnResetSearch").attr("disabled", false);
    $("span#matches").text("(" + n + " matches)");
  }).focus();
  $("button#btnResetSearch").click(function(e){
    $("input[name=search]").val("");
    $("span#matches").text("");
    tree.clearFilter();
  }).attr("disabled", true);
  $("fieldset input:checkbox").change(function(e){
      var id = $(this).attr("id"),
        flag = $(this).is(":checked");

      // Some options can only be set with general filter options (not method args):
      switch( id ){
      case "counter":
      case "hideExpandedCounter":
        tree.options.filter[id] = flag;
        break;
      }
      tree.clearFilter();
      $("input[name=search]").keyup();
  });
}
$("#tamamBtn").click(function(){
    if(ilan_turu==1 &&sozlesme_turu==0)
    {
      var tree = $("#tree").fancytree("getTree");
      var kalem_id=tree.getSelectedNodes();
      var sel_key= $.map(kalem_id,function(node){
        var mal_kalem_id=$("#input_mal_id").val();
          $("#"+mal_kalem_id).val(node.title);
           var id = mal_kalem_id.substring(9,mal_kalem_id.lenght);
           $("#mal_id"+id).val(node.key);
         });
        $('.m_kalemAgaci').modal('hide');
        $("#tree").fancytree("getTree").visit(function(node){
           node.setSelected(false);
        });
    }
    else if(ilan_turu==2 && sozlesme_turu==0){

        var tree = $("#tree").fancytree("getTree");
        var kalem_id=tree.getSelectedNodes();
        var sel_key= $.map(kalem_id,function(node){
        var hizmet_kalem_id=$("#input_hizmet_id").val();
          $("#"+hizmet_kalem_id).val(node.title);
        var id = hizmet_kalem_id.substring(12,hizmet_kalem_id.lenght);
           $("#hizmet_id"+id).val(node.key);
         });
        $('.m_kalemAgaci').modal('hide');
        $("#tree").fancytree("getTree").visit(function(node){
          node.setSelected(false);
        });
    }
    else if(sozlesme_turu==1){

        var tree = $("#tree").fancytree("getTree");
        var kalem_id=tree.getSelectedNodes();
        var sel_key= $.map(kalem_id,function(node){
        var goturu_kalem_id=$("#input_goturu_id").val();
          $("#"+goturu_kalem_id).val(node.title);
        var id = goturu_kalem_id.substring(12,goturu_kalem_id.lenght);
           $("#goturu_id"+id).val(node.key);
         });
        $('.m_kalemAgaci').modal('hide');
        $("#tree").fancytree("getTree").visit(function(node){
          node.setSelected(false);
        });
    }
    else if(ilan_turu==3){
        var tree = $("#tree").fancytree("getTree");
        var kalem_id=tree.getSelectedNodes();
        var sel_key= $.map(kalem_id,function(node){
        var yapim_kalem_id=$("#input_yapim_id").val();
          $("#"+yapim_kalem_id).val(node.title);
        var id = yapim_kalem_id.substring(11,yapim_kalem_id.lenght);
           $("#yapim_id"+id).val(node.key);
         });
        $('.m_kalemAgaci').modal('hide');
        $("#tree").fancytree("getTree").visit(function(node){
          node.setSelected(false);
        });
    }

  });

var firma_id='{{$firma->id}}';

$(function() {
    var dt = new Date();
    dt.setDate(dt.getDate() + 3);
    var is_tarihi_start= new Date();
    $('input[name="ilan_tarihi_araligi"]').daterangepicker({
                locale: {
                  format: 'DD/MM/YYYY',
                    "applyLabel": "Uygula",
                    "cancelLabel": "Vazgeç",
                    "fromLabel": "Dan",
                    "toLabel": "a",
                    "customRangeLabel": "Seç",
                    "daysOfWeek": [
                        "Pt",
                        "Sl",
                        "Çr",
                        "Pr",
                        "Cm",
                        "Ct",
                        "Pz"
                    ],
                    "monthNames": [
                        "Ocak",
                        "Şubat",
                        "Mart",
                        "Nisan",
                        "Mayıs",
                        "Haziran",
                        "Temmuz",
                        "Ağustos",
                        "Eylül",
                        "Ekim",
                        "Kasım",
                        "Aralık"
                    ],
                    "firstDay": 1

                },
                    startDate: new Date(),
                    endDate: dt
      },function(start, end, label) {
            is_tarihi_start=end.format('DD/MM/YYYY');
            var is_tarihi_end=end.format('DD/MM/YYYY');

          $('input[name="is_tarihi_araligi"]').daterangepicker({
                    locale: {
                      format: 'DD/MM/YYYY',
                     "applyLabel": "Uygula",
                    "cancelLabel": "Vazgeç",
                    "fromLabel": "Dan",
                    "toLabel": "a",
                    "customRangeLabel": "Seç",
                    "daysOfWeek": [
                        "Pt",
                        "Sl",
                        "Çr",
                        "Pr",
                        "Cm",
                        "Ct",
                        "Pz"
                    ],
                    "monthNames": [
                        "Ocak",
                        "Şubat",
                        "Mart",
                        "Nisan",
                        "Mayıs",
                        "Haziran",
                        "Temmuz",
                        "Ağustos",
                        "Eylül",
                        "Ekim",
                        "Kasım",
                        "Aralık"
                    ],
                    "firstDay": 1
                },
                    startDate: is_tarihi_start,
                    endDate: is_tarihi_end

        });
    });

    $('input[name="is_tarihi_araligi"]').daterangepicker({
                locale: {
                  format: 'DD/MM/YYYY',
                   "applyLabel": "Uygula",
                    "cancelLabel": "Vazgeç",
                    "fromLabel": "Dan",
                    "toLabel": "a",
                    "customRangeLabel": "Seç",
                    "daysOfWeek": [
                        "Pt",
                        "Sl",
                        "Çr",
                        "Pr",
                        "Cm",
                        "Ct",
                        "Pz"
                    ],
                    "monthNames": [
                        "Ocak",
                        "Şubat",
                        "Mart",
                        "Nisan",
                        "Mayıs",
                        "Haziran",
                        "Temmuz",
                        "Ağustos",
                        "Eylül",
                        "Ekim",
                        "Kasım",
                        "Aralık"
                    ],
                    "firstDay": 1

                },
                startDate:new Date(),
                endDate: dt

     });

});
</script>

@endsection
