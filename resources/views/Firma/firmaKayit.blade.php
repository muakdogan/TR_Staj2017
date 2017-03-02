@extends('layouts.app')
<?php use App\IletisimBilgi; 
use App\Il;?>
@section('content')
<head>    
    <link rel="stylesheet" type="text/css" href="{{asset('css/firmaProfil.css')}}"/>
    <style>
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
        form .error {
                  color: #ff0000;
        }
    </style>
</head>
    <div class="container">
        <h1>TAMREKABET'E HOŞGELDİNİZ</h1>
        <h1>ÜYELİK OLUŞTUR</h1>
        <br>
        <div class="row">
            <div  class="col-lg-6">
                <div  class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-body"> 
                            {!! Form::open(array('url'=>'form' ,'name'=>'kayit','method' => 'POST','files'=>true))!!}
                            <div class="row">
                                <h5><strong>Firma Bilgileri</strong></h5>
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                        {!! Form::label('Firma adı') !!}
                                        </div> 
                                        <div class="col-sm-1">:</div> 
                                        <div class="col-sm-8">
                                        {!! Form::text('firma_adi', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'Firma adı',
                                        'data-validation'=>'length alphanumeric', 
                                        'data-validation-length'=>'3-12', 
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-sm-3">
                                        {!! Form::label('Sektorler') !!}
                                        </div> 
                                        <div class="col-sm-1">:</div> 
                                        <div class="col-sm-8">
                                            <select class="form-control" name="sektor_id" id="sektor_id" data-validation="required" 
                                                  data-validation-error-msg="Lütfen bu alanı doldurunuz!" >
                                                <option selected disabled>Seçiniz</option>
                                                @foreach($sektorler as $sektor)
                                                <option  value="{{$sektor->id}}" >{{$sektor->adi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                          <div class="col-sm-3">
                                        {!! Form::label('Telefon') !!}
                                          </div>
                                        <div class="col-sm-1">:</div> 
                                        <div class="col-sm-8">
                                        {!! Form::text('telefon', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'Telefonunuz',
                                        'data-validation'=>'length alphanumeric', 
                                        'data-validation-length'=>'3-12', 
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                        <label for="">İl</label>
                                        </div>
                                        <div class="col-sm-1">:</div> 
                                            <div class="col-sm-8">
                                                <select class="form-control input-sm" name="il_id" id="il_id" data-validation="required" 
                                                      data-validation-error-msg="Lütfen bu alanı doldurunuz!" >
                                                    <option  value="Seçiniz" selected disabled>Seçiniz</option>
                                                    @foreach($iller as $il)
                                                    <option value="{{$il->id}}">{{$il->adi}}</option>
                                                    @endforeach
                                                </select>
                                            <div class="ajax-loader">
                                                <img src="{{asset('images/200w.gif')}}" class="img-responsive" />
                                           </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">İlçe</label>
                                    </div>
                                    <div class="col-sm-1">:</div> 
                                        <div class="col-sm-8">
                                            <select class="form-control input-sm" name="ilce_id" id="ilce_id" data-validation="required" 
                                                                            data-validation-error-msg="Lütfen bu alanı dolduurnuz!">
                                              <option selected disabled>Seçiniz</option>
                                            </select> 
                                    </div>
                                </div>
                                    <div class="form-group">
                                 <div class="col-sm-3">   
                                    <label for="">Semt</label>
                                 </div>
                                  <div class="col-sm-1">:</div> 
                                        <div class="col-sm-8">
                                            <select class="form-control input-sm" name="semt_id" id="semt_id"  data-validation="required" 
                                                   data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                                <option selected disabled>Seçiniz</option>   
                                            </select> 
                                        </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                            <h5><strong>Kişiler Bilgiler</strong></h5>
                            <hr>
                                <div class="form-group">
                                <div class="col-sm-3">   
                                    {!! Form::label('Adınız') !!}
                                </div>
                                 <div class="col-sm-1">:</div> 
                                    <div class="col-sm-8">
                                        {!! Form::text('adi', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'Adınız',
                                        'data-validation'=>'length alphanumeric', 
                                        'data-validation-length'=>'3-12', 
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3"> 
                                    {!! Form::label('Soyadınız') !!}
                                    </div>
                                     <div class="col-sm-1">:</div> 
                                    <div class="col-sm-8">
                                        {!! Form::text('soyadi', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'Soyadınız',
                                        'data-validation'=>'length alphanumeric', 
                                        'data-validation-length'=>'3-12', 
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-3"> 
                                        {!! Form::label('unvan') !!}
                                   </div>
                                     <div class="col-sm-1">:</div> 
                                    <div class="col-sm-8">
                                        {!! Form::text('unvan', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'Ünvanınız',
                                        'data-validation'=>'length alphanumeric', 
                                        'data-validation-length'=>'3-12', 
                                        'data-validation-error-msg'=>'LÜtfen bu alanı doldurunuz!')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                      <div class="col-sm-3"> 
                                        {!! Form::label('E-posta') !!}
                                     </div>
                                    <div class="col-sm-1">:</div> 
                                    <div class="col-sm-8">
                                        {!! Form::email('email', null, 
                                        array('id'=>'email',
                                        'class'=>'form-control', 
                                        'placeholder'=>'E-postanız',
                                        'onFocusout' =>'emailControl()',
                                        'data-validation'=>'email',
                                         'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3"> 
                                         {!! Form::label('Telefon') !!}
                                    </div>
                                    <div class="col-sm-1">:</div> 
                                    <div class="col-sm-8">
                                        {!! Form::text('telefonkisisel', null, 
                                        array( 'class'=>'form-control', 
                                        'placeholder'=>'Telefonunuz',
                                        'data-validation'=>'length alphanumeric', 
                                        'data-validation-length'=>'3-12', 
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                     </div>
                                </div>
                            </div>
                            <br> 
                            <div class="row">
                            <h5><strong>Giriş Bilgilerinizi Oluşturun</strong></h5>
                            <hr>
                            <div class="form-group">
                                  <div class="col-sm-3"> 
                                    {!! Form::label(' Kullanıcı Adı') !!}
                                  </div>
                                  <div class="col-sm-1">:</div> 
                                    <div class="col-sm-8">
                                        {!! Form::text('kullanici_adi', null, 
                                        array('class'=>'form-control', 
                                        'placeholder'=>'Kullanıcı Adı',
                                        'data-validation'=>'length alphanumeric', 
                                        'data-validation-length'=>'3-12', 
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!' )) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                    {!! Form::label('Email') !!}
                                    </div>
                                       <div class="col-sm-1">:</div> 
                                    <div class="col-sm-8">
                                        {!! Form::email('email_giris', null, 
                                          array('class'=>'form-control email', 
                                        'placeholder'=>'E-postanız' ,
                                        'onFocusout'=>'emailControl()',
                                        'data-validation'=>'email' ,
                                         'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                    {!! Form::label('Şifre') !!}
                                     </div>
                                    <div class="col-sm-1">:</div> 
                                    <div class="col-sm-8">
                                        {!! Form::password('password', null, 
                                        array( 'class'=>'form-control', 
                                        'placeholder'=>'Şifre',
                                        'data-validation'=>'strength' ,
                                        'data-validation-strength'=>'6')) !!}
                                     </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-3">
                                    {!! Form::label('Şifre Tekrar') !!}
                                    </div>
                                    <div class="col-sm-1">:</div> 
                                    <div class="col-sm-8">
                                        {!! Form::password('password_confirmation', null, 
                                         array('class'=>'form-control', 
                                        'placeholder'=>'Şifre Tekrar',
                                        'data-validation'=>'confirmation')) !!}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div style="float:right" class="row">
                                <div class="form-group">
                                     <button class="btn btn-primary" type="submit">Kaydet!</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div> 
                </div>
            </div>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
            <div class="col-lg-6">
     
            </div> 
    </div>
   </div>
<script>

$.validate({
    modules : 'location, date, security, file',
    onModulesLoaded : function() {
      $('#country').suggestCountry();
    }
  });
  $('#presentation').restrictLength( $('#pres-max-length') );


var email; 
function emailControl(){
     email = $('#email').val();
    emailGet();
} 
function emailGet(){
            $.ajax({
            type:"GET",
            url:"/tamrekabet/public/emailControl",
            data:{email:email},
            cache: false,
            success: function(data){
            console.log(data);
            if(data==1){
                alert("BU EMAİL SİSTEME KAYITLIDIR.BAŞKA EMAİL İLE TEKRAR DENEYİNİZ");
                $('#email').val("");
            }   
         }
    });
} 
$('#il_id').on('change', function (e) {
    console.log(e);

    var il_id = e.target.value;
    //ajax
    $.get('/tamrekabet/public/index.php/ajax-subcat?il_id=' + il_id, function (data) {
        //success data
        //console.log(data);
        
        beforeSend:( function(){
            $('.ajax-loader').css("visibility", "visible");
        });
   
        $('#ilce_id').empty();
         $('#ilce_id').append('<option value=""> Seçiniz </option>');
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
    $.get('/tamrekabet/public/index.php/ajax-subcatt?ilce_id=' + ilce_id, function (data) {
        
        beforeSend:( function(){
            $('.ajax-loader').css("visibility", "visible");
            alert("yukleniyor");
        });
        
        $('#semt_id').empty();
        $('#semt_id').append('<option value=" ">Seçiniz </option>');
        $.each(data, function (index, subcatObj) {
            $('#semt_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
        });
    }).done(function(data){
                       
          $('.ajax-loader').css("visibility", "hidden");
        }).fail(function(){ 
           alert('İller Yüklenemiyor !!!  ');
        });
});
</script>
@endsection