<div  id="hizmet">
    {{ Form::open(array('id'=>'teklifForm','url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.Auth::user()->id)) }}
    <table class="table">
        <thead id="tasks-list" name="tasks-list">
                <?php $i=1; ?>
            <tr>
                <th width="2%">Sıra:</th>
                <th width="20%">Adı:</th>
                <th width="8%">Fiyat Standartı:</th>
                <th width="8%">Fiyat Standartı Birimi:</th>
                <th width="6%">Miktar:</th>
                <th width="6%">Miktar Birimi:</th>
                @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. --> 
                    <th width="14%">KDV Oranı:</th>
                    <th width="15%">Birim Fiyat:</th>
                    <th width="1%"></th><!-- Fiyat hesaplanması için gerekli-->
                    <th width="10%">Toplam:({{$para_birimi}})</th>
                @endif    
            </tr>
            @foreach($ilan->ilan_hizmetler as $ilan_hizmet)
                @if(count($teklif) != 0)
                    <?php  $hizmetTeklif = $ilan_hizmet->getHizmetTeklif($ilan_hizmet->id, $teklif[0]['id']); ?>
                @endif
            <tr>
                <td>
                    {{$i++}}
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
                @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. --> 
                    <td>
                        <select style="margin-top: 0px" class="select kdv" name="kdv[]" id="kdv{{$i-2}}"  required>
                            @if(count($teklif)!=0 && count($hizmetTeklif) != 0)
                                @if($hizmetTeklif[0]['kdv_orani'] == 0)
                                    <option value="-1" hidden>Seçiniz</option>
                                    <option value="0"  selected>%0</option>
                                    <option value="1">%1</option>
                                    <option value="8" >%8</option>
                                    <option value="18">%18</option>
                                @elseif($hizmetTeklif[0]['kdv_orani'] == 1)
                                    <option value="-1" hidden>Seçiniz</option>
                                    <option value="0">%0</option>
                                    <option value="1" selected>%1</option>
                                    <option value="8">%8</option>
                                    <option value="18">%18</option>
                                @elseif($hizmetTeklif[0]['kdv_orani'] == 8)
                                    <option value="-1" hidden>Seçiniz</option>
                                    <option value="0">%0</option>
                                    <option value="1">%1</option>
                                    <option value="8" selected>%8</option>
                                    <option value="18">%18</option>
                                @elseif($hizmetTeklif[0]['kdv_orani'] == 18)
                                    <option value="-1" hidden>Seçiniz</option>
                                    <option value="0">%0</option>
                                    <option value="1">%1</option>
                                    <option value="8">%8</option>
                                    <option value="18" selected>%18</option>
                                @endif
                            @else
                                <option value="-1" selected hidden>Seçiniz</option>
                                <option value="0">%0</option>
                                <option value="1">%1</option>
                                <option value="8">%8</option>
                                <option value="18">%18</option>
                            @endif
                        </select>
                    </td>
                    <td>
                        @if(count($teklif)!=0 && count($hizmetTeklif) != 0)
                            <input id="visible_miktar#{{$i-1}}" style="margin-top: 0px" align="right"  type="text" class="form-control fiyat kdvsizFiyat" onkeyup="ParaFormat(this.value,event, 'visible_miktar#{{$i-1}}','miktar#{{$i-1}}') " value="{{$teklifler[0]->paraFormat($hizmetTeklif[0]['kdv_haric_fiyat'])}}" onkeypress="return isNumberKey(event)" required>
                            <input id="miktar#{{$i-1}}" type="hidden" name="birim_fiyat[]" value="{{$hizmetTeklif[0]['kdv_haric_fiyat']}}" />
                            <label class="control-label toplam">Eski Teklif: {{$teklifler[0]->paraFormat($hizmetTeklif[0]['kdv_haric_fiyat'])}}</label>
                         @else
                            <input id="visible_miktar#{{$i-1}}" style="margin-top: 0px" align="right" type="text" class="form-control fiyat kdvsizFiyat" value="0,00" onkeyup="ParaFormat(this.value,event, 'visible_miktar#{{$i-1}}','miktar#{{$i-1}}') " onkeypress="return isNumberKey(event)" required>
                            <input id="miktar#{{$i-1}}" type="hidden" name="birim_fiyat[]" value="0" />
                        @endif
                    </td>
                    <td></td><!-- Fiyat hesaplaması için gerekli -->
                    <td>
                        @if(count($teklif)!=0 && count($hizmetTeklif) != 0)
                            <span align="right" class="kalem_toplam" name="kalem_toplam" class="col-sm-3">{{$teklifler[0]->paraFormat($hizmetTeklif[0]['kdv_dahil_fiyat'])}}</span>
                            <input type="hidden" name="kalem_toplam[]"  id="kalem_toplam" value="{{$hizmetTeklif[0]['kdv_dahil_fiyat']}}">
                        @else
                            <span align="right" class="kalem_toplam" name="kalem_toplam" class="col-sm-3">0,00</span>
                            <input type="hidden" name="kalem_toplam[]"  id="kalem_toplam" value="">
                        @endif
                    </td>                                        
                    <input type="hidden" name="ilan_hizmet_id[]"  id="ilan_hizmet_id" value="{{$ilan_hizmet->id}}"> 
                @endif    
            </tr>
            @endforeach
            @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. --> 
                <tr>
                    <td colspan="7"></td>
                    <td colspan="3" style="text-align:right">
                        @if($kullaniciTeklifi != null)
                            <label for="" id="toplamFiyatL" class="control-label toplam" >KDV Hariç Toplam Fiyat: {{$teklifler[0]->paraFormat($kullaniciTeklifi['kdv_haric_fiyat'])}} {{$para_birimi}}</label>
                            <input type="hidden" name="toplamFiyatKdvsiz"  id="toplamFiyatKdvsiz" value="{{$kullaniciTeklifi['kdv_haric_fiyat']}}">
                        @else
                            <label for="" id="toplamFiyatL" class="control-label toplam" ></label>
                            <input type="hidden" name="toplamFiyatKdvsiz"  id="toplamFiyatKdvsiz" value="">
                        @endif
                    </td>
                  </tr>
                <tr>
                    <td colspan="7">
                        @if($ilan['kismi_fiyat']==1)
                            @if($kullaniciTeklifi['iskonto_orani']>0)
                                <input type="checkbox" id="iskonto" checked>&nbsp;<label id="iskontoLabel" class="highlight">İskonto Ver</label>&nbsp;
                                <input style="width: 60px" type="number" min="1" max="100" name="iskontoVal" id="iskontoVal" value="{{$kullaniciTeklifi['iskonto_orani']}}" placeholder="yüzde">
                            @else
                                <input type="hidden" id="iskonto">&nbsp;<label id="iskontoLabel" class="highlight">İskonto verebilmek için tüm kalemlere teklif vermelisiniz!</label>
                                <input style="width: 60px" type="hidden" name="iskontoVal" id="iskontoVal" value="" placeholder="yüzde">
                            @endif
                            <p>İskontolu fiyat, tüm kalemler sizden alındığında yapacağınız indirimli fiyattır.</p>
                        @else
                            <p class="highlight">İskontolu teklif verebilmek için ilanın kısmi teklife açık olması gerekiyor.</p>
                        @endif
                    </td> 
                    <td colspan="3" style="text-align:right">
                        @if($kullaniciTeklifi != null)
                            <label for="toplamFiyatLabel" id="toplamFiyatLabel" name="toplamFiyatLabel" class="control-label toplam" >KDV Dahil Toplam Fiyat: {{$teklifler[0]->paraFormat($kullaniciTeklifi['kdv_dahil_fiyat'])}} {{$para_birimi}}</label>
                            <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="{{$kullaniciTeklifi['kdv_dahil_fiyat']}}">
                        @else
                            <label for="toplamFiyatLabel" id="toplamFiyatLabel" name="toplamFiyatLabel" class="control-label toplam"></label>
                            <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="4" style="text-align:right">
                        @if($kullaniciTeklifi['iskonto_orani']>0)
                            <label for="" id="iskontoluToplamFiyatL" class="control-label toplam" >İskontolu KDV Hariç Toplam Fiyat: {{$teklifler[0]->paraFormat($kullaniciTeklifi['iskontolu_kdvsiz_fiyat'])}}</label>
                            <input type="hidden" name="iskontoluToplamFiyatKdvsiz"  id="iskontoluToplamFiyatKdvsiz" value="{{$kullaniciTeklifi['iskontolu_kdvsiz_fiyat']}}">
                        @else
                            <label for="" id="iskontoluToplamFiyatL" class="control-label toplam" ></label>
                            <input type="hidden" name="iskontoluToplamFiyatKdvsiz"  id="iskontoluToplamFiyatKdvsiz" value="">
                        @endif
                    </td>
                    <td colspan="4" style="text-align:right">
                        @if($kullaniciTeklifi['iskonto_orani']>0)
                            <label for="" id="iskontoluToplamFiyatLabel" class="control-label toplam" >İskontolu KDV Dahil Toplam Fiyat: {{$teklifler[0]->paraFormat($kullaniciTeklifi['iskontolu_kdvli_fiyat'])}}</label>
                            <input type="hidden" name="iskontoluToplamFiyatKdvli"  id="iskontoluToplamFiyatKdvli" value="{{$kullaniciTeklifi['iskontolu_kdvli_fiyat']}}">
                        @else
                            <label for="" id="iskontoluToplamFiyatLabel" class="control-label toplam" ></label>
                            <input type="hidden" name="iskontoluToplamFiyatKdvli"  id="iskontoluToplamFiyatKdvli" value="">
                        @endif
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <div align="right">
        @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. --> 
            @if($ilan->kapanma_tarihi > $dt)
               @if(count($teklif)!= 0) <!--Teklif varsa buton güncelleme kontrolu -->
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