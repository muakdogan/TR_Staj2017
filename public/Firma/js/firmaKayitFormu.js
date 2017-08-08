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
})
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
$('#fatura_tur_kurumsal').click(showBillForm);
$('#fatura_tur_bireysel').click(showBillForm);
function showBillForm(){
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
}
/*
  25-26.07.2017 Oguzhan Ulucay
  Sirket adresini form'un altinda yer alan fatura adresini kopyalama scripti.
  Checkbox'a basilmasi hallinde aktif olup yukarida ki ve asagida ki formlarin
  bosluk veya doluluk durumlarini kontrol edip kopyalama islemini gerceklestirir.
  flag_first_adrs_filled = Sirket adresinin tum fieldlarinin dolulugunu tutar.
  flag_second_adrs_empty = Fatura adresinin tum fieldlarinin boslugunu tutar.
  flag_return_original   = Fatura adresinin tum fieldlarinin dolulugunu tutar.
*/
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
/*
  Oguzhan Ulucay 18.07.2017
  Tooltips
*/
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
