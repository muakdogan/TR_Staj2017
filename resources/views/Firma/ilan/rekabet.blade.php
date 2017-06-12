 <?php use Barryvdh\Debugbar\Facade as Debugbar; ?>
<?php
    if(count($teklifler) != 0){
        $tekliflerCount = $ilan->teklifler()->count();
    }
    else {
        $tekliflerCount = 0;
    }
    $i=0; $j=0; $ilanSahibi=0;
?>
@if(($ilan->sozlesme_turu == 0 || $ilan->sozlesme_turu == 1 )  && $ilan->kismi_fiyat == 0) <!--Kismi Teklife Kapalı -->
    <div class="demo">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th  class="anim:update anim:number"  width="10%">Sıra</th>
                    <th  class="anim:id" width="40%">Firma Adı</th>
                    <th  class="anim:update anim:sort anim:number" width="40%">Verilen Fiyat({{$ilan->para_birimleri->adi}})</th>
                    <th  class="anim:constant" width="10%"></th>
                </tr>
            </thead>
            <br>
            <tbody>
                @foreach($teklifler as $teklif)
                    <?php  $j++; ?>
                    @if(count($teklif->verilenFiyat()) != 0)
                        @if($kisKazanCount == 1 && $kazanK->kazanan_firma_id == $teklif->teklifler->getFirma("id")) <!--Kazanan firma kontrolü -->
                            <tr  class="kismiKazanan">
                        @else
                            <tr>
                        @endif  
                        @if(session()->get('firma_id') == $teklif->teklifler->getFirma("id")) <!--Teklifi veren firma ise -->
                            <td class="highlight">{{$j}}</td>
                            <td class="highlight">{{$teklif->teklifler->getFirma("adi")}}:</td>
                            <td class="highlight firmaFiyat" style="text-align: right"><strong>{{$teklif->verilenFiyat()}}</strong> &#8378;</td>
                            <td class="highlight"></td>
                        <?php $sessionF= session()->get('firma_id'); $sahibF=$ilan->firmalar->id; ?>
                        @elseif(session()->get('firma_id') == $ilan->firmalar->id) <!--İlan sahibi ise Kazananı belirlemek için -->
                            <?php $ilanSahibi= 1;?>
                            <td>{{$j}}</td>
                            <td>{{$teklif->teklifler->getFirma("adi")}}</td>
                            <td  style="text-align: right"><strong>{{$teklif->verilenFiyat()}}</strong>
                                @if($ilan->para_birimleri->adi == "Türk Lirası")
                                    &#8378;
                                @elseif($ilan->para_birimleri->adi == "Dolar")
                                    $
                                @else
                                    &#8364;
                                @endif
                            </td>
                            @if($ilan->kapanma_tarihi > $dt)
                                <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                            @else
                                @if($kisKazanCount == 0)
                                    <td><button name="{{$teklif->teklifler->getFirma("id")}}" id="{{$teklif->verilenFiyat()}}" style="float:right" type="button" class="btn btn-info KapaliKazanan">Kazanan</button></td>
                                @elseif($kisKazanCount == 1 && $kazanK->kazanan_firma_id == $teklif->teklifler->getFirma("id"))
                                    <td>KAZANDI</td>
                                @endif
                            @endif
                        @else  <!-- Diğer teklif veren firmalar -->
                            <td>{{$j}}</td>
                            <td>X Firması</td>
                            <td style="text-align: right"><strong>{{$teklif->verilenFiyat()}}</strong>
                                @if($ilan->para_birimleri->adi == "Türk Lirası")
                                    &#8378;
                                @elseif($ilan->para_birimleri->adi == "Dolar")
                                    $
                                @else
                                    &#8364;
                                @endif
                            </td>
                            <td></td>
                        @endif
                        </tr>
                    @endif

                @endforeach
            </tbody>
        </table>
    </div>
@elseif($ilan->sozlesme_turu == 0 && $ilan->kismi_fiyat == 1) <!--Kısmi teklife açık -->
    
    <table class="table" id="table">
            <thead>

                <tr>
                    <th   width="10%">Sıra</th>
                    <th   width="20%">Firma Adı</th>
                    <th   width="20%">Verilen Fiyat({{$ilan->para_birimleri->adi}})</th>
                    <th   width="50%"></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($teklifler as $teklif)
                   <?php Debugbar::info($teklif->verilenFiyat()); ?>
                        @if($teklif->teklifler->teklifMalCount($ilan)) <!-- Tüm kalemlere teklif verme kontrolü -->
                        <tr>
                            <?php  $j++; ?>
                            @if(count($teklif->verilenFiyat()) != 0)
                                @if(session()->get('firma_id') == $teklif->teklifler->getFirma("id"))
                                    <td class="highlight">{{$j}}</td>
                                    <td class="highlight">{{$teklif->teklifler->getFirma("adi")}}</td>
                                    <td class="highlight" style="text-align: right"><strong>{{$teklif->verilenFiyat()}}</strong>
                                        @if($ilan->para_birimleri->adi == "Türk Lirası")
                                            &#8378;
                                        @elseif($ilan->para_birimleri->adi == "Dolar")
                                            $
                                        @else
                                            &#8364;
                                        @endif
                                    </td>
                                    <td class="highlight"></td>
                                <?php $sessionF= session()->get('firma_id'); $sahibF=$ilan->firmalar->id; ?>
                                @elseif(session()->get('firma_id') == $ilan->firmalar->id)
                                    <?php $ilanSahibi= 1;?>
                                    <td>{{$j}}</td>
                                    <td>{{$teklif->teklifler->getFirma("adi")}}:</td>
                                    <td  style="text-align: right"><strong>{{$teklif->verilenFiyat()}}</strong>
                                        @if($ilan->para_birimleri->adi == "Türk Lirası")
                                            &#8378;
                                        @elseif($ilan->para_birimleri->adi == "Dolar")
                                            $
                                        @else
                                            &#8364;
                                        @endif
                                    </td>
                                    @if($ilan->kapanma_tarihi > $dt)
                                        <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                    @else
                                        @if($kisKazanCount == 0)
                                            <td><button name="{{$teklif->teklifler->getFirma("id")}}" id="{{$teklif->verilenFiyat()}}" style="float:right" type="button" class="btn btn-info KapaliAcikRekabetKazanan">Kazanan</button></td>
                                        @elseif($kisKazanCount == 1)
                                            <td></td>
                                        @endif
                                    @endif
                                @else
                                    <td>{{$j}}</td>
                                    <td>X Firması</td>
                                    <td style="text-align: right"><strong> {{$teklif->verilenFiyat()}}</strong>
                                        @if($ilan->para_birimleri->adi == "Türk Lirası")
                                            &#8378;
                                        @elseif($ilan->para_birimleri->adi == "Dolar")
                                            $
                                        @else
                                            &#8364;
                                        @endif
                                    </td>
                                    <td></td>
                                @endif
                            @endif
                            </tr>
                        @endif

                @endforeach
                <tr> <!--Minumum fiyat sorgusu -->
                    <td class="minFiyat">{{$j=$j+1}}</td>
                    <td class="minFiyat">Optimum Fiyat</td>
                    <td class="minFiyat" style="text-align: right"><strong><?php foreach ($minFiyat as $fyt) { echo number_format($fyt->deneme, 2, '.', ''); } ?></strong> &#8378;</td>
                    <td class="minFiyat"></td>
                </tr>
            </tbody>
        </table>
@endif 
<script>
    var tcount ={{$tekliflerCount}};
    var i = {{$i}};
    var ilanSahibi = {{$ilanSahibi}};
    if(tcount === i && ilanSahibi !== 1) { ///ilan sahibi teklif vermediyse hide edilmesi
        $('#3').hide();
        $('.kismiDiv').hide();
        $('.kismiRekabet').hide();
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
