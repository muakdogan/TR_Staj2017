$(document).ready(function(){

    var url = "/tamrekabet/public/index.blade.php/firma";
   
    //display modal form for task editing
    $('.open-modal').click(function(){
        var iletisimbilgisi_id = $(this).val();

        $.get(url + '/' + iletisimbilgisi_id, function (data) {
            //success data
            console.log(data);
            $('#il_id').val(data.il_id);
            $('#ilce_id').val(data.ilce_id);
            $('#semt_id').val(data.semt_id);
            $('#adres').val(data.adres);
            $('#telefon').val(data.telefon);
            $('#fax').val(data.fax);
            $('#web_sayfası').val(data.web_sayfası);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
            
        }) 
    });
        //display modal form for task editing
   

    //display modal form for creating new task
    $('#btn-add').click(function(){
        $('#myModal').modal('show');        
    });

    //delete task and remove it from list
    $('.delete-task').click(function(){
        var commucation_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + commucation_id,
            success: function (data) {
                console.log(data);

                $("#task" + commucation_id).remove(); //task yerine ne yazmam lazım ?? o task html adı???
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new task / update existing task
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
               
            }
        });

        e.preventDefault(); 

        var formData = {
            il_id: $('#il_id').val(),
            ilce_id: $('#ilce_id').val(),
            semt_id: $('#semt_id').val(),
            adres: $('#adres').val(),
            telefon: $('#telefon').val(),
            fax: $('#fax').val(),
            web_sayfası: $('#web_sayfası').val(),           
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var commucation_id = $('#commucation_id').val();
        var my_url = url;
        

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + commucation_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

               
                $('#frmTasks').trigger("reset");

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
