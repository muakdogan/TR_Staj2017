$(document).ready(function(){

   var url = "tamrekabet/public/index.blade.php/firma";
    $('.open-modal-gecmis').click(function(){
        var ref_id = $(this).val();

        $.get(url + '/'  + ref_id, function (data) {
            //success data
           console.log(data);
            $('#ref_id').val(data.id);
            $('#ref_turu').val(data.ref_turu);
            $('#ref_firma_adi').val(data.adi);
            $('#yapılan_isin_adi').val(data.is_adi);
            $('#isin_turu').val(data.is_turu);
            $('#is_yili').val(data.is_yili);
            $('#calısma_suresi').val(data.calisma_suresi);
            $('#yetkili_kisi_adi').val(data.yetkili_adi);
            $('#yetkili_kisi_email').val(data.yetkili_email);
            $('#yetkili_kisi_telefon').val(data.yetkili_telefon);
            $('#myModal-referanslarGecmis').modal('show');
            
        }) 
    });
});