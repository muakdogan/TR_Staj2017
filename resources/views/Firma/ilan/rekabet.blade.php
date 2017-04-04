 <?php 
    if(count($teklifler) != 0){
        $tekliflerCount = App\Teklif::where('ilan_id',$ilan->id)->count();
    }
    else {
        $tekliflerCount = 0;
    }
    $i=0; $j=0; $ilanSahibi=0;
?>
@if(($ilan->sozlesme_turu == 0 || $ilan->sozlesme_turu == 1 )  && $ilan->kismi_fiyat == 0) <!--Kismi Teklife Kapalı -->
    <div class="tab-pane demo" id="3">
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
                    <?php $teklifFirma = App\Teklif::find($teklif->teklif_id);
                            $firmaAdi = App\Firma::find($teklifFirma->firma_id);?>
                    <?php $j++;  ?>
                    <?php $verilenFiyat = $teklifFirma->teklif_hareketler()->orderBy('id','desc')->limit(1)->get();
                        
                    
                    ?>
                    <?php $kazananKapali = App\KismiKapaliKazanan::where("ilan_id",$ilan->id)->get(); /////ilanın kazananı var mı kontrolü
                                            $kisKazanCount=0;
                                            foreach($kazananKapali as $kazanK){
                                                $kisKazanCount=1;
                                            }
                                        ?>
                                          
                    @if(count($verilenFiyat) != 0)
                        @if($kisKazanCount == 1 && $kazanK->kazanan_firma_id == $firmaAdi->id) <!--Kazanan firma kontrolü -->
                            <tr  class="kismiKazanan">
                        @else
                            <tr>
                        @endif  
                        @if(session()->get('firma_id') == $firmaAdi->id) <!--Teklifi veren firma ise -->
                            <td class="highlight">{{$j}}</td>                            
                            <td class="highlight">{{$firmaAdi->adi}}:</td>
                            <td class="highlight firmaFiyat" style="text-align: right"><strong>{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}</strong> &#8378;</td>
                            <td class="highlight"></td>
                        <?php $sessionF= session()->get('firma_id'); $sahibF=$ilan->firmalar->id; ?>
                        @elseif(session()->get('firma_id') == $ilan->firmalar->id) <!--İlan sahibi ise Kazananı belirlemek için -->
                            <?php $ilanSahibi= 1;?>
                            <td>{{$j}}</td>
                            <td>{{$firmaAdi->adi}}</td>
                            <td  style="text-align: right"><strong>{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}</strong> &#8378;</td>
                            @if($ilan->kapanma_tarihi > $dt)
                                <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                            @else
                                @if($kisKazanCount == 0)
                                    <td><button name="{{$firmaAdi->id}}" id="{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}" style="float:right" type="button" class="btn btn-info KapaliKazanan">Kazanan</button></td>
                                @elseif($kisKazanCount == 1 && $kazanK->kazanan_firma_id == $firmaAdi->id)
                                    <td>KAZANDI</td>
                                @endif
                            @endif
                        @else  <!-- Diğer teklif veren firmalar -->
                            <td>{{$j}}</td>
                            <td>X Firması</td>
                            <td style="text-align: right"><strong>{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}</strong> &#8378;</td>                            
                            <td></td>
                        @endif
                        </tr>
                    @endif    
                    
                @endforeach
            </tbody>
        </table>
    </div>
@elseif($ilan->sozlesme_turu == 0 && $ilan->kismi_fiyat == 1) <!--Kısmi teklife açık -->
    <div class="tab-pane" id="3">
        <table class="table" id="table"> 
            <thead>

                <tr>
                    <th   width="10%">Sıra</th>
                    <th   width="20%">Verilen Fiyat({{$ilan->para_birimleri->adi}})</th>
                    <th   width="20%">Firma Adı</th>
                    <th   width="50%"></th>
                </tr>
            </thead>
            <br>

            <tbody>
                @foreach($teklifler as $teklif)
                    <?php    $teklifFirma = App\Teklif::find($teklif->teklif_id);
                            $firmaAdi = App\Firma::find($teklifFirma->firma_id);?>
                    <?php $kazananKapali = App\KismiAcikKazanan::where("ilan_id",$ilan->id)->get();
                                            $kisKazanCount=0;
                                            foreach($kazananKapali as $kazanK){
                                                $kisKazanCount=1;
                                            }
                                        ?>
                        @if($ilan->ilan_turu == 1 && $ilan->sozlesme_turu == 0) <!--MAl -->
                            <?php $ilanMalCount = $ilan->ilan_mallar()->count();
                            $teklifMallar=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, mal_teklifler m
                                                WHERE t.id = m.teklif_id
                                                AND t.id ='$teklifFirma->id'
                                                GROUP BY m.ilan_mal_id"));
                                $teklifMalCount=0;
                                foreach($teklifMallar as $teklifMal){
                                    $teklifMalCount++;
                                }
                                  ?>
                        @elseif($ilan->ilan_turu == 2 && $ilan->sozlesme_turu == 0) <!--Hizmet -->      
                               <?php $ilanMalCount = $ilan->ilan_hizmetler()->count();
                                $teklifHizmetler=DB::select(DB::raw("SELECT * 
                                                FROM teklifler t, hizmet_teklifler h
                                                WHERE t.id = h.teklif_id
                                                AND t.id ='$teklifFirma->id'
                                                GROUP BY h.ilan_hizmet_id"));
                                $teklifMalCount=0;
                                foreach($teklifHizmetler as $teklifHizmet){
                                    $teklifMalCount++;
                                }
                                  ?>
                        @elseif($ilan->ilan_turu == 3)<!-- Yapım İşi-->
                                <?php $ilanMalCount = $ilan->ilan_yapim_isleri()->count();
                                        $teklifYapimIsleri=DB::select(DB::raw("SELECT * 
                                                        FROM teklifler t, yapim_isi_teklifler y
                                                        WHERE t.id = y.teklif_id
                                                        AND t.id ='$teklifFirma->id'
                                                        GROUP BY y.ilan_yapim_isleri_id"));
                                        $teklifMalCount=0;
                                        foreach($teklifYapimIsleri as $teklifYapimIsi){
                                            $teklifMalCount++;
                                        }
                                  ?>
                        @else <!-- Goturu Bedel-->
                            <?php $ilanMalCount = $ilan->ilan_goturu_bedeller()->count();
                                        $teklifGoturuBedeller=DB::select(DB::raw("SELECT * 
                                                        FROM teklifler t, goturu_bedel_teklifler g
                                                        WHERE t.id = g.teklif_id
                                                        AND t.id ='$teklifFirma->id'
                                                        GROUP BY g.ilan_goturu_bedel_id"));
                                        $teklifMalCount=0;
                                        foreach($teklifGoturuBedeller as $teklifGoturuBedel){
                                            $teklifMalCount++;
                                        }
                                  ?>
                        @endif
                       
            
                        @if($ilanMalCount == $teklifMalCount) <!-- Tüm kalemlere teklif verme kontrolü -->
                        <tr>
                            <?php $verilenFiyat = $teklifFirma->teklif_hareketler()->orderBy('id','desc')->limit(1)->get();
                               $j++; $i++;
                            ?>
                            @if(count($verilenFiyat) != 0)
                                @if(session()->get('firma_id') == $firmaAdi->id)
                                    <td class="highlight">{{$j}}</td>
                                    <td class="highlight" style="text-align: right"><strong>{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}</strong> &#8378;</td>
                                    <td class="highlight">{{$firmaAdi->adi}}</td>
                                    <td class="highlight"></td>
                                <?php $sessionF= session()->get('firma_id'); $sahibF=$ilan->firmalar->id; ?>
                                @elseif(session()->get('firma_id') == $ilan->firmalar->id)
                                    <?php $ilanSahibi= 1;?>
                                    <td>{{$j}}</td>
                                    <td  style="text-align: right"><strong>{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}</strong></td>
                                    <td>{{$firmaAdi->adi}}:</td>
                                    @if($ilan->kapanma_tarihi > $dt)
                                        <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                    @else
                                        @if($kisKazanCount == 0)
                                            <td><button name="{{$firmaAdi->id}}" id="{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}" style="float:right" type="button" class="btn btn-info KapaliAcikRekabetKazanan">Kazanan</button></td>
                                        @elseif($kisKazanCount == 1)
                                            <td></td>
                                        @endif
                                    @endif
                                @else
                                    <td>{{$j}}</td>
                                    <td style="text-align: right"><strong> {{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}</strong> &#8378;</td>
                                    <td>X Firması</td>
                                    <td></td>
                                @endif
                            @endif
                            </tr>
                        @endif   
                    
                @endforeach
                <tr> <!--Minumum fiyat sorgusu -->
                        @if($ilan->ilan_turu == 1 && $ilan->sozlesme_turu == 0) <!--MAl -->
                            <?php $minFiyat = DB::select(DB::raw("SELECT SUM( toplam ) AS deneme
                                FROM (

                                SELECT min( kdv_dahil_fiyat ) AS toplam
                                FROM teklifler t, mal_teklifler m
                                WHERE t.id = m.teklif_id
                                AND t.ilan_id ='$ilan->id'
                                AND m.id
                                IN (

                                SELECT MAX( id ) 
                                FROM mal_teklifler
                                GROUP BY teklif_id, ilan_mal_id
                                )
                                GROUP BY ilan_mal_id
                                )y"));
                            ?>
                        @elseif($ilan->ilan_turu == 2 && $ilan->sozlesme_turu == 0) <!--Hizmet -->      
                            <?php $minFiyat = DB::select(DB::raw("SELECT SUM( toplam ) AS deneme
                                FROM (
                                SELECT min( kdv_dahil_fiyat ) AS toplam
                                FROM teklifler t, hizmet_teklifler h
                                WHERE t.id = h.teklif_id
                                AND t.ilan_id ='$ilan->id'
                                AND h.id
                                IN (
                                SELECT MAX( id ) 
                                FROM hizmet_teklifler
                                GROUP BY teklif_id, ilan_hizmet_id
                                )
                                GROUP BY ilan_hizmet_id
                                )y"));
                            ?>  
                        @elseif($ilan->ilan_turu == 3)<!-- Yapım İşi-->
                            <?php $minFiyat = DB::select(DB::raw("SELECT SUM( toplam ) AS deneme
                                FROM (
                                SELECT min( kdv_dahil_fiyat ) AS toplam
                                FROM teklifler t, yapim_isi_teklifler y
                                WHERE t.id = y.teklif_id
                                AND t.ilan_id ='$ilan->id'
                                AND y.id
                                IN (
                                SELECT MAX( id ) 
                                FROM yapim_isi_teklifler
                                GROUP BY teklif_id, ilan_yapim_isleri_id
                                )
                                GROUP BY ilan_yapim_isleri_id
                                )y"));
                            ?>  
                        @else <!-- Goturu Bedel-->
                            <?php $minFiyat = DB::select(DB::raw("SELECT SUM( toplam ) AS deneme
                                FROM (
                                SELECT min( kdv_dahil_fiyat ) AS toplam
                                FROM teklifler t, goturu_bedel_teklifler g
                                WHERE t.id = g.teklif_id
                                AND t.ilan_id ='$ilan->id'
                                AND g.id
                                IN (
                                SELECT MAX( id ) 
                                FROM goturu_bedel_teklifler
                                GROUP BY teklif_id, ilan_goturu_bedel_id
                                )
                                GROUP BY ilan_goturu_bedel_id
                                )y"));
                            ?>  
                        @endif
                        
                    <td class="minFiyat">{{$j=$j+1}}</td>
                    <td class="minFiyat" style="text-align: right"><strong><?php foreach ($minFiyat as $fyt) { echo number_format($fyt->deneme, 2, '.', ''); } ?></strong> &#8378;</td>
                    <td class="minFiyat">Optimum Fiyat</td>
                    <td class="minFiyat"></td>
                </tr>
            </tbody>
        </table>
    </div>
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
