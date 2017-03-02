<div  id="goturu" class="panel panel-default ">
    <div class="panel-heading">
          <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Fiyat İstenen Kalemler Listesi</a>
          </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body"> <?php $firma_id = session()->get('firma_id'); 
                    $kullanici_id=Auth::user()->kullanici_id;
              ?>
              {{ Form::open(array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'method' => 'POST', 'files'=>true)) }}
            <table class="table" >
                  <thead id="tasks-list" name="tasks-list">
                      <tr id="firma{{$firma->id}}">
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
                          <th>Toplam:</th>
                      </tr>
                      @foreach($ilan->ilan_goturu_bedeller as $ilan_goturu_bedel)
                        <?php if(count($teklif) != 0){
                                $goturuBedelTeklif = App\GoturuBedelTeklif::where('ilan_goturu_bedel_id',$ilan_goturu_bedel->id)->where('teklif_id',$teklif[0]['id'])->orderBy('id','DESC')->limit(1)->get();
                                if(count($goturuBedelTeklif) != 0){
                                      $kdvArray[$i-1] = $goturuBedelTeklif[0]['kdv_orani'];
                                }  
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
                                <select class="form-control select" name="kdv[]" id="kdv{{$i-2}}" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   <option  value="0" >%0</option>
                                                   <option  value="1" >%1</option>
                                                   <option  value="8" >%8</option>
                                                   <option  value="18">%18</option>                                                                
                               </select>
                            </td>
                            <td>
                                @if(count($teklif)!=0 && count($goturuBedelTeklif) != 0)
                                    <input align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="{{$goturuBedelTeklif[0]['kdv_haric_fiyat']}}" required>
                                @else
                                    <input align="right" type="text" class="form-control fiyat kdvsizFiyat" name="birim_fiyat[]" placeholder="Fiyat" value="" required>
                                @endif
                            </td>
                            <td>
                                {{$firma->ilanlar->para_birimleri->adi}}
                            </td>
                            <td>
                                <span align="right" class="kalem_toplam" name="kalem_toplam" class="col-sm-3"></span>
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
    </div>
</div>
<script>
    var kdv = <?php echo json_encode($kdvArray); ?>;
    for(var k=0; k <kdv.length; k++ ){
        $("#kdv"+k).val(kdv[k]);
        $("#kdv"+k).trigger('input');
    }
</script>