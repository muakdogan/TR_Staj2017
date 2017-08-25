<style>
    .puanlama {
        background: #dddddd;
        width: 30px;
        border-radius: 4px;
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
        <?php $i = 1; ?>
        @foreach($firmalar as $firma)
            <div class="ilanDetayPop ">
                <div class="row hover">
                    <div class="col-sm-10 ">
                        <div class="col-sm-2"><img src="{{asset('uploads')}}/{{$firma->logo}}" alt="HTML5 Icon" width="80" height="80" class="img-responsive " style="padding-top:16px;padding-bottom: 10px">
                            @if(($firma->puanlamaOrtalama())> 0)
                                <div class="puanlama ">{{$firma->puanlamaOrtalama()}}</div>
                                <br />
                            @endif
                        </div>
                        <div class="col-sm-3"><p style="font-size:18px ; color:#666 ;font-weight:bold" >{{$firma->adi}}</p>
                            <p>{{$firma->iladi}}</p>

                        </div>
                        <div class="col-sm-5">
                            <ul type="circle">@foreach($firma->sektorler as $sektor) <li>{{$sektor->adi}} </li> @endforeach </ul>
                        </div>

                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary btn-tedEkle" id="btn_tedEkle_{{$firma->id}}" value="{{$firma->id}}" style="float:right;width:170px;margin: 30px">Onaylı Tedarikçi Ekle</button>
                        <button type="button" class="btn btn-primary btn-tedCikar" id="btn_tedCikar_{{$firma->id}}" value="{{$firma->id}}" style="float:right;width:170px;display: none;margin: 30px">Tedarikçilerimden Çıkar</button>
                    </div>
                </div>

                <hr class="hr">

            </div>
            <?php $i++; ?>
        @endforeach
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

    $(".btn-tedEkle").click(function () {
        var tedarikci_id=$(this).val();
        var index= $(this).index(".btn-tedEkle");
        $.ajax({
            type:"GET",
            url:"{{asset('onayliTedarikciEkle')}}",
            data:{tedarikci_id:tedarikci_id},
            cache: false,
            success: function(data){
                $('.btn-tedEkle').eq(index).hide();
                $('.btn-tedCikar').eq(index).show();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    });

    $(".btn-tedCikar").click(function () {
        var tedarikci_id=$(this).val();
        var index= $(this).index(".btn-tedCikar");
        $.ajax({
            type:"GET",
            url:"{{asset('onayliTedarikciCikar')}}",
            data:{tedarikci_id:tedarikci_id},
            cache: false,
            success: function(data){
                $('.btn-tedCikar').eq(index).hide();
                $('.btn-tedEkle').eq(index).show();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    });

    $(document).ready(function(){
        onayliTedArr = [];
        @for ($i = 0 ; $i< count($onayliTedarikciler); $i++)
            onayliTedArr.push({{$onayliTedarikciler[$i]->tedarikci_id}});
        @endfor


        $(".btn-tedEkle").each(function () {
            for (i = 0; i < onayliTedArr.length; i++) {
                if($(this).val()==onayliTedArr[i]){
                    $(this).hide();
                    var index= $(this).index(".btn-tedEkle");
                    $('.btn-tedCikar').eq(index).show();
                    break;
                }
            }
        });
    });

</script>