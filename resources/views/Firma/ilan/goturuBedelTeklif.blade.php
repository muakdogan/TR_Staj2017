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
                          $i=0; 
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
                      <tr>
                          <td>
                              {{$ilan_goturu_bedel->sira}}
                          </td>

                          <td>
                              {{$ilan_goturu_bedel->isin_adi}}
                          </td>
                          <td>
                              {{$ilan_goturu_bedel->miktar_turu}}
                          </td>
                             <td>
                              <select class="form-control select" name="kdv[]" id="kdv" required>
                                                 <option selected disabled>Seçiniz</option>
                                                 <option  value="0" >%0</option>
                                                 <option  value="1" >%1</option>
                                                 <option  value="8" >%8</option>
                                                 <option  value="18">%18</option>                                                                
                             </select>
                          </td>
                          <td>
                            <input type="text" class="form-control fiyat" id="fiyat" name="{{$ilan_goturu_bedel->id}}" placeholder="Fiyat" value="" required>
                          </td>
                          <td>
                              {{$ilan->para_birimleri->adi}}
                          </td>
                          <td>
                               <!--label for="inputEmail3"  id="{{$ilan_goturu_bedel->id}}"  name ="fiyat" class="col-sm-3 control-label toplam"></label>
                               <input type="hidden" name="fiyat[]"  id="{{$ilan_goturu_bedel->id}}" value=""-->
                          </td>
                           <?php $i++;?>                                          
                          <input type="hidden" name="ilan_goturu_bedel_id[]"  id="ilan_goturu_bedel_id" value="{{$ilan_goturu_bedel->id}}"> 
                        </tr>
                        @endforeach
                        <tr>
                          <td colspan="9">
                            <label for="inputEmail3" name="toplamFiyatLabel" id="toplamFiyatLabel" class="col-sm-3 control-label toplam"></label>  
                          </td>
                          <td>
                              <label for="inputEmail3" name="toplamFiyatL" id="toplamFiyatL" class="col-sm-3 control-label toplam"></label>
                              <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="">
                          </td>
                        </tr>
                        </tbody>
            </table>

                {!! Form::submit('Teklif Gönder', array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'class'=>'btn btn-danger')) !!}
                {!! Form::close() !!}                         
        </div>
    </div>
</div>