@extends('layouts.app')


  @section('head')
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
  @endsection

  @section('bodyAttributes')
    style="background-color: #fff;"
  @endsection

  @section('content')

   <body class="nav-md" style="background-color: #fff">


     <!-- <div>
       @if (count($errors) > 0)
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
       @endif
       <div> -->
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

                        <div class="col-md-9 col-sm-9 col-xs-12" name="firma_adi" value="{{ Request::old('firma_adi') }}">
                          {!! Form::text('firma_adi', null,
                                        array('class'=>'form-control',
                                        'placeholder'=>'Firma adı',
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'min1',
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                        <!-- Burayı if içine alıp birşeyler yapabilirsin -->
                                        <span class="help-block" style="color:red"> {{ $errors->first('firma_adi') }}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sektörler</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                          <select class="form-control deneme" name="sektor_id[]" id="custom-headers" multiple='multiple'value="{{1}}" data-validation = "required" data-validation-error-msg = "Lütfen Sektör Seçiniz">
                            @foreach($sektorler as $sektor)
                                    <option  value="{{$sektor->id}}">{{$sektor->adi}}</option>
                            @endforeach
                          </select>
                          <span class="help-block" style="color:red"> {{ $errors->first('sektor_id') }}</span>
                        </div>
                      </div>
                      <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefon </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          {!! Form::text('telefon', '5125119612',
                                        array('id' => 'telefon',
                                        'class'=>'form-control',
                                        'placeholder'=>'Telefonunuz',
                                        'data-validation'=>'length ',
                                        'data-validation-length'=>'min15',
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                          <span class="help-block" style="color:red"> {{ $errors->first('telefon') }}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="il_id">İl</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="il_id" id="il_id"
                          data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!" value="{{1}}">
                            <option selected disabled>İl Seçiniz</option>
                            @foreach($iller_query as $il)
                                   <option value="{{$il->id}}">{{$il->adi}}</option>
                            @endforeach
                          </select>
                          <span class="help-block" style="color:red"> {{ $errors->first('il_id') }}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ilce_id">İlçe</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control"name="ilce_id" id="ilce_id" data-validation="required"
                                                           data-validation-error-msg="Lütfen bu alanı dolduurnuz!"> <!--value= {{ Request::old('ilce_id') }} -->
                          </select>
                          <span class="help-block" style="color:red"> {{ $errors->first('ilce_id') }}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="semt_id">Semt</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="semt_id" id="semt_id"
                          data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                          </select>
                          <span class="help-block" style="color:red"> {{ $errors->first('semt_id') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bireysel_firma_adres">Firma Adresi <span class="required"></span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                          {!! Form::text('firma_adres', null,
                              array('id' => 'firma_adres',
                              'class'=>'form-control',
                              'placeholder'=>'Firmanizin adresi',
                              'data-validation' => 'required',
                              'data-validation-error-msg' => 'Lutfen bu alani doldurunuz'
                              )) !!}
                              <span class="help-block" style="color:red"> {{ $errors->first('firma_adres') }}</span>
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
                          {!! Form::text('adi', 'Özenç',
                                        array('class'=>'form-control',
                                        'placeholder'=>'Adınız',
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'min2',
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                        <span class="help-block" style="color:red"> {{ $errors->first('adi') }}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="soyadi">Soyad</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          {!! Form::text('soyadi', 'Çelik',
                                        array('class'=>'form-control',
                                        'placeholder'=>'Soyadınız',
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'min2',
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                        <span class="help-block" style="color:red"> {{ $errors->first('soyadi') }}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unvan">Ünvan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          {!! Form::text('unvan', 'ADmin',
                                        array('class'=>'form-control',
                                        'placeholder'=>'Ünvanınız',
                                        'data-toggle' => 'tooltip',
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'min2',
                                        'data-validation-error-msg'=>'LÜtfen bu alanı doldurunuz!')) !!}
                                        <span class="help-block" style="color:red"> {{ $errors->first('unvan') }}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefonkisisel">Telefon</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          {!! Form::text('telefonkisisel', '5380583230',
                                        array('id' => 'telefonkisisel',
                                        'class'=>'form-control',
                                        'placeholder'=>'Telefonunuz',
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'3-17',
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                        <span class="help-block" style="color:red"> {{ $errors->first('telefonkisisel') }}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_giris">E-Mail</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          {!! Form::email('email_giris', 'ozenc.celik@ceng.deu.edu.tr',
                                         array('id'=>'email_giris','class'=>'form-control email',
                                         'placeholder'=>'E-postanız' ,
                                         'onFocusout'=>'email_girisControl()',
                                         'data-validation'=>'email' ,
                                         'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                          <span class="help-block" id="email_error" style="color:red" onload="findPos()">{{ $errors->first('email_giris') }}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Şifre</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="password" class="form-control" placeholder="******" name="password" id="password" onkeyup="CheckPasswordStrength(this.value)"
                          data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"
                          data-toggle="tooltip" >
                            <span class="help-block" style="color:red"> {{ $errors->first('password') }}</span>
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
                            <span class="help-block" style="color:red"> {{ $errors->first('password_confirmation') }}</span>
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

                          <div class="radio">
                            <label>
                              <input type="radio" name="fatura_tur" id="fatura_tur_kurumsal" value="kurumsal" checked> Kurumsal
                            </label>
                            <label>
                              <input type="radio" name="fatura_tur" id="fatura_tur_bireysel" value="bireysel"> Bireysel
                            </label>

                              <span class="help-block" style="color:red"> {{ $errors->first('fatura_tur') }}</span>
                          </div>


                          </br></br>
                            <div class="form-group">
                                <div class="checkbox">
                                  <label>
                                    <input id="adres_kopyalayici" type="checkbox" name="adres_kopyalayici"> "Firma Adresi" ile "Fatura Adresi" aynı
                                  </label>
                                    <span class="help-block" style="color:red"> {{ $errors->first('adres_kopyalayici') }}</span>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="form-group fatura_adres_group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatura_adres">Fatura Adresi <span class="required"></span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          {!! Form::text('fatura_adres', null,
                                          array('id' => 'fatura_adres',
                                                'class'=>'form-control',
                                                'placeholder'=>'Fatura Adresiniz',
                                                'data-validation' => 'required',
                                                'data-validation-depends-on' =>'fatura_tur',
                                                'data-validation-error-msg' => 'Lutfen bu alani doldurunuz'
                                                )) !!}
                          <!-- TextArea is like MultiLine TextBox. -->
                            <span class="help-block" style="color:red"> {{ $errors->first('fatura_adres') }}</span>
                        </div>
                      </div>


                      <div class="form-group fatura_adres_group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatura_il_id">İl</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="fatura_il_id" id="fatura_il_id"
                          data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"
                          data-validation-depends-on="adres_kopyalayici" data-validation-depends-on-value="off">
                            @foreach($iller_query as $il)
                                   <option value="{{$il->id}}">{{$il->adi}}</option>
                            @endforeach
                          </select>
                            <span class="help-block" style="color:red"> {{ $errors->first('fatura_il_id') }}</span>
                        </div>
                      </div>

                      <div class="form-group fatura_adres_group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatura_ilce_id">İlçe</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="fatura_ilce_id" id="fatura_ilce_id"
                          data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"
                          data-validation-depends-on="adres_kopyalayici" data-validation-depends-on-value="off">
                        </select>
                          <span class="help-block" style="color:red"> {{ $errors->first('fatura_ilce_id') }}</span>
                        </div>
                      </div>

                      <div class="form-group fatura_adres_group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatura_semt_id">Semt</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="fatura_semt_id" id="fatura_semt_id"
                          data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"
                          data-validation-depends-on="adres_kopyalayici" data-validation-depends-on-value="off">
                          </select>
                            <span class="help-block" style="color:red"> {{ $errors->first('fatura_semt_id') }}</span>
                        </div>
                      </div>




                      <div id="div_kurumsal" name="div_kurumsal">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firma_unvan">Firma Ünvanı</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              {!! Form::text('firma_unvan', 'asad',
                                              array('id' => 'firma_unvan',
                                                  'class'=>'form-control',
                                                  'placeholder'=>'Firma Ünvanı',
                                                  'data-toggle' => 'tooltip',
                                                  'data-validation' => 'required',
                                                  'data-validation-depends-on' =>'fatura_tur',
                                                  'data-validation-depends-on-value' => 'kurumsal',
                                                  'data-validation-error-msg'  => 'Lutfen bu alani doldurunuz'
                                               )) !!}
                                                 <span class="help-block" style="color:red"> {{ $errors->first('firma_unvan') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vergi_no">Vergi No</label>
                            <div class="col-md-9 col-sm-9 col-xs-12" data-toggle="tooltip">
                              {!! Form::text('vergi_no', '1234567891',
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
                                <span class="help-block" style="color:red"> {{ $errors->first('vergi_no') }}</span>
                            </div>
                        </div>
                     </div>

                     <div id="div_bireysel" name="div_bireysel" style="display:none;">
<!-- style="display:none;" -->
                       <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ad_soyad">Ad Soyad</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                             {!! Form::text('ad_soyad', 'ÖZenç ÇElik',
                                             array('id' => 'ad_soyad',
                                             'class'=>'form-control',
                                             'placeholder'=>'Ad ve Soyadiniz',
                                             'data-validation' => 'required',
                                             'data-validation-depends-on' =>'fatura_tur',
                                             'data-validation-depends-on-value' => 'bireysel',
                                             'data-validation-error-msg' => 'Lutfen bu alani doldurunuz'
                             )) !!}
                               <span class="help-block" style="color:red"> {{ $errors->first('ad_soyad') }}</span>
                           </div>
                       </div>

                       <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tc_kimlik">TC Kimlik No</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                             {!! Form::text('tc_kimlik', '32629641654',
                                             array('id' => 'tc_kimlik',
                                                   'class'=>'form-control',
                                                   'placeholder'=>'T.C Kimlik Numaraniz',
                                                   'maxlength'=>'11',
                                                   'data-validation' => 'tc_kimlik_dogrulama number length',
                                                   'data-validation-length' => 'min11',
                                                   'data-validation-depends-on' =>'fatura_tur',
                                                   'data-validation-depends-on-value' => 'bireysel',
                                                   'data-validation-error-msg-number' => 'Lutfen sayi giriniz',
                                                   'data-validation-error-msg-length' => 'Lutfen 11 haneli sayi giriniz',
                                             )) !!}
                                               <span class="help-block" style="color:red"> {{ $errors->first('tc_kimlik') }}</span>
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
                          <span class="help-block" style="color:red"> {{ $errors->first('vergi_daire_il') }}</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vergi_daire">Vergi Dairesi</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="form-control" name="vergi_daire" id="vergi_daire"
                                data-validation = "required" data-validation-depends-on = "fatura_tur"
                                data-validation-depends-on-value = "kurumsal" data-validation-error-msg = "Lutfen Seciniz">
                        </select>
                          <span class="help-block" style="color:red"> {{ $errors->first('vergi_daire') }}</span>

                      </br>
                        <div class="form-group">
                          <div>
                            <input name="sözlesme_checkbox" type="checkbox" data-validation="required"
                              data-validation-error-msg="Devam etmek için sözleşmeyi onaylamalısınız.">
                              <button class="btn btn-link btn-xs sozlesme_goster" style="vertical-align: baseline;">Kullanıcı sözleşmesini okudum ve onaylıyorum.</button>
                            </input>
                            <span class="help-block" style="color:red"> {{ $errors->first('sözlesme_checkbox') }}</span>
                          </div>
                        </div>


                      </div>
                    </div>



                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <!-- <button type="button" class="btn btn-primary">Cancel</button>
                        <button type="reset" class="btn btn-primary">Reset</button> -->
                        <button type="submit" class="btn btn-primary">Kaydol</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="sozlesme_modal" class="modal fade in out" role="dialog">
              <div class="modal-dialog modal-lg" style="overflow-y: initial !important">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close sozlesme_kapat">&times;</button>
                    <h4 class="modal-title">KULLANICI SÖZLEŞMESİ</h4>
                  </div>

                  <fieldset style="display:block;">

                    <div style="overflow:auto; height:500px; border:2px solid #ebebeb; padding:15px 20px;">
                      KULLANICI SÖZLEŞMESİ (YAPIM AŞAMASINDADIR)<br>
                      1. TARAFLAR<br>
                      İşbu Kullanım Sözleşmesi (bundan böyle “Sözleşme” olarak anılacaktır); “Dokuz Eylül Üniversitesi Teknopark Depark Buca İzmir” adresinde mukim TAMREKABET... .... A.Ş. (bundan böyle kısaca "Tamrekabet" olarak anılacaktır) ile www.tamrekabet.com Portalına üye olmak için işbu Kullanım Sözleşmesi ile ayrılmaz parçası olan eklerine ve tamrekabet.com Portalında yer alan şartlar ile kurallara onay veren "Müşteri" arasında elektronik ortamda akdedilerek yürürlüğe girmiştir.<br>
                      Müşteri aşağıdaki kural ve şartlar ile bağlı olduğunu kabul eder. Bu şartlar altında Tamrekabet’e bilgi veren bütün çalışanların, Müşteri’yi temsil etmek amacıyla yetkiye sahip olması gerekmektedir.<br>
                      2. SÖZŞEMENİN KONUSU<br>
                      İşbu Sözleşme’nin konusunu, Tamrekabet’in www.tamrekabet.com internet sitesi üzerinden Müşteri’ye satın alma sürecnde teklif toplamak ve satış süreçlerinde teklif vermek için elektronik ortamda kendisine tanınan miktarlarda satın alma ilanı oluşturması, tedarikçi havuzunda tedarikçi araştırması yapması ve faaliyet gösterdiği alanlar için tamrekabet.com’a üye başka firmalar tarafından açılan satın alma ilanlarına teklif vermek için ilgili mevzuat hükümleri gereğince verdiği hizmete ait tarafların karşılıklı hak ve yükümlülüklerinin düzenlenmesi oluşturmaktadır.<br>
                      3. ÜYELİK ŞARTLARI<br>
                      3.1. Tamrekabet herhangi bir zamanda gerekçe göstermeden, bildirimde bulunmadan, tazminat, ceza vb. sair yükümlülüğü bulunmaksızın derhal yürürlüğe girecek şekilde işbu “Üyelik Sözleşmesi”ni tek taraflı olarak feshedebilir, Müşteri’nin Üyeliğine son verebilir veya geçici olarak durdurabilir. Portal da belirtilen kurallara aykırılık halleri, Müşteri’nin Tamrekabet bilgi güvenliği sistemine risk oluşturması halleri üyeliğe son verme veya üyeliği geçici durdurma hallerindendir.<br>
                      3.2. İşbu Üyelik Sözleşmesi Müşteri tarafından üyelik talebinin alınmasını takiben Tamrekabet adminlerinin Üyelik için onay verdiği tarihte yürürlüğe girer ve  Üyelik Sözleşmesi’nin devamı süresince yürürlükte kalır. Üyelik Sözleşmesi her ne sebeple olursa olsun sona erdiğinde Taraflarca hiçbir bildirime gerek kalmaksızın işbu Sözleşme de kendiliğinden sona erer.<br>
                      3.3. Müşteri, Tamrekabet’in kurumsal web sitesindeki (http://www.tamrekabet.com) kayıt formunu doldurarak Platform'a kayıt olur. Müşteri, form üzerine doğru detayları yazacağını ve bu detayları güncel tutacağını taahhüt eder.<br>
                      4 HİZMET KULLANIMI<br>
                      4.1. Müşteri’nin sadece;<br>
                      •	500 adet Satın Alım ilanı yayınlama<br>
                      •	1000 adet Firma Profili görüntüleme<br>
                      •	700 adet Tedarikçi Oluşturma<br>
                      •	200 adet Başvuru Yapma<br>
                      Hakkı vardır.<br>
                      4.2. İşbu Sözleşme’nin kurulması ile “İlan İşlemleri”, “Başvuru İşlemleri” ve Müşteri’nin istediği takdirde tedarikçilerini de davet edebildiği ‘’Firma Havuzu’’ modülleri, Müşteri’nin kullanımına açılacaktır.<br>
                      •	İlan İşlemleri Modülü: İlan verme modülü ile Müşteri işbu Sözleşme süresince satın almış olduğu 500(beşyüz) adet Satın Alım ilanını yayınlayabilir, yayındaki ilanın metninde değişiklik yapabilir, ilanı yayından kaldırabilir ve dilerse ilanı verirkenünvanını gizli tutatbilir.<br>
                      •	Başvuru İşlemleri Modülü: Müşteri, Başvuru İşlemleri modülü ile ticari olarak faaliyet gösterdiği sektör veya sektörler için yayınlanmış Satın Alma İlanlarını arayabilir ve başvurabilmesine uygun olan Satın Alma İlanlarına fiyat ve/veya bilgi vererek 200 adet başvuru gerçekleştirebilir.<br>
                      •	Firma Havuzu Modülü: Müşteri işbu Sözleşmeyle, ayrıca 1000(bin) adet firma profili görüntüleme hakkı satın alarak, görüntüleme hakkı miktarı kadar Firma Havuzu araştırması yapabilecektir. Firma Havuzu Modülü uyarınca Müşteri satın aldığı görüntüleme hakkı sayısı kadar Tamrekabet üzerinde aktif firma profili oluşturan tüm firmalar içinden, belirlediği Tamrekabet filtreleme kriterlerine göre firma profillerini eleminasyona tabi tutubilmektedir.<br>
                      1(bir) görüntüleme hakkı ile 1(bir) adet firma profili görüntülenebilir.<br>
                      Müşteri Firma Havuzu’nda bulunan Tamrekabet üyesi firmalar içinden veya kendisi tamrekabet.com üzerinden istediği firmaları davet ederek Firma Havuzu Modülü kapsamında 700(yediyüz) adet firmayı Tearikçi Listesi’ne tanımlayabilir<br>
                      Müşterinin, satın almış olduğu yukarıda tanımları ve adetleri verilmiş olan hizmetlerin Sözleşme geçerlilik süresi içinde kullanması esastır. Sözleşme süresi sonunda satın alınan tüm hizmetlerin kullanma hakkı da bitecektir.<br>
                      Müşteri’nin Üyelik Sözleşmesi uyarınca www.tamrekabet.com internet sitesi üzerinden sisteme erişimi mevcuttur. Bu kapsamda Müşteri’ye özel bir kullanıcı adı ve şifre tahsis edilmiştir. Müşteri kendisine tahsis edilmiş söz konusu kullanıcı adı ve şifreleri kullanarak Tamrekabet adminlerinin onay vermesine müteakip Yukarıda belirtilen Modüller’e erişebilecek ve Sözleşme’de belirtilen sayıda ve sözleşme süresince işlemeri yapabilecektir.<br>
                      4.3. Satın Alma İlanına teklif veren Müşteri’ler, Satın Alma İlanını açan Müşteri tarafından Platform'da tayin edilen mallar, hizmetler ve sorular için bilgi ve teklif sunar. Satın Alma ilanını açan Müşteri Satın Alma Sürecinin hüküm ve şartlarını belirler ve Platform'a iştirak eden Satın Alma ilanına teklif veren Müşteri’ler bu hüküm ve şartları üstlendiklerini kabul eder.<br>
                      4.4. Satın Alma İlanı açan Müşteri, İlanı yeniden açma, sona erdirme ya da iptal etme hakkını mahfuz tutar. Eğer Satın Alma İlanına teklif vererek katılmış herhangi bir Müşteri teklifini geri çekmek isterse veya Satın Alma Sürecinden geri çekilmek isterse teklif veren Müşteri Satın Alma İlanı açan Müşteri ile iletişime geçmelidir. Satın Alma İlanı açan Müşteri teklifi iptal etme ya da Satın Alma İlanına teklif veren Müşteriyi Satın Alma Sürecinden çıkartma hakkına sahiptir.<br>
                      4.5. Tamrekabet’in, web sitesine Müşteri tarafından girişi yapılan ilan ve ilan içeriğinde yer alan bilgileri kontrol etme mecburiyeti olmayıp, Tamrekabet, ilan içeriğindeki bilgilerin doğruluğu, güvenilirliği, eksiksizliği konusunda herhangi bir garanti vermez. Tamrekabet, websitesinin kullanılmasından ötürü özel satınalma ya da satış bürosu ya da  işveren olarak değerlendirilemez, her ne şekilde olursa olsun Müşteri’nin kararları ve/veya hataları nedeniyle sorumlu tutulamaz.<br>
                      4.6. Yayınlanan ilanda Müşteri tarafından faks numarası, e-posta, adres veya web adresi verilemez.<br>
                      4.7. Müşteri, yayınlarığı Satın Alma İlanlarına gelen teklifleri fiyata, performansa ve kalite kriterlerine göre değerlendirecektir. Müşteri, Satın alma ilanına en düşük fiyat teklifini veren diğer Müşteri ile  anlaşmak zorunda değildir.<br>
                      4.8. Satın Alma İlanı açan Müşteri Satın alma sürecinin sonunda Satın Alma İlanına konu olan iş için anlaşmaya vardığı tedarikçi eğer Satın Alma İlanına Platform üzerinden teklif verenbir Tamrekabet Müşterisi ise İlgili Satın Alma İlanının kazananı olarak bu Müşteriyi ‘’Kazananı Belirle’’ modülü üzerinden belirlemeyi taahhüt eder. Müşteri Kazananı 3 iş günü içerisinde belirlemediği takdirde Tamrekabet Müşteri’nin üyeliğini dondurma veya Üyelik Sözleşmesi’ni tazminatsız ve derhal fesih etme hakkı saklıdır. Bu halde Müşteri  Tamrekabet’ten ücret iadesi ile her ne ad altında olursa olsun hiçbir ücret, ek ödeme ve/veya tazminat talebinde bulunamayacaktır.<br>
                      4.9. Satın Alma İlanı’nı açan müşteri Satın Alma İlanına teklif veren Satın Alma süreci sonunda anlaşmaya varılan Müşteri hakkında Tamrekabet’te bulunan değerlendirme kriterlerine göre değerlendirme yapabilecektir. Satın alma ilanına teklif veren her müşteri Satın Alma Süreci sonunda anlaşmaya varıldığı takdirde bu değerlendirmeye tabi olacağının bilinciyle Satın Alma İlanına teklif vererek başvurur ve bu başvuru ile Müşteri kendisi hakkında yapılacak her türlü değerlendirmeyi kabul eder.<br>
                      4.10. Müşteri, Tamrekabet sayfalarında yayınlayacağı satın alma ilanında, bir ilan altında birden fazla sektörde Satın alma talebi duyuramayacağını kabul eder.<br>
                      5 YÜKÜMLÜLÜKLER<br>
                      5.1. Müşteri, Sözleşme konusu hizmetin temel nitelikleri, satış fiyatı ve ödeme şekli ile ilgili tüm ön bilgileri okuyup bilgi sahibi olduğunu ve elektronik ortamda gerekli teyidi verdiğini kabul ve beyan eder.<br>
                      5.2. Tamrekabet’in verdiği hizmet modelinde de, karar ve politikaları belirleyen Müşteri’dir. Tamrekabet, Platform sağlayıcı olarak hareket eder ve iletişimlerden, sözleşmelerden ve Müşteri ve diğer Tamrekabet üyesi firma arasındaki işten sorumlu değildir.<br>
                      5.3. Tamrekabet Müşteriler nezdinde mal ve hizmetlerin tedariğinden sorumlu değildir. Tamrekabet Satın Alma İlanı yayınlayan Müşteri ve bu Satın alma İlanına başvuran diğer Müşteri veya Müşteriler  arasındaki herhangi bir ticari şartın ya da sözleşmenin tarafı değildir. Ek olarak, Müşteri, tedarikçilerinin seçimini, onaylanmasını ve denetlemesini üstlenir.<br>
                      5.4. Tamrekabet hizmetleri Müşteri'nin gereksinimlerine göre kullanılabilir. Satın alma ve teklif verme süreçlerinin devamlılığı Tamrekabet’in sorumluluğunun dışındadır. Satın alma ilanını oluşturan Müşteri, Satın Alma Sürecinden sorumludur. Satın alma süreçlerinden kaynaklanan üçüncü tarafın tüm iddiaları için Tamrekabet’in zararı, Müşteri tarafından tazmin edilecektir.<br>

                      5.5.Firma Havuzu Tamrekabet’in asli ve en önemli malvarlığıdır. İşbu Sözleşme ile Tamrekabet tarafından Müşteri’ye verilen hizmet, Firma Havuzu’ndaki bilgilere erişim ve kullanım imkanıdır. Müşteri, Firma Havuzu ve içeriğinde yer alan bilgilerin sadece bünyesindeki işleri için tedarikçi bulma ihtiyacını karşılamak için kullanacaktır. Müşteri söz konusu amaç ile belirlenen usul dışında kullanımının, Tamrekabet  için telafisi imkansız zararlar oluşturacağını bildiğini peşinen kabul eder. Müşteri’nin bu yükümlülüğüne aykırı davranışı Sözleşme ile birlikte Üyelik Sözleşmesi’nin de ihlalini oluşturacaktır. Bu halde Tamrekabetin’in Sözleşme ile birlikte Üyelik Sözleşmesi’ni derhal ve tazminatsız fesih hakkı saklıdır. Bu halde Müşteri  Tamrekabet’ten ücret iadesi ile her ne ad altında olursa olsun hiçbir ücret, ek ödeme ve/veya tazminat talebinde bulunamayacaktır.<br>
                      5.6. Firma Havuzu ve Satın Alma İlan Bilgileri, Tamrekabet için asli ve en önemli malvarlığıdır. İşbu Sözleşme ile Tamrekabet tarafından Müşteri’ye verilen asli hizmet, Satın Alma İlanı yayınlayarak teklif toplamak, Firma Havuzundaki ve diğer firmaların Satın Alma ilanlarındaki bilgilere erişim kullanım ve teklif verme imkanıdır. Müşteri, Firma Havuzu ve Satın Alma İlanları içeriğinde yer alan bilgilerin sözleşmede belirlenen usuller dışında kullanımının, Tamrekabet için telafisi imkansız zararlar oluşturacağını bildiğini kabul eder. Bu nedenle müşteri, işbu Sözleşme’yi ihlal ettiği takdirde Tamrekabet’in müspet zararlarına ek olarak, yoksun kalınan kazancını da ödemeyi kabul, beyan ve taahhüt eder.<br>
                      5.7.Websitesindeki verilerin Tamrekabet’in bilgisi veya yazılı onayı dışında herhangi bir şekilde kopyalanması, çoğaltılması ve dağıtılması, Sözleşme amaçları dışında kullanılması halinde tüm sorumluluk Müşteri’ye ait olacaktır. Aksi halde Tamrekabet’in uğrayacağı her türlü zarar ve ziyandan Müşteri sorumlu olacaktır.<br>
                      5.8. Tamrekabet, web sitesi üzerinden görüntülenen Firma Profillerinin içeriğinden ve bu içerikte yer alan bilgilerin doğruluğundan hiçbir şekilde sorumlu değildir. Müşteri bu hususu peşinen kabul eder.<br>
                      5.9. Müşteri ilan edeceği satın alma talepleri ve firma profilindeki her türlü hatadan veya diğer firmalara aktarılacak yanlış bilgiden sorumludur. Ayrıca Müşteri, yayınlayacağı tüm satın alma ilan içeriklerinin yürürlükte olan mevzuata uygun olarak düzenlenmesinden bizzat ve tek sorumludur. İşbu sözleşmeye konu firma profili ve/veya ilan içeriği ile ilgili 3. kişilerin tüm taleplerinin muhatabı Müşteri olup, Müşteri bu konuda Tamrekabet’in hiçbir sorumluluğu olmadığını, kabul, beyan ve taahhüt eder.<br>
                      5.10. Müşteri işbu Sözleşme kapsamındaki yükümlülüklerini ihlal ettiği takdirde, Tamrekabet’in bu nedenle uğradığı zararı tazminle mükelleftir. Tamrekabet tarafından bu nedenle idari para cezası, vesair her ne nam altında olursa olsun ceza ve/veya tazminatların ödenmesi halinde, Tamrekabet’in Müşteri’ye rücu hakkı olup, Müşteri ilk yazılı talepte Tamrekabet’e derhal ve ferileri ile birlikte ödeme yapmayı kabul ve taahhüt eder.<br>
                      5.11. Satın Alma Süreci zamanında anlaşmazlık olduğu herhangi bir zamanda, Tamrekabet sunucu zamanı referans olacaktır. Müşteri bunun bilincinde olmalıdır ve Tamrekabet’in sunucu zamanına göre teklifte bulunmalıdır.<br>
                      5.12. Tamrekabet tarafından yerine getirilen bu sözleşmedeki faaliyetler ve hizmetler için gereken tüm yetki ve izinleri Müşteri verir ve Tamrekabet’in bu amaca ilişkin bütün gerekli ve uygun kararları alacağını kabul eder. Müşteri, Tamrekabet’in web sitesinde kullanılmak üzere adını, logosunu, markalarını coğaltma ve kullanma hakkını herhangi bir lisans ücretine tabi tutmadan Tamrekabet’e verir.<br>
                      5.13. Müşteri, Tamrekabet’e (i) üçüncü tarafın her türlü fikri mülkiyet hakkını içeren haklarının ihlali ve gasp etmeyi: (ii) iftira, hakaret ya da tehdit içeren ahlak ve örf ve adetlere karşı veya kanuna aykırı veya (iii) virüsler, “solucanlar”, “Trojan” veya diğer zarar verici özellikleri içeren herhangi bir program - veri yüklemeyeceğini kabul eder. Müşteri, Tamrekabet’i kanuna aykırı amaçlarla kullanmamayı veya bu tür amaçları fark edeceğini kabul eder. Tamrekabet, kendi takdirinde olarak bu hükümlere karşı olan Satın Alma İlan ve Süreçlerini iptal etme, silme ve değiştirme hakkını saklı tutar.<br>
                      6 DESTEK<br>
                      6.1. Tamrekabet, websitesinin veya internet iletişim ortamının hatasız ve kesintisiz çalışacağını garanti etmez. Websitesinin kullanılmasından dolayı Müşteri’nin donanım veya verilerinin bakım/onarım görmesi ya da değiştirilmesi gerektiği ya da bu konuda herhangi bir zarar oluştuğu takdirde ilgili harcamalardan Tamrekabet sorumlu tutulamaz.<br>
                      6.2. Tamrekabet, sayılanlarla sınırlı olmamak kaydı ile websitesinin hatalı kullanılmasından veya kullanım şartlarına uyulmaması sebebiyle ortaya çıkacak zararlardan, donanım, sistem yazılımı ve ağ ilişkili işlevden ortaya çıkacak arızalardan, iletişim ağı (network) tasarım ve bağlantı hatalarından, voltaj dalgalanmalarından, elektrik kesilmelerinden, virüs bulaşmasından ve benzeri çevresel faktörlerden doğacak zararlardan sorumlu değildir.<br>
                      6.3. Tamrekabet,  Müşteri Hizmetleri 0232 ... telefon numarası  veya musterihizmetleri@tamrekabet.com mail adresi aracılığı ile Müşteri’ye sistemin kullanımıyla ilgili telefonda veya e-posta yoluyla her türlü teknik desteği 09:00 – 18:00 (GMT+2) mesai saatleri içinde verecektir. Müşteri aynı numaradan ve e-posta adresinden talep ve şikayetlerini Tamrekabet’e iletebilir.<br>
                      6.4. Müşteriler Tamrekabet’in önceden belirlenen planlı bakım ve güncellemeleri durumunda bilgilendirilecektir.<br>
                      7 SÜRE<br>
                      Müşteri’nin üyeliği 180(yüz seksen) gündür. Bu süre Müşteri tarafından ödemenin tamamen gerçekleşip, Tamrekabet adminlerinin Müşteri’nin kullanımına onay vermesi ile başlar.<br>
                      Tamrekabet sayfalarında yayınlanan Satın Alma ilanlarının yayında kalma  süreleri, ilanın aktif duruma getirilmesinden itibaren, sözleşme üyelik süresi dahilinde olmak koşulu ile, 60(altmış ) gündür. Müşterinin üyelik süresinin bitimine 60(altmış ) günden daha az bir süre kaldığı durumlarda ilan yayınlanırsa, söz konusu ilan, üyelik süresi bitene kadar yayında kalacaktır, üyelik süresi sonunda otomatik olarak kapanacaktır. Ayrıca işbu madde kapsamında belirtilen 60(altmış ) günlük yayın süresi, müşterinin ilanı yayınladığı ilk günden itibaren işlemeye başlamakta ve kesintisiz olarak (ilan müşteri tarafından belirli bir süre pasife alınmış olsa dahi) 60(altmış ) gün sonunda son bulmaktadır. Müşteri Satın Alma İlanının yayınlandığı tarihten itibaren 7 gün içinde ve eğer hiçbir başka Müşteri teklif vermemiş ise ilan metninin içinde düzeltme yapılabilir.<br>
                      8 GİZLİLİK<br>
                      8.1. Tamrekabet’in Müşteri’ye hizmetin ifası için sağlayacağı hizmet şifresinin tahsis edileceği kişi veya firma yetkilisi, şifrenin gizliliğini korumakla sorumludur. Şifre gizliliğinin ihlali durumunda Tamrekabet işbu Sözleşme’yi tek taraflı olarak feshedebilme hakkını saklı tutar. Fesih halinde, Tamrekabet tarafından alınmış ücretler iade edilmez.<br>
                      8.2. Müşteri’nin , Tamrekabet üzerinden ulaştığı Tamrekabet’e üye diğer firma bilgilerini ve Tamrekabet’te diğer firmalar tarafından açılmış olan satın alma ilan bilgilerini 3. kişi veya kurumlarla paylaşması, bilgilerin gizliliği için gerekli tedbirleri almaması veya Tamrekabet’e üye diğer firmalara teklif isteme ve teklif verme dışında herhangi bir amaçla (eğitim pazarlama, tanıtım, vs) iletişim kurması durumunda  Tamrekabet işbu Sözleşmeyi tek taraflı feshedebilme hakkını saklı tutar. Müşteri, bu maddenin ihlali halinde doğabilecek sonuçlara katlanır veTamrebet’i her türlü sorumluluktan ari kılar.<br>
                      8.3. Müşteri’nin bu Sözleşme’de gizlilikle ilgili olarak vermiş olduğu taahhütler, Sözleşme’den bağımsız olarak, Sözleşme süresi ile sınırlı olmayıp, işbu Sözleşme her ne sebeple olursa olsun sona erdikten sonra da devam eder ve Sözleşme sona erdikten sonra meydana gelecek bir ihlal, Sözleşme’nin yürülükte olduğu süre içinde meydana gelmiş bir ihlalle aynı sonuçları doğurur.<br>
                      8.4. Müşteri, Tamrekabet.com sayfalarında yayınlayacağı Satın Alma İlanında, bir ilan altında birden fazla sektörde Satın Alma talebi duyuramayacağını aksi halde ilanının Tamrekabet tarafından kapatılacağını kabul eder. İşbu Sözleşme kapsamında Müşteri’ye, Tamrekabet kullanıcılarına ait kişisel veriler ve/veya özel nitelikli kişisel veriler aktarılmaktadır. Müşteri kendisine Tamrekabet aracılığı ile teklif veren kurumların yetkili kişilerinin ve/veya Firma Havuzu incelemesi sonucu ulaştığı kurumların yetkili kişilerinin kişisel verilerini ve/veya özel nitelikli kişisel verilerini sadece işbu sözleşme kapsamında, ticari iş amaçlı kullanmayı, kendisine aktarılan ve/veya Tamrekabet aracılığı ile elde ettiği kişisel verilerin güvenliğinden bizzat sorumlu olduğunu, Sözleşme sona erdikten sonra, işlenmiş veri varsa bunları derhal ortadan kaldırmayı ve hiçbir şekilde kullanmamayı, kendisine iletilen ve/veya kendisi tarafından elde edilen kişisel verilerin ve/veya özel nitelikli kişisel verilerin ticari iş amacı dışında başka amaçlarla ve/veya yürürlükteki mevzuata aykırı bir biçimde kullanılmasından dolayı Tamrekabet’e iletilecek 3. kişilerin ve/veya kurumların tüm taleplerinden bizzat sorumlu olacağını, bu konuda Tamrekabet’in hiçbir sorumluluğu olmadığını, Tamrekabet tarafından bu nedenle idari para cezası, vesair her ne nam altında olursa olsun ceza ve/veya tazminatların ödenmesi halinde, Tamrekabet’in kendisine rücu hakkı olduğunu, ilk yazılı talepte Tamrekabet’e derhal ve ferileri ile birlikte ödeme yapmayı kabul,beyan ve taahhüt eder.<br>
                      8.5. Müşterilerin kullanıcıları kişisel kullanıcı adı ve parolalarını güvenli ve gizli tutacaklarını taahhüt ederler. Bir kuruluşun bünyesinde veya dışında oturum açma detaylarının paylaşımı kesin suretle yasaklanmıştır ve bu tüm taraflar için önemli risklere yol açar. Oturum açma bilgisinin gizliliğinin ihlalinden doğan bütün zararlar bu oturum açma bilgisinden sorumlu taraf tarafından tazmin edilir.<br>
                      8.6. Müşteri, Tamrekabet’e Müşteri’nin faaliyetlerinden elde edilen verileri pazarlama amacıyla kullanabilmesi için onay verir. Gizli bilgiler Tamrekabet tarafından yayınlanamayacaktır.<br>
                      8.7. Müşteri kendi iş alanındaki kullanıcıların kullanıcı hesaplarını gizli ve özel tutmaktan sorumludur ve bu kullanıcı hesaplarını hiçbir üçüncü partiye vermeyeceğini ve ortaya çıkarmayacağını kabul eder. Müşteri’nin kullanıcı hesaplarının kullanıldığı süre boyunca verilen her ifade ve uygulanan her davranış ve ihmal için de Müşteri sorumludur. Tamrekabet, Müşteri’nin kullanıcı hesaplarını gizli tutmamasından meydana gelen herhangi bir güvenlik ihlalinden sorumlu tutulamaz. Müşteri kullanıcı hesaplarının kaybolması veya çalınması ya da bir şekilde kullanıcı hesaplarının gizliliğinin ihlaline inanırsa ya da Tamrekabet’i kullanıldığını anlarsa ya da bunlar için yetkisiz bir şekilde kullanılması ihtimali olması durumunda, Müşteri derhal Tamrekabet’i bilgilendireceğini kabul eder. Tamrekabet, Müşteri’nin kullanıcı hesaplarını ön bildirim ile iptal etme hakkını saklı tutar.<br>
                      8.8. Taraflar, üçüncü taraflardan gizlenmesi gereken tüm bilgileri gizli tutacağını taahhüt eder. Hukuken yanlarında bulundurmaları gereken belgeler hariç olmak üzere, taraflar anlaşmanın sona ermesiyle beraber, talep üzerine kendilerine verilmiş belgeleri gecikmeksizin iade veya imha etmeyi taahhüt ederler. Ayrıca, taraflar bu anlaşmanın konusuyla ilişkili olan çalışanlarının ve bağlı şirketlerinin de bu anlaşma kapsamındaki gizlilik yükümlülüğüne ve karşılıklı gizlilik hükmüne riayet etmelerini sağlar. Aksi halde, taraflar karşılıklı gizliliğe dair bu hükmü ihlal eden çalışanları/bağlı şirketleriyle beraber müştereken ve müteselsilen sorumlu olmayı kabul ederler.<br>
                      6.2 Gizlilik yükümlülüğü ve gizli bilgilerin kullanımı hükmü aşağıda belirtilen bilgileri kapsamaz:<br>
                      (i) Bilgiyi edinen tarafın ilgili bilgiyi karşı tarafın açıklamasından önce bildiğini ispatladığı bilgiler,<br>
                      (ii) Karşı tarafın hakları ihlal edilmeksizin, bilgiyi edinen tarafa üçüncü kişilerce sağlanan bilgiler,<br>
                      (iii) Bilgiyi edinen tarafın herhangi bir müdahalesi olmaksızın kamusal alana düşen bilgiler,<br>
                      (iv) Bilgiyi edinen tarafın yetkili hukuk gereği açıklamak zorunda olduğu bilgiler,<br>
                      (v) Menkul Kıymetler Hukuku kuralları kapsamında kamuya sunulan bilgiler ve gerekli veya tavsiye niteliğindeki ürün bilgileri.<br>
                      8.9. Bu anlaşma kapsamında taraflar arasındaki bilgi alışverişi, bu anlaşmanın uygulanması için gerekli bilgi ile sınırlıdır. Taraflar, fiyat ve pazarlama politikaları, kar marjı veya kullanım kapasitesi gibi rekabet açısından hassas nitelikte olan bilgi alışverişinde bulunmamalıdırlar.<br>
                      9 MÜLKİYET HAKLARI<br>
                      9.1. www.tamrekabet.com üzerindeki fikri mülkiyet haklarına ilişkin tüm haklar Tamrekabet’e aittir. Kullanıcıların bu hizmetin doğası gereği kullanmak zorunda oldukları haklar hariç, bu anlaşma fikri haklara dair herhangi bir hak veya lisans tanımaz.<br>
                      9.2. Tamrekabet, www.tamrekabet.com ve Tamrekabet markaları üzerindeki tüm mülkiyet ve tasarruf haklarına sahiptir. Bu anlaşmadaki hiçbir hüküm, Müşteri’ye mülkiyet, bağlantılı hak veya yetki sağlamaz. Müşteri, sadece www.tamrekabet.com’a münhasır olmayan ve sınırlı bir erişim hakkı elde eder. Bu erişim hakkı, alım işlemlerine dair kurum içi kullanım amacına dairdir ve bunları kullanım hakkını da ihtiva eder. Keza, bu hak, bu anlaşma süresince geçerlidir ve fakat başka kişilere temlik edilemez. Aksi kararlaştırılmadığı müddetçe, Müşteri, www.tamrekabet.com ve Tamrekabet markalarını veyahut bunların bir kısmını kullanamaz, çoğaltamaz, taklit edemez, geliştiremez, teşhir amaçlı kullanamaz, dağıtamaz, yayınlayamaz, dönüştüremez, değiştiremez ve bunlardan işleme eserler oluşturamaz. Dahası, Müşteri, bunlara dair alt-lisans veremez, bunları iletemez, devredemez, ticari amaçlarla kullanamaz veya başka benzer eylemlerde bulunamaz. Müşteri, www.tamrekabet.com’dan yetkili olarak aldığı tüm nüshaları, Tamrekabet’in telif hakları, ticari markası ve diğer mülkiyet haklarına dair olacak şekilde bandroller. Müşteri, bu bandrolleri silmemeli, ortadan kaldırmamalı, başka bandrollerle kaplamamalı veyahut bu bandrollerin üzerine herhangi bir işaret veya uyarı koymamalıdır. Müşteri, üçüncü tarafların, www.tamrekabet.com’dan gelen malzemeleri çoğaltmasına, kullanmasına veya teşhir amaçlı kullanmasına izin vermemelidir.<br>
                      10 DİĞER<br>
                      10.1. Tamrekabet muhtelif zamanlarda ihbarsız ve kendi takdirinde bu Şartları güncelleme ve değişirme hakkını saklı tutar. Müşteri değişiklikler için Tamrekabet’in kurumsal web sitesi olan http://www.tamrekabet.com’u kontrol etmek zorundadırlar.<br>
                      10.2. Gereken uyarlama ve değişiklikler ayrı ayrı değerlendirilecektir, sistemdeki önemli değişikliklere neden olan talepler ayrı şekilde fiyatlandırılabilecektir.<br>
                      10.3. Bu hükümlere yönelik değişiklikler, derhal yürürlüğe girer. www.tamrekabet.com’un değişikliklerden sonra Müşteri tarafından kullanılması durumunda, bu, Müşteri’nin yeni hükümlerle bağlı olmak istediği anlamına gelir.<br>
                      10.4. Müşteri, kayıt esnasında kendisi tarafından sunulan adreslerin kendisinin kalıcı adresleri olduğunu ve bu adreslerde meydana gelen değişiklikleri derhal Tamrekabet’e bildireceğini kabul eder. Aksi halde, sunulan adreslere yapılan bildirimler geçerli olacaktır.<br>
                      10.5. Tarafların bu anlaşma kapsamındaki haklarını, yetkilerini veyahut ayrıcalıklarını kullanmaması veya bunları geç kullanması, kendilerinin bunlardan feragat ettiği anlamına gelmez. Aynı şekilde, bu hak, yetki veyahut ayrıcalıkların kısmen kullanılması, kullanılmayan kısmın veya kullanılmayan diğer hak, yetki ve ayrıcalıkların artık kullanılamayacağı anlamını taşımaz. Bu anlaşma kapsamındaki hüküm ve şartlara dair hiçbir feragat, bu hüküm ve şartlardan sürekli feragat edildiği anlamını taşıyacak veya feragatin kapsamını genişletecek şekilde yorumlanamaz.<br>
                      10.6. Bu anlaşma, tarafların üzerinde anlaştığı her şeyi kapsar.Bu anlaşma, taraflar arasında daha önce bu anlaşmanın konusuna giren diğer tüm sözlü ve yazılı anlaşmaların yerine geçer.<br>
                      10.7. Bu anlaşmanın bir veya birkaç hükmünün yok veya geçersiz olması ve anlaşmanın geri kalanının görece daha büyük kalması durumunda, geri kalan hükümler geçerliliklerini korurlar. Aynı sonuç, bu anlaşmanın eksik kaldığı durumlar için de uygulanmalıdır. Yok hükmündeki veya geçersiz anlaşma hükmü, kendisine anlamsal ve amaçsal açıdan en yakın bir hükümle değiştirilir.<br>
                      11. SON HÜKÜMLER<br>
                      11.1.Taraflar, Sözleşme gereğince yapılacak her türlü bildirimin yazılı olması gerektiğini, ayrıca, aksi yazılı olarak bildirilmedikçe iş bu Sözleşme uyarınca verilen adreslerinin kanuni tebligat adresleri olduğunu beyan ile, bu adreslere yapılacak yazılı bildirimlerin kanunen geçerli tebligatın  tüm hukuki sonuçlarını doğuracağını kabul ederler.<br>
                      11.2. Taraflar, işbu sözleşmeden doğan hak ve alacaklarını üçüncü kişilere devir ve temlik etmeyeceğini kabul ve taahhüt eder.<br>
                      11.3. İşbu Sözleşme’den kaynaklanan uyuşmazlıkların çözümünde  İzmir Mahkemeleri ve İcra Daireleri yetkili kılınmıştır.<br>
                      İş bu Sözleşme 08.08.2017 tarihinde düzenlenmiştir.<br>

                    </div>

                  </fieldset>

                  <div class="form-group">
                    <button class="btn btn-primary col-md-offset-4 col-md-4 close sozlesme_kapat">Kapat</button>
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

    {{--bu include layouts/app'teki head'te de var ama buraya ulaşamıyor..?--}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>


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
                  console.log("data:");
                  console.log(data);
               });
       });


       $('#ilce_id').on('change', function (e) {
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


      $("#adres_kopyalayici").change(function(event){

        if (document.getElementById("adres_kopyalayici").checked)
          $(".fatura_adres_group").hide();

        else
          $(".fatura_adres_group").show();
      });

       /* Oguzhan Ulucay 24.07.2017
           fatura adres icin eklendi
       */
       $('#fatura_il_id').on('change', function (e) {
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

       /*$('#adres_kopyalayici').click(function copyTheAdress(){
         var flag_first_adrs_filled = false;
         var flag_second_adrs_empty = false;//flag_fields_empty
         var flag_return_original = false;
         var debug4 = $('#firma_adres').val();
         var debug5 = $('#semt_id').val();

           //firma adresi dolu ise aktif et.

         if($('#firma_adres').val()!="" &&
            $('#il_id').val() !=null      &&
            $('#ilce_id').val()!=null     &&
            $('#semt_id').val()!=null ){
              flag_first_adrs_filled = true;
            }
         var debug = $('#fatura_ilce_id').val();
         var debug2 = $('#fatura_adres').val();
         var debug3 = $('#fatura_il_id').val();

           //fatura adresi bos ise

         if( $('#fatura_adres').val()==""   &&
             $('#fatura_il_id').val()==null   &&
             $('#fatura_ilce_id').val()==null &&
             $('#fatura_semt_id').val()==null ){
               flag_second_adrs_empty = true;
             }

           //fatura adresi dolu ise

        if($('#fatura_adres').val()!=""   &&
            $('#fatura_il_id').val()!=null   &&
            $('#fatura_ilce_id').val()!=null &&
            $('#fatura_semt_id').val()!=null ){
              flag_return_original =true;
            }

           //firma ve fatura adresi bos ise checkbox isaretlenmez.

         if(flag_first_adrs_filled == false && flag_second_adrs_empty == true){
           $('#adres_kopyalayici').attr("checked",false);
         }

          // firma adresi bos, fatura adresi dolu ise checkbox isaretlenmez.

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
       });*/

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
         $("#vergi_no").tooltip({
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
        selectionHeader: "<p id = 'sektor_count' style='font-size:12px;color:green'>Lütfen Sektör Seçiniz</p>",
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
          count = $(".ms-selection").find(".ms-selected").length;
          if(count>5){
              $('#custom-headers').multiSelect('deselect', values);
          }
          $("#sektor_count").text(" '"+(5-count)+"' sektör seçebilirsiniz");
          this.qs1.cache();
        },
        afterDeselect: function(values){
          count = $(".ms-selection").find(".ms-selected").length;

          if(count!=5){
            $("#sektor_count").text(" '"+(5-count)+"' sektör seçebilirsiniz");
          }
          if(count==0){
            $("#sektor_count").text("Lütfen Sektör Seçiniz");
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

    $(".sozlesme_kapat").click(function (event){
      event.preventDefault();
      $("#sozlesme_modal").modal('hide');
    });

    $(".sozlesme_goster").click(function (event){
      event.preventDefault();
      $("#sozlesme_modal").modal('show');
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
        /*modules : 'location, date, security, file, logic',//18.7.17 Logic eklendi. -Oguzhan
        onModulesLoaded : function() {
          $('#country').suggestCountry();
        }*/
    });
    $('#presentation').restrictLength( $('#pres-max-length') );

    /*
    21.07.2017 Oguzhan
    Eklemeler:
    Form data serialize edilmeden once maskelemeler kaldirilir daha sonra da
    tekrar maskeleme yapilir.
    */


    $("#firma_kayit").submit(function(e)
    {
      var obj,curtop;
      var json;

      var postData, formURL;
      $('#telefon').unmask();//telefon verilerinin maskesini kaldirir.
      $('#telefonkisisel').unmask();
      postData = $(this).serialize();
      $('#telefon').mask('(000) 000-00-00');//telefon verisini tekrar maskeler
      $('#telefonkisisel').mask('(000) 000-00-00');
      formURL = $(this).attr('action');

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
          console.log(textStatus + "," + errorThrown);
          location.reload();

          window.scroll(0,0);//Kullanıcıların hatasını görebilmesi için sayfa başına yeniliyor.
        }
      });
      e.preventDefault(); //STOP default action
    });

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



  @endsection
