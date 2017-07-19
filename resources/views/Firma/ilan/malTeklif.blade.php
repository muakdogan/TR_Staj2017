<?php use Barryvdh\Debugbar\Facade as Debugbar;//debug yapmak için gerekli ?>
<div id="mal">
    <h4>Fiyat İstenen Kalemler Listesi</h4>
    {{ Form::open(array('id'=>'teklifForm','url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.Auth::user()->id)) }}  
        <table class="table" >
            <thead>
                <tr>
                    <?php $i=1; ?>
                    <th width="3%" >Sıra:</th>
                    <th width="8%">Marka:</th>
                    <th width="9%">Model:</th>
                    <th width="9%">Adı:</th>
                    <th width="9%">Ambalaj:</th>
                    <th width="4%">Miktar:</th>
                    <th width="9%">Birim:</th>
                    @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. --> 
                        <th width="12%">KDV Oranı:</th>
                        <th width="14%">Birim Fiyat:</th>
                        <th width="1%"></th><!--Fiyat hesaplaması için gerekli -->
                        <th width="11%">Toplam:<br />({{$ilan->para_birimleri->adi}})</th>
                    @endif    

                </tr>
            </thead>
                @foreach($ilan->ilan_mallar as $ilan_mal)
                    @if(count($teklif) != 0)
                        <?php $malTeklif= $ilan_mal->getMalTeklif($ilan_mal->id,$teklif[0]['id']);Debugbar::info($ilan_mal);?>
                        
                    @endif   
                <tr>
                    <td>
                        {{$i++}}
                    </td>
                    <td>
                        {{$ilan_mal->marka}}
                    </td>
                    <td>
                        {{$ilan_mal->model}}
                    </td>
                    <td>
                        {{$ilan_mal->kalem_adi}}
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
                    @if(session()->get('firma_id') != $ilan->firmalar->id)<!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. -->
                        <td>
                            <select style="margin-top: 0px" class="select kdv" name="kdv[]" id="kdv{{$i-2}}"  required>
                                <option value="-1" selected hidden>Seçiniz</option>
                                @if(count($teklif)!=0 && count($malTeklif) != 0 && $malTeklif[0]['kdv_orani'] == 0)
                                     <option  value="0"  selected>%0</option>
                                @else
                                     <option  value="0">%0</option>
                                @endif

                                @if(count($teklif)!=0 && count($malTeklif) != 0 && $malTeklif[0]['kdv_orani'] == 1)
                                     <option  value="1" selected >%1</option>
                                @else
                                     <option  value="1">%1</option>
                                @endif

                                @if(count($teklif)!=0 && count($malTeklif) != 0 && $malTeklif[0]['kdv_orani'] == 8)
                                     <option  value="8" selected>%8</option>
                                @else
                                     <option  value="8" >%8</option>
                                @endif

                                @if(count($teklif)!=0 && count($malTeklif) != 0 && $malTeklif[0]['kdv_orani'] == 18)    
                                     <option  value="18" selected>%18</option>
                                @else
                                     <option  value="18">%18</option>
                                @endif
                           </select>
                        </td>
                        <td>
                            @if(count($teklif)!=0 && count($malTeklif) != 0)
                                <?php $eskiTeklif=number_format($malTeklif[0]['kdv_haric_fiyat'], 2, ',', '.'); ?>
                                <input id="visible_miktar#{{$i-1}}" style="margin-top: 0px" align="right"  type="text" class="form-control fiyat kdvsizFiyat" onkeyup="ParaFormat(this.value,event, 'visible_miktar#{{$i-1}}','miktar#{{$i-1}}') " value="{{$eskiTeklif}}" onkeypress="return isNumberKey(event)">
                                <input id="miktar#{{$i-1}}" type="hidden" name="birim_fiyat[]" value="{{$malTeklif[0]['kdv_haric_fiyat']}}" />
                                <label class="control-label toplam">Eski Teklif: {{$eskiTeklif}}</label>
                            @else
                                <input id="visible_miktar#{{$i-1}}" style="margin-top: 0px" align="right" type="text" class="form-control fiyat kdvsizFiyat" value="0,00" onkeyup="ParaFormat(this.value,event, 'visible_miktar#{{$i-1}}','miktar#{{$i-1}}') " onkeypress="return isNumberKey(event)">
                                <input id="miktar#{{$i-1}}" type="hidden" name="birim_fiyat[]" value="0" />
                            @endif
                        </td>
                        <td>

                        </td>
                        <td>
                            <span align="right" class="kalem_toplam" name="kalem_toplam" class="col-sm-3"></span>
                            <input type="hidden" name="kalem_toplam[]"  id="kalem_toplam" value="">
                        </td>

                        <input type="hidden" name="ilan_mal_id[]"  id="ilan_mal_id" value="{{$ilan_mal->id}}"> 
                @endif
                </tr>

                @endforeach
                @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. -->
                    <tr>
                        <td colspan="8"></td>
                        <td colspan="3" style="text-align:right">
                            <label for="" id="toplamFiyatL" class="control-label toplam" ></label>
                            <input type="hidden" name="toplamFiyatKdvsiz"  id="toplamFiyatKdvsiz" value="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8">
                            <input type="hidden" id="iskonto"><label id="iskontoLabel"></label>
                            <input style="width: 60px" type="hidden" name="iskontoVal" id="iskontoVal" value="" placeholder="yüzde">   
                        </td> 
                        <td colspan="3" style="text-align:right">
                            <label for="toplamFiyatLabel" id="toplamFiyatLabel" name="toplamFiyatLabel" class="control-label toplam" ></label>
                            <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td colspan="3" style="text-align:right">
                            <label for="" id="iskontoluToplamFiyatL" class="control-label toplam" ></label>
                            <input type="hidden" name="iskontoluToplamFiyatKdvsiz"  id="iskontoluToplamFiyatKdvsiz" value="">
                        </td>
                        <td colspan="3" style="text-align:right">
                            <label for="" id="iskontoluToplamFiyatLabel" class="control-label toplam" ></label>
                            <input type="hidden" name="iskontoluToplamFiyatKdvli"  id="iskontoluToplamFiyatKdvli" value="">
                        </td>
                    </tr>
                @endif    
        </table>
        <div align="right">
            @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. -->
                @if($ilan->kapanma_tarihi > $dt)
                    @if(count($teklif)!=0) <!--Teklif varsa buton güncelleme kontrolu -->
                        {!! Form::button('Teklif Güncelle', array('id'=>'gonder','class'=>'btn btn-info')) !!}
                    @else
                        {!! Form::button('Teklif Gönder', array('id'=>'gonder','class'=>'btn btn-info')) !!}
                    @endif
                @else
                    Bu ilanın KAPANMA SÜRESİ geçmiştir.O yüzden teklif günceleyemezsiniz !
                @endif
            @endif
            {!! Form::close() !!}
        </div>
           
</div>
 <div id="mesaj" class="popup">
    <span class="button b-close"><span>X</span></span>
    <h2 style="color:red"> Üzgünüz.. !!!</h2>
    <h3>Sistemsel bir hata oluştu.Lütfen daha sonra tekrar deneyin</h3>
</div>