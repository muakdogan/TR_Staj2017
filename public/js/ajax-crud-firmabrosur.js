$(document).ready(function(){

    $('#btn-add-firmabrosurEkle').click(function(){
        $('#btn-save-firmabrosurEkle').val("add");
        $('#myModal-firmabrosurEkle').modal('show');
    });
    var url = "/tamrekabet/public/index.blade.php/firmabrosur";
    $('.open-modal-brosurGuncelle').click(function(){
        var brosur_id = $(this).val();
    
    
        $.get(url + '/'  + brosur_id, function (data) {
            //success data
           console.log(data);
            $('#brosur_id').val(data.id);
            $('#brosur_adi').val(data.adi);
       
        $('#myModal-firmabrosurGuncelle').modal('show');
    })
    });

});