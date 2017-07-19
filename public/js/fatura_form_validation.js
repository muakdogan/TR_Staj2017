// Wait for the DOM to be ready
$(document).ready(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration

  // $("#firma_kayit :input").tooltip({
  //
  //    // place tooltip on the right edge
  //    position: "center right",
  //
  //    // a little tweaking of the position
  //    offset: [-2, 10],
  //
  //    // use the built-in fadeIn/fadeOut effect
  //    effect: "fade",
  //
  //    // custom opacity setting
  //    opacity: 0.7
  //
  //  });

  /*$.validator.addMethod('tc_no_dogrulama',function(value,element){
    if(value.substr(0,1) == 0)
      return false;
    if(value.substr(10,1)%2 != 0)
      return false;
    else{
      return true;
    }
  });*/

  $("#firma_kayit").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fatura_adres: {
        required: function(element){
        return $("#fatura_tur_kurumsal").is(":checked");
      }
        },
      firma_unvan: {
          required: function(element){
          return $("#fatura_tur_kurumsal").is(":checked");
        }
      },
      vergi_daire_il: {
        required: function(element){
        return $("#fatura_tur_kurumsal").is(":checked");}
      },
      vergi_daire: {
        required: function(element){
        return $("#fatura_tur_kurumsal").is(":checked");}
      },
      vergi_no: {
        required: function(element){
        return $("#fatura_tur_kurumsal").is(":checked");},
        minlength: 10
      },
      firma_adres:{
        required: function(element){
        return $("#fatura_tur_kurumsal").is(":checked");
        }
      },
      //------------Bireysel Fatura Form Validation----------------------
      bireysel_fatura_adres:{
        required: function(element){
        return $("#fatura_tur_bireysel").is(":checked");
        }
      },
      ad_soyad:{
        required: function(element){
        return $("#fatura_tur_bireysel").is(":checked");
        }
      },
      tc_kimlik:{
        required: function(element){
          return $("#fatura_tur_bireysel").is(":checked");
        },
        //tc_no_dogrulama: true,
        minlength:11,
        number: true
      },
      adres:{
        required: function(element){
        return $("#fatura_tur_bireysel").is(":checked");
        }
      }
    },
    // Specify validation error messages
    messages: {

      fatura_adres:   "Lütfen boş bırakmayınız.",

      firma_unvan:    "Lütfen boş bırakmayınız.",

      vergi_no: {
        required:     "Lütfen boş bırakmayınız.",
        minlength:    "En az 10 karakter giriniz"
      },

      vergi_daire_il: "Lütfen boş bırakmayınız.",

      vergi_daire:    "Lütfen boş bırakmayınız.",

      firma_adres:    "Lütfen boş bırakmayınız.",
      //------------Bireysel Fatura Form Validation----------------------
      bireysel_fatura_adres: "Lütfen boş bırakmayınız.",

      ad_soyad:              "Lütfen boş bırakmayınız.",

      tc_kimlik:{
        required:            "Lütfen boş bırakmayınız.",
        minlength:           "Lütfen 11 karakter giriniz",
        number:              "Lutfen sayi giriniz.",
        tc_no_dogrulama:     "Lutfen gecerli T.C Kimlik No giriniz."
      },

      adres:                 "Lütfen boş bırakmayınız."

    },

    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    /*submitHandler: function(posts) {
      form.submit();
    }*/
  });

});
