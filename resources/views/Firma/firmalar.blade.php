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
.hover:hover {
    background-color:#eee;
}
</style>
    <div class="form-group">
        <h1>Firmalar</h1>
        <hr>
        <div>
            <table>
            <?php $i = 1; ?>
            @foreach($firmalar as $firma)
            <div class="ilanDetayPop ">
                <div class="row hover">
                    <div class="col-sm-10 ">
                        <div class="col-sm-2"><img src="{{asset('uploads')}}/{{$firma->logo}}" alt="HTML5 Icon" width="80" height="80" class="img-responsive " style="padding-top:16px;padding-bottom: 10px">

                        @if(($firma->puanlamaOrtalama())> 0)
                            <div class="center"><div class="puanlama ">{{$firma->puanlamaOrtalama()}}</div></div>
                        @endif
                        </div>
                        <div class="col-sm-4"><p style="font-size:18px ; color:#666 ;font-weight:bold" >{{$firma->adi}}</p>
                            <p>{{$firma->iladi}}</p>
                            <p>@foreach($firma->sektorler as $sektor) {{$sektor->adi}}, @endforeach </p>
                        </div>
                            

                    </div>
                    <div class="col-sm-2">
                        @if(Auth::guest())
                        @else
                            <a href="#"><button type="button" class="btn btn-primary" name="{{$firma->id}}" id="tedarikci" onclick="tedarikci()" style='float:right;margin-top:60px'>@if($firma->onay == 0)Onaylı Tedarikçi Ekle @else Tedarikçilerimden Çıkar @endif</button></a><br><br>
                        @endif
                    </div>

                </div>

                <hr class="hr">

            </div>
            <?php $i++; ?>
            @endforeach
            </table>
            {{$firmalar->links()}}
        </div>

        <br>
        <div class="form-group">
        </div>
    </div>
<script>


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
var firma_id = $("#tedarikci").attr('name');
function tedarikci(){          
        $.ajax({
        type:"GET",
        url:"{{asset('onayliTedarikci')}}",
        data:{firma_id:firma_id},
        cache: false,
        success: function(data){
            console.log(data);
               alert("başarılı");
            }
        });
    }
</script>
