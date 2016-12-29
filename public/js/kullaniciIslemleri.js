$(document).ready(function(){


    $('#btn-add-kullanici').click(function () {
        $('#btn-save-kullanici').val("add");
        $('#myModal-kullanici').modal('show');
    });
     $('#btn-add-sifre').click(function () {
        $('#btn-save-sifre').val("add");
        $('#myModal-sifre').modal('show');
    });

    
    
    
   var url = "/tamrekabet/public/index.php/kullanici";
    $('.open-modal-kullanici').click(function(){
        var kullanici_id = $(this).val();
        $.get(url + '/'  + kullanici_id, function (data) {
            //success data
           console.log(data);
            $('#kullanici_id').val(data.id);
            $('#adi').val(data.adi);
            $('#soyadi').val(data.soyadi);
            $('#email').val(data.email);
            $('#rol').val(data.rol);
            $('#myModal-kullaniciDüzenle').modal('show');
            
        }) 
    });

    
    
    
    
    
});

