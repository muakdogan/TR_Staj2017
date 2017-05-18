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
                        <div style="width:128px;height:128px;"class="image-wrapper col-sm-2 ">
                             <img src="{{asset('uploads')}}/{{$firma->logo}}" alt="HTML5 Icon" style="width:128px;height:128px;">
                        </div>
                        @if(($firma->puanlamaOrtalama())> 0)
                            <div class="col-sm-1"><div class="puanlama">{{$firma->puanlamaOrtalama()}}</div></div>
                            <div class="col-sm-2"><a href="{{url('firmaDetay/'.$firma->id)}}" style="padding:0px" >Firma: {{$firma->adi}}</a></div>
                        @else
                            <div class="col-sm-2"><p style="font-size:15px ; color:#666" ><a href="{{url('firmaDetay/'.$firma->id)}}" style="padding: 0px" >Firma: {{$firma->adi}}</a></p></div>
                        @endif
                            <div class="col-sm-2"><p><a href="{{ url('firmaProfili/'.$firma->id)}}" style="padding:0px">Firma Profili&nbsp;&nbsp;&nbsp;&nbsp;</a></p></div>
                            <div class="col-sm-3"><p><a href="{{ url('firmaIslemleri/'.$firma->id)}}" style="padding:0px">Firma İşlemleri&nbsp;&nbsp;&nbsp;&nbsp;</a></p></div>


                    <div class="col-sm-2">
                        @if(Auth::guest())
                        @else
                            <a href="#"><button type="button" class="btn btn-primary" name="{{$firma->id}}" id="{{$firma->id}}" style='float:right;margin-top:60px'>Onaylı Tedarikçi Ekle</button></a><br><br>
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
</script>
