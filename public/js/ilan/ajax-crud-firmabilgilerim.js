$(document).ready(function(){


    $('#btn-add-firmaBilgilerim').click(function () {
        $('#btn-save-firmaBilgilerim').val("add");
        $('#myModal-firmaBilgilerim').modal('show');
    });
   
      $('#btn-add-fiyatlandırmaBilgileri').click(function () {
        $('#btn-save-fiyatlandırmaBilgileri').val("add");
        $('#myModal-fiyatlandırmaBilgileri').modal('show');
    });
    
     $('.btn-add-teknik').click(function () {
        $('#btn-save-teknik').val("add");
        $('#myModal-teknik').modal('show');
    });
     $('#btn-add-mal').click(function () {
        $('#myModal-mal_birimfiyat_add').modal('show');

    });
     $('#btn-add-hizmet').click(function () {
        $('#myModal-hizmet_birimfiyat_add').modal('show');
    });
     $('#btn-add-goturu_bedeller').click(function () {
        $('#myModal-goturu_bedeller_add').modal('show');
    });
     $('#btn-add-yapim_isleri').click(function () {
        $('#myModal-yapim_isleri_add').modal('show');
    });
    
    
    
   var url = "/tamrekabet/public/index.php/firmaMal";
    $('.open-modal-mal').click(function(){
        var ilan_mal_id = $(this).val();
        $.get(url + '/'  + ilan_mal_id, function (data) {
            //success data
           console.log(data);
            $('#ilan_mal_id').val(data.id);
            $('#sira').val(data.sira);
            $('#marka').val(data.marka);
            $('#model').val(data.model);
            $('#adi').val(data.adi);
            $('#ambalaj').val(data.ambalaj);
            $('#miktar').val(data.miktar);
            $('#birim').val(data.birim);
            $('#myModal-mal_birimfiyat').modal('show');
            
        }) 
    });
     var url1 = "/tamrekabet/public/index.php/firmaHizmet";
    $('.open-modal-hizmet').click(function(){
        var ilan_hizmet_id = $(this).val();
        $.get(url1 + '/'  + ilan_hizmet_id, function (data) {
          
           console.log(data);
            $('#ilan_hizmet_id').val(data.id);
            $('#sira').val(data.sira);
            $('#adi').val(data.adi);
            $('#fiyat_standardi').val(data.fiyat_standardi);
            $('#fiyat_standardi_birimi').val(data.fiyat_standardi_birim_id);
            $('#miktar').val(data.miktar);
            $('#miktar_birimi').val(data.miktar_birim_id); 
            $('#myModal-hizmet_birimfiyat').modal('show');
            
        }) 
    });
   var url2 = "/tamrekabet/public/index.php/firmaGoturuBedel";
    $('.open-modal-goturu-bedel').click(function(){
        var ilan_goturu_bedel_id = $(this).val();
        $.get(url2 + '/'  + ilan_goturu_bedel_id, function (data) {
            //success data
           console.log(data);
            $('#ilan_goturu_bedel_id').val(data.id);
            $('#sira').val(data.sira);
            $('#isin_adi').val(data.isin_adi);
            $('#miktar_turu').val(data.miktar_turu); 
            $('#myModal-goturu_bedeller').modal('show');
            
        }) 
    });
      var url3= "/tamrekabet/public/index.php/firmaYapimİsi";
    $('.open-modal-yapim-isi').click(function(){
        var ilan_yapim_isi_id = $(this).val();
        $.get(url3 + '/'  + ilan_yapim_isi_id, function (data) {
            
           console.log(data);
            $('#ilan_yapim_isi_id').val(data.id);
            $('#sira').val(data.sira);
            $('#adi').val(data.adi);
            $('#miktar').val(data.miktar); 
            $('#birim').val(data.birim_id); 
            $('#myModal-yapim_isleri').modal('show');
            
        }) 
    });
    
    
    
    
      $('.detay').click(function(){
        $('#btn-save-detay').val("add");
        $('#myModal-detay').modal('show');
    });
      $('.düzenle').click(function(){
        $('#btn-save-düzenle').val("add");
        $('#myModal-düzenle').modal('show');
    });
    
    
    
    
    
    
});

