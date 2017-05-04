$(document).ready(function(){

    $('#btn-add-referanslar').click(function(){
        $('#btn-save-referanslar').val("add");
        $('#myModal-referanslar').modal('show');
        console.log($(this).val());
    });
    
});