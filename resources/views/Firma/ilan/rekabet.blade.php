<?php use Barryvdh\Debugbar\Facade as Debugbar; ?>
<?php
if(count($teklifler) != 0){
    $tekliflerCount = $ilan->teklifler()->count();
}
else {
    $tekliflerCount = 0;
}
$i=0; $j=0;
$para_birimi=$ilan->para_birimleri->para_birimi();
?>

<div id="rekabetDiv">
@if(($ilan->sozlesme_turu == 0 || $ilan->sozlesme_turu == 1 )  && $ilan->kismi_fiyat == 0) <!--Kismi Teklife Kapalı -->
    <table class="table" id="table">
        <thead>
        <tr>
            <th  class="anim:update anim:number"  width="10%">Sıra</th>
            <th  class="anim:id" width="45%">Firma Adı</th>
            <th  class="anim:update anim:sort anim:number" width="45%">Teklif({{$para_birimi}})</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teklifler as $teklif)
            <?php  $j++; ?>
            @if(count($teklif->verilenFiyat()) != 0)
                @if($kisKazanCount == 1 && $kazanK->kazanan_firma_id == $teklif->teklifler->getFirma("id")) <!--Kazanan firma kontrolü -->
                    <tr class="kismiKazanan">
                @else
                    <tr>
                @endif

                @if(session()->get('firma_id') == $teklif->teklifler->getFirma("id")) <!--Teklifi veren firma ise -->
                    <td class="highlight">{{$j}}</td>
                    <td class="highlight">{{$teklif->teklifler->getFirma("adi")}}:</td>
                    <td class="highlight firmaFiyat" style="text-align: right; font-size: 10px"><strong class="currency">{{$teklif->teklifler->verilenFiyat()}}</strong></td>
                @elseif($ilanSahibi) <!--İlan sahibi ise Kazananı belirlemek için -->
                    <?php  $i++; ?>
                    <td>{{$j}}</td>
                    <td>{{$teklif->teklifler->getFirma("adi")}}</td>
                    <td style="text-align: right; font-size: 10px"><strong class="currency">{{$teklif->teklifler->verilenFiyat()}}</strong>
                    </td>
                @else  <!-- Diğer teklif veren firmalar -->
                    <?php  $i++; ?>
                    <td>{{$j}}</td>
                    <td>X Firması</td>
                    <td  style="text-align: right; font-size: 10px"><strong class="currency">{{$teklif->teklifler->verilenFiyat()}}</strong>
                    </td>
                @endif
                </tr>
        @endif
                @endforeach
        </tbody>
    </table>

@elseif($ilan->sozlesme_turu == 0 && $ilan->kismi_fiyat == 1) <!--Kismi teklife açık -->
    <table class="table" id="table">
        <thead>
        <tr>
            <th width="10%">Sıra</th>
            <th class="anim:id" width="45%">Firma Adı</th>
            <th class="anim:sort" width="45%">Teklif ({{$para_birimi}})</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teklifler as $teklif)
            @if($teklif->teklifler->teklifMalCount($ilan)) <!-- Tüm kalemlere teklif verme kontrolü -->
            <tr>
                <?php  $j++;?>
                @if(count($teklif->verilenFiyat()) != 0)
                    @if(session()->get('firma_id') == $teklif->teklifler->getFirma("id"))
                        <td class="highlight">{{$j}}</td>
                        <td class="highlight">{{$teklif->teklifler->getFirma("adi")}}</td>
                        <?php /*<strong class="currency"> ifin içine alininca javascript kodlari çalismiyor.. */?>
                        <td class="highlight" style="text-align: right; font-size: 10px"><strong class="currency">
                            @if($teklif['iskonto_orani']==0)
                                {{$teklif->teklifler->verilenFiyat()}}
                            </strong>
                            @else
                                {{$teklif['iskontolu_kdvli_fiyat']}}
                            </strong> <br />%{{$teklif['iskonto_orani']}} İskontolu
                            @endif
                        </td>
                    @elseif($ilanSahibi)
                        <?php  $i++; ?>
                        <td>{{$j}}</td>
                        <td>{{$teklif->teklifler->getFirma("adi")}}:</td>
                        {{--<strong class="currency"> ifin içine alininca javascript kodlari çalismiyor.. --}}
                        <td style="text-align: right; font-size: 10px"><strong class="currency">
                            @if($teklif['iskonto_orani']==0)
                                {{$teklif->teklifler->verilenFiyat()}}
                                </strong>
                            @else
                                {{$teklif['iskontolu_kdvli_fiyat']}}
                                </strong> <br />%{{$teklif['iskonto_orani']}} İskontolu
                            @endif
                        </td>
                    @else
                        <?php  $i++; ?>
                        <td>{{$j}}</td>
                        <td>X Firması</td>
                        <?php /*<strong class="currency"> ifin içine alininca javascript kodlari çalismiyor.. */?>
                        <td style="text-align: right; font-size: 10px"><strong class="currency">
                            @if($teklif['iskonto_orani']==0)
                                {{$teklif->teklifler->verilenFiyat()}}
                                </strong>
                            @else
                                {{$teklif['iskontolu_kdvli_fiyat']}}
                                </strong> <br />%{{$teklif['iskonto_orani']}} İskontolu
                            @endif
                        </td>
                    @endif
                @endif
            </tr>
            @endif
        @endforeach
        <tr> <!--Minumum fiyat sorgusu -->
            <td class="minFiyat">{{$j=$j+1}}</td>
            <td class="minFiyat">Optimum Fiyat</td>
            <td class="minFiyat" style="text-align: right; font-size: 10px"><strong class="currency"><?php foreach ($minFiyat as $fyt) { echo number_format($fyt->deneme, 2, '.', ''); } ?></strong></td>
        </tr>
        </tbody>
    </table>
</div>

@endif
<script>
    var tcount ={{$tekliflerCount}};
    var i = {{$i}};
    var ilanSahibi = {{$ilanSahibi}};
    if(tcount==0) { //teklif verilmediyse hide edilmesi
        $('#rekabetDiv').html("Bu ilana henüz Teklif Verilmemiş!");
        $('#kismiRekabet').html("Bu ilana henüz Teklif Verilmemiş!");
    }
    else if(tcount===i && !ilanSahibi){
        $('#rekabetDiv').html("Bu alanı görebilmek için teklif vermelisiniz!");
        $('#kismiRekabet').html("Bu alanı görebilmek için teklif vermelisiniz!");

    }
    $(".KapaliKazanan").click(function(){
        var kazananFirmaId=$(this).attr("name");
        var kazananFiyat=$(this).attr("id");
        var ilanID={{$ilan->id}};
        var successValue = $(this);
        if(confirm("Bu firmayı kazanan ilan etmek istediğinize emin misiniz ?")){
            $.ajax({
                type:"POST",
                url:"{{asset('KismiKapaliKazanan')}}",
                data:{ilan_id:ilanID, kazananFirmaId:kazananFirmaId,kazananFiyat:kazananFiyat},
                cache: false,
                success: function(data){
                    console.log(data);
                    alert(" Seçmiş Olduğunuz İlanın Kazanını Kaydedildi!");
                    $('.KapaliKazanan').hide();
                    successValue.parent().parent().addClass("kismiKazanan");
                    successValue.parent().text("KAZANDI");
                }
            });
        }
        else{
            return false;
        }
    });
    $(".KapaliAcikRekabetKazanan").click(function(){
        var kazananFirmaId=$(this).attr("name");
        var ilanID={{$ilan->id}};
        var successValue = $(this);
        if(confirm("Bu firmayı kazanan ilan etmek istediğinize emin misiniz ?")){
            $.ajax({
                type:"POST",
                url:"{{asset('KismiAcikRekabetKazanan')}}",
                data:{ilan_id:ilanID, kazananFirmaId:kazananFirmaId},
                cache: false,
                success: function(data){
                    console.log(data);
                    alert(" Seçmiş Olduğunuz İlanın Kazanını Kaydedildi!");
                    $('.KapaliKazanan').hide();
                    successValue.parent().parent().addClass("kismiKazanan");
                    successValue.parent().text("KAZANDI");

                    for(var key=0; key <Object.keys(data).length;key++){
                        $('.kazan'+data[key]).hide();
                    }
                }
            });
        }
        else{
            return false;
        }
    });
</script>