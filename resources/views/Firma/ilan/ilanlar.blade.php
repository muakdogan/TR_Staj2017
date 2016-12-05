
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
        <p>Firma: {{$ilan->adi}}</p>
        <p>{{$ilan->iladi}}</p>
        <p>{{$ilan->yayin_tarihi}}</p>
        
        <a href="{{ URL::to('ilanTeklifVer', array($ilan->ilan_id), false) }}"><button type="button" class="btn btn-primary" id="{{$ilan->ilan_id}}" style='float:right'>Başvur</button></a><br><br>
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
</script>
