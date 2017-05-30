@extends('layouts.ui')
@section('content')
<head>
    <link rel="stylesheet" type="text/css" href="{{asset('css/firmaProfil.css')}}"/>
    <link href="{{asset('css/multi-select.css')}}" media="screen" rel="stylesheet" type="text/css"></link>
    </head>
    <div class="container">
        <h1>ÜYELİK OLUŞTUR</h1>
        <br>
        <div class="row">
            <div  class="col-lg-6">
                <div  class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="ui dividing header">Shipping Information</h4>
                            {!! Form::open(array('id'=>'firma_kayit','url'=>'form' ,'name'=>'kayit','method' => 'POST','files'=>true))!!}
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
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'min1',
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-sm-3">
                                        {!! Form::label('Sektörler') !!}
                                        </div>
                                        <div class="col-sm-1">:</div>
                                        <div class="col-sm-8">
                                          <select class="form-control deneme"   name="sektor_id[]" id="custom-headers" multiple='multiple' >
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
                                        'data-validation'=>'length ',
                                        'data-validation-length'=>'min2',
                                        'data-validation-error-msg'=>'Lütfen bu alanı doldurunuz!')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                          <div class="col-sm-3">
                                            {!! Form::label('Firma E-posta') !!}
                                         </div>
                                        <div class="col-sm-1">:</div>
                                        <div class="col-sm-8">
                                            {!! Form::email('email', null,
                                            array('id'=>'email',
                                            'class'=>'form-control',
                                            'placeholder'=>'E-postanız',
                                            'data-validation'=>'email',
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
                                                    @foreach($iller_query as $il)
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
                            <h5><strong>Kişisel  Bilgiler</strong></h5>
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
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'min2',
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
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'min2',
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
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'min2',
                                        'data-validation-error-msg'=>'LÜtfen bu alanı doldurunuz!')) !!}
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
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'3-17',
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
                                        'data-validation'=>'length',
                                        'data-validation-length'=>'min2',
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
                                         array('id'=>'email_giris','class'=>'form-control email',
                                         'placeholder'=>'E-postanız' ,
                                         'onFocusout'=>'email_girisControl()',
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
                                         <input type="password" name="password" id="password" class="form-control" placeholder='Şifre' onkeyup="CheckPasswordStrength(this.value)"data-validation="required"
                                                   data-validation-error-msg="Lütfen bu alanı doldurunuz!" />
                                         <span id="password_strength"></span>
                                         <span id="passwordmsg"></span>

                                     </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-3">
                                    {!! Form::label('Şifre Tekrar') !!}
                                    </div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-8">

                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder='Şifre Tekrar'  onfocusout="checkPass(); return false;" data-validation="required"
                                                   data-validation-error-msg="Lütfen bu alanı doldurunuz!"/>

                                        <span id="confirmMessage" class="confirmMessage"></span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div style="float:right" class="row">
                                <div class="form-group">
                                     <button class="btn btn-primary"  type="submit">Kaydet!</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{asset('js/jquery.multi-select.js')}}" type="text/javascript"></script>
            <script type="text/javascript" src="{{asset('js/jquery.quicksearch.js')}}"></script>
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
         <div id="email2"  class='popup'>
            <span class="button b-close"><span>X</span></span>
            <p style="color:red;font-size:18px"> Üzgünüz..!!!</p>
            <p style="font-size:12px">Bu email sistemimize kayıtlıdır.Lütfen başka email ile tekrar deneyiniz.</p>
        </div>
         <div  id="email1"  class='popup'>
            <span class="button b-close"><span>X</span></span>
            <p style="color:red;font-size:18px"> Üzgünüz..!!!</p>
            <p style="font-size:12px">Bu email sistemimize kayıtlıdır.Lütfen başka email ile tekrar deneyiniz.</p>
        </div>
         <div  id="kayit_msg"  class='popup'>
            <span class="button b-close"><span>X</span></span>
            <p style="color:green;font-size:18px">Bilgilendirme</p>
            <p style="font-size:12px">Kayıdınız Alınmıştır Lütfen E-mailinizi Kontrol ediniz. </p>
        </div>
   </div>


<script charset="utf-8">
    var count = 0;
    $('#custom-headers').multiSelect({
        selectableHeader: "</i><input type='text'  class='search-input col-sm-12 search_icon' autocomplete='off' placeholder='Sektör Seçiniz'></input>",
        selectionHeader: "<p style='font-size:12px;color:red'>Max 5 sektör seçebilirsiniz</p>",
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
        var color = "";
        var strength = "";
        switch (passed) {
            case 0:
            case 1:
                strength = "Şifre en az 6 karakterden oluşmalıdır";
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
    if(password.value == password_confirmation.value){
        //The passwords match.
        //Set the color to the good color and inform
        //the user that they have entered the correct password
        password_confirmation.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Şifre Eşleşti"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        password_confirmation.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Şifre Eşleşmedi"
    }
}

 $("#firma_kayit").submit(function(e)
   {
       var postData = $(this).serialize();
            var formURL = $(this).attr('action');
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

    $.validate({

        modules : 'location, date, security, file',
        onModulesLoaded : function() {
          $('#country').suggestCountry();
        }
      });
    $('#presentation').restrictLength( $('#pres-max-length') );

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
    $('#il_id').on('change', function (e) {
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

        $.get("{{asset('ajax-subcatt?ilce_id=')}}"+ ilce_id, function (data) {

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
