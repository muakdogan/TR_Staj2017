<style>
.puanlama {
                
                background: #dddddd;
                width: 30px;
                border-radius: 4px;
                position: absolute;
                margin: auto;
                text-align: center;
                color: white;
            }
            a{
                padding: 35px;
            }
</style>
    <h3>İlanlar</h3> 
    <hr>
    <?php $count=$ilanlar->total();?>
    <input type="hidden" name="totalCount" value='{{$ilanlar->total()}}'>
    @foreach($ilanlar as $ilan)
    <div class="ilanDetayPop" name="{{$ilan->ilan_id}}">
        <div class="pop-up"  style="display: none;
                                        position: absolute;
                                        left: 200px;
                                        width: 280px;
                                        padding: 10px;
                                        background: #eeeeee;
                                        color: #000000;
                                        border: 1px solid #1a1a1a;
                                        font-size: 90%;
                                        z-index: 1000;">
                        <p id="popIlanAdi">İlan Adı : {{$ilan->adi}}</p>
                        <p id="popIlanTuru">İlan Türü: {{$ilan->ilan_turu}}</p>
                        <p id="popIlanUsulu">Usulü: {{$ilan->usulu}}</p>
                        <p id="popIlanAciklama">Açıklama: {{$ilan->aciklama}}</p>
                        <p id="popIlanIsinSuresi">İşin Süresi: {{$ilan->isin_suresi}}</p>
                        <p id="popIlanSözlesmeTuru">Sözleşme Türü: {{$ilan->sozlesme_turu}}</p>                                
        </div>
        
        <p><b>İlan Adı: {{$ilan->ilanadi}}</b></p>
        <div class="puanlama">10</div><p><a href="{{url('firmaDetay/'.$ilan->firmaid)}}" >Firma: {{$ilan->adi}}</a></p>
        <p>{{$ilan->iladi}}</p>
        <p>{{$ilan->yayin_tarihi}}</p>
        
        <a href="#"><button type="button" class="btn btn-primary" name="{{$ilan->ilan_id}}" id="{{$ilan->ilan_id}}" style='float:right'>Başvur</button></a><br><br>
        <hr>
    </div>
    @endforeach
    
{{$ilanlar->links()}}

<script>
    $('.ilanDetayPop').mouseenter(function(){
        $(this).children("div.pop-up").show();
    });
    $('.ilanDetayPop').mouseleave(function () {
        $('div.pop-up').hide();
    });
    
   var ilan_id;
  
   $(".btn-primary").click(function(){

       ilan_id=$(this).attr("name");
      
       func();
    });
          

    function func(){
                    
           $.ajax({
            type:"GET",
            url:"basvuruControl",
            data:{ilan_id:ilan_id
      
           },
           cache: false,
           success: function(data){
            console.log(data);
            alert("mdnfjkdn");
                if(data==0){
                      
                     
                    window.location.href="ilanTeklifVer/"+ilan_id;
                     
                     
                }
                else{
                      
                    alert("Bu İlana Daha Önce Teklif Verdiniz.Teklif Veremezsiniz.Ancak Teklifi Düzenleye Bilirsiniz.");
                }
                  
                  
        
          }

        });
    }
    $(".puanlama").each(function(){
        var puan = $(this).text();
        if(puan > 0 && puan < 3){
            $(this).css("background", "#e65100");
        }
        else if (puan >= 3 && puan <= 5){
            $(this).css("background", "#e54100");
        }
        else if (puan > 5 && puan <= 6){
            $(this).css("background", "#f46f02");
        }
        else if (puan > 5 && puan <= 6){
            $(this).css("background", "#f46f02");
        }
        else if (puan > 6 && puan <= 7){
            $(this).css("background", "#ffba04");
        }
        else if (puan > 7 && puan <= 8){
            $(this).css("background", "#d6d036");
        }
        else if (puan > 8 && puan <= 9){
            $(this).css("background", "#a5c530");
        }
        else if (puan > 9 && puan <= 10){
            $(this).css("background", "#45c538");
        }
    });
                       


</script>
