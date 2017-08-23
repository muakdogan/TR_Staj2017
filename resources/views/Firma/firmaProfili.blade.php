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
        <script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
        <script src="{{asset('js/ajax-crud-malibilgiler.js')}}"></script>
        <script src="{{asset('js/ajax-crud-ticaribilgiler.js')}}"></script>
        <script src="{{asset('js/ajax-crud-bilgilendirmetercihi.js')}}"></script>
        <script src="{{asset('js/ajax-crud-referanslar.js')}}"></script>
        <script src="{{asset('js/ajax-crud-referanslarGecmis.js')}}"></script>
        <script src="{{asset('js/ajax-crud-kalite.js')}}"></script>
        <script src="{{asset('js/ajax-crud-firmacalisanlari.js')}}"></script>
        <script src="{{asset('js/ajax-crud-firmabrosur.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/firmaProfil.css')}}"/>
        <link href="{{asset('css/multi-select.css')}}" media="screen" rel="stylesheet" type="text/css"></link>
        <link href="{{asset('css/multiple-select.css')}}" rel="stylesheet"/>
        <style>
            .search_icon {   
                background-color: white;
                background-image: url("{{asset('images/src.png')}}");
                background-repeat: no-repeat;
                padding: 0px 0px 0px 20px;

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
            .wrapper {
                padding: 25px;
              }

              .image-wrapper {
                padding: 5px;
             
               
              }

              .image-wrapper img {
                  max-width:200px;
                  height:200px;
               
              }
              .bilgiEkle{
                  text-align: center;
                  height:67px;
                  border-width:2px;
                  border-style:dotted;
                  border-color:#ddd
                  
              }
              /* Pie Chart */
                .progress-pie-chart {
                width:200px;
                height: 200px;
                border-radius: 50%;
                background-color: #E5E5E5;
                position: relative;
                }
                .progress-pie-chart.gt-50 {
                background-color: #81CE97;
                }

                .ppc-progress {
                content: "";
                position: absolute;
                border-radius: 50%;
                left: calc(50% - 100px);
                top: calc(50% - 100px);
                width: 200px;
                height: 200px;
                clip: rect(0, 200px, 200px, 100px);
                }
                .ppc-progress .ppc-progress-fill {
                content: "";
                position: absolute;
                border-radius: 50%;
                left: calc(50% - 100px);
                top: calc(50% - 100px);
                width: 200px;
                height: 200px;
                clip: rect(0, 100px, 200px, 0);
                background: #81CE97;
                transform: rotate(60deg);
                }
                .gt-50 .ppc-progress {
                clip: rect(0, 100px, 200px, 0);
                }
                .gt-50 .ppc-progress .ppc-progress-fill {
                clip: rect(0, 200px, 200px, 100px);
                background: #E5E5E5;
                }

                .ppc-percents {
                content: "";
                position: absolute;
                border-radius: 50%;
                left: calc(50% - 173.91304px/2);
                top: calc(50% - 173.91304px/2);
                width: 173.91304px;
                height: 173.91304px;
                background: #fff;
                text-align: center;
                display: table;
                }
                .ppc-percents span {
                display: block;
                font-size: 2.6em;
                font-weight: bold;
                color: #81CE97;
                }

                .pcc-percents-wrapper {
                display: table-cell;
                vertical-align: middle;
                }

                .progress-pie-chart {
                margin: 50px auto 0;
                }
                .switch {
                position: relative;
                display: inline-block;
                width: 40px;
                height: 18px;
                margin-top: 8px;
              }

              .switch input {display:none;}

              .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
              }

              .slider:before {
                position: absolute;
                content: "";
                height: 16px;
                width: 20px;
                left: 0px;
                bottom: 2px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
              }

              input:checked + .slider {
                background-color: #2196F3;
              }

              input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
              }

              input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
              }

              /* Rounded sliders */
              .slider.round {
                border-radius: 34px;
              }

              .slider.round:before {
                border-radius: 50%;
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
               form .error {
                  color: #000;
                 }
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
        </style>
   </head>
   <body>
         <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
         <script src="{{asset('js/jquery.multi-select.js')}}" type="text/javascript"></script>
         <script type="text/javascript" src="{{asset('js/jquery.quicksearch.js')}}"></script>
         <script src="{{asset('js/multiple-select.js')}}"></script>
         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
         
  
   <div class="container">
       <br>
       <br>
         @include('layouts.alt_menu') 
       <h2>{{$firma->adi}} Profili</h2>
   </div>
   <div class="container"> 
    <div class="row">
     <div class="col-sm-8" >

       <div  class="panel-group" id="accordion">
           <div  class="form-group">
               <div class="row">
                   <div class="col-sm-5" >
                       <img id="logo1" value="" src="{{asset('uploads')}}/{{$firma->logo}}" alt="HTML5 Icon" style="width:128px;height:128px;">
                        <br />
                       <button class="btn btn-primary btn-xs btn-detail " id="btn-add-image" onclick="" value="{{$firma->id}}">Düzenle</button>
                   </div>
                   <div class="col-sm-7">

                       <div class="panel panel-default">
                           <div  class="panel-heading">
                               <h4 class="panel-title">
                                   <a data-toggle="collapse" data-parent="#accordion" href="#collapse0"><img width="20" height="20" src="{{asset('images/islem.png')}}">&nbsp;<strong>Sektorler</strong></a>
                               </h4>
                           </div>
                           <div class="panel-body">
                               <ul>
                                   @foreach($firmaSektorleri as $firmaSektor)
                                   <li>{{$firmaSektor->adi}}</li>
                                   @endforeach
                               </ul>
                           </div>
                       </div>





                   </div>
               </div>
               <div class="modal fade" id="myModal-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                               <h4 class="modal-title" id="myModalLabel">Firma Logonu Güncelle</h4>
                           </div>
                           <div class="modal-body">
                               <div class="span7 offset1">
                                   {!! Form::open(array('url'=>'firmaProfili/uploadImage/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}
                                   <div class="control-group">
                                       <div class="controls">
                                           <div class="container-fuild">
                                               <div class="row">
                                                   <div class="col-sm-4" >
                                                       <div class="secure"><strong>Mevcut Logonuz</strong></div>
                                                       <br>
                                                       <div style="width:128px;height:128px;"class="image-wrapper">
                                                           <img src="{{asset('uploads')}}/{{$firma->logo}}" alt="HTML5 Icon" style="width:128px;height:128px;">
                                                       </div>
                                                   </div>
                                                   <div class="col-sm-8" >
                                                       <div class="secure"><strong>Logonuzu Değiştirin</strong></div>
                                                       <div class="wrapper">
                                                           {!! Form::file('logo', ['id' => 'addImage']) !!}
                                                       </div>
                                                   </div>
                                               </div>
                                               <br>
                                               <p class="errors">{!!$errors->first('image')!!}</p>
                                               @if(Session::has('error'))
                                                   <p class="errors">{!! Session::get('error') !!}</p>
                                               @endif
                                           </div>
                                       </div>
                                       <div id="success">
                                       </div>
                                       {!! Form::submit('Logo Yükle', array('url'=>'firmaProfili/uploadImage'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                       {{ Form::open(array('url'=>'firmaProfili/deleteImage/'.$firma->id,'method' => 'DELETE', 'files'=>true)) }}
                                       {{ Form::hidden('id', $firma->logo) }}
                                       {{ Form::submit('Logo Sil', ['style'=>'float:right' ,'class' => 'btn btn-danger']) }}
                                       {{ Form::close() }}
                                       <br>
                                       <br>
                                       <br>
                                   </div>
                               </div>
                               <div class="modal-footer">
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>


           <div class="panel panel-default">
               <div  class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><img src="{{asset('images/phone.png')}}">&nbsp;<strong>İletişim Bilgileri</strong></a>
                       <button style="float:right" id="btn-add" name="btn-add" onclick="populateDD()" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                   </h4>
               </div>
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr>
                                   <td><strong>Adres</strong></td>
                                   <td><strong>:</strong>  {{$firmaAdres->adres}}</td>

                               </tr>
                               <tr>
                                   <td  width="25%"><strong>İli</strong></td>
                                   <td id="il_id_td" width="75%"><strong>:</strong> {{$firmaAdres->iller->adi}}</td>

                               </tr>
                               <tr>
                                   <td><strong>İlçesi</strong></td>
                                   <td id="ilce_id_td"><strong>:</strong> {{$firmaAdres->ilceler->adi}}</td>

                               </tr>
                               <tr>
                                   <td><strong>Semt</strong></td>
                                   <td  id="semt_id_td"><strong>:</strong> {{$firmaAdres->semtler->adi}}</td>

                               </tr>
                               <tr>
                                   <td><strong>Telefon</strong></td>
                                   <td><strong>:</strong> {{$firma->iletisim_bilgileri->telefon}}</td>

                               </tr>
                               <tr>
                                   <td><strong>Fax</strong></td>
                                   <td><strong>:</strong> {{$firma->iletisim_bilgileri->fax}}</td>

                               </tr>
                               <tr>
                                   <td><strong>Web Sayfası</strong></td>
                                   <td><strong>:</strong> {{$firma->iletisim_bilgileri->web_sayfasi}}</td>

                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>İletişim Bilgileri</strong></h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('id'=>'iletisim_kayit','url'=>'firmaProfili/iletisimAdd/'.$firma->id, 'class' => 'form-horizontal', 'method' => 'POST')) !!}

                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-1 control-label"></label>
                                           <label for="inputTask" class="col-sm-3 control-label">Şehir</label>
                                           <label for="inputTask" style="text-align: left"class="col-sm-1 control-label">:</label>
                                           <div class="col-sm-7">
                                               <select class="form-control il_id" name="il_id" id="il_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($iller as $il)
                                                   <option  value="{{$il->id}}" >{{$il->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-1 control-label"></label>
                                           <label for="inputTask" class="col-sm-3 control-label">İlçe</label>
                                           <label for="inputTask" style="text-align: left" class="col-sm-1 control-label">:</label>
                                           <div class="col-sm-7">
                                               <select class="form-control" name="ilce_id" id="ilce_id" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                   <option selected disabled>Seçiniz</option>
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-1 control-label"></label>
                                           <label for="inputTask" class="col-sm-3 control-label">Semt</label>
                                           <label for="inputTask" style="text-align: left" class="col-sm-1 control-label">:</label>
                                           <div class="col-sm-7">
                                               <select class="form-control" name="semt_id" id="semt_id" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                   <option selected disabled>Seçiniz</option>
                                               </select>
                                           </div>
                                       </div>                                                     
                                       <div class="form-group">
                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                           <label for="inputEmail3" class="col-sm-3 control-label">Adres</label>
                                            <label for="inputTask"style="text-align: left" class="col-sm-1 control-label">:</label>
                                           <div class="col-sm-7">
                                               <input type="text" class="form-control" id="adres" name="adres" placeholder="Adres" value="{{$firmaAdres->adres}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                           </div>
                                       </div>
                                       <div class="form-group">
                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                           <label for="inputEmail3" class="col-sm-3 control-label">Telefon</label>
                                            <label for="inputTask" style="text-align: left" class="col-sm-1 control-label">:</label>
                                           <div class="col-sm-7">
                                               <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Telefon" value="{{$firma->iletisim_bilgileri->telefon}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                           </div>
                                       </div>
                                       <div class="form-group">
                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                           <label for="inputEmail3" class="col-sm-3 control-label">Fax</label>
                                            <label for="inputTask" style="text-align: left" class="col-sm-1 control-label">:</label>
                                           <div class="col-sm-7">
                                               <input type="text" class="form-control" id="fax" name="fax" placeholder="Fax" value="{{$firma->iletisim_bilgileri->fax}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                           </div>
                                       </div>
                                       <div class="form-group">
                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                           <label for="inputEmail3" class="col-sm-3 control-label">Web Sayfası</label>
                                            <label for="inputTask" style="text-align: left" class="col-sm-1 control-label">:</label>
                                           <div class="col-sm-7">
                                               <input type="text" class="form-control" id="web_sayfasi" name="web_sayfasi" placeholder="Web Sayfası" value="{{$firma->iletisim_bilgileri->web_sayfasi}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                           </div>
                                       </div>
                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/iletisimAdd/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                       <br>
                                       <br>
                                       {!! Form::close() !!}
                                   </div>                                                        
                                   <div class="modal-footer">
                                       <input type="hidden" id="iletisimbilgisi_id" name="iletisimbilgisi_id" value="{{$firma->iletisim_bilgileri->id}}">
                                   </div>
                               </div>
                           </div>
                       </div>
                       
                   </div>
               
           </div>
           <div class="panel panel-default">
               <div style="border-bottom: 3px solid transparent;border-color:#ddd" class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><img src="{{asset('images/yazi.png')}}">&nbsp;<strong>Firma Tanıtım Yazısı</strong></a>
                        @if($firma->tanitim_yazisi=="")
                           
                        @else
                         <button style="float:right" id="btn-add-tanıtımyazısı" name="btn-add-tanıtımyazısı" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                        @endif
                   </h4>
               </div>
                   <div class="panel-body">
                       @if($firma->tanitim_yazisi=="")
                        <div class="bilgiEkle"> 
                            <button style="margin-top:20px" id="btn-add-tanıtımyazısı" name="btn-add-tanıtımyazısı" class="btn btn-primary btn-xs" ><img src="{{asset('images/plus.png')}}">&nbsp;Bilgilerinizi Ekleyin</button>
                        </div>
                       @else
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr id="firma{{$firma->id}}">
                               <tr>
                                   <td width="25%"><strong>Tanıtım Yazısı</strong></td>
                                   <td id="tanitim_id_td" width="75%"><strong>:</strong>
                                       <?php echo $firma->tanitim_yazisi;?>
                                   </td>
                               </tr>
                               </tr>
                           </thead>
                       </table>
                       @endif
                       <div class="modal fade" id="myModal-tanıtımyazısı" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Firma Tanıtım Yazısı</strong></h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('id'=>'tanitim_kayit','url'=>'firmaProfili/tanitim/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Tanıtım Yazısı</label>
                                             <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                           <div class="col-sm-8">  
                                               <textarea id="tanitim_yazisi" name="tanitim_yazisi" rows="5" class="form-control ckeditor"  placeholder="{{$firma->tanitim_yazisi}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">&lt;p&gt; &lt;/p&gt; <?php echo $firma->tanitim_yazisi;?></textarea>                                        
                                                <br>
                                                <br>
                                           </div>
                                       </div>
                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/tanitim/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                       <br>
                                       <br>
                                       {!! Form::close() !!}
                                   </div>
                                   <br> <br><br><br><br><br><br><br><br><br><br><br><br>
                                   <div class="modal-footer">                                                            
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
            </div>
           <div class="panel panel-default">
               <div style="border-bottom: 3px solid transparent;border-color:#ddd" class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><img src="{{asset('images/mali.png')}}">&nbsp;<strong>Mali Bilgiler</strong></a>
                       <?php
                            if (!$firma->mali_bilgiler) {
                                $mali_bilgi = "boş";
                                $checkboxCiro = 1;
                                $checkboxSermaye =1;
                                $firma->mali_bilgiler = new App\MaliBilgi();
                            }
                            else{
                                $mali_bilgi="dolu";
                                $checkboxCiro=$firma->mali_bilgiler->ciro_goster;
                                $checkboxSermaye=$firma->mali_bilgiler->sermaye_goster;
                            }
                       ?>
                       @if($firma->mali_bilgiler->firma_id==0)
                       @else
                            <button style="float:right" id="btn-add-malibilgiler" name="btn-add-malibilgiler" onclick="populateMaliDD()" class="btn btn-primary btn-xs">Ekle / Düzenle</button>
                       @endif
                   </h4>
               </div>

               <div class="panel-body">
                   @if($firma->mali_bilgiler->firma_id==0)
                   <div class="bilgiEkle"> 
                       <button style="margin-top:20px" id="btn-add-malibilgiler" name="btn-add-malibilgiler" class="btn btn-primary btn-xs"><img src="{{asset('images/plus.png')}}">&nbsp;Bilgilerinizi Ekleyin</button>
                   </div>
                   @else
                   <table class="table" >
                       <thead id="tasks-list" name="tasks-list">
                           <tr>
                               <td width="25%"><strong>Firma Ünvanı</strong></td>
                               <td width="75%"><strong>:</strong>{{$firma->mali_bilgiler->unvani}}</td>
                           </tr>
                           <tr>
                               <td><strong>Şirket Türü</strong></td>
                               @foreach($sirketTurleri as $sirket)
                                @if($sirket->id == $firma->sirket_turu) 
                                    <td id="sirket_id_td"><strong>:</strong>  {{$sirket->adi}}</td>
                                @endif
                               @endforeach
                           </tr>
                           <tr>
                               <td><strong>Fatura Adresi</strong></td>
                               <td><strong>:</strong>{{$firmaFatura->adres}}</td>
                           </tr>
                           <tr>
                               <td><strong>İli</strong></td>
                               <td id="mali_il_td"><strong>:</strong>  {{$firmaFatura->iller->adi}}</td>
                           </tr>
                           <tr>
                               <td><strong>İlçesi</strong></td>
                               <td id="mali_ilce_td"><strong>:</strong>  {{$firmaFatura->ilceler->adi}}</td>
                           </tr>
                           <tr>
                               <td><strong>Vergi Dairesi</strong></td>                                                        
                               <td id="vergi_id_td"><strong>:</strong>  {{$firma->mali_bilgiler->vergi_daireleri->adi}}</td>
                           </tr>
                           <tr>
                               <td  ><strong>Vergi Numarası</strong></td>
                               <td><strong>:</strong>  {{$firma->mali_bilgiler->vergi_numarasi}}</td>
                           </tr>
                           <tr>
                               <td><strong>Yıllık Ciro</strong></td>
                               <td id="ciro_id_td"><strong>:</strong>  {{$firma->mali_bilgiler->yillik_cirosu}}</td>
                           </tr>
                           <tr>
                               <td><strong>Sermayesi</strong></td>
                               <td><strong>:</strong>  {{$firma->mali_bilgiler->sermayesi}}</</td>
                           </tr>
                       </thead>
                   </table>
                   @endif
                   <div class="modal fade" id="myModal-malibilgiler" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                   <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Mali Bilgiler</strong></h4>
                               </div>
                               <div class="modal-body">
                                   {!! Form::open(array('id'=>'mali_kayit','url'=>'firmaProfili/malibilgi/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                   <div class="form-group">
                                        <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Fatura Adresi</label>
                                        <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <input type="text" class="form-control" id="fatura_adresi" name="fatura_adresi" placeholder="Fatura Adresi" value="{{$firmaFatura->adres}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                       </div>
                                   </div>   
                                   <div class="form-group error">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputTask" class="col-sm-3 control-label">İl</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <select class="form-control il_id"  name="mali_il_id" id="mali_il_id" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                               <option selected disabled>Seçiniz</option>
                                               @foreach($iller as $il)
                                               <option  value="{{$il->id}}" >{{$il->adi}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group error">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputTask" class="col-sm-3 control-label">İlçe</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <select class="form-control" name="mali_ilce_id" id="mali_ilce_id" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                               <option selected disabled>Seçiniz</option>

                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Firma Ünvanı</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <input type="text" class="form-control" id="unvani" name="unvani" placeholder="Firma Ünvanı" value="{{$firma->mali_bilgiler->unvani}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Şirket Türü</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <select class="form-control" name="sirket_turu" id="sirket_turu" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                               <option selected disabled>Seçiniz</option>
                                               @foreach($sirketTurleri as $tur)
                                               <option  value="{{$tur->id}}" >{{$tur->adi}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Vergi Dairesi</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <select class="form-control" name="vergi_dairesi_id" id="vergi_dairesi_id" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                               <option selected disabled>Seçiniz</option>
                                               
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputTask" class="col-sm-3 control-label">Vergi Numarası</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <input type="text" class="form-control" id="vergi_numarasi" name="vergi_numarasi" placeholder="Vergi Numarası" value="{{$firma->mali_bilgiler->vergi_numarasi}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Yıllık Ciro</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <select class="form-control" name="yillik_cirosu" id="yillik_cirosu" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                               <option selected disabled>Seçiniz</option>
                                               <option  value="0-300.000" >0-300.000</option>
                                               <option  value="300.001-1.000.000" >300.001-1.000.000</option>
                                               <option  value="1.000.001-8.000.000" >1.000.001-8.000.000</option>
                                               <option  value="8.000.001-40.000.000" >8.000.001-40.000.000</option>
                                               <option  value="40.000.000 ve üzeri" >40.000.000 ve üzeri</option>
                                            </select>   
                                               <label>Gösterme</label>
                                               <label class="switch" style="margin-bottom: -5px;">
                                                    <input type="checkbox" id="ciro_goster" name="ciro_goster" checked>
                                                    <div class="slider round"></div>
                                               </label> 
                                                <label>Göster</label>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Sermayesi</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <input type="text" class="form-control" id="sermayesi" name="sermayesi" placeholder="Sermayesi" value="{{$firma->mali_bilgiler->sermayesi}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                           <label>Gösterme</label>
                                           <label class="switch" style="margin-bottom: -5px;">
                                                <input type="checkbox" id="sermaye_goster" name="sermaye_goster" checked>
                                                <div class="slider round"></div>
                                           </label> 
                                            <label>Göster</label>
                                       </div>
                                   </div>
                                   {!! Form::submit('Kaydet', array('url'=>'firmaProfili/malibilgi/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                   <br>
                                   <br>
                                   {!! Form::close() !!}
                               </div>
                               <div class="modal-footer">
                               </div>
                           </div>
                       </div>
                   </div>

               </div>

           </div>
           <div class="panel panel-default">
               <div style="border-bottom: 3px solid transparent;border-color:#ddd" class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><img src="{{asset('images/tl.png')}}">&nbsp;<strong>Ticari Bilgiler</strong></a>
                       <button  style="float:right" id="btn-add-ticaribilgiler" onclick="populateTicaretDD()" name="btn-add-ticaribilgiler" class="btn btn-primary btn-xs">Ekle / Düzenle</button>
                   </h4>
               </div>
               <div class="panel-body">
                   <table class="table" >
                       <thead id="tasks-list" name="tasks-list">
                           <tr>
                               <td width="25%"><strong>Ticaret Sicil No</strong></td>
                               <td width="75%"><strong>:</strong>  {{$firma->ticari_bilgiler->tic_sicil_no}}</td>
                           </tr>
                           <tr>
                               <td><strong>Ticaret Odası</strong></td>
                               <td id="odasi_id_td"><strong>:</strong>  {{$firma->ticari_bilgiler->ticaret_odalari->adi}}</td>
                           </tr>
                           <tr>
                               <td><strong>Faaliyet Türü</strong></td>
                               <td id="faaliyet_id_td" ><strong>:</strong>
                                   @foreach($firma->faaliyetler as $faaliyet)
                                    {{$faaliyet->adi}}
                                   @endforeach
                               </td>
                           </tr>
                           <tr>
                              <td><strong>Üst Sektör</strong></td>
                              <td id="ust_id_td"> <strong>:</strong>{{$firma->getUstSektor()}}</td>
                           </tr>
                           <tr>
                               <td><strong>Faaliyet Gösterilen Sektörler</strong></td>
                               <td  id="gfaaliyet_id_td"><strong>:</strong>
                                   @foreach($firma->sektorler as $sektor)
                                    {{$sektor->adi}}
                                   @endforeach
                               </td>
                           </tr>
                           
                           <tr>
                                <td><strong>Kuruluş Tarihi</strong></td>
                                <td><strong>:</strong>
                                    @if($firma->kurulus_tarihi != null)
                                        {{$firma->kurulus_tarihi}}
                                    @endif
                                </td>
                           </tr> 
                           <tr>
                               <td><strong>Firmanın Ürettiği Markalar</strong></td>
                               <td  id="urettigi_id_td"><strong>:</strong>
                                   @foreach($uretilenMarka as $marka)
                                        {{$marka->adi}}
                                   @endforeach
                               </td>
                           </tr>
                           <tr>
                               <td><strong>Firmanın Sattığı Markalar</strong></td>
                               <td id="sattıgı_id_td"><strong>:</strong>
                                    @if(count($satilanMarka) > 1)
                                        @foreach($firma->$satilanMarka as $satMarka)
                                            {{$satMarka->satilan_marka_adi}}
                                        @endforeach
                                    @endif 
                               </td>
                           </tr>
                       </thead>
                   </table>
              
                   <div class="modal fade" id="myModal-ticaribilgiler" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                   <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Ticari Bilgiler</strong></h4>
                               </div>
                               <div class="modal-body">
                                   {!! Form::open(array('id'=>'ticari_kayit','url'=>'firmaProfili/ticaribilgi/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-4 control-label">Ticaret Sicil NO</label>
                                       <label for="inputTask" style="text-align: left"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-6">
                                           <input type="text" class="form-control" id="ticaret_sicil_no" name="ticaret_sicil_no" placeholder="Ticaret Sicil No" value="{{$firma->ticari_bilgiler->tic_sicil_no}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-4 control-label">Ticaret Odası</label>
                                       <label for="inputTask" style="text-align: left"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-6">
                                           <select class="form-control" name="ticaret_odasi" id="ticaret_odasi" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                               <option selected disabled>Seçiniz</option>
                                               @foreach($ticaretodasi as $ticaret)
                                                    <option  value="{{$ticaret->id}}" >{{$ticaret->adi}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                        <label for="inputTask" class="col-sm-1 control-label"></label>
                                        <label for="inputEmail3" class="col-sm-4 control-label">Faaliyet Türü</label>
                                        <label for="inputTask" style="text-align: left"class="col-sm-1 control-label">:</label>
                                        <div class="col-sm-6">
                                            @foreach($faaliyetler as $faaliyet)
                                                <input type="checkbox" class="firma_faaliyet_turu" id="firma_faaliyet_turu" name="firma_faaliyet_turu[]" value="{{$faaliyet->id}}"  data-validation="checkbox_group" data-validation-qty="min1" data-validation-error-msg="En az bir tanesini seçiniz!">{{$faaliyet->adi}}
                                            @endforeach    
                                        </div>
                                   </div>
                                   <div class="form-group">
                                         <label for="inputTask" class="col-sm-1 control-label"></label>
                                         <label for="inputEmail3" class="col-sm-4 control-label">Üst Sektör</label>
                                         <label for="inputTask" style="text-align: left"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-6">
                                           <select class="form-control" name="ust_sektor" id="ust_sektor" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                               <option selected disabled>Seçiniz</option>
                                               <option  value="1" >Sanayi</option>
                                               <option  value="2" >Tarım</option>
                                               <option  value="3" >Hizmet</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                         <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-4 control-label">Faaliyet Gösterilen Sektörler</label>
                                         <label for="inputTask" style="text-align: left"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-6">
                                           <select class="form-control deneme"   name="faaliyet_sektorleri[]" id="custom-headers" multiple='multiple' >
                                                <?php $sektorler=DB::table('sektorler')->orderBy('adi','ASC')->get();  ?>
                                                @foreach($ustsektor as $sektor)
                                                    <option  value="{{$sektor->id}}" >{{$sektor->adi}}</option>
                                                @endforeach
                                          </select>
                                           
                                       </div>
                                   </div>
                                   <div class="form-group">
                                         <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-4 control-label">Kuruluş Tarihi</label>
                                         <label for="inputTask" style="text-align: left"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-6">
                                           <input type="text" class="form-control date" id="kurulus_tarihi" name="kurulus_tarihi" placeholder="Kuruluş Tarihi" value="{{$firma->kurulus_tarihi}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                       </div>
                                   </div>
                                   <div class="form-group" id="uretilenDiv">
                                         <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-4 control-label">Üretilen Markalar</label>
                                         <label for="inputTask" style="text-align: left"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-6">
                                           <div class="input_fields_wrap">
                                               <button  class="add_field_button btn btn-danger">Ekle</button>
                                               @foreach($uretilenMarka as $markas)
                                                    <div><input type="text" id="firmanin_urettigi_markalar" name="firmanin_urettigi_markalar[]"  value="{{$markas->adi}}" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><a href="#" class="remove_field">Sil</a></div>
                                               @endforeach
                                               
                                            </div>
                                       </div>
                                   </div>
                                   <div class="form-group" id="sattigiDiv">
                                        <label for="inputTask" class="col-sm-1 control-label"></label>
                                        <label for="inputEmail3" class="col-sm-4 control-label">Firmanın Sattığı Markalari</label>
                                        <label for="inputTask" style="text-align: left"class="col-sm-1 control-label">:</label>
                                        <div class="col-sm-6">
                                            <div class="input_fields_sattigi_wrap">
                                                <button  class="add_field_sattigi_button btn btn-danger">Ekle</button>
                                                @foreach($satilanMarka as $markaSatilan)
                                                    <div><input type="text" id="firmanin_sattigi_markalar"  name="firmanin_sattigi_markalar[]" value="{{$markaSatilan->adi}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!" ><a href="#" class="remove_field">Sil</a></div>
                                                @endforeach
                                                <div><input type="text" id="firmanin_sattigi_markalar"  name="firmanin_sattigi_markalar[]" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!" ><a href="#" class="remove_field">Sil</a></div>
                                            </div>
                                        </div>
                                   </div>
                                   {!! Form::submit('Kaydet', array('url'=>'firmaProfili/ticaribilgi/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                   <br>
                                   <br>
                                   {!! Form::close() !!}
                               </div>
                               <div class="modal-footer">
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div  class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><img src="{{asset('images/kalite.png')}}">&nbsp;<strong>Kalite Belgeleri ve Referanslar</strong></a>
                   </h4>
               </div>
                   <div class="panel-body">
                       <div class="panel-footer"><strong>Kalite Belgeleri</strong>
                        @if($kaliteBelge==null)
                            <div class="bilgiEkle"> 
                                <button style="margin-top:20px" id="btn-add-kalite" name="btn-add-kalite" class="btn btn-primary btn-xs"><img src="{{asset('images/plus.png')}}">&nbsp;Kalite Belgeleirnizi  Ekleyin</button>
                            </div>
                        @else 
                           <button style="float:right" id="btn-add-kalite" name="btn-add-kalite" class="btn btn-primary btn-xs" >Ekle</button>  
                           <table class="table" >
                               <thead id="tasks-list" name="tasks-list">
                                       <th>Kalite Belgesi:</th>
                                       <th>Belge NO:</th>
                                   
                                   @foreach($firma->kalite_belgeleri as $kalite_belgesi)
                                    <tr>
                                       <td id="kalite_id_td">
                                           {{$kalite_belgesi->adi}}
                                       </td>
                                       <td>
                                           {{$kalite_belgesi->pivot->belge_no}}
                                       </td>
                                       <td>
                                 
                                       <button name="open-modal-kaliteGuncelle"  style="float:right" value="{{$kalite_belgesi->id}}" class="btn btn-primary btn-xs open-modal-kaliteGuncelle" >Düzenle</button>
                                       </td>
                                      
                                        <td>
                                            
                                            {{ Form::open(array('url'=>'firmaProfili/kaliteSil/'.$kalite_belgesi->id,'method' => 'DELETE')) }}
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
                                           <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalite Belgeleri</strong> </h4>
                                       </div>
                                       <div class="modal-body">
                                           {!! Form::open(array('id'=>'kalite_up_kayit','url'=>'firmaProfili/kaliteGuncelle/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                           <div class="form-group">
                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                               <label for="inputEmail3" class="col-sm-3 control-label">Kalite Belgesi</label>
                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                               <div class="col-sm-7">
                                                    <select class="form-control" name="kalite_belgeleri" id="kalite_belgeleri" required>
                                                        <option selected disabled>Seçiniz</option>
                                                        @foreach($kalite_belgeleri as $kalite)
                                                        <option  value="{{$kalite->id}}">{{$kalite->adi}}</option>
                                                        @endforeach
                                                    </select>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                               <label for="inputEmail3" class="col-sm-3 control-label">Belge No</label>
                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                               <div class="col-sm-7">
                                                   <input type="text" class="form-control " id="belge_no" name="belge_no" placeholder="Belge No" value="{{$kalite_belgesi->pivot->belge_no}}" required/>
                                               </div>
                                           </div>
                                           <br>
                                           <br>
                                           <input type="hidden" name="kalite_id"  id="kalite_id" value="{{$kalite_belgesi->id}}"> 
                                           {!! Form::submit('Kaydet', array('url'=>'firmaProfili/kaliteGuncelle/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                           {!! Form::close() !!}
                                       </div>
                                       <br>
                                       <br>
                                       <br>
                                       <div class="modal-footer">                                                            
                                       </div>
                                   </div>
                               </div>
                           </div>
                               @endforeach
                            </thead>
                           </table>
                        @endif   
                           <div class="modal fade" id="myModal-kalite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                           <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalite Belgeleri</strong> </h4>
                                       </div>
                                       <div class="modal-body">
                                           {!! Form::open(array('id'=>'kalite_add_kayit','url'=>'firmaProfili/kalite/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                           <div class="form-group">
                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                               <label for="inputEmail3" class="col-sm-3 control-label">Kalite Belgesi</label>
                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                               <div class="col-sm-7">
                                                    <select class="form-control" name="kalite_belgeleri" id="kalite_belgeleri" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                        <option selected disabled>Seçiniz</option>
                                                        @foreach($kalite_belgeleri as $kalite)
                                                            <option  value="{{$kalite->id}}">{{$kalite->adi}}</option>
                                                        @endforeach
                                                    </select>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                                 <label for="inputTask" class="col-sm-1 control-label"></label>
                                               <label for="inputEmail3" class="col-sm-3 control-label">Belge No</label>
                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                               <div class="col-sm-7">
                                                   <input type="text" class="form-control " id="belge_no" name="belge_no" placeholder="Belge No" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                               </div>
                                           </div>
                                           {!! Form::submit('Kaydet', array('url'=>'firmaProfili/kalite/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                           <br>
                                           <br>
                                           {!! Form::close() !!}
                                       </div>
                                       <div class="modal-footer">                                                            
                                       </div>
                                       
                                   </div>
                               </div>
                           </div>
                          
                       </div>
                       <div class="panel-footer "><strong>Referanslar</strong>
                           @if($referans==null)
                            <div class="bilgiEkle"> 
                                <button style="margin-top:20px" id="btn-add-referanslar" name="btn-add-referanslar" class="btn btn-primary btn-xs"><img src="{{asset('images/plus.png')}}">&nbsp;Referanslarınızı  Ekleyin</button>
                            </div>
                           @else
                           <button style="float:right" id="btn-add-referanslar" name="btn-add-referanslar" class="btn btn-primary btn-xs" >Ekle</button>
                           <br>
                           <br>
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
                                       <th>İşin Yılı:</th>
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
                                       <td id="is_turu_id_td">
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
                                       <td id="ref_turu_id_td">
                                           {{$firmaReferans->ref_turu}}
                                       </td>
                                       <td>
                                           @if($firmaReferans->is_yili=="0000-00-00")

                                           @else
                                           {{$firmaReferans->is_yili}}
                                           @endif
                                       </td>
                                       <td> <button name="open-modal-gecmis"  value="{{$firmaReferans->id}}" class="btn btn-primary btn-xs open-modal-gecmis" >Düzenle</button>
                                       </td>
                                       <td>
                                           {{ Form::open(array('url'=>'firmaProfili/referansSil/'.$firmaReferans->id,'method' => 'DELETE', 'files'=>true))}}
                                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                                                {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs'])}}
                                                {{ Form::close()}}
                                        </td>
                                                <input type="hidden" name="ref_id"  id="ref_id" value="{{$firmaReferans->id}}"> 
                                       </tr>
                                        <div class="modal fade" id="myModal-referanslarGecmis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                           <div class="modal-dialog">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                       <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Referanslar</strong> </h4>
                                                   </div>
                                                   <div class="modal-body">
                                                       {!! Form::open(array('id'=>'ref_up_kayit','url'=>'firmaProfili/referansUpdate/'. $firmaReferans->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                       <div class="form-group">
                                                             
                                                           <label for="inputEmail3" class="col-sm-2 control-label">Referans Türü</label>
                                                             <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                             
                                                           <div class="col-sm-9">
                                                               <select class="form-control" name="ref_turu" id="ref_turu" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                   <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                   <option   value="Geçmiş">Geçmiş</option>
                                                                   <option  value="Şuan">Şuan</option>                                                  
                                                               </select>
                                                           </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                                            <label for="inputEmail3" class="col-sm-3 control-label">Firma Adı</label>
                                                            <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control " id="ref_firma_adi" name="ref_firma_adi" placeholder="Firma Adı" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                                            <label for="inputEmail3" class="col-sm-3 control-label">Yapılan İşin Adı</label>
                                                            <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control " id="yapılan_isin_adi" name="yapılan_isin_adi" placeholder="Yapılan İşin Adı" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                                            <label for="inputEmail3" class="col-sm-3 control-label">İşin Türü</label>
                                                            <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                           <div class="col-sm-7">
                                                               <select class="form-control" name="isin_turu" id="isin_turu" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                   <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                   <option   value="Mal Satışı">Mal Satışı</option>
                                                                   <option  value="Hizmet Satışı">Hizmet Satışı</option>
                                                                   <option  value="Yapım İşi">Yapım İşi</option>
                                                               </select>
                                                           </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                                            <label for="inputEmail3" class="col-sm-3 control-label">İşin Yılı</label>
                                                            <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control " id="is_yili" name="is_yili" placeholder="İş Yılı" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                                            <label for="inputEmail3" class="col-sm-3 control-label">Çalışma Süresi</label>
                                                            <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control " id="calısma_suresi" name="calısma_suresi" placeholder="Çalışma Süresi" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                                            <label for="inputEmail3" class="col-sm-3 control-label">Yetkili Kişi Adı</label>
                                                            <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control " id="yetkili_kisi_adi" name="yetkili_kisi_adi" placeholder="Yetkili Kişi Adı" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                                            <label for="inputEmail3" class="col-sm-3 control-label">Y.K Email Adresi</label>
                                                            <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" class="form-control " id="yetkili_kisi_email" name="yetkili_kisi_email" placeholder="Yetkili Kişi Email Adresi" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label for="inputTask" class="col-sm-1 control-label"></label>
                                                            <label for="inputEmail3" class="col-sm-3 control-label">Y.K Telefon</label>
                                                            <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control " id="yetkili_kisi_telefon" name="yetkili_kisi_telefon" placeholder="Yetkili Kişi Telefon" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                            </div>
                                                       </div>
                                                       <input type="hidden" name="ref_id"  id="ref_id" value="{{$firmaReferans->id}}">

                                                           {!! Form::submit('Kaydet', array('url'=>'firmaProfili/referansUpdate/'. $firmaReferans->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                           <br>
                                                           <br>
                                                           {!! Form::close() !!}
                                                           </div>
                                                           <div class="modal-footer">   
                                                           </div>
                                                   </div>
                                                    <div class="modal-footer">   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                </thead>
                             </table>
                           @endif
                                           <div class="modal fade" id="myModal-referanslar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                               <div class="modal-dialog">
                                                   <div class="modal-content">
                                                       <div class="modal-header">
                                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                           <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Referanslar</strong> </h4>
                                                       </div>
                                                       <div class="modal-body">
                                                           {!! Form::open(array('id'=>'ref_add_kayit','url'=>'firmaProfili/referans/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                           <div class="form-group">
                                                               
                                                               <label for="inputTask" class="col-sm-4 control-label">Referans Türü</label>
                                                               <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                               <div class="col-sm-7">
                                                                   <select class="form-control" name="ref_turu" id="ref_turu" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                       <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                       <option   value="Geçmiş">Geçmiş</option>
                                                                       <option  value="Şuan">Şuan</option>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                                
                                                               <label for="inputTask" class="col-sm-4 control-label">Firma Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                               <div class="col-sm-7">
                                                                   <input type="text" class="form-control " id="ref_firma_adi" name="ref_firma_adi" placeholder="Firma Adı" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                                
                                                               <label for="inputEmail3" class="col-sm-4 control-label">Yapım İşi Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                               <div class="col-sm-7">
                                                                   <input type="text" class="form-control " id="yapılan_isin_adi" name="yapılan_isin_adi" placeholder="Yapılan İşin Adı" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                               
                                                               <label for="inputEmail3" class="col-sm-4 control-label">İşin Türü</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                               <div class="col-sm-7">
                                                                   <select class="form-control" name="isin_turu" id="isin_turu" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                                       <option selected disabled value="Seçiniz">Seçiniz</option>
                                                                       <option   value="Mal Satışı">Mal Satışı</option>
                                                                       <option  value="Hizmet Satışı">Hizmet Satışı</option>
                                                                       <option  value="Yapım İşi">Yapım İşi</option>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                               
                                                               <label for="inputEmail3" class="col-sm-4 control-label">İş Yılı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                               <div class="col-sm-7">
                                                                   <input type="text" class="form-control " id="is_yili" name="is_yili" placeholder="İş Yılı" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label for="inputEmail3" class="col-sm-4 control-label">Çalışma Süresi</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                               <div class="col-sm-7">
                                                                   <input type="text" class="form-control " id="calısma_suresi" name="calısma_suresi" placeholder="Çalışma Süresi" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label for="inputEmail3" class="col-sm-4 control-label">Yetkili Kişi Adı</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                               <div class="col-sm-7">
                                                                   <input type="text" class="form-control " id="yetkili_kisi_adi" name="yetkili_kisi_adi" placeholder="Yetkili Kişi Adı" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label for="inputEmail3" class="col-sm-4 control-label">Yetkili Kişi Email Adresi</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                               <div class="col-sm-7">
                                                                   <input type="email" class="form-control " id="yetkili_kisi_email" name="yetkili_kisi_email" placeholder="Yetkili Kişi Email Adresi" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label for="inputEmail3" class="col-sm-4 control-label">Yetkili Kişi Telefon</label>
                                                                 <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                               <div class="col-sm-7">
                                                                   <input type="text" class="form-control " id="yetkili_kisi_telefon" name="yetkili_kisi_telefon" placeholder="Yetkili Kişi Telefon" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                               </div>
                                                           </div>

                                                           {!! Form::submit('Kaydet', array('url'=>'firmaProfili/referans/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                           <br>
                                                           <br>

                                                           {!! Form::close() !!}
                                                       </div>
                                                       <div class="modal-footer">                                                            
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <input type="hidden" name="add"  id="add" value="add"> 
                                       </div>
                   </div>
               
           </div>
           <div class="panel panel-default">
                <div style="border-bottom: 3px solid transparent;border-color:#ddd" class="panel-heading">
                    <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6"><img src="{{asset('images/brosur.png')}}">&nbsp;<strong>Firma Broşürü</strong></a>
                        @if($brosur==null)
                        @else
                        <button style="float:right"id="btn-add-firmabrosurEkle" name="btn-add-firmabrosurEkle" class="btn btn-primary btn-xs" >Ekle</button>
                        @endif
                    </h4>
                </div>
              
                <div class="panel-body">
                       @if($brosur==null)
                        <div class="bilgiEkle"> 
                                <button style="margin-top:20px" id="btn-add-firmabrosurEkle" name="btn-add-firmabrosurEkle" class="btn btn-primary btn-xs"><img src="{{asset('images/plus.png')}}">&nbsp;Broşürünüzü Ekleyin</button>
                        </div>
                       
                       @else
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                                <th>Broşür Adı:</th>
                                <th>Broşür Pdf:</th>
                                
                                @foreach($firma->firma_brosurler as $firmaBrosur)
                                    <tr >   
                                       <td>
                                           {{$firmaBrosur->adi}}
                                       </td>
                                       <td data-toggle="tooltip" data-placement="bottom" title="PDF'i görüntülemek için lütfen üstüne tıklayın!">
                                           <a target="_blank" href="{{ asset('brosur/'.$firmaBrosur->yolu) }}"><img src="{{asset('images/see.png')}}">   {{$firmaBrosur->yolu}}</a>
                                       </td>
                                  
                                    <td><button   value="{{$firmaBrosur->id}}" class="btn btn-primary btn-xs open-modal-brosurGuncelle" >Düzenle</button>
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
                                                    <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Firma Broşürü</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(array('id'=>'brosur_up_kayit','url'=>'firmaProfili/firmaBrosurGuncelle/'.$firmaBrosur->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                                    <div class="form-group">
                                                          <label for="inputTask" class="col-sm-1 control-label"></label>
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Broşür Adı</label>
                                                        <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control " id="brosur_adi" name="brosur_adi" placeholder="Broşür Adi" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                         <label for="inputTask" class="col-sm-1 control-label"></label>
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Broşür Dosyası</label>
                                                        <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                        <div class="col-sm-7">
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    {!! Form::file('yolu', array('data-validation'=>'required', 'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
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
                                                    {!! Form::submit('Kaydet', array('url'=>'firmaProfili/firmaBrosurGuncelle/'.$firmaBrosur->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                                    <br>
                                                    <br>
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
                       @endif
                        <div class="modal fade" id="myModal-firmabrosurEkle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                              <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Firma Broşürü</strong></h4>
                                          </div>
                                          <div class="modal-body">
                                              {!! Form::open(array('id'=>'brosur_kayit','url'=>'firmaProfili/firmaBrosur/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                              <div class="form-group">
                                                  <label for="inputTask" class="col-sm-1 control-label"></label>
                                                  <label for="inputEmail3" class="col-sm-3 control-label">Broşür Adı</label>
                                                  <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                  <div class="col-sm-7">
                                                      <input type="text" class="form-control " id="brosur_adi" name="brosur_adi" placeholder="Broşür Adi" value="" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputTask" class="col-sm-1 control-label"></label>
                                                  <label for="inputEmail3" class="col-sm-3 control-label">Broşür Dosyası</label>
                                                  <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                                  <div class="col-sm-7">
                                                      <div class="control-group">
                                                          <div class="controls">
                                                              {!! Form::file('yolu',array('data-validation'=>'required', 'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
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

                                              {!! Form::submit('Kaydet', array('url'=>'firmaProfili/firmaBrosur/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                              <br>
                                              <br>
                                              {!! Form::close() !!}
                                          </div>
                                          <div class="modal-footer">                                                            
                                          </div>
                                      </div>
                                  </div>
                              </div>
                   </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse7"><img src="{{asset('images/calisan.png')}}">&nbsp;<strong>İdari Bilgiler</strong></a>
                       @if($calisan==null)
                       @else
                             <button style="float:right" id="btn-add-firmacalisanbilgileri" name="btn-add-firmacalisanbilgileri" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                       @endif
                   </h4>
               </div>

               <div class="panel-body">
                   @if($calisan==null)
                    <div class="bilgiEkle"> 
                            <button style="margin-top:20px" id="btn-add-firmacalisanbilgileri" name="btn-add-firmacalisanbilgileri" class="btn btn-primary btn-xs"><img src="{{asset('images/plus.png')}}">&nbsp;Bilgilerinizi Ekleyin</button>
                    </div>
                   @else
                   <table class="table" >
                       <thead id="tasks-list" name="tasks-list">
                           <tr>
                               <td  width="25%"><strong>Çalışma Günleri</strong></td>
                               <td  id="calisma_id_td" width="75%"><strong>:</strong>  {{$calismaGunu}}</td>
                           </tr>
                           <tr>
                               <td><strong>Çalışma Saatleri</strong></td>
                               <td><strong>:</strong>  {{$firma->firma_calisma_bilgileri->calisma_saatleri}}</td>
                           </tr>
                           <tr>
                               <td><strong>Çalışan Profili</strong></td>
                               <td id="profil_id_td"><strong>:</strong> {{$firma->getCalisanProfil()}}</td>
                           </tr>
                           <tr>
                               <td><strong>Çalışan Sayısı</strong></td>
                               <td><strong>:</strong>  {{$firma->firma_calisma_bilgileri->calisan_sayisi}}</td>
                           </tr>
                           <tr>
                               <td id="departman_id_td"><strong>Firma Departmanları</strong></td>
                               <td><strong>:</strong>
                                   @foreach($firma->departmanlar as $departman)
                                     {{$departman->adi}}
                                   @endforeach
                               </td>
                           </tr>
                       </thead>
                   </table>
                   @endif
                   <div class="modal fade" id="myModal-firmacalisanbilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                   <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>İdari Bilgiler</strong></h4>
                               </div>
                               <div class="modal-body">
                                   {!! Form::open(array('id'=>'calisma_kayit','url'=>'firmaProfili/firmaCalisan/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Çalışma Günleri</label>
                                        <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <select class="form-control" name="calisma_gunleri" id="calisma_gunleri" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                               <option selected disabled>Seçiniz</option>
                                               @foreach($calisma_günleri as $günleri)
                                               <option  value="{{$günleri->id}}">{{$günleri->adi}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Çalışma Saatleri</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <input type="text" class="form-control " id="calisma_saatleri" name="calisma_saatleri" placeholder="Çalışma Saatleri" value="{{$firma->firma_calisma_bilgileri->calisma_saatleri}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Çalışan Profili</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <input type="checkbox" class="firma_calisan " name="firma_calisma_profili[]" value="1" data-validation="checkbox_group"  data-validation-error-msg="Lütfen birini seçiniz!"  data-validation-qty="min1"/>Mavi Yaka
                                           <input type="checkbox" class="firma_calisan "  name="firma_calisma_profili[]" value="2" data-validation="checkbox_group" data-validation-error-msg="Lütfen birini seçiniz!"  data-validation-qty="min1"/>Beyaz Yaka
                                           
                                           
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Çalışan Sayısı</label>
                                       <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-7">
                                           <input type="text" class="form-control " id="calisma_sayisi" name="calisma_sayisi" placeholder="Çalışan Sayısı" value="{{$firma->firma_calisma_bilgileri->calisan_sayisi}}" data-validation="required"  data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                         <label for="inputTask" class="col-sm-1 control-label"></label>
                                       <label for="inputEmail3" class="col-sm-3 control-label">Firma Departmanları</label>
                                         <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                       <div class="col-sm-6">
                                           <select id="firma_departmanlari"   name="firma_departmanları[]" multiple="multiple">
                                                @foreach($departmanlar as $departman)
                                                 <option data-toggle="tooltip" data-placement="bottom" title="{{$departman->adi}}" value="{{$departman->id}}">{{$departman->adi}}</option>
                                                @endforeach
                                           </select>
                                       </div>
                                   </div>

                                   {!! Form::submit('Kaydet', array('url'=>'firmaProfili/firmaCalisan/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                   <br>
                                   <br>
                                   {!! Form::close() !!}
                               </div>
                               <div class="modal-footer">                                                            
                               </div>
                           </div>
                       </div>
                   </div>

               </div>

           </div>
           <div class="panel panel-default">
                <div  class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse8"><strong><img src="{{asset('images/bilgilendirme.png')}}">&nbsp;Bilgilendirilme Tercihi</strong></a>
                        <button style="float:right" id="btn-add-bilgilendirmetercihi" name="btn-add-bilgilendirmetercihi" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                    </h4>
                </div>
                <div class="panel-body">
                       <table data-toggle="tooltip" data-placement="bottom" title="Eğer değiştirmek istiyorsanız Ekle/Düzenle butonunu kullanın!" class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr id="firma{{$firma->id}}">
                               <tr>
                                   <td width="25%"><strong>Bilgilendirme Tercihi :</strong></td>
                                   <td width="75%"><input type="checkbox" class="bilgilendirmeOnTaraf"  id="bilgilendirme_tercihi" name="bilgilendirme_tercihi[]" value="Sms" disabled/>Sms <br>
                                   <input type="checkbox" class="bilgilendirmeOnTaraf" id="bilgilendirme_tercihi" name="bilgilendirme_tercihi[]" value="Mail" disabled/>Mail <br>
                                               <input type="checkbox" class="bilgilendirmeOnTaraf" id="bilgilendirme_tercihi" name="bilgilendirme_tercihi[]" value="Telefon" disabled/>Telefon <br>
                                               <input type="checkbox" class="bilgilendirmeOnTaraf" id="bilgilendirme_tercihi" name="bilgilendirme_tercihi[]" value="Bilgilendirme İstemiyorum" disabled/>Bilgilendirme İstemiyorum</td>
                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-bilgilendirmetercihi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Bilgilendirilme Tercihi</strong></h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('id'=>'bilgilendirme_kayit','url'=>'firmaProfili/bilgilendirmeTercihi/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                   
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-4 control-label">Bilgilendirilme Tercihi</label>
                                           <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                                           <div class="col-sm-7">
                                               <input type="checkbox" class="bilgilendirme"  id="bilgilendirme_tercihi" name="bilgilendirme_tercihi[]" data-validation="checkbox_group" value="Sms" data-validation-qty="min1" data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>Sms <br>
                                               <input type="checkbox" class="bilgilendirme" id="bilgilendirme_tercihi" name="bilgilendirme_tercihi[]" data-validation="checkbox_group" value="Mail" data-validation-qty="min1" data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>Mail <br>
                                               <input type="checkbox" class="bilgilendirme" id="bilgilendirme_tercihi" name="bilgilendirme_tercihi[]" data-validation="checkbox_group" value="Telefon" data-validation-qty="min1" data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>Telefon <br>
                                               <input type="checkbox" class="bilgilendirme" id="bilgilendirme_tercihi" name="bilgilendirme_tercihi[]" data-validation="checkbox_group" value="Bilgilendirme İstemiyorum" data-validation-qty="min1" data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>Bilgilendirme İstemiyorum
                                           </div>
                                       </div>
                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/bilgilendirmeTercihi/'.$firma->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                                       <br>
                                       <br>
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
     <div class="col-sm-4" >
              <div  class="panel-group">
                         <div    class="panel panel-default">
                             <div style="background-color: #e5e5e5" class="panel-heading"><img src="{{asset('images/ayar.png')}}">&nbsp;Firma Profil Görünüm Ayarları</div>
                             <div class="panel-body">
                             </div>
                         </div>
                         <div class="panel panel-default">
                                <div  style="background-color: #e5e5e5;" class="panel-heading"><img src="{{asset('images/doluluk.png')}}">&nbsp;Firma Profili Doluluk Oranı</div>
                                <div class="panel-body">
                                    <div class="bar_container">
                                        <div id="main_container">
                                            <div id="pbar" class="progress-pie-chart" data-percent="0">
                                                <div class="ppc-progress">
                                                    <div class="ppc-progress-fill"></div>
                                                </div>
                                                <div class="ppc-percents">
                                                    <div class="pcc-percents-wrapper">
                                                        <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <progress style="display: none" id="progress_bar" value="0" max="1" >
                                            </progress>
                                        </div>
                                    </div>
                                </div>
                         </div>
                         <div class="panel panel-default">
                             <div  style="background-color: #e5e5e5;" class="panel-heading"><img src="{{asset('images/islem.png')}}">&nbsp;Firma Profili İşlemleri</div>
                             <div class="panel-body">
                             </div>
                         </div>
             </div>
        </div>
     </div>
       <div id="mesaj" class="popup">
            <span class="button b-close"><span>X</span></span>
            <h2 style="color:red"> Üzgünüz.. !!!</h2>
            <h3>Sistemsel bir hata oluştu.Lütfen daha sonra tekrar deneyin</h3>
       </div>
     
   </div>  
   <script src="{{asset('js/selectDD.js')}}"></script>  
   <script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
<script> 
    $("#firma_departmanlari").multipleSelect({
            width: 260,
            multiple: true,
            multipleWidth: 100
    });
    
    var count = 0;
    $('#custom-headers').multiSelect({
        selectableHeader: "</i><input type='text'  class='search-input col-sm-12 search_icon' autocomplete='off' placeholder='Sektör Seçiniz'></input>",
        selectionHeader: "<p style='font-size:12px;color:red'>Max 5 sektör</p>",
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

        },
        afterSelect: function(values){
          count++;
         
          if(count>5){
              $('#custom-headers').multiSelect('deselect', values);
          }
          this.qs1.cache();
          this.qs2.cache();
          
         
        },
        afterDeselect: function(){
          count--;
          this.qs1.cache();
          this.qs2.cache();
        }
    });
    /////////////Bilgilendirme Checkbox buton kontrolü
    $('.bilgilendirme').click(function(){
        jQuery('.bilgilendirme').each(function(){
            $(this).attr("disabled",false);
        });
        jQuery('.bilgilendirme:checked').each(function(){
            if($(this).val() == "Bilgilendirme İstemiyorum"){
                jQuery('.bilgilendirme').each(function(){
                    if($(this).val() != "Bilgilendirme İstemiyorum"){
                        $(this).prop("checked",false);
                        $(this).attr("disabled",true);
                    }
                });
            }
        });
    });
    var kontrol=0;
    jQuery('.bilgilendirmeOnTaraf').each(function(){
        if($(this).val() == "Sms"){
            if({{$firma->sms}} == 1){
                $(this).prop("checked",true);
                kontrol=1;
            }
            else{
                $(this).prop("checked",false);
            }
        }
        else if($(this).val() == "Mail"){
            if({{$firma->mail}} == 1){
                $(this).prop("checked",true);
                kontrol=1;
            }
            else{
                $(this).prop("checked",false);
            }
        }
        else if($(this).val() == "Telefon"){
            if({{$firma->telefon}} == 1){
                $(this).prop("checked",true);
                kontrol=1;
            }
            else{
                $(this).prop("checked",false);
            }
        }
        else{
            if(kontrol == 0){
                $(this).prop("checked",true);
            }
        }
    });
    
  $.validate({
    modules : 'location, date, security, file',
    onModulesLoaded : function() {
      $('#country').suggestCountry();
    }
  });
  jQuery('.firma_faaliyet_turu').each(function(){
      <?php foreach ($firma->faaliyetler as $flyt){ ?>
              var falyAdi = {{$flyt->id}};
          if($(this).val() == falyAdi){
              $(this).prop("checked",true);
            }
          
      <?php } ?>

   });
  $('.firma_faaliyet_turu').click(function(){ ///////////faaliyet turu /////////////////
        var sonSecilen;
        var count=0;
        
        jQuery('.firma_faaliyet_turu:checked').each(function(){
            sonSecilen = $(this).val();
            count++;
        });
        if(count == 1){
            if(sonSecilen == 1){
                $('#sattigiDiv').hide();
            }
            else{
                $('#uretilenDiv').hide();
            }
        }else{
            $('#sattigiDiv').show();
            $('#uretilenDiv').show();
        }
    });
  $('#presentation').restrictLength( $('#pres-max-length') );
    $(document).ready(function() {
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
            format: 'yyyy',
            language:"tr",
            viewMode:"years",
            minViewMode:"years",
            container: container,
            weekStart:1,
            todayHighlight: true,
            autoclose: true
        });
        
        $("#calisma_gunleri").val({{$firma->firma_calisma_bilgileri->calisma_gunleri_id}});
        
        $("#ust_sektor").val({{$firma->ticari_bilgiler->ust_sektor}});
        $('[data-toggle="tooltip"]').tooltip();   
        var arrayDepartman = new Array();
        <?php foreach($firma->departmanlar as $departman){ ?>
             arrayDepartman.push({{$departman->id}});
        <?php } ?>
        $("#firma_departmanlari").multipleSelect("setSelects", arrayDepartman);
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
        
        var s=1;
        var wrapper_sattigi         = $(".input_fields_sattigi_wrap"); //Fields wrapper
        var add_button_sattigi      = $(".add_field_sattigi_button"); //Add button ID
        $(add_button_sattigi).click(function(e){ //on add input button click
            e.preventDefault();
            if(s < max_fields){ //max input box allowed
                s++; //text box increment
                $(wrapper_sattigi).append('<div><input type="text" name="firmanin_sattigi_markalar_[]"/><a href="#" class="remove_field">Sil</a></div>'); //add input box
            }
        });

        $(wrapper_sattigi).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        });
        $('.il_id').on('change', function (e) {
            var il_id = e.target.value;
            GetIlce(il_id,e.target.id);
            GetVergi(il_id);
            //popDropDown('ilce_id', 'ajax-subcat?il_id=', il_id);
            //$("#semt_id")[0].selectedIndex=0;
        });
        $('#ilce_id').on('change', function (e) {
            var ilce_id = e.target.value;
            GetSemt(ilce_id);
            //popDropDown('semt_id', 'ajax-subcatt?ilce_id=', ilce_id);
        });
        dolulukForm();
        /* Pie Chart */
        var progressbar = $('#progress_bar');
        max = total_yuzde;
        if(max > 1 && max <= 15)
        {
            $('.ppc-progress-wrapper').css("background","#e54100");
            $('.ppc-percents span').css("color","#e54100");
            
        }
        if(max > 15 && max <= 30)
        {
            $('.ppc-progress-fill').css("background","#f46f02");
            $('.ppc-percents span').css("color","#f46f02");
            
        }
        if(max > 30 && max <=45 )
        {
            $('.ppc-progress-fill').css("background","#ffba04");
            $('.ppc-percents span').css("color","#ffba04");
            
        }
        if(max > 45 && max <=60 )
        {
            $('.ppc-progress-fill').css("background","#d6d036");
            $('.ppc-percents span').css("color","#d6d036");
            
        }
        if(max > 60 && max <=75 )
        {
            //$('.ppc-progress-fill').css("background","#a5c530");
            $('.ppc-percents span').css("color","#a5c530");
            
        }
        if(max > 75 && max <=100)
        {
            //$('.ppc-progress-fill').css("background","#45c538");
            $('.ppc-percents span').css("color","#45c538");
            
        }
        time = (1000 / max) * 0.5;
        value = progressbar.val();

        var loading = function() {
        value += 1;
        addValue = progressbar.val(value);

        $('.progress-value').html(value + '%');
        var $ppc = $('.progress-pie-chart'),
        deg = 360 * value / 100;
        if (value > 50) {
           $ppc.addClass('gt-50');
        }

        $('.ppc-progress-fill').css('transform', 'rotate(' + deg + 'deg)');
        $('.ppc-percents span').html(value + '%');
     

        if (value == max) {
            clearInterval(animate);
        }
        };

        var animate = setInterval(function() {
        loading();
        }, time);
       

    });
   
    function GetIlce(il_id,Id) {
        
        if (il_id > 0) {
            if(Id == "il_id"){
                $("#ilce_id").get(0).options.length = 0;
                $("#ilce_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 
            }
            else{
                $("#mali_ilce_id").get(0).options.length = 0;
                $("#mali_ilce_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 
            }
            $.ajax({
                type: "GET",
                url: "{{asset('ajax-subcat')}}",
                data:{il_id:il_id},
                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    if(Id == "il_id"){
                        $("#ilce_id").get(0).options.length = 0;
                        $("#ilce_id").get(0).options[0] = new Option("Seçiniz", "-1");
                    }else{
                        $("#mali_ilce_id").get(0).options.length = 0;
                        $("#mali_ilce_id").get(0).options[0] = new Option("Seçiniz", "-1");
                    }    
                    $.each(msg, function(index, ilce) {
                        if(Id == "il_id"){
                            $("#ilce_id").get(0).options[$("#ilce_id").get(0).options.length] = new Option(ilce.adi, ilce.id);
                        }
                        else{
                            $("#mali_ilce_id").get(0).options[$("#mali_ilce_id").get(0).options.length] = new Option(ilce.adi, ilce.id);
                        }
                    });
                },
                async: false,
                error: function() {
                    if(Id == "il_id"){
                        $("#ilce_id").get(0).options.length = 0;
                    }
                    else{
                        $("#mali_ilce_id").get(0).options.length = 0;
                    }
                    alert("İlçeler yükelenemedi!!!");
                }
            });
        }
        else {
            if(Id == "il_id"){
                $("#ilce_id").get(0).options.length = 0;
            }
            else{
                $("#mali_ilce_id").get(0).options.length = 0;
            }
        }
    }
    
    function GetSemt(ilce_id) {
        if (ilce_id > 0) {
            $("#semt_id").get(0).options.length = 0;
            $("#semt_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 

            $.ajax({
                type: "GET",
                url: "{{asset('ajax-subcatt?ilce_id=')}}"+ilce_id,

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
    function GetTicaret(il_id) {
        if (il_id > 0) {
            $("#ticaret_odasi").get(0).options.length = 0;
            $("#ticaret_odasi").get(0).options[0] = new Option("Yükleniyor", "-1"); 

            $.ajax({
                type: "GET",
                url: "{{asset('ticaret_odalari')}}",
                data:{il_id:il_id},
                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    $("#ticaret_odasi").get(0).options.length = 0;
                    $("#ticaret_odasi").get(0).options[0] = new Option("Seçiniz", "-1");

                    $.each(msg, function(index, ticaret) {
                        $("#ticaret_odasi").get(0).options[$("#ticaret_odasi").get(0).options.length] = new Option(ticaret.adi, ticaret.id);
                    });
                },
                async: false,
                error: function() {
                    $("#ticaret_odasi").get(0).options.length = 0;
                    alert("Vergi Daireleri yükelenemedi!!!");
                }
            });
        }
        else {
            $("#ticaret_odasi").get(0).options.length = 0;
        }
    }
        function GetVergi(il_id) {
        if (il_id > 0) {
            $("#vergi_dairesi_id").get(0).options.length = 0;
            $("#vergi_dairesi_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 

            $.ajax({
                type: "GET",
                url: "{{asset('vergi_daireleri')}}",
                data:{il_id:il_id},
                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    $("#vergi_dairesi_id").get(0).options.length = 0;
                    $("#vergi_dairesi_id").get(0).options[0] = new Option("Seçiniz", "-1");

                    $.each(msg, function(index, vergi) {
                        $("#vergi_dairesi_id").get(0).options[$("#vergi_dairesi_id").get(0).options.length] = new Option(vergi.adi, vergi.id);
                    });
                },
                async: false,
                error: function() {
                    $("#vergi_dairesi_id").get(0).options.length = 0;
                    alert("Vergi Daireleri yükelenemedi!!!");
                }
            });
        }
        else {
            $("#vergi_dairesi_id").get(0).options.length = 0;
        }
    }
    function populateDD(){
        GetIlce({{$firmaAdres->iller->id}},"il_id");
        GetSemt({{$firmaAdres->ilceler->id}});
        $("#il_id ").val({{$firmaAdres->iller->id}}).trigger("event");
        console.log($("#ilce_id").val({{$firmaAdres->ilceler->id}}));
        $("#semt_id").val({{$firmaAdres->semtler->id}});
    }
    function populateTicaretDD(){
        GetTicaret({{$firmaFatura->iller->id}});
        $("#ticaret_odasi").val({{$firma->ticari_bilgiler->tic_oda_id}});
    }
    function populateMaliDD(){
        GetIlce({{$firmaFatura->iller->id}},"mali_il_id");
        GetVergi({{$firmaFatura->iller->id}});
        $("#mali_il_id").val({{$firmaFatura->iller->id}});
        $("#mali_ilce_id").val({{$firmaFatura->ilceler->id}});
        $("#sirket_turu").val({{$firma->sirket_turu}});
        $("#yillik_cirosu").val("{{$firma->mali_bilgiler->yillik_cirosu}}");
        $("#vergi_dairesi_id").val({{$firma->mali_bilgiler->vergi_dairesi_id}});
        
        if( "{{$mali_bilgi}}" == "dolu" && {{$checkboxCiro}} == 0){
            $("#ciro_goster").prop('checked',false);
        }
        if( "{{$mali_bilgi}}" == "dolu" && {{$checkboxSermaye}} == 0){
            $("#sermaye_goster").prop('checked',false);
        }
    }
    $('#addImage').on('change', function(evt) {
    var selectedImage = evt.currentTarget.files[0];
    var imageWrapper = document.querySelector('.image-wrapper');
    var theImage = document.createElement('img');
    imageWrapper.innerHTML = '';

    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
    if (regex.test(selectedImage.name.toLowerCase())) {
      if (typeof(FileReader) != 'undefined') {
        var reader = new FileReader();
        reader.onload = function(e) {
            theImage.id = 'new-selected-image';
            theImage.src = e.target.result;
            imageWrapper.appendChild(theImage);
          }
          //
        reader.readAsDataURL(selectedImage);
      } else {
        //-- Let the user knwo they cannot peform this as browser out of date
        console.log('browser support issue');
      }
    } else {
      //-- no image so let the user knwo we need one...
      $(this).prop('value', null);
      console.log('please select and image file');
    }
  });
  
  
        var total_row=44; 
        var dolu_row=0;
        var total_yuzde=0; 
        function dolulukForm(){
     
        var logo1 = document.getElementById("logo1").src;
        
        var il_id = $('#il_id_td').text();
    
        var ilce_id = $('#ilce_id_td').text();
        
        var semt_id= $('#semt_id_td').text();
      
        var adres=$('#adres').val(); 
        
        var telefon=$('#telefon').val(); 
        
        var fax=$('#fax').val(); 
        
        var web_sayfasi=$('#web_sayfasi').val(); 
        
        var firma_tanitim =$('#tanitim_id_td').text(); 
     
        var mal_il_id= $('#mali_il_td').text()
       
        var mal_ilce_id= $('#mali_ilce_td').text();
        
        var unvani=$('#unvani').val();      
       
        var sirket_turu=$('#sirket_id_td').text();
       
        var vergi_dairesi= $('#vergi_id_td').text();
        
        var vergi_numarasi=$('#vergi_numarasi').val(); 
        
        var yillik_cirosu=$('#ciro_id_td').text(); 
        
        var sermayesi=$('#sermayesi').val(); 

        var ticaret_sicil_no=$('#ticaret_sicil_no').val(); 
        var ticaret_odasi= $('#odasi_id_td').text();
     
       
        var ust_sektor= $('#ust_id_td').text();
        
        var faaliyet_sektorleri=$('#dfaaliyet_id_td').text(); 
        
        var firma_departmanlari=$('#departman_id_td').text(); 
        
        var kurulus_tarihi=$('#kurulus_tarihi').val(); 
        
        var firma_faaliyet_turu=$('#faaliyet_id_td').text(); 
        
        var firmanin_urettigi_markalar=$('#urettigi_id_td').text(); 
        
        var firmanin_sattigi_markalar=$('#sattıgı_id_td').text(); 
       
       
        var kalite_belgeleri=$('#kalite_id_td').text();
        
        var belge_no=$('#belge_no').val(); 
        
      
        var ref_turu= $('#ref_turu_id_td').text();
        
        var ref_firma_adi=$('#ref_firma_adi').val(); 
        
        var yapılan_isin_adi=$('#yapılan_isin_adi').val(); 
       
        var isin_turu= $('#is_turu_id_td').text();
        
        var is_yili=$('#is_yili').val(); 
        
        var calisma_suresi=$('#calısma_suresi').val(); 
        
        var yetkili_kisi_adi=$('#yetkili_kisi_adi').val(); 
        
        var yetkili_kisi_email=$('#yetkili_kisi_email').val(); 
        
        var yetkili_kisi_telefon=$('#yetkili_kisi_telefon').val(); 
        
        var brosur_adi=$('#brosur_adi').val(); 
       
        var calisma_gunleri= $('#calisma_id_td').text();
        
        var calisma_saatleri=$('#calisma_saatleri').val(); 
        
        var calisma_profili=$('#profil_id_td').text(); 
        
        var calisma_sayisi=$('#calisma_sayisi').val(); 
        
        var bilgilendirme_tercihi='dolu'; 
        
        if(logo1 != null ){
             dolu_row++
        }
        if(il_id != "" && il_id != "Seçiniz"){
            dolu_row++
        }
        if(ilce_id != "" && ilce_id!="Seçiniz"){
             dolu_row++
        } 
        if(semt_id != "" && semt_id!="Seçiniz"){
            dolu_row++  
        } 
        if(adres != ""){
            dolu_row++
            
        }
        if(telefon != ""){
             dolu_row++
        }
        if(fax != ""){
             dolu_row++
        }
        if(web_sayfasi != ""){
             dolu_row++
            
        } 
        if(firma_tanitim != ""){
             dolu_row++
            
        }
        if(mal_il_id != "" && mal_il_id!="Seçiniz"){
             dolu_row++
        }
        if(mal_ilce_id != "" && mal_ilce_id!="Seçiniz"){
             dolu_row++
        }
        
        if(unvani != ""){
             dolu_row++
        }
        if(sirket_turu != "" && sirket_turu!="Seçiniz"){
             dolu_row++
        }
        if(vergi_dairesi != "" && vergi_dairesi!="Seçiniz"){
             dolu_row++
        }
        if(vergi_numarasi != ""){
             dolu_row++
        }
        if(yillik_cirosu != ""){
             dolu_row++
        }
        if(sermayesi != ""){
             dolu_row++
        }
        if(ticaret_sicil_no != ""){
             dolu_row++
        }
        if(ticaret_odasi != "" && ticaret_odasi!="Seçiniz"){
             dolu_row++
        }
        if(ust_sektor != "" && ust_sektor!="Seçiniz"){
             dolu_row++
        }
        if(faaliyet_sektorleri != ""){
             dolu_row++
        }
        if(firma_departmanlari != ""){
             dolu_row++
        }
        if(kurulus_tarihi != ""){
             dolu_row++
        }
        if(firma_faaliyet_turu != ""){
             dolu_row++
        }
        if(firmanin_urettigi_markalar != ""){
             dolu_row++
        }
        if(firmanin_sattigi_markalar != ""){
             dolu_row++
        }
        if(kalite_belgeleri != "" && kalite_belgeleri!="Seçiniz"){
             dolu_row++
        }
        if(belge_no != ""){
             dolu_row++
        }
        if(ref_turu != ""  && ref_turu!="Seçiniz"){
             dolu_row++
        }
        if(ref_firma_adi != ""){
             dolu_row++
        }
        if(yapılan_isin_adi != ""){
             dolu_row++
        }
        if(isin_turu != ""  && isin_turu!="Seçiniz"){
             dolu_row++
        }
        if(is_yili != ""){
             dolu_row++
        }
        if(calisma_suresi != ""){
             dolu_row++
        }
        if(yetkili_kisi_adi != ""){
             dolu_row++
        }
        if(yetkili_kisi_email != ""){
             dolu_row++
        }
        if(yetkili_kisi_telefon != ""){
             dolu_row++
        }
        if(brosur_adi != ""){
             dolu_row++
        }
        if(calisma_gunleri != ""  && calisma_gunleri!="Seçiniz"){
             dolu_row++
        }
        if(calisma_saatleri != ""){
             dolu_row++
        }
        if(calisma_profili != ""){
             dolu_row++
        }
        if(calisma_sayisi != ""){
             dolu_row++
        }
        if(bilgilendirme_tercihi != ""){
             dolu_row++
        }
        
       var total_dolu_row=dolu_row;
       
       var hesaplama=(total_dolu_row/total_row)*100;
       total_yuzde=hesaplama.toFixed(0);
       
       funcDolulukKayıt()
       
    }
    
   function funcDolulukKayıt(){             
    $.ajax({
        type:"POST",
        url: "{{asset('doluluk_orani')}}"+"/"+{{$firma->id}},
        data:{doluluk_orani:total_yuzde},
       
        cache: false,
        success: function(data){
           console.log(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        }
    });
   }
////transection controollerinde çıkan sistemsel hatanın ekrana bastırılması.
var firma_id='{{$firma->id}}';
$("#iletisim_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                        $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });
 $("#mali_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
               
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                      
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });    
  $("#ticari_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
              
            
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });   
  $("#kalite_add_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
                
            
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });
  $("#kalite_up_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
          
            
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });
  $("#ref_up_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
              
            
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });
  $("#ref_add_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
               
            
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });
 $("#brosur_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
              
            
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });
  $("#brosur_up_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
               
            
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });
   $("#calisma_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
           
            
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });
   $("#bilgilendirme_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
               
            
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
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                        setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id}, 5000);
                    }
                    else{
                         
                         setTimeout(function(){ location.href="{{asset('firmaProfili')}}"+"/"+firma_id }, 1000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert(textStatus + "," + errorThrown);     
                }
            });
            e.preventDefault();
    });
</script>
</body>
</html>
@endsection
