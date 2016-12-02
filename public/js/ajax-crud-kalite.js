$(document).ready(function(){

    $('#btn-add-kalite').click(function(){
        $('#btn-save-kalite').val("add");
        $('#myModal-kalite').modal('show');
    });
 
    $('.open-modal-kaliteGuncelle').click(function(){
        $('#myModal-kaliteGuncelle').modal('show');
    });
});