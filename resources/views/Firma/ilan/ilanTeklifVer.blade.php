
@extends('layouts.app')
<br>
 <br>
 @section('content')
 
 <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #fff;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #fff;
}
.div5{
    float:right;
}
.div6{
    float:left;
}
.button {
    background-color: #ccc; /* Green */
    border: none;
    color: white;
    padding: 6px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
}
    form .error {
                  color: #000000;
        }
         .popup, .popup2, .bMulti {
            background-color: #fff;
            border-radius: 10px 10px 10px 10px;
            box-shadow: 0 0 25px 5px #999;
            color: #111;
            display: none;
            min-width: 450px;
            padding: 25px;
            text-align: center;
            }
            .popup, .bMulti {
                min-height: 150px;
            }
            .button.b-close, .button.bClose {
                border-radius: 7px 7px 7px 7px;
                box-shadow: none;
                font: bold 131% sans-serif;
                padding: 0 6px 2px;
                position: absolute;
                right: -7px;
                top: -7px;
            }
            .button {
                background-color: #2b91af;
                border-radius: 10px;
                box-shadow: 0 2px 3px rgba(0,0,0,0.3);
                color: #fff;
                cursor: pointer;
                display: inline-block;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
            }

</style>
   <script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
     <div class="container">
         <?php $firma=$ilan->firmalar;?>
          @include('layouts.alt_menu') 
         <div class="col-sm-12">     
             
            <h3>{{$firma->adi}}'nın {{$ilan->adi}} İlanına Teklif  Ver</h3>
              <hr>
              <div class="panel-group" id="accordion">
                 @include('Firma.ilan.malTeklif') 
                 @include('Firma.ilan.hizmetTeklif')
                 @include('Firma.ilan.goturuBedelTeklif') 
                 @include('Firma.ilan.yapimIsiTeklif') 
              <?php $j=0;$k=0;
                $kullanici = App\Kullanici::find(Auth::user()->kullanici_id);
            ?>
            <div class="modal fade" id="myModalSirketListe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                         <h4 class="modal-title" id="myModalLabel">Lütfen Şirket Seçiniz!</h4>
                    </div>
                    <div class="modal-body">
                        <p style="font-weight:bold;text-align: center;font-size:x-large">{{ Auth::user()->name }}  </p>
                        <hr>
                        <div id="radioDiv">
                        @foreach($kullanici->firmalar as $kullanicifirma)
                        <input type="radio" name="firmaSec" value="{{$kullanicifirma->id}}"> {{$kullanicifirma->adi}}<br>   
                        @endforeach
                        </div>
                        <button  style='float:right' type='button' class="firmaButton" class='btn btn-info'>Firma Seçiniz</button><br><br>
                    </div>
                    <div class="modal-footer">                                                            
                    </div>
                 </div>
                </div>
            </div>
              
              
              
              
              <br>
              <br>                                     
             <hr>                               
        </div>    
    </div>
</div>          
<script>
    var fiyat;
    var temp=0;
    var count=0;
    var toplamFiyat=0; 

    $('#kdv').on('change', function() {
   
        var kdv=parseFloat(this.value);
        var result;

        if($(this).parent().next().children().val() !== '')
        {
            var miktar = parseFloat($(this).parent().prev().prev().text());
            fiyat=parseFloat($(this).parent().next().children().val()); 
            result=(fiyat+(fiyat*kdv)/100)*miktar;
            toplamFiyat += result;
            var name=$(this).attr('name');
           
            $(this).parent().next().next().next().children().next().text(result);
            $("#toplamFiyatLabel").text("Toplam Fiyat: " + toplamFiyat);
            $("#toplamFiyatL").text(toplamFiyat);
            $("#toplamFiyat").val(toplamFiyat);
            
        }  
    });

    $('.fiyat').on('change', function() {

        var fiyat=parseFloat(this.value);
        var result;

        if($(this).parent().prev().children().val() !== '')
        {
            var miktar = parseFloat($(this).parent().prev().prev().prev().text());
            kdv=parseFloat($(this).parent().prev().children().val());
            result=(fiyat+(fiyat*kdv)/100)*miktar;
            toplamFiyat += result;
            var name=$(this).attr('name');
           
            $("#"+name).text(result);
            $("label[for='toplamFiyatLabel']").text("Toplam Fiyat: " + toplamFiyat);
            $("label[for='toplamFiyatL']").text(toplamFiyat);
            $("label[for='toplamFiyat']").val(toplamFiyat);
            
        }
    });

    $('.teklifGonder').on('click', function() {
        alert('Bu ilana teklif vermek istediğinize emin misiniz ? ');
    });
    $('.firmaButton').on('click', function() {
       var selected = $("#radioDiv input[type='radio']:checked").val();
        $.ajax({
            type:"GET",
            url: "{{asset('set_session')}}",
            data: { role: selected },
            }).done(function(data){
                $('#myModalSirketListe').modal('toggle');
                location.reload();
            }).fail(function(){ 
                alert('Yüklenemiyor !!!  ');
            });
    });
    $(document).ready(function() {
        var firmaId = "{{session()->get('firma_id')}}";
        if(firmaId === ""){
            $('#myModalSirketListe').modal({
                show: 'true'
            });
        }
        var ilan_turu='{{$ilan->ilan_turu}}';
        var sozlesme_turu='{{$ilan->sozlesme_turu}}';    
                if(ilan_turu=="") 
                {
                    $('#hizmet').hide()
                    $('#mal').hide()
                    $('#goturu').hide()
                    $('#yapim').hide()
                }
                else if(ilan_turu=="Mal" && sozlesme_turu=="Birim Fiyatlı")
                    {
                       $('#hizmet').hide()
                       $('#goturu').hide()
                       $('#yapim').hide()
                    }
                 else if(ilan_turu=="Hizmet" && sozlesme_turu=="Birim Fiyatlı")
                    {
                       $('#mal').hide()
                       $('#goturu').hide()
                       $('#yapim').hide()
                    }
                 else if(sozlesme_turu=="Götürü Bedel")
                    {
                       $('#hizmet').hide()
                       $('#mal').hide()
                       $('#yapim').hide();
                    }
                else if(ilan_turu=="Yapim İşi")
                    {
                       $('#hizmet').hide()
                       $('#goturu').hide()
                       $('#mal').hide()
                    }      
    });
</script>
@endsection
