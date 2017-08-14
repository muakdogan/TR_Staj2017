<div  id="goturu">
    {{ Form::open(array('id'=>'teklifForm','url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.Auth::user()->id))}}
    <table class="table" >
        <thead id="tasks-list" name="tasks-list">
            <?php $i=1;?>
            <tr>
                  <th width="4%">Sıra:</th>
                  <th width="30%">İşin Adı:</th>
                  <th width="10%">Miktar Türü:</th>
                  @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. --> 
                    <th width="20%">KDV Oranı:</th>
                    <th width="25%">Fiyat:</th>
                    <th width="1%"></th>
                    <th width="10%">Toplam:({{$firma->ilanlar->para_birimleri->adi}})</th>
                  @endif  
            </tr>
            @foreach($ilan->ilan_goturu_bedeller as $ilan_goturu_bedel)
                @if(count($teklif) != 0)
                    <?php $goturuBedelTeklif = $ilan_goturu_bedel->getGoturuBedelTeklif($ilan_goturu_bedel->id,$teklif[0]["id"]); ?>
                @endif
                <tr>
                    <td>
                        {{$i++}}
                    </td>

                    <td>
                        {{$ilan_goturu_bedel->kalem_adi}}
                    </td>
                    <td>
                        {{$ilan_goturu_bedel->miktar_birimler->adi}}
                    </td>
                @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. -->
                    <td>
                        <select class="select kdv" name="kdv[]" id="kdv{{$i-2}}"  required>
                            <option value="-1" selected hidden>Seçiniz</option>
                            @if(count($teklif)!=0 && count($goturuBedelTeklif) != 0 && $goturuBedelTeklif[0]['kdv_orani'] == 0)
                                <option  value="0"  selected>%0</option>
                            @else
                                <option  value="0">%0</option>
                            @endif

                            @if(count($teklif)!=0 && count($goturuBedelTeklif) != 0 && $goturuBedelTeklif[0]['kdv_orani'] == 1)
                                <option  value="1" selected >%1</option>
                            @else
                                <option  value="1">%1</option>
                            @endif

                            @if(count($teklif)!=0 && count($goturuBedelTeklif) != 0 && $goturuBedelTeklif[0]['kdv_orani'] == 8)
                                <option  value="8" selected>%8</option>
                            @else
                                <option  value="8" >%8</option>
                            @endif

                            @if(count($teklif)!=0 && count($goturuBedelTeklif) != 0 && $goturuBedelTeklif[0]['kdv_orani'] == 18)
                                <option  value="18" selected>%18</option>
                            @else
                                <option  value="18">%18</option>
                            @endif
                        </select>
                    </td>
                    <td>
                        @if($ilan->kismi_fiyat == 0)
                            @if(count($teklif)!=0 && count($goturuBedelTeklif) != 0)
                                <input style="margin-top: 0px" align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="{{$goturuBedelTeklif[0]['kdv_haric_fiyat']}}" required>
                            @else
                                <input style="margin-top: 0px" align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="0" required>
                            @endif
                        @else
                            @if(count($teklif)!=0 && count($goturuBedelTeklif) != 0)
                                <input style="margin-top: 0px" align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="{{$goturuBedelTeklif[0]['kdv_haric_fiyat']}}">
                            @else
                                <input style="margin-top: 0px" align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="0">
                            @endif
                        @endif
                    </td>
                    <td></td> <!--Fiyat hesaplaması için gerekli -->
                    <td>
                        <span align=zz"right" class="kalem_toplam" name="kalem_toplam" class="col-sm-3"></span>
                    </td>
                    <td colspan="2">
                    </td>
                    <input type="hidden" name="ilan_goturu_bedel_id[]"  id="ilan_goturu_bedel_id" value="{{$ilan_goturu_bedel->id}}">
                    @endif
                </tr>
            @endforeach
            @if(session()->get('firma_id') != $ilan->firmalar->id) <!-- ilan sahibi ise teklif vermemesi için bu butonların kaldırıyorum. --> 
                <tr>
                    <td colspan="4"></td>
                    <td colspan="3" style="text-align:right">
                        <label for="" id="toplamFiyatL" class="control-label toplam" ></label>
                        <input type="hidden" name="toplamFiyatKdvsiz"  id="toplamFiyatKdvsiz" value="">
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="3" style="text-align:right">
                        <label for="toplamFiyatLabel" id="toplamFiyatLabel" class="control-label toplam" ></label>
                        <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="">
                    </td>
                </tr>
            @endif    
        </tbody>
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