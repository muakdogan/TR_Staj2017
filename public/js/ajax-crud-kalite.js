$(document).ready(function(){

    $('#btn-add-kalite').click(function(){
        $('#btn-save-kalite').val("add");
        $('#myModal-kalite').modal('show');
    });
 
    $('.open-modal-kaliteGuncelle').click(function(){
            console.log($(this).val());
            $('#myModal-kaliteGuncelle').modal('show');
            $('#kalite_belgeleri').val($(this).val());
        });
});