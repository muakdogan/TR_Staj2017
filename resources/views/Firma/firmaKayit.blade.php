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
    </style>
</head>
    <div class="container">
        
        <h1>TAMREKABET'E HOŞGELDİNİZ</h1>
        <h1>ÜYELİK OLUŞTUR</h1>
        <div class="row">
            <div class="col-lg-6">
                {!! Form::open(array('url'=>'form' ,'method' => 'POST','files'=>true))!!}
               
                    <h3>Firma Bilgileri</h3>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-3">
                         
                        {!! Form::label('Firma adı') !!}
                        </div> 
                        <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                        {!! Form::text('firma_adi', null, 
                        array('required', 
                        'class'=>'form-control', 
                        'placeholder'=>'Firma adı')) !!}
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-3">
                        {!! Form::label('Sektorler') !!}
                        </div> 
                        <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            <select class="form-control" name="sektor_id" id="sektor_id" required>
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
                        array('required', 
                        'class'=>'form-control', 
                        'placeholder'=>'Telefonunuz')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-3">
                    <label for="">İl</label>
                    </div>
                    <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            <select class="form-control input-sm" name="il_id" id="il_id" required>
                                <option selected disabled>Seçiniz</option>
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
                            <select class="form-control input-sm" name="ilce_id" id="ilce_id" required>
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
                            <select class="form-control input-sm" name="semt_id" id="semt_id" required>
                                <option selected disabled>Seçiniz</option>   
                            </select> 
                        </div>
                </div>
                <br>
                <hr>
                <h3>Kişiler Bilgiler</h3>
                <hr>
                <div class="form-group">
                    <div class="col-sm-3">   
                        {!! Form::label('Adınız') !!}
                    </div>
                     <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            {!! Form::text('adi', null, 
                            array('required', 
                            'class'=>'form-control', 
                            'placeholder'=>'Adınız')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3"> 
                        {!! Form::label('Soyadınız') !!}
                        </div>
                         <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            {!! Form::text('soyadi', null, 
                            array('required', 
                            'class'=>'form-control', 
                            'placeholder'=>'Soyadınız')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-3"> 
                            {!! Form::label('unvan') !!}
                       </div>
                         <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            {!! Form::text('unvan', null, 
                            array('required', 
                            'class'=>'form-control', 
                            'placeholder'=>'Ünvanınız')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                          <div class="col-sm-3"> 
                            {!! Form::label('E-posta') !!}
                         </div>
                        <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            {!! Form::email('email', null, 
                            array('required', 
                            'class'=>'form-control', 
                            'placeholder'=>'E-postanız')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3"> 
                             {!! Form::label('Telefon') !!}
                        </div>
                        <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            {!! Form::text('telefonkisisel', null, 
                            array('required', 
                            'class'=>'form-control', 
                            'placeholder'=>'Telefonunuz')) !!}
                         </div>
                    </div>
                <br>   
                <hr>
               
                <h3>Giriş Bilgilerinizi Oluşturun</h3>
                <hr>
                  <div class="form-group">
                      <div class="col-sm-3"> 
                        {!! Form::label(' Kullanıcı Adı') !!}
                      </div>
                      <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            {!! Form::text('kullanici_adi', null, 
                            array('required', 
                            'class'=>'form-control', 
                            'placeholder'=>'Kullanıcı Adı')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                        {!! Form::label('Email') !!}
                        </div>
                           <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            {!! Form::email('email', null, 
                              array('required', 
                            'class'=>'form-control email', 
                            'placeholder'=>'E-postanız' , 'onFocusout'=>'emailControl();')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                        {!! Form::label('Şifre') !!}
                         </div>
                        <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            {!! Form::password('password', null, 
                            array('required', 
                            'class'=>'form-control', 
                            'placeholder'=>'Şifre')) !!}
                         </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-3">
                        {!! Form::label('Şifre Tekrar') !!}
                        </div>
                        <div class="col-sm-1">:</div> 
                        <div class="col-sm-8">
                            {!! Form::password('password_confirmation', null, 
                            array('required', 
                            'class'=>'form-control', 
                            'placeholder'=>'Şifre Tekrar')) !!}
                        </div>
                    </div>
            
                <br>
                <br>
                <br>
                <br>
                <div class="form-group">
                    {!! Form::submit('Kaydet!', 
                    array('class'=>'btn btn-primary')) !!}
                </div>

                {!! Form::close() !!}
            </div>
            <div class="col-lg-6">

            </div>
            
        </div>
    </div>

<script>
    
var email; 
function emailControl(){
   alert("girdi");
     email = $('.email').val();
     alert(email);
     func();

} 
function func(){
                    
            $.ajax({
            type:"GET",
            url:"../emailControl",
            data:{email:email
       
            },
            cache: false,
            success: function(data){
            console.log(data);
           
            if(data==1){
                alert("BU EMAİL SİSTEME KAYITLIDIR.BAŞKA EMAİL İLE TEKRAR DENEYİNİZ");
                $('.email').val("");
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