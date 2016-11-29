$(document).ready(function(){

    //display modal form for creating new task
    $('#btn-add-image').click(function(){
        $('#btn-save-image').val("add");
        $('#frmImage').trigger("reset");
        $('#myModal-image').modal('show');
    });

});