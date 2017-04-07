<div  id="goturu">
    <?php $firma_id = session()->get('firma_id'); 
            $kullanici_id=Auth::user()->kullanici_id;
            $count=0;
    ?>
    {{ Form::open(array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'method' => 'POST')) }}
            <table class="table" >
                  <thead id="tasks-list" name="tasks-list">
                          <?php
                          if (!$firma->ilanlar)
                              $firma->ilanlar = new App\Ilan();
                          if (!$firma->ilanlar->ilan_goturu_bedeller)
                              $firma->ilanlar->ilan_goturu_bedeller = new App\IlanGoturuBedel ();
                          $i=1; 
                            $kdvArray = array();
                            $teklif= App\Teklif::where('firma_id',$firma_id)->where('ilan_id',$ilan->id)->get();
                          ?>
                      <tr>
                            <th>Sıra:</th>
                            <th>İşin Adı:</th>
                            <th>Miktar Türü:</th>
                            <th>KDV Oranı:</th>
                            <th>Fiyat:</th>
                            <th>Para Birimi</th>
                            <th>Toplam:({{$firma->ilanlar->para_birimleri->adi}})</th>
                      </tr>
                      @foreach($ilan->ilan_goturu_bedeller as $ilan_goturu_bedel)
                        <?php if(count($teklif) != 0){
                                $goturuBedelTeklif = App\GoturuBedelTeklif::where('ilan_goturu_bedel_id',$ilan_goturu_bedel->id)->where('teklif_id',$teklif[0]['id'])->orderBy('id','DESC')->limit(1)->get();
                            } 
                        ?>
                      <tr>
                            <td>
                                {{$i++}}
                            </td>

                            <td>
                                {{$ilan_goturu_bedel->isin_adi}}
                            </td>
                            <td>
                                {{$ilan_goturu_bedel->miktar_turu}}
                            </td>
                            <td>
                                <select class="form-control select kdv" name="kdv[]" id="kdv{{$i-2}}"  required>
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
                                <span align="right" class="kalem_toplam" name="kalem_toplam" class="col-sm-3"></span>
                            </td> 
                            <td colspan="2">
                            </td>
                            <input type="hidden" name="ilan_goturu_bedel_id[]"  id="ilan_goturu_bedel_id" value="{{$ilan_goturu_bedel->id}}"> 
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="8"></td>
                            <td colspan="3" style="text-align:right">
                                <label for="" id="toplamFiyatL" class="control-label toplam" ></label>
                                <input type="hidden" name="toplamFiyatKdvsiz"  id="toplamFiyatKdvsiz" value="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                            <td colspan="3" style="text-align:right">
                                <label for="toplamFiyatLabel" id="toplamFiyatLabel" class="control-label toplam" ></label>
                                <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="">
                            </td>
                        </tr>
                    </tbody>
            </table>
            <div align="right">
                {!! Form::submit('Teklif Gönder', array('url'=>'teklifGonder/'.$firma_id.'/'.$ilan->id.'/'.$kullanici_id,'class'=>'btn btn-danger')) !!}
                {!! Form::close() !!}
            </div>                        
       
</div>