<!DOCTYPE html>
<html lang="en">
@extends('layouts.app')
@section('content')
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="admin/genvendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="admin/genvendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="admin/genvendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="admin/genvendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="admin/genvendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="admin/genvendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="admin/genvendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="admin/genvendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="admin/genvendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../genbuild/css/custom.min.css" rel="stylesheet">

      <link href="{{asset('css/multi-select.css')}}" media="screen" rel="stylesheet" type="text/css"></link>
  </head>

   <body class="nav-md">
     <div>
       <div>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="panel-group">
            {!! Form::open(array('id'=>'firma_kayit','url'=>'form' ,'name'=>'kayit','method' => 'POST','files'=>true,
                                  'class' => 'form-horizontal form-label-left' ))!!}
            <div class="page-title">
              <div class="title_left">
                <h3>Üyelik Oluştur</h3>
              </div>
              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="clearfix"></div>


            <div class="row">


              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Firma Bilgileri<small>different form elements</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <!-- <form class="form-horizontal form-label-left" id="firma_kayit"> -->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Firma Adı</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="" name="firma_adi" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sektörler</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control deneme" name="sektor_id[]" id="custom-headers" multiple='multiple'>
                            @foreach($sektorler as $sektor)
                                    <option  value="{{$sektor->id}}" >{{$sektor->adi}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefon </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="0 (232) 000 00 00">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="il_id">İl</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="il_id" id="il_id">
                            <option selected disabled>İl Seçiniz</option>
                            @foreach($iller_query as $il)
                                   <option value="{{$il->id}}">{{$il->adi}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ilce_id">İlçe</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control"name="ilce_id" id="ilce_id" data-validation="required"
                                                          data-validation-error-msg="Lütfen bu alanı dolduurnuz!">
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="semt_id">Semt</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="semt_id" id="semt_id" >
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bireysel_firma_adres">Firma Adresi <span class="required"></span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea id="firma_adres" class="form-control" rows="3" ></textarea>
                        </div>
                      </div>

                      </br></br>

                      <div class="x_title">
                        <h2>Kullanıcı Bilgileri<small>different form elements</small></h2>
                        <div class="clearfix"></div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adi">Ad</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="adi" id="adi">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="soyadi">Soyad</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="soyadi" id="soyadi">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unvan">Ünvan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Admin Or Manager ?? askMeteHoca" name="unvan" id="unvan">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefonkisisel">Telefon</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="0 (539) 000 00 00" name="telefonkisisel" id="telefonkisisel">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_giris">E-Mail</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="abc@hotmail.com" name="email_giris" id="email_giris">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Şifre</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="password" class="form-control" placeholder="******" name="password" id="password" onkeyup="CheckPasswordStrength(this.value)"
                          data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"
                          data-toggle="tooltip">
                        </div>
                        <span id="password_strength"></span>
                        <span id="passwordmsg"></span>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">Şifre Onayla</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="password" class="form-control" placeholder="******" name="password_confirmation" id="password_confirmation" onkeyup="CheckPasswordStrength(this.value)"
                          data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"
                          data-toggle="tooltip">
                          <span id="confirmMessage" class="confirmMessage"></span>
                        </div>
                      </div>

                      </br></br>

                      <div class="x_title">
                        <h2>Fatura Bilgileri<small>different form elements</small></h2>
                        <div class="clearfix"></div>
                      </div>




                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Fatura Türü
                          <br>
                          <small class="text-navy">Normal Bootstrap elements</small>
                        </label>

                        <div class="col-md-9 col-sm-9 col-xs-12">

                          <div class="radio" id="adres_kopyalayici">
    <!-- There may be a problem about "adres_kopyalayici" -->
                            <label>
                              <input type="radio" name="fatura_tur" id="fatura_tur_kurumsal" checked> Kurumsal
                            </label>
                            <label>
                              <input type="radio" name="fatura_tur" id="fatura_tur_bireysel"> Bireysel
                            </label>

                          </br></br>
                            <div class="form-group">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="adres_kopyalayici" > "Firma Adresi" ile "Fatura Adresi" aynı
                                  </label>
                                </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatura_adres">Fatura Adresi <span class="required"></span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          {!! Form::textarea('fatura_adres', null,
                                          array('id' => 'fatura_adres',
                                                'class'=>'form-control',
                                                'placeholder'=>'Fatura Adresiniz',
                                                'data-validation' => 'required',
                                                'data-validation-depends-on' =>'fatura_tur',
                                                'data-validation-error-msg' => 'Lutfen bu alani doldurunuz'
                                                )) !!}
                          <!-- TextArea is like MultiLine TextBox. -->
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatura_il_id">İl</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="fatura_il_id" id="fatura_il_id">
                            @foreach($iller_query as $il)
                                   <option value="{{$il->id}}">{{$il->adi}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatura_ilce_id">İlçe</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="fatura_ilce_id" id="fatura_ilce_id">
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatura_semt_id">Semt</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="fatura_semt_id" id="fatura_semt_id">
                          </select>
                        </div>
                      </div>




                      <div id="div_kurumsal" name="div_kurumsal">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firma_unvan">Firma Ünvanı</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              {!! Form::text('firma_unvan', null,
                                              array('id' => 'firma_unvan',
                                                  'class'=>'form-control',
                                                  'placeholder'=>'Firma Ünvanı',
                                                  'data-toggle' => 'tooltip',
                                                  'data-validation' => 'required',
                                                  'data-validation-depends-on' =>'fatura_tur',
                                                  'data-validation-depends-on-value' => 'kurumsal',
                                                  'data-validation-error-msg'  => 'Lutfen bu alani doldurunuz'
                                               )) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vergi_no">Vergi No</label>
                            <div class="col-md-9 col-sm-9 col-xs-12" data-toggle="tooltip">
                              {!! Form::text('vergi_no', null,
                                              array('id' => 'vergi_no',
                                                'class'=>'form-control',
                                              'placeholder'=>'Vergi No',
                                              'data-toggle' => 'tooltip',
                                              'data-validation' => 'number length',
                                              'data-validation-length' => '10',
                                              'data-validation-depends-on' =>'fatura_tur',
                                              'data-validation-depends-on-value' => 'kurumsal',
                                              'data-validation-error-msg' => 'Lutfen bu alani doldurunuz',
                                              'data-validation-error-msg-length' => 'Lutfen 10 haneli numara giriniz'
                              )) !!}
                            </div>
                        </div>
                     </div>

                     <div id="div_bireysel" name="div_bireysel" style="display:none;">
<!-- style="display:none;" -->
                       <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ad_soyad">Ad Soyad</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                             {!! Form::text('ad_soyad', null,
                                             array('id' => 'ad_soyad',
                                             'class'=>'form-control',
                                             'placeholder'=>'Ad ve Soyadiniz',
                                             'data-validation' => 'required',
                                             'data-validation-depends-on' =>'fatura_tur',
                                             'data-validation-depends-on-value' => 'bireysel',
                                             'data-validation-error-msg' => 'Lutfen bu alani doldurunuz'
                             )) !!}
                           </div>
                       </div>

                       <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tc_kimlik">TC Kimlik No</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                             {!! Form::text('tc_kimlik', null,
                                             array('id' => 'tc_kimlik',
                                                   'class'=>'form-control',
                                                   'placeholder'=>'T.C Kimlik Numaraniz',
                                                   'maxlength'=>'11',
                                                   'data-validation' => 'tc_kimlik_dogrulama number length',
                                                   'data-validation-length' => 'min11',
                                                   'data-validation-depends-on' =>'fatura_tur',
                                                   'data-validation-depends-on-value' => 'bireysel',
                                                   'data-validation-error-msg-number' => 'Lutfen sayi giriniz',
                                                   'data-validation-error-msg-length' => 'Lutfen 11 haneli sayi giriniz'
                                             )) !!}
                           </div>
                       </div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vergi_daire_il">İl</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="form-control" data-validation = "required" data-validation-depends-on = "fatura_tur"
                        data-validation-depends-on-value = "kurumsal" name="vergi_daire_il" id="vergi_daire_il">
                          <option selected disabled>İl Seçiniz</option>
                          @foreach($iller_query as $il)
                                 <option value="{{$il->id}}">{{$il->adi}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vergi_daire">Vergi Dairesi</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="form-control" name="vergi_daire" id="vergi_daire"
                                data-validation = "required" data-validation-depends-on = "fatura_tur"
                                data-validation-depends-on-value = "kurumsal" data-validation-error-msg = "Lutfen Seciniz" required>
                        </select>
                      </div>
                    </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <!-- <button type="button" class="btn btn-primary">Cancel</button>
                          <button type="reset" class="btn btn-primary">Reset</button> -->
                          <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                      </div>
                    <!-- </form> -->
                  </div>
                </div>
              </div>
            </div>




            {!! Form::close() !!}

          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
      </div>
      </div>
        <!-- <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer> -->


        <!-- /footer content -->



    <!-- jQuery -->
    <script src="admin/genvendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="admin/genvendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="admin/genvendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="admin/genvendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="admin/genvendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="admin/genvendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="admin/genvendors/moment/min/moment.min.js"></script>
    <script src="admin/genvendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="admin/genvendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="admin/genvendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="admin/genvendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="admin/genvendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="admin/genvendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="admin/genvendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="admin/genvendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="admin/genvendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="admin/genvendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="admin/genvendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../genbuild/js/custom.min.js"></script>


    <script src="{{asset('js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/jquery.quicksearch.js')}}"></script>
    <script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <!-- Form Validation -->
    <!-- <script src="admin/genvendors/validator/firmaKayitFormValidator.js"></script> -->


    <script>
    /*
      19.07.2017 Oguzhan
      original_state_il   = fatura adresinin il kismini alan form elementinin klonunu tutar
      original_state_ilce = fatura adresinin ilce kismini alan form elementinin klonunu tutar.
      original_state_semt = fatura adresinin semt kismini alana form elemenetinin klonunu tutar.
    */
    var original_state_il;
    var original_state_ilce;
    var original_state_semt;
    $(document).ready(function(){
       $('#telefon').mask('(000) 000-00-00');//jQuery mask plug-in. sirket ve kisisel telefon form'larini maskeler.
       $('#telefonkisisel').mask('(000) 000-00-00');
       original_state_il= $("#fatura_il_id").clone(true);// Cagrilan elementin tam olarak orjinal halini klonlar.
       original_state_ilce = $("#fatura_ilce_id").clone(true);//True paramtresi klonlarken, elemente bagli evenleri de alir.
       original_state_semt = $("#fatura_semt_id").clone(true);

       $('#il_id').change(function (e) {
           console.log(e);
           var il_id = e.target.value;
           //ajax
           $.get("{{asset('ajax-subcat?il_id=')}}"+il_id, function (data) {
               //success data
               //console.log(data);
               beforeSend:( function(){
                   $('.ajax-loader').css("visibility", "visible");
               });
               $('#ilce_id').empty();
                $('#ilce_id').append('<option value="" selected disabled> Seçiniz </option>');
               $.each(data, function (index, subcatObj) {
                   $('#ilce_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
               });
           }).done(function(data){
                 $('.ajax-loader').css("visibility", "hidden");
               }).fail(function(){
                  alert('İller Yüklenemiyor !!!  ');
               });
       });


       $('#ilce_id').on('change', function (e) {
           console.log(e);
           var ilce_id = e.target.value;
           //ajax
           $.get("{{asset('ajax-subcatt?ilce_id=')}}"+ ilce_id, function (data) {
               beforeSend:( function(){
                   $('.ajax-loader').css("visibility", "visible");
               });
               $('#semt_id').empty();
               $('#semt_id').append('<option value="" selected disabled>Seçiniz </option>');
               $.each(data, function (index, subcatObj) {
                   $('#semt_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
               });
           }).done(function(data){
                 $('.ajax-loader').css("visibility", "hidden");
               }).fail(function(){
                  alert('İller Yüklenemiyor !!!  ');
               });
       });
       /* Oguzhan Ulucay 24.07.2017
           fatura adres icin eklendi
       */
       $('#fatura_il_id').on('change', function (e) {
           console.log(e);
           var il_id = e.target.value;
           //ajax
           $.get("{{asset('ajax-subcat?il_id=')}}"+il_id, function (data) {
               //success data
               //console.log(data);
               beforeSend:( function(){
                   $('.ajax-loader').css("visibility", "visible");
               });
               $('#fatura_ilce_id').empty();
                $('#fatura_ilce_id').append('<option value="" selected disabled> Seçiniz </option>');
               $.each(data, function (index, subcatObj) {
                   $('#fatura_ilce_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
               });
           }).done(function(data){
                 $('.ajax-loader').css("visibility", "hidden");
               }).fail(function(){
                  alert('İller Yüklenemiyor !!!  ');
               });
       });
       /* Oguzhan Ulucay 24.07.2017
           fatura adres icin eklendi
       */
       $('#fatura_ilce_id').on('change', function (e) {
           console.log(e);
           var ilce_id = e.target.value;
           //ajax
           $.get("{{asset('ajax-subcatt?ilce_id=')}}"+ ilce_id, function (data) {
               beforeSend:( function(){
                   $('.ajax-loader').css("visibility", "visible");
               });
               $('#fatura_semt_id').empty();
               $('#fatura_semt_id').append('<option value="" selected disabled>Seçiniz </option>');
               $.each(data, function (index, subcatObj) {
                   $('#fatura_semt_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
               });
           }).done(function(data){
                 $('.ajax-loader').css("visibility", "hidden");
               }).fail(function(){
                  alert('İller Yüklenemiyor !!!  ');
               });
       });
       /* Oguzhan Ulucay 18.07.2017 */
       $('#vergi_daire_il').on('change', function (e) {
           console.log(e);
           var vergi_daire_il = e.target.value;
           //ajax
           $.get("{{asset('vergi_daireleri?il_id=')}}"+vergi_daire_il, function (data) {
               //success data
               //console.log(data);
               beforeSend:( function(){
                   $('.ajax-loader').css("visibility", "visible");
               });
               $('#vergi_daire').empty();
               $('#vergi_daire').append('<option value="" selected disabled> Seçiniz </option>');
               $.each(data, function (index, subcatObj) {
                   $('#vergi_daire').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
               });
           }).done(function(data){
                 $('.ajax-loader').css("visibility", "hidden");
               }).fail(function(){
                  alert('Vergi dairesi Yüklenemiyor !!!  ');
               });
       });

       $('input[type=radio][name=fatura_tur]').change(function(){
           var form_kurumsal = document.getElementById('div_kurumsal');
           var form_bireysel = document.getElementById('div_bireysel');
           //Kurumsal form aktif degilse aktif eder.
           if(form_kurumsal.style.display === 'none'){
               form_bireysel.style.display = 'none';
               form_kurumsal.style.display = 'block';
           }
           //Bireysel form aktif degilse aktif eder.
           else{
             form_kurumsal.style.display = 'none';
             form_bireysel.style.display = 'block';
           }
       });

       $('#adres_kopyalayici').click(function copyTheAdress(){
         var flag_first_adrs_filled = false;
         var flag_second_adrs_empty = false;//flag_fields_empty
         var flag_return_original = false;
         var debug4 = $('#firma_adres').val();
         var debug5 = $('#semt_id').val();
         /*
           firma adresi dolu ise aktif et.
         */
         if($('#firma_adres').val()!="" &&
            $('#il_id').val() !=null      &&
            $('#ilce_id').val()!=null     &&
            $('#semt_id').val()!=null ){
              flag_first_adrs_filled = true;
            }
         var debug = $('#fatura_ilce_id').val();
         var debug2 = $('#fatura_adres').val();
         var debug3 = $('#fatura_il_id').val();
         /*
           fatura adresi bos ise
         */
         if( $('#fatura_adres').val()==""   &&
             $('#fatura_il_id').val()==null   &&
             $('#fatura_ilce_id').val()==null &&
             $('#fatura_semt_id').val()==null ){
               flag_second_adrs_empty = true;
             }
         /*
           fatura adresi dolu ise
       */
        if($('#fatura_adres').val()!=""   &&
            $('#fatura_il_id').val()!=null   &&
            $('#fatura_ilce_id').val()!=null &&
            $('#fatura_semt_id').val()!=null ){
              flag_return_original =true;
            }
         /*
           firma ve fatura adresi bos ise checkbox isaretlenmez.
         */
         if(flag_first_adrs_filled == false && flag_second_adrs_empty == true){
           $('#adres_kopyalayici').attr("checked",false);
         }
         /*
           firma adresi bos, fatura adresi dolu ise checkbox isaretlenmez.
         */
         else if(flag_first_adrs_filled == false && flag_second_adrs_empty == false){
           $('#adres_kopyalayici').attr("checked",false);
         }
         if( flag_first_adrs_filled == true && flag_second_adrs_empty == true){
             $('#fatura_adres').val( $('#firma_adres').val() );
         }else if(flag_return_original == true){
             $('#fatura_adres').val(null);
         }
         if(flag_first_adrs_filled == true && flag_second_adrs_empty == true){
           $('#fatura_il_id').val( $('#il_id').val() );
         }else if( flag_return_original == true){
           // Use this command if you want to keep divClone as a copy of "#some_div"
           $('#fatura_il_id').replaceWith(original_state_il.clone(true));// Restore element with a copy of divClone
         }
         if(flag_first_adrs_filled == true && flag_second_adrs_empty == true){
           $('#fatura_ilce_id').html( $('#ilce_id').html() );
           $('#fatura_ilce_id').val( $('#ilce_id').val() );
         }else if( flag_return_original == true){
           $('#fatura_ilce_id').replaceWith(original_state_ilce.clone(true)); // Restore element with a copy of divClone
         }
         if(flag_first_adrs_filled == true && flag_second_adrs_empty == true){
           $('#fatura_semt_id').html( $('#semt_id').html() );
           $('#fatura_semt_id').val( $('#semt_id').val() );
         }else if( flag_return_original == true ){
           $('#fatura_semt_id').replaceWith(original_state_semt.clone(true));
         }
       });

       $("#password").tooltip({
         title: "En az 6 karakter uzunlugunda; sayi, harf veya ozel karakter kombinasyonu giriniz.",
         // place tooltip on the right edge
         placement: "right",
         offset: [-2, 10],
         effect: "fade",
         opacity: 0.7
       });
       $("#unvan").tooltip({
          title: "Sirkette ki posizyonunuz",
          // place tooltip on the right edge
          placement: "right",
          offset: [-2, 10],
          effect: "fade",
          opacity: 0.7
        });
        $("#firma_unvan").tooltip({
           title: "Firmanizin adi",
           // place tooltip on the right edge
           placement: "right",
           offset: [-2, 10],
           effect: "fade",
           opacity: 0.7
         });
         alert("Tooltip1");
         $("#vergi_no").tooltip({
            alert("Tooltip2");
            title: "10 haneli sirket numaraniz.",
            // place tooltip on the right edge
            placement: "right",
            offset: [-2, 10],
            effect: "fade",
            opacity: 0.7
          });
          $("#vergi_no").tooltip({
             title: "10 haneli sirket numaraniz.",
             // place tooltip on the right edge
             placement: "right",
             offset: [-2, 10],
             effect: "fade",
             opacity: 0.7
           });
           $("#tc_kimlik").tooltip({
              title: "11 haneli T.C kimlik numaraniz.",
              // place tooltip on the right edge
              placement: "right",
              offset: [-2, 10],
              effect: "fade",
              opacity: 0.7
            });


    });
    // READY PARANTHESIS







    /*
      18-19.07.2017 Oguzhan
      selection header'a id eklendi.
      count_for_header degiskeni eklendi.
      afterSelect ve afterDeselect fonksiyonlarinda duzenleme yapildi.
      Duzenleme islevi:
      Sektorler secilirken Header'da ki degiskeni 1'er 1'er azaltir.
      Sektorlerin secimleri kaldirirken de ayni sekilde degiskeni artirir.
      count_for_header = Kac tane sektor secme hakki oldugunu tutar.
    */
    var count = 0;
    var count_for_header = 5;
    $('#custom-headers').multiSelect({
        selectableHeader: "</i><input type='text'  class='search-input col-sm-12 search_icon' autocomplete='off' placeholder='Sektör Seçiniz'></input>",
        selectionHeader: "<p id = 'sektor_count' style='font-size:12px;color:red'>Max '"+count_for_header+"' sektör seçebilirsiniz</p>",
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
          }else{
              count_for_header--;
          }
          $("#sektor_count").text("Max '"+count_for_header+"' sektör seçebilirsiniz");
          this.qs1.cache();
        },
        afterDeselect: function(values){
          count--;
          if(count!=5){
            count_for_header++;
            $("#sektor_count").text("Max '"+count_for_header+"' sektör seçebilirsiniz");
          }
          this.qs1.cache();
        }
    });
    function CheckPasswordStrength(password) {
        var password_strength = document.getElementById("password_strength");
        //TextBox left blank.
        if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
        }
        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.
        var passed = 0;
        var color = "";
        var strength = "";
        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }
        //Validate for length of Password.
        if (passed > 6 && password.length > 12) {
            passed++;
        }
        //Display status.
        switch (passed) {
            case 0:
            case 1:
                strength = "Zayıf";
                color = "red";
                break;
            case 2:
                strength = "İyi";
                color = "darkorange";
                break;
            case 3:
            case 4:
                strength = "Güçlü";
                color = "green";
                break;
            case 5:
                strength = "Çok Güçlü";
                color = "darkgreen";
                break;
        }
        var  password_deneme=$('#password').val().length;
        if(password_deneme<6){
            strength = "Şifre en az 6 karakterden oluşmalıdır işiş";
            color = "red";
        }
        password_strength.innerHTML = strength;
        password_strength.style.color = color;
    }
    function checkPass()
    {
        //Store the password field objects into variables ...
        var password = document.getElementById('password');
        var password_confirmation = document.getElementById('password_confirmation');
        //Store the Confimation Message Object ...
        var message = document.getElementById('confirmMessage');
        //Set the colors we will be using ...
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        //Compare the values in the password field
        //and the confirmation field
        if(password.value != '' && password.value == password_confirmation.value){//control of empty password value added -Oguzhan
            //The passwords match.
            //Set the color to the good color and inform
            //the user that they have entered the correct password
            password_confirmation.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "Şifre Eşleşti"
        }else if(password.value != ''){//control of empty password value added -Oguzhan
            //The passwords do not match.
            //Set the color to the bad color and
            //notify the user.
            password_confirmation.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "Şifre Eşleşmedi"
        }
    }
    /*
    21.07.2017 Oguzhan
    Eklemeler:
    Form data serialize edilmeden once maskelemeler kaldirilir daha sonra da
    tekrar maskeleme yapilir.
    */
    $("#firma_kayit").submit(function(e)
    {

       var postData, formURL;
       $('#telefon').unmask();//telefon verilerinin maskesini kaldirir.
       $('#telefonkisisel').unmask();
       postData = $(this).serialize();
       $('#telefon').mask('(000) 000-00-00');//telefon verisini tekrar maskeler
       $('#telefonkisisel').mask('(000) 000-00-00');
       formURL = $(this).attr('action');
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

                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                         $('#mesaj').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('firmaKayit')}}"}, 5000);
                    }
                    else{
                        $('#kayit_msg').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('/')}}"}, 5000);
                    }
                        e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
            e.preventDefault(); //STOP default action
    });
    /*
      Oguzhan Ulucay 18/07/2017
      T.C kimlik numarasi icin ozel validation.
      T.C kimlik numaralarinin basinda sifir olamaz.
      T.C kimlik numaralarinin sonunda tek sayi olamaz.
    */
    $.formUtils.addValidator
    ({
              name : 'tc_kimlik_dogrulama',
              validatorFunction : function(value, $el, config, language, $form) {
                if(value.substr(0,1) == 0)
                  return false;
                if(value.substr(10,1)%2 != 0)
                  return false;
                else{
                  return true;
                }
              },
              errorMessage : 'Lutfen T.C kimlik numaranizi giriniz',
              errorMessageKey: 'Lutfen gecerli T.C Kimlik No giriniz.'
    });
    $.validate({
        modules : 'location, date, security, file, logic',//18.7.17 Logic eklendi. -Oguzhan
        onModulesLoaded : function() {
          $('#country').suggestCountry();
        }
    });
    $('#presentation').restrictLength( $('#pres-max-length') );
    /*
      Oguzhan Ulucay 13/07/2017
      Fatura bilgileri kayit formu icin script.
      Fonksiyon radio buttonlara tiklanildiginda cagrilir.
      Tiklanilan buttona gore bireysel yada kurumsal
      fatura formlarin display ozelliklerini kapayip acar.
      form_kurumsal = kurumsal fatura form div elementi.
      form_bireysel = bireysel fatura form div elementi.
    */

    /*
      25-26.07.2017 Oguzhan Ulucay
      Sirket adresini form'un altinda yer alan fatura adresini kopyalama scripti.
      Checkbox'a basilmasi hallinde aktif olup yukarida ki ve asagida ki formlarin
      bosluk veya doluluk durumlarini kontrol edip kopyalama islemini gerceklestirir.
      flag_first_adrs_filled = Sirket adresinin tum fieldlarinin dolulugunu tutar.
      flag_second_adrs_empty = Fatura adresinin tum fieldlarinin boslugunu tutar.
      flag_return_original   = Fatura adresinin tum fieldlarinin dolulugunu tutar.
    */

    /*
      Oguzhan Ulucay 18.07.2017
      Tooltips
    */

    var email;
    var email_giris;
    function emailControl(){
        email = $('#email').val();
        emailGet();
    }
    function email_girisControl(){
         email_giris = $('#email_giris').val();
         email_girisGet();
    }
    function email_girisGet(){
                $.ajax({
                type:"GET",
                url:"{{asset('email_girisControl')}}",
                data:{email_giris:email_giris},
                cache: false,
                success: function(data){
                console.log(data);
                if(data==1){
                    $('#email2').bPopup({
                                speed: 650,
                                transition: 'slideIn',
                                transitionClose: 'slideBack',
                                autoClose: 5000
                            });
                    $('#email_giris').val("");
                }
             }
        });
    }
    function emailGet(){
                $.ajax({
                type:"GET",
                url:"{{asset('emailControl')}}",
                data:{email:email},
                cache: false,
                success: function(data){
                console.log(data);
                if(data==1){
                    $('#email1').bPopup({
                                speed: 650,
                                transition: 'slideIn',
                                transitionClose: 'slideBack',
                                autoClose: 5000
                            });
                    $('#email').val("");
                }
             }
        });
    }
    </script>


  </body>
  @endsection
</html>
