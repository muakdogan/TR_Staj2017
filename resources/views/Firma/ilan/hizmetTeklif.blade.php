<div  id="hizmet"   class="panel panel-default">
      <div class="panel-heading">
          <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Fiyat İstenen Kalemler Listesi</a>
          </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
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
                          if (!$firma->ilanlar->ilan_hizmetler)
                              $firma->ilanlar->ilan_hizmetler = new App\IlanHizmet();
                          $i=0; 
                          ?>
                      <tr>
                          <th>Sıra:</th>
                          <th>Adı:</th>
                          <th>Fiyat Standartı:</th>
                          <th>Fiyat Standartı Birimi:</th>
                          <th>Miktar:</th>
                          <th>Miktar Birimi:</th>
                           <th>KDV Oranı:</th>
                          <th>Birim Fiyat:</th>
                          <th>Para Birimi</th>
                           <th>Toplam:</th>
                      </tr>
                      @foreach($ilan->ilan_hizmetler as $ilan_hizmet)
                      <tr>
                          <td>
                              {{$ilan_hizmet->sira}}
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
                            <input type="text" class="form-control fiyat" id="fiyat" name="{{$ilan_hizmet->id}}" placeholder="Fiyat" value="" required>
                          </td>
                          <td>
                              {{$ilan->para_birimleri->adi}}
                          </td>
                          <td>
                               <!--label for="inputEmail3"  id="{{$ilan_hizmet->id}}"  name ="fiyat" class="col-sm-3 control-label toplam"></label>
                               <input type="hidden" name="fiyat[]"  id="{{$ilan_hizmet->id}}" value=""-->
                          </td>
                           <?php $i++;?>                                          
                          <input type="hidden" name="ilan_hizmet_id[]"  id="ilan_hizmet_id" value="{{$ilan_hizmet->id}}"> 
                        </tr>
                        @endforeach
                        <tr>
                          <td colspan="9">
                            <label for='toplamFiyatLabel' id="toplamFiyatLabel" class="col-sm-3 control-label toplam"></label>  
                          </td>
                          <td>
                              <label for="toplamFiyatL" id="toplamFiyatL" class="col-sm-3 control-label toplam"></label>
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