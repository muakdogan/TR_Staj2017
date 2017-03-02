<div id="mal">
    <h4>Fiyat İstenen Kalemler Listesi</h4>
    <?php $firma_id = session()->get('firma_id'); 
            $kullanici_id=Auth::user()->kullanici_id;
            $count=0;
    ?>
            {{ Form::open(array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'method' => 'POST', 'files'=>true)) }}  
            <table class="table" >
                <thead>
                    <tr>
                        <?php
                            if (!$firma->ilanlar)
                                $firma->ilanlar = new App\Ilan();
                            if (!$firma->ilanlar->ilan_mallar)
                                $firma->ilanlar->ilan_mallar = new App\IlanMal();
                            $i=1;
                            $kdvArray = array();
                            $teklif= App\Teklif::where('firma_id',$firma_id)->where('ilan_id',$ilan->id)->get();
                        ?>
                        <th width="6%" >Sıra:</th>
                        <th width="9%">Marka:</th>
                        <th width="9%">Model:</th>
                        <th width="9%">Adı:</th>
                        <th width="9%">Ambalaj:</th>
                        <th width="4%">Miktar:</th>
                        <th width="9%">Birim:</th>
                        <th width="13%">KDV Oranı:</th>
                        <th width="11%">Birim Fiyat:</th>
                        <th width="12%">Para Birimi</th>
                        <th width="9%">Toplam:</th>

                    </tr>
                </thead>
                    
                    @foreach($ilan->ilan_mallar as $ilan_mal)
                    <?php if(count($teklif) != 0){
                            $malTeklif = App\MalTeklif::where('ilan_mal_id',$ilan_mal->id)->where('teklif_id',$teklif[0]['id'])->orderBy('id','DESC')->limit(1)->get();
                             
                        } 
                    ?>
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

                        <td>
                            <select class="form-control select kdv" name="kdv[]" id="kdv{{$i-2}}"  required>
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
                            @if($ilan->kismi_fiyat == 0)
                                @if(count($teklif)!=0 && count($malTeklif) != 0)
                                    <input align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="{{$malTeklif[0]['kdv_haric_fiyat']}}" required>
                                @else
                                    <input align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="0" required>
                                @endif
                            @else
                                @if(count($teklif)!=0 && count($malTeklif) != 0)
                                    <input align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="{{$malTeklif[0]['kdv_haric_fiyat']}}">
                                @else
                                    <input align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="0">
                                @endif
                            @endif    
                        </td>
                        <td>
                            {{$firma->ilanlar->para_birimleri->adi}}
                        </td>
                        <td>
                            <span align="right" class="kalem_toplam" name="kalem_toplam" class="col-sm-3"></span>
                        </td>
                                                                 
                        <input type="hidden" name="ilan_mal_id[]"  id="ilan_mal_id" value="{{$ilan_mal->id}}"> 
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
                        <td colspan="8">
                            <input type="hidden" id="iskonto"><label id="iskontoLabel"></label>
                            <input style="width: 60px" type="hidden" name="iskontoVal" id="iskontoVal" value="" placeholder="rakam">   
                        </td> 
                        <td colspan="3" style="text-align:right">
                            <label for="toplamFiyatLabel" id="toplamFiyatLabel" class="control-label toplam" ></label>
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
            </table>
            <div align="right">
                
                {!! Form::submit('Teklif Gönder', array('url'=>'teklifGonder/'.$firma_id.'/'.$ilan->id.'/'.$kullanici_id,'class'=>'btn btn-danger')) !!}
                {!! Form::close() !!}
            </div>
</div>
