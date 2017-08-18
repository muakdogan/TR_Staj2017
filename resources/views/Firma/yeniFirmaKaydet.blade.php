@extends('layouts.app')
@section('content')
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
                  color: #000000;
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
 <div class="container">     
        <h1>YENİ FİRMA OLUŞTUR</h1>
        <br>
        <div class="row">
            <div  class="col-lg-6">
                <div  class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        {!! Form::open(array('id'=>'yeni_kayit','url'=>'yeniFirma/'.$kullanici_id->id ,'method' => 'POST','files'=>true))!!}
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
             <script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
            <div class="col-lg-6">
            </div> 
        </div>
         <div id="mesaj" class="popup">
            <span class="button b-close"><span>X</span></span>
            <h2 style="color:red"> Üzgünüz.. !!!</h2>
            <h3>Sistemsel bir hata oluştu.Lütfen daha sonra tekrar deneyin</h3>
        </div>
         <div  id="kayit_msg"  class='popup'>
            <span class="button b-close"><span>X</span></span>
            <p style="color:green;font-size:18px">Bilgilendirme</p>
            <p style="font-size:12px">Firmanız Kayıt edilmiştir.</p>
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
        
        
        
$('#il_id').on('change', function (e) {
    console.log(e);

    var il_id = e.target.value;
    
    //ajax
    
    $.get("{{asset('ajax-subcat?il_id=')}}" + il_id, function (data) {
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
     
    $.get("{{asset('ajax-subcatt?ilce_id=')}}" + ilce_id, function (data) {
        
        beforeSend:( function(){
            $('.ajax-loader').css("visibility", "visible");
           
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
$('#semt_id').on('change', function (e) {
    console.log(e);

    var semt_id = e.target.value;

    //ajax
   
    $.get("{{asset('ajax-subcattt?semt_id=')}}" + semt_id, function (data) {
        
          beforeSend:( function(){
            $('.ajax-loader').css("visibility", "visible");
           
        });
        $('#semt_id').empty();
        $.each(data, function (index, subcatObj) {
            $('#semt_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
        });
    }).done(function(data){  
          $('.ajax-loader').css("visibility", "hidden");
        }).fail(function(){ 
           
        });
});
var kullaniciId='{{$kullanici_id->id}}';
$("#yeni_kayit").submit(function(e)
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
                        setTimeout(function(){ location.href="{{asset('yeniFirmaKaydet')}}"}, 5000);
                    }
                    else{
                        $('#kayit_msg').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000 
                        });
                       
                        setTimeout(function(){ location.href="{{asset('/')}}"}, 1000);
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






</script>
@endsection