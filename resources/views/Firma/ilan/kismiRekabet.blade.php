@if($ilan->kismi_fiyat == 1)
    @if($ilan->ilan_turu == 1 && $ilan->sozlesme_turu == 0)
    <h3>Fiyat İstenen Kalemler Rekabet Listesi</h3>
       <table class="table table-condensed" style="border-collapse:collapse;" >
                <thead>
                    <tr>

                        <th width="6%" >Sıra:</th>
                        <th width="9%">Marka:</th>
                        <th width="9%">Model:</th>
                        <th width="9%">Adı:</th>
                        <th width="9%">Ambalaj:</th>
                        <th width="4%">Miktar:</th>
                        <th width="9%">Birim:</th>
                    </tr>
                </thead>
                    <?php $kismiCount =1;?>
                    @foreach($ilan->ilan_mallar as $ilan_mal)

                    <tr style="background-color:#e6e0d4 "data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                        <td>
                            {{$kismiCount}}
                        </td>
                        <td>
                            {{$ilan_mal->marka}}
                        </td>
                        <td>
                            {{$ilan_mal->model}}
                        </td>
                        <td>
                            {{$ilan_mal->adi}}
                        </td>
                        <td>
                            {{$ilan_mal->ambalaj}}
                        </td>
                        <td>
                            {{$ilan_mal->miktar}}
                        </td>
                        <td>
                            {{$ilan_mal->birimler->adi}}
                        </td>                            
                        <input type="hidden" name="ilan_mal_id[]"  id="ilan_mal_id" value="{{$ilan_mal->id}}"> 
                    </tr>
                    <tr>
                        <td colspan="8" class="hiddenRow">
                            <div class="accordian-body collapse" id="kalem{{$kismiCount}}">
                                <!--Mal kalemleri çekme sorgusu -->
                                <?php 
                                $malIdTeklifler= DB::select(DB::raw("SELECT * 
                                    FROM mal_teklifler
                                    WHERE ilan_mal_id ='$ilan_mal->id'
                                    AND id
                                    IN (
                                        
                                    SELECT MAX( id ) 
                                    FROM mal_teklifler
                                    GROUP BY teklif_id, ilan_mal_id
                                    )
                                    ORDER BY kdv_dahil_fiyat ASC  "));
                                    $malIdCount=1;
                                ?>
                                
                                <table>
                                    <thead>
                                        <tr>
                                            <th >Sıra:</th>
                                            <th >Firma:</th>
                                            <th >KDV:</th>
                                            <th >Birim Fiyat:</th>
                                            <th >Toplam:</th>
                                        </tr>
                                    </thead>
                                    
                                        @foreach($malIdTeklifler as $malIdTeklif)
                                        <?php 
                                            $firmaMalId = App\Teklif::find($malIdTeklif->teklif_id);
                                            $firmaMal = App\Firma::find($firmaMalId->firma_id);
                                        ?>
                                        <?php $kazanan = App\KismiAcikKazanan::where("ilan_id",$ilan->id)->where("kalem_id",$malIdTeklif->ilan_mal_id)->get();
                                            $kisKazanCount=0;
                                            foreach($kazanan as $kazan){
                                                $kisKazanCount=1;
                                            }
                                        ?>
                                        @if($kisKazanCount == 1 && $kazan->kazanan_firma_id == $firmaMal->id)
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle kismiKazanan">
                                        @else
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                                        @endif    
                                            @if(session()->get('firma_id') == $firmaMal->id) <!--Teklifi veren firma ise -->   
                                                <td class="highlight">
                                                    {{$malIdCount++}}
                                                </td>
                                                <td class="highlight">
                                                    {{$firmaMal->adi}}
                                                </td>
                                                <td class="highlight">
                                                    {{$malIdTeklif->kdv_orani}}
                                                </td>
                                                <td class="highlight">
                                                    {{$malIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td class="highlight">
                                                    {{number_format($malIdTeklif->kdv_dahil_fiyat,2,'.','')}} &#8378;
                                                </td>
                                            @elseif(session()->get('firma_id') == $ilan->firmalar->id)<!--İlan sahibi ise Kazananı belirlemek için -->
                                                <td>
                                                    {{$malIdCount++}}
                                                </td>
                                                <td>
                                                    {{$firmaMal->adi}}
                                                </td>
                                                <td>
                                                    {{$malIdTeklif->kdv_orani}}
                                                </td>
                                                <td>
                                                    {{$malIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td>
                                                    {{number_format($malIdTeklif->kdv_dahil_fiyat,2,'.','')}} &#8378;
                                                </td>
                                                @if($ilan->kapanma_tarihi > $dt)
                                                    <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                                @else
                                                    @if($kisKazanCount == 0)
                                                        <td><button  style="float:right" name="{{$malIdTeklif->ilan_mal_id}}_{{number_format($malIdTeklif->kdv_dahil_fiyat,2,'.','')}}" id="{{$firmaMal->id}}" type="button" class="btn btn-info kazanan kazan{{$malIdTeklif->ilan_mal_id}}">Kazanan</button></td>
                                                    @elseif($kisKazanCount == 1 && $kazan->kazanan_firma_id == $firmaMal->id)
                                                        <td>KAZANDI</td>
                                                    @endif
                                                @endif
                                            @else
                                                <td>
                                                    {{$malIdCount++}}
                                                </td>
                                                <td>
                                                    X Firması
                                                </td>
                                                <td>
                                                    {{$malIdTeklif->kdv_orani}}
                                                </td>
                                                <td>
                                                    {{$malIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td>
                                                    {{number_format($malIdTeklif->kdv_dahil_fiyat,2,'.','')}} &#8378;
                                                </td>
                                            @endif    
                                        </tr>
                                    @endforeach
                                </table> 
                            </div> 
                        </td>
                    </tr>
                    <?php $kismiCount=$kismiCount+1;?>
                @endforeach
        </table>
    @elseif($ilan->ilan_turu == 2 && $ilan->sozlesme_turu == 0)     <!--Hizmet Teklifler -->  
        <h3>Fiyat İstenen Kalemler Rekabet Listesi</h3>
       <table class="table table-condensed" style="border-collapse:collapse;" >
                <thead>
                    <tr>
                        <th>Sıra:</th>
                        <th>Adı:</th>
                        <th>Fiyat Standartı:</th>
                        <th>Fiyat Standartı Birimi:</th>
                        <th>Miktar:</th>
                        <th>Miktar Birimi:</th>
                    </tr>
                </thead>
                    <?php $kismiCount =1;?>
                    @foreach($ilan->ilan_hizmetler as $ilan_hizmet)

                    <tr style="background-color:#e6e0d4 "data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                        <td>
                            {{$kismiCount}}
                        </td>
                        <td>
                            {{$ilan_hizmet->adi}}
                        </td>
                        <td>
                            {{$ilan_hizmet->fiyat_standardi}}
                        </td>
                        <td>
                            {{$ilan_hizmet->fiyat_birimler->adi}}
                        </td>
                        <td>
                            {{$ilan_hizmet->miktar}}
                        </td>
                        <td>
                            {{$ilan_hizmet->miktar_birimler->adi}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="hiddenRow">
                            <div class="accordian-body collapse" id="kalem{{$kismiCount}}"> 
                                <!--Hizmet kalemleri çekme sorgusu -->
                                <?php 
                                $hizmetIdTeklifler= DB::select(DB::raw("SELECT * 
                                    FROM hizmet_teklifler
                                    WHERE ilan_hizmet_id ='$ilan_hizmet->id'
                                    AND id
                                    IN (
                                        
                                    SELECT MAX( id ) 
                                    FROM hizmet_teklifler
                                    GROUP BY teklif_id, ilan_hizmet_id
                                    )
                                    ORDER BY kdv_dahil_fiyat ASC  "));
                                    $hizmetIdCount=1;
                                ?>
                                
                                <table>
                                    <thead>
                                        <tr>
                                            <th >Sıra:</th>
                                            <th >Firma:</th>
                                            <th >KDV:</th>
                                            <th >Birim Fiyat:</th>
                                            <th >Toplam:</th>
                                        </tr>
                                    </thead>
                                    
                                        @foreach($hizmetIdTeklifler as $hizmetIdTeklif)
                                        <?php 
                                            $firmaHizmetId = App\Teklif::find($hizmetIdTeklif->teklif_id);
                                            $firmaHizmet = App\Firma::find($firmaHizmetId->firma_id);
                                        ?>
                                        <?php $kazanan = App\KismiAcikKazanan::where("ilan_id",$ilan->id)->where("kalem_id",$hizmetIdTeklif->ilan_hizmet_id)->get();
                                            $kisKazanCount=0;
                                            foreach($kazanan as $kazan){
                                                $kisKazanCount=1;
                                            }
                                        ?>
                                        @if($kisKazanCount == 1 && $kazan->kazanan_firma_id == $firmaHizmet->id)
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle kismiKazanan">
                                        @else
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                                        @endif
                                            @if(session()->get('firma_id') == $firmaHizmet->id) <!--Teklifi veren firma ise -->   
                                                <td class="highlight">
                                                    @if($hizmetIdCount == 1)
                                                        <img src="{{asset('images/rightOk.png')}}" width="40" height="20">
                                                    @endif
                                                    {{$hizmetIdCount++}}
                                                </td>
                                                <td class="highlight">
                                                    {{$firmaHizmet->adi}}
                                                </td>
                                                <td class="highlight">
                                                    {{$hizmetIdTeklif->kdv_orani}}
                                                </td>
                                                <td class="highlight">
                                                    {{$hizmetIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td class="highlight">
                                                    {{number_format($hizmetIdTeklif->kdv_dahil_fiyat,2,'.','')}} &#8378;
                                                </td>
                                            @elseif(session()->get('firma_id') == $ilan->firmalar->id)<!--İlan sahibi ise Kazananı belirlemek için -->
                                                <td>
                                                    {{$hizmetIdCount++}}
                                                </td>
                                                <td>
                                                    {{$firmaHizmet->adi}}
                                                </td>
                                                <td>
                                                    {{$hizmetIdTeklif->kdv_orani}}
                                                </td>
                                                <td>
                                                    {{$hizmetIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td>
                                                    {{number_format($hizmetIdTeklif->kdv_dahil_fiyat,2,'.','')}} &#8378;
                                                </td>
                                                @if($ilan->kapanma_tarihi > $dt)
                                                    <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                                @else
                                                    @if($kisKazanCount == 0)
                                                        <td><button  style="float:right" name="{{$hizmetIdTeklif->ilan_hizmet_id}}_{{number_format($hizmetIdTeklif->kdv_dahil_fiyat,2,'.','')}}" id="{{$firmaHizmet->id}}" type="button" class="btn btn-info kazanan kazan{{$hizmetIdTeklif->ilan_hizmet_id}}">Kazanan</button></td>
                                                    @elseif($kisKazanCount == 1 && $kazan->kazanan_firma_id == $firmaHizmet->id)
                                                        <td>KAZANDI</td>
                                                    @endif
                                                @endif
                                            @else
                                                <td>
                                                    {{$hizmetIdCount++}}
                                                </td>
                                                <td>
                                                    X Firması
                                                </td>
                                                <td>
                                                    {{$hizmetIdTeklif->kdv_orani}}
                                                </td>
                                                <td>
                                                    {{$hizmetIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td>
                                                    {{number_format($hizmetIdTeklif->kdv_dahil_fiyat,2,'.','')}} &#8378;
                                                </td>
                                            @endif    
                                        </tr>
                                    @endforeach
                                </table> 
                            </div> 
                        </td>
                    </tr>
                    <?php $kismiCount=$kismiCount+1;?>
                @endforeach
        </table>   
    @elseif($ilan->ilan_turu == 3)  <!--Yapım İşi Teklifler -->
        <h3>Fiyat İstenen Kalemler Rekabet Listesi</h3>
       <table class="table table-condensed" style="border-collapse:collapse;" >
                <thead>
                    <tr>
                        <th>Sıra:</th>
                        <th>Adı:</th>
                        <th>Miktar:</th>
                        <th>Birim:</th>
                    </tr>
                </thead>
                    <?php $kismiCount =1;?>
                    @foreach($ilan->ilan_yapim_isleri as $ilan_yapim_isi)

                    <tr style="background-color:#e6e0d4 "data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                        <td>
                            {{$kismiCount}}
                        </td>
                        <td>
                            {{$ilan_yapim_isi->adi}}
                        </td>
                        <td>
                            {{$ilan_yapim_isi->miktar}}
                        </td>
                        <td>
                            {{$ilan_yapim_isi->birimler->adi}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="hiddenRow">
                            <div class="accordian-body collapse" id="kalem{{$kismiCount}}"> 
                                <!--Hizmet kalemleri çekme sorgusu -->
                                <?php 
                                $yapimIsiIdTeklifler= DB::select(DB::raw("SELECT * 
                                    FROM yapim_isi_teklifler
                                    WHERE ilan_yapim_isleri_id ='$ilan_yapim_isi->id'
                                    AND id
                                    IN (
                                        
                                    SELECT MAX( id ) 
                                    FROM yapim_isi_teklifler
                                    GROUP BY teklif_id, ilan_yapim_isleri_id
                                    )
                                    ORDER BY kdv_dahil_fiyat ASC  "));
                                    $yapimIsiIdCount=1;
                                ?>
                                
                                <table>
                                    <thead>
                                        <tr>
                                            <th >Sıra:</th>
                                            <th >Firma:</th>
                                            <th >KDV:</th>
                                            <th >Birim Fiyat:</th>
                                            <th >Toplam:</th>
                                        </tr>
                                    </thead>
                                    
                                        @foreach($yapimIsiIdTeklifler as $yapimIsiIdTeklif)
                                        <?php 
                                            $firmaYapimIsiId = App\Teklif::find($yapimIsiIdTeklif->teklif_id);
                                            $firmaYapimIsi = App\Firma::find($firmaYapimIsiId->firma_id);
                                        ?>
                                        <?php $kazanan = App\KismiAcikKazanan::where("ilan_id",$ilan->id)->where("kalem_id",$yapimIsiIdTeklif->ilan_yapim_isleri_id)->get();
                                            $kisKazanCount=0;
                                            foreach($kazanan as $kazan){
                                                $kisKazanCount=1;
                                            }
                                        ?>
                                        @if($kisKazanCount == 1 && $kazan->kazanan_firma_id == $firmaYapimIsi->id)
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle kismiKazanan">
                                        @else
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                                        @endif    
                                        <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                                            @if(session()->get('firma_id') == $firmaYapimIsi->id) <!--Teklifi veren firma ise -->   
                                                <td class="highlight">
                                                    {{$yapimIsiIdCount++}}
                                                </td>
                                                <td class="highlight">
                                                    {{$firmaYapimIsi->adi}}
                                                </td>
                                                <td class="highlight">
                                                    {{$yapimIsiIdTeklif->kdv_orani}}
                                                </td>
                                                <td class="highlight">
                                                    {{$yapimIsiIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td class="highlight">
                                                    {{number_format($yapimIsiIdTeklif->kdv_dahil_fiyat,2,'.','')}} &#8378;
                                                </td>
                                            @elseif(session()->get('firma_id') == $ilan->firmalar->id)<!--İlan sahibi ise Kazananı belirlemek için -->
                                                <td>
                                                    {{$yapimIsiIdCount++}}
                                                </td>
                                                <td>
                                                    {{$firmaYapimIsi->adi}}
                                                </td>
                                                <td>
                                                    {{$yapimIsiIdTeklif->kdv_orani}}
                                                </td>
                                                <td>
                                                    {{$yapimIsiIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td>
                                                    {{number_format($yapimIsiIdTeklif->kdv_dahil_fiyat,2,'.','')}} &#8378;
                                                </td>
                                                @if($ilan->kapanma_tarihi > $dt)
                                                    <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                                @else
                                                    @if($kisKazanCount == 0)
                                                        <td><button  style="float:right" name="{{$yapimIsiIdTeklif->ilan_yapim_isleri_id}}_{{number_format($yapimIsiIdTeklif->kdv_dahil_fiyat,2,'.','')}}" id="{{$firmaYapimIsi->id}}" type="button" class="btn btn-info kazanan kazan{{$yapimIsiIdTeklif->ilan_yapim_isleri_id}}">Kazanan</button></td>
                                                    @elseif($kisKazanCount == 1 && $kazan->kazanan_firma_id == $firmaYapimIsi->id)
                                                        <td>KAZANDI</td>
                                                    @endif
                                                @endif
                                            @else
                                                <td>
                                                    {{$yapimIsiIdCount++}}
                                                </td>
                                                <td>
                                                    X Firması
                                                </td>
                                                <td>
                                                    {{$yapimIsiIdTeklif->kdv_orani}}
                                                </td>
                                                <td>
                                                    {{$yapimIsiIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td>
                                                    {{number_format($yapimIsiIdTeklif->kdv_dahil_fiyat,2,'.','')}} &#8378;
                                                </td>
                                            @endif    
                                        </tr>
                                    @endforeach
                                </table> 
                            </div> 
                        </td>
                    </tr>
                    <?php $kismiCount=$kismiCount+1;?>
                @endforeach
        </table>   
    @endif 
@endif    
<script>
    $(".kazanan").click(function(){
       var name=$(this).attr("name");
       var nameArray = name.split('_');
       var kalemId = nameArray[0];
       var kazananFiyat = nameArray[1];
       alert(kalemId);
       alert(kazananFiyat);
       var kazananFirmaId=$(this).attr("id");
       var ilanID={{$ilan->id}};
       var successValue = $(this);
       if(confirm("Bu firmayı kazanan ilan etmek istediğinize emin misiniz ?")){
            $.ajax({
                type:"POST",
                url:"http://localhost:8080/22.11.2016tamrekabet/public/KismiAcikKazanan",
                data:{ilan_id:ilanID, kazananFirmaId:kazananFirmaId, kalem_id:kalemId ,kazanan_fiyat:kazananFiyat},
                cache: false,
                success: function(data){
                    console.log(data);
                    console.log(successValue.parent().parent());
                    alert(" Seçmiş Olduğunuz Kalemin Kazanını Kaydedildi!");
                    $('.kazan'+kalemId).hide();
                    $('.KapaliAcikRekabetKazanan').hide();
                    successValue.parent().parent().addClass("kismiKazanan");
                    successValue.parent().text("KAZANDI");  
                }
            });
        }
        else{
            return false;
        }
    });
</script>
