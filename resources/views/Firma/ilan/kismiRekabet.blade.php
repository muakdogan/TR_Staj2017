<?php $puanNumber = 0;?>
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
                    <?php 
                    $kismiCount =1;
                    $kullanici_id=Auth::user()->id;?>
                    
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
                                <?php $malIdCount=1;?>
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
                                        
                                        @foreach($ilan_mal->malIdTeklifler($ilan_mal->id,$ilan->id) as $malIdTeklif)
                                        
                                        @if($ilan_mal->kisKazanCount() == 1 && $ilan_mal->kisKazananFirmaId() == $ilan_mal->getFirmaId($malIdTeklif->teklif_id))
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle kismiKazanan">
                                        @else
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                                        @endif    
                                            @if(session()->get('firma_id') == $ilan_mal->getFirmaId($malIdTeklif->teklif_id)) <!--Teklifi veren firma ise -->   
                                                <td class="highlight">
                                                    {{$malIdCount++}}
                                                </td>
                                                <td class="highlight">
                                                    {{$ilan_mal->getFirmaAdi($malIdTeklif->teklif_id)}}
                                                </td>
                                                <td class="highlight">
                                                    {{$malIdTeklif->kdv_orani}}
                                                </td>
                                                <td class="highlight">
                                                    {{$malIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td class="highlight currency2">
                                                    {{number_format($malIdTeklif->kdv_dahil_fiyat,2,'.','')}}
                                                </td>
                                            @elseif(session()->get('firma_id') == $ilan->firmalar->id)<!--İlan sahibi ise Kazananı belirlemek için -->
                                                <td>
                                                    {{$malIdCount++}}
                                                </td>
                                                <td>
                                                    {{$ilan_mal->getFirmaAdi($malIdTeklif->teklif_id)}}
                                                </td>
                                                <td>
                                                    {{$malIdTeklif->kdv_orani}}
                                                </td>
                                                <td>
                                                    {{$malIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td class="currency2">
                                                    {{number_format($malIdTeklif->kdv_dahil_fiyat,2,'.','')}}
                                                </td>
                                                
                                                @if($ilan->kapanma_tarihi > $dt)
                                                    <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                                @else
                                                    @if($ilan_mal->kisKazanCount() == 0)
                                                        <td><button  style="float:right" name="{{$malIdTeklif->ilan_mal_id}}_{{number_format($malIdTeklif->kdv_dahil_fiyat,2,'.','')}}" id="{{$ilan_mal->getFirmaId($malIdTeklif->teklif_id)}}" type="button" class="btn btn-info kazanan kazan{{$malIdTeklif->ilan_mal_id}}">Kazanan</button></td>
                                                    @elseif($ilan_mal->kisKazanCount() == 1 && $ilan_mal->kisKazananFirmaId() == $ilan_mal->getFirmaId($malIdTeklif->teklif_id))
                                                        <td>KAZANDI</td>
                                                        <?php $existYorum = $ilan->existsYorum($ilan_mal->getFirmaId($malIdTeklif->teklif_id));  ///////////// Daha önce yorum
                                                              $existPuan = $ilan->existsPuan($ilan_mal->getFirmaId($malIdTeklif->teklif_id)); ///////yapılmış mı onun kontrolü
                                                        ?>
                                                        @if(count($existPuan) != 0 || count($existYorum) != 0)
                                                            <td>
                                                           <a><button style="float:right;padding: 4px 12px;font-size:12px" type="button" class="btn btn-info add" id="{{$puanNumber}}">Puan Ver/Yorum Yap</button></a>
                                                        @endif    
                                                            <div class="modal fade" id="myModalForm{{$puanNumber}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div style="background-color: #fcf8e3;" class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                            <h4 style="font-size:14px" class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Puanla/Yorum Yap</strong></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="dialog" id="dialog{{$puanNumber++}}" style="display:none">

                                                                                {!! Form::open(array('url'=>'yorumPuan/'.$firma->id.'/'.$ilan_mal->getFirmaId($malIdTeklif->teklif_id).'/'.$ilan->id.'/'.$kullanici_id,'method'=>'POST', 'files'=>true)) !!}
                                                                                  <div class="row col-lg-12">
                                                                                    <div class="col-lg-3">
                                                                                        <label1 name="kriter1" type="text" >Ürün/hizmet kalitesi</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber}}"></div>
                                                                                          <input type="hidden" id="puan1" name="puan1" value="5"/>
                                                                                      </div>
                                                                                    </div>  
                                                                                    <div class="col-lg-3" style="border-color:#ddd">
                                                                                        <label1 name="kriter2" type="text"><br>Teslimat</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber+1}}"></div>
                                                                                          <input type="hidden" id="puan2" name="puan2" value="5"/>
                                                                                      </div>
                                                                                    </div> 
                                                                                    <div class="col-lg-3">
                                                                                        <label1 name="kriter3" type="text">Teknik ve Yönetsel Yeterlilik</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber+2}}"></div>
                                                                                          <input type="hidden" id="puan3" name="puan3" value="5"/>
                                                                                      </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <label1 name="kriter4" type="text" >İletişim ve Esneklik</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber+3}}"></div>
                                                                                          <input type="hidden" id="puan4" name="puan4" value="5"/>
                                                                                      </div>
                                                                                    </div> 
                                                                                  </div>


                                                                                  <textarea name="yorum" placeholder="Yorum" cols="30" rows="5" wrap="soft"></textarea>
                                                                                  <input type="submit" value="Ok"/>
                                                                                {{ Form::close() }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td><?php $puanNumber=$puanNumber+3;?>
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
                                                <td class="currency2">
                                                    {{number_format($malIdTeklif->kdv_dahil_fiyat,2,'.','')}}
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
                    <?php $puanCount=0;  $i = 0;?>
                    @foreach($ilan->ilan_hizmetler as $ilan_hizmet)

                    <tr style="background-color:#e6e0d4 "data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                        <td>
                            {{$kismiCount}}
                        </td>
                        <td>
                            {{$ilan_hizmet->kalem_adi}}
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
                                <?php  $hizmetIdCount=1; ?>
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
                                    
                                    @foreach($ilan_hizmet->hizmetIdTeklifler($ilan->id) as $hizmetIdTeklif)
                                        
                                        @if($ilan_hizmet->kisKazanCount() == 1 && $ilan_hizmet->kisKazananFirmaId() == $ilan_hizmet->getFirmaId($hizmetIdTeklif->teklif_id))
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle kismiKazanan">
                                        @else
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                                        @endif
                                            @if(session()->get('firma_id') == $ilan_hizmet->getFirmaId($hizmetIdTeklif->teklif_id)) <!--Teklifi veren firma ise -->   
                                                <td class="highlight">
                                                    @if($hizmetIdCount == 1)
                                                        <img src="{{asset('images/rightOk.png')}}" width="40" height="20">
                                                    @endif
                                                    {{$hizmetIdCount++}}
                                                </td>
                                                <td class="highlight">
                                                    {{$ilan_hizmet->getFirmaAdi($hizmetIdTeklif->teklif_id)}}
                                                </td>
                                                <td class="highlight">
                                                    {{$hizmetIdTeklif->kdv_orani}}
                                                </td>
                                                <td class="highlight">
                                                    {{$hizmetIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td class="highlight currency2">
                                                    {{number_format($hizmetIdTeklif->kdv_dahil_fiyat,2,'.','')}}
                                                </td>
                                            @elseif(session()->get('firma_id') == $ilan->firmalar->id)<!--İlan sahibi ise Kazananı belirlemek için -->
                                                <td>
                                                    {{$hizmetIdCount++}}
                                                </td>
                                                <td>
                                                    {{$ilan_hizmet->getFirmaAdi($hizmetIdTeklif->teklif_id)}}
                                                </td>
                                                <td>
                                                    {{$hizmetIdTeklif->kdv_orani}}
                                                </td>
                                                <td>
                                                    {{$hizmetIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td class="currency2">
                                                    {{number_format($hizmetIdTeklif->kdv_dahil_fiyat,2,'.','')}}
                                                </td>
                                                @if($ilan->kapanma_tarihi > $dt)
                                                    <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                                @else
                                                    @if($ilan_hizmet->kisKazanCount() == 0)
                                                        <td><button  style="float:right" name="{{$hizmetIdTeklif->ilan_hizmet_id}}_{{number_format($hizmetIdTeklif->kdv_dahil_fiyat,2,'.','')}}" id="{{$ilan_hizmet->getFirmaId($hizmetIdTeklif->teklif_id)}}" type="button" class="btn btn-info kazanan kazan{{$hizmetIdTeklif->ilan_hizmet_id}}">Kazanan</button></td>
                                                    @elseif($ilan_hizmet->kisKazanCount() == 1 && $ilan_hizmet->kisKazananFirmaId == $ilan_hizmet->getFirmaId())
                                                        <td>KAZANDI</td>
                                                        <?php $existYorum = $ilan->existsYorum($ilan_hizmet->getFirmaId($hizmetIdTeklif->teklif_id));  ///////////// Daha önce yorum
                                                              $existPuan = $ilan->existsPuan($ilan_hizmet->getFirmaId($hizmetIdTeklif->teklif_id)); ///////yapılmış mı onun kontrolü
                                                        ?>
                                                        @if(count($existPuan) != 0 || count($existYorum) != 0)
                                                            <td>
                                                           <a><button style="float:right;padding: 4px 12px;font-size:12px" type="button" class="btn btn-info add" id="{{$puanNumber}}">Puan Ver/Yorum Yap</button></a>
                                                        @endif 
                                                            <div class="modal fade" id="myModalForm{{$puanNumber}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div style="background-color: #fcf8e3;" class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                            <h4 style="font-size:14px" class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Puanla/Yorum Yap</strong></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="dialog" id="dialog{{$puanNumber++}}" style="display:none">

                                                                                {!! Form::open(array('url'=>'yorumPuan/'.$firma->id.'/'.$ilan_hizmet->getFirmaId($hizmetIdTeklif->teklif_id).'/'.$ilan->id.'/'.$kullanici_id,'method'=>'POST', 'files'=>true)) !!}
                                                                                  <div class="row col-lg-12">
                                                                                    <div class="col-lg-3">
                                                                                        <label1 name="kriter1" type="text" >Ürün/hizmet kalitesi</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber}}"></div>
                                                                                          <input type="hidden" id="puan1" name="puan1" value="5"/>
                                                                                      </div>
                                                                                    </div>  
                                                                                    <div class="col-lg-3" style="border-color:#ddd">
                                                                                        <label1 name="kriter2" type="text"><br>Teslimat</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber+1}}"></div>
                                                                                          <input type="hidden" id="puan2" name="puan2" value="5"/>
                                                                                      </div>
                                                                                    </div> 
                                                                                    <div class="col-lg-3">
                                                                                        <label1 name="kriter3" type="text">Teknik ve Yönetsel Yeterlilik</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber+2}}"></div>
                                                                                          <input type="hidden" id="puan3" name="puan3" value="5"/>
                                                                                      </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <label1 name="kriter4" type="text" >İletişim ve Esneklik</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber+3}}"></div>
                                                                                          <input type="hidden" id="puan4" name="puan4" value="5"/>
                                                                                      </div>
                                                                                    </div> 
                                                                                  </div>


                                                                                  <textarea name="yorum" placeholder="Yorum" cols="30" rows="5" wrap="soft"></textarea>
                                                                                  <input type="submit" value="Ok"/>
                                                                                {{ Form::close() }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             </div>
                                                        </td><?php $puanNumber=$puanNumber+3;?>
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
                                                <td class="currency2">
                                                    {{number_format($hizmetIdTeklif->kdv_dahil_fiyat,2,'.','')}}
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
                    <?php $puanCount=0; $i = 0;?>
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
                                <?php  $yapimIsiIdCount=1;?>
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
                                    
                                    @foreach($ilan_yapim_isi->yapimIsiIdTeklifler($ilan->id) as $yapimIsiIdTeklif)
                                        
                                        @if($ilan_yapim_isi->kisKazanCount() == 1 && $ilan_yapim_isi->kisKazananFirmaId() == $ilan_yapim_isi->getFirmaId($yapimIsiIdTeklif->teklif_id))
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle kismiKazanan">
                                        @else
                                            <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                                        @endif    
                                        <tr data-toggle="collapse" data-target="#kalem{{$kismiCount}}" class="accordion-toggle">
                                            @if(session()->get('firma_id') == $ilan_yapim_isi->getFirmaId($yapimIsiIdTeklif->teklif_id)) <!--Teklifi veren firma ise -->   
                                                <td class="highlight">
                                                    {{$yapimIsiIdCount++}}
                                                </td>
                                                <td class="highlight">
                                                    {{$ilan_yapim_isi->getFirmaAdi($yapimIsiIdTeklif->teklif_id)}}
                                                </td>
                                                <td class="highlight">
                                                    {{$yapimIsiIdTeklif->kdv_orani}}
                                                </td>
                                                <td class="highlight">
                                                    {{$yapimIsiIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td class="highlight currency2">
                                                    {{number_format($yapimIsiIdTeklif->kdv_dahil_fiyat,2,'.','')}}
                                                </td>
                                            @elseif(session()->get('firma_id') == $ilan->firmalar->id)<!--İlan sahibi ise Kazananı belirlemek için -->
                                                <td>
                                                    {{$yapimIsiIdCount++}}
                                                </td>
                                                <td>
                                                    {{$ilan_yapim_isi->getFirmaAdi($yapimIsiIdTeklif->teklif_id)}}
                                                </td>
                                                <td>
                                                    {{$yapimIsiIdTeklif->kdv_orani}}
                                                </td>
                                                <td>
                                                    {{$yapimIsiIdTeklif->kdv_haric_fiyat}}
                                                </td>
                                                <td class="currency2">
                                                    {{number_format($yapimIsiIdTeklif->kdv_dahil_fiyat,2,'.','')}}
                                                </td>
                                                @if($ilan->kapanma_tarihi > $dt)
                                                    <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                                @else
                                                    @if($ilan_yapim_isi->kisKazanCount() == 0)
                                                        <td><button  style="float:right" name="{{$yapimIsiIdTeklif->ilan_yapim_isleri_id}}_{{number_format($yapimIsiIdTeklif->kdv_dahil_fiyat,2,'.','')}}" id="{{$ilan_yapim_isi->getFirmaId($yapimIsiIdTeklif->teklif_id)}}" type="button" class="btn btn-info kazanan kazan{{$yapimIsiIdTeklif->ilan_yapim_isleri_id}}">Kazanan</button></td>
                                                    @elseif($ilan_yapim_isi->kisKazanCount() == 1 && $kazan->kazanan_firma_id == $ilan_yapim_isi->getFirmaId($yapimIsiIdTeklif->teklif_id))
                                                        <td>KAZANDI</td>
                                                        <?php $existYorum = $ilan->existsYorum($ilan_yapim_isi->getFirmaId($yapimIsiIdTeklif->teklif_id));  ///////////// Daha önce yorum
                                                              $existPuan = $ilan->existsPuan($ilan_yapim_isi->getFirmaId($yapimIsiIdCount->teklif_id)); ///////yapılmış mı onun kontrolü
                                                        ?>
                                                        @if(count($existPuan) != 0 || count($existYorum) != 0)
                                                            <td>
                                                                <a><button style="float:right;padding: 4px 12px;font-size:12px" type="button" class="btn btn-info add" id="{{$puanNumber}}">Puan Ver/Yorum Yap</button></a>
                                                        @endif <div class="modal fade" id="myModalForm{{$puanNumber}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div style="background-color: #fcf8e3;" class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                            <h4 style="font-size:14px" class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Puanla/Yorum Yap</strong></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="dialog" id="dialog{{$puanNumber++}}" style="display:none">

                                                                                {!! Form::open(array('url'=>'yorumPuan/'.$firma->id.'/'.$ilan_yapim_isi->getFirmaId($yapimIsiIdTeklif->teklif_id).'/'.$ilan->id.'/'.$kullanici_id,'method'=>'POST', 'files'=>true)) !!}
                                                                                  <div class="row col-lg-12">
                                                                                    <div class="col-lg-3">
                                                                                        <label1 name="kriter1" type="text" >Ürün/hizmet kalitesi</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber}}"></div>
                                                                                          <input type="hidden" id="puan1" name="puan1" value="5"/>
                                                                                      </div>
                                                                                    </div>  
                                                                                    <div class="col-lg-3" style="border-color:#ddd">
                                                                                        <label1 name="kriter2" type="text"><br>Teslimat</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber+1}}"></div>
                                                                                          <input type="hidden" id="puan2" name="puan2" value="5"/>
                                                                                      </div>
                                                                                    </div> 
                                                                                    <div class="col-lg-3">
                                                                                        <label1 name="kriter3" type="text">Teknik ve Yönetsel Yeterlilik</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber+2}}"></div>
                                                                                          <input type="hidden" id="puan3" name="puan3" value="5"/>
                                                                                      </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <label1 name="kriter4" type="text" >İletişim ve Esneklik</label1>
                                                                                      <div id="puanlama">
                                                                                          <div class="sliders" id="k{{$puanNumber+3}}"></div>
                                                                                          <input type="hidden" id="puan4" name="puan4" value="5"/>
                                                                                      </div>
                                                                                    </div> 
                                                                                  </div>


                                                                                  <textarea name="yorum" placeholder="Yorum" cols="30" rows="5" wrap="soft"></textarea>
                                                                                  <input type="submit" value="Ok"/>
                                                                                {{ Form::close() }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             </div>
                                                        </td><?php $puanNumber=$puanNumber+3;?>
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
                                                <td class="currency2">
                                                    {{number_format($yapimIsiIdTeklif->kdv_dahil_fiyat,2,'.','')}}
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
    
<script>
    $(".kazanan").click(function(){
       var name=$(this).attr("name");
       var nameArray = name.split('_');
       var kalemId = nameArray[0];
       var kazananFiyat = nameArray[1];
      
       var kazananFirmaId=$(this).attr("id");
       var ilanID={{$ilan->id}};
       var successValue = $(this);
       if(confirm("Bu firmayı kazanan ilan etmek istediğinize emin misiniz ?")){
            $.ajax({
                type:"POST",
                url:"{{asset('KismiAcikKazanan')}}",
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
    
     $(document).ready(function() {
    
    
        
        for(var key=0; key<{{$puanNumber}}; key=key+4){
            $('#'+key).click(function(e){
                var j = $(this).attr('id');
              e.stopPropagation();
             if ($(this).hasClass('active')){
                $('#dialog'+j).fadeOut(200);
                $(this).removeClass('active');
             } else {
                $('#myModalForm'+j).modal('show');
                $('#dialog'+j).delay(300).fadeIn(200);
                $(this).addClass('active');
             }
           });
        }   
        function closeMenu(){
          $('.dialog').fadeOut(200);
          $('.add').removeClass('active');  
        }

        $(document.body).click( function(e) {
             closeMenu();
        });

        $(".dialog").click( function(e) {
            e.stopPropagation();
        });
        var sliders = document.getElementsByClassName('sliders');
        var connect = document.getElementsByClassName('noUi-connect');
        var tooltip = document.getElementsByClassName('noUi-tooltip');
        console.log(tooltip);
        var value = document.getElementsByClassName('value');
        for ( var i = 0; i < sliders.length; i++ ) {
            noUiSlider.create(sliders[i], {
                    start: 5,
                    step:1,
                    connect: [true, false],
                    range: {
                            'min':[1],
                            'max':[10]
                    },
                    format: wNumb({
                        decimals:0
                    }),
                    tooltips:true

            });
            var deneme;
            sliders[i].noUiSlider.on('slide', function( values, handle ,e){
                var idCount=$(this.target.id).selector;
                idCount=idCount.substring(1);
                console.log($(this));
                deneme = values[handle];
                deneme = parseInt(deneme);
                if(idCount % 5 === 1){
                    $("#puan1").val(deneme);
                }
                else if(idCount % 5 === 2){
                    $("#puan2").val(deneme);
                }
                else if(idCount % 5 === 3){
                    $("#puan3").val(deneme);
                }
                else if(idCount % 5 === 4){
                    $("#puan4").val(deneme);
                }
                idCount = parseInt(idCount)-1;
                if(deneme <= 4){
                    connect[idCount].style.backgroundColor = "#e65100";
                    tooltip[idCount].style.backgroundColor = "#e65100";
                    tooltip[idCount].style.border = "1px solid #e65100";
                }
                else if(deneme === 5){
                    connect[idCount].style.backgroundColor = "#e54100";
                    tooltip[idCount].style.backgroundColor = "#e54100";
                    tooltip[idCount].style.backgroundColor = "#e54100";
                }
                else if(deneme === 6){
                    connect[idCount].style.backgroundColor = "#f46f02";
                    tooltip[idCount].style.backgroundColor = "#f46f02";
                    tooltip[idCount].style.border = "1px solid #f46f02";
                }
                else if(deneme === 7){
                    connect[idCount].style.backgroundColor = "#ffba04";
                    tooltip[idCount].style.backgroundColor = "#ffba04";
                    tooltip[idCount].style.border = "1px solid #ffba04";
                }
                else if(deneme === 8){
                    connect[idCount].style.backgroundColor = "#d6d036";
                    tooltip[idCount].style.backgroundColor = "#d6d036";
                    tooltip[idCount].style.border = "1px solid #d6d036";
                }
                else if(deneme === 9){
                    connect[idCount].style.backgroundColor = "#a5c530";
                    tooltip[idCount].style.backgroundColor = "#a5c530";
                    tooltip[idCount].style.border = "1px solid #a5c530";
                }
                else if(deneme === 10){
                    connect[idCount].style.backgroundColor = "#45c538";
                    tooltip[idCount].style.backgroundColor = "#45c538";
                    tooltip[idCount].style.border = "1px solid #45c538";
                }


            });
        }
        });
</script>
