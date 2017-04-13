/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    function GetIlce(il_id) {
        if (il_id > 0) {
            $("#ilce_id").get(0).options.length = 0;
            $("#ilce_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 

            $.ajax({
                type: "GET",
                url: "{{asset('ajax-subcat')}}",
                data:{il_id:il_id},
                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    $("#ilce_id").get(0).options.length = 0;
                    $("#ilce_id").get(0).options[0] = new Option("Seçiniz", "-1");

                    $.each(msg, function(index, ilce) {
                        $("#ilce_id").get(0).options[$("#ilce_id").get(0).options.length] = new Option(ilce.adi, ilce.id);
                    });
                },
                async: false,
                error: function() {
                    $("#ilce_id").get(0).options.length = 0;
                    alert("İlçeler yükelenemedi!!!");
                }
            });
        }
        else {
            $("#ilce_id").get(0).options.length = 0;
        }
    }
    
    function GetSemt(ilce_id) {
        if (ilce_id > 0) {
            $("#semt_id").get(0).options.length = 0;
            $("#semt_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 

            $.ajax({
                type: "GET",
                url: "{{asset('ajax-subcatt?ilce_id=')}}"+ilce_id,

                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    $("#semt_id").get(0).options.length = 0;
                    $("#semt_id").get(0).options[0] = new Option("Seçiniz", "-1");

                    $.each(msg, function(index, semt) {
                        $("#semt_id").get(0).options[$("#semt_id").get(0).options.length] = new Option(semt.adi, semt.id);
                    });
                },
                async: false,
                error: function() {
                    $("#semt_id").get(0).options.length = 0;
                    alert("Semtler yükelenemedi!!!");
                }
            });
        }
        else {
            $("#semt_id").get(0).options.length = 0;
        }
    }
});
    
    