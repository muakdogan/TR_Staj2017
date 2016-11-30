
    <h3>İlanlar</h3> 
    <hr>
    <?php $count=$ilanlar->total();?>
    <input type="hidden" name="totalCount" value='{{$ilanlar->total()}}'>
    @foreach($ilanlar as $ilan)
    
        <p><b>İlan Adı: {{$ilan->ilanadi}}</b></p>
        <p>Firma: {{$ilan->adi}}</p>
        <p>{{$ilan->iladi}}</p>
        <p>{{$ilan->yayin_tarihi}}</p>
        
       <button type="button" class="btn btn-primary" id="{{$ilan->ilan_id}}" name="{{$ilan->ilan_id}}" style='float:right'>Başvur</button><br><br>
        <hr>
       
    @endforeach
    
{{$ilanlar->links()}}

<script>
    var ilan_id;
   
    
    $(".btn-primary").click(function(){

                 ilan_id=$(this).attr("name");
                    alert(ilan_id); 
                   
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
           if(data==null){
               
               
             window.location.href="ilanTeklifVer"+ilan_id;
              
               
           }
           else{
               
               alert("Bu İlana Daha Önce Teklif Verdiniz.Teklif Veremezsiniz.Ancak Teklifi Düzenleye Bilirsiniz.");
           }
           
           
           
           
         }

        });
    }
    
</script>
