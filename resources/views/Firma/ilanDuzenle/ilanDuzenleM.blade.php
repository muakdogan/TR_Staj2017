<div class="modal fade" id="myModal-ilanBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div style="width:900px" class="modal-dialog">
        <script src="{{asset('js/jquery.multi-select.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{asset('js/jquery.quicksearch.js')}}"></script>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>İlan Bilgileri</strong></h4>
            </div>

            <div class="modal-body">
                {!! Form::open(array('url'=>'firmaIlanOlustur/ilanBilgileri/'.$firma->id.'/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Firma Adı Göster</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">

                                <input type="radio" class="filled-in firma_goster  required"  name="firma_adi_goster" value="1"  data-validation-error-msg="Lütfen birini seçiniz!" ><label> Göster</label> </input>
                                <input type="radio" data-toggle="tooltip" data-placement="bottom" title="İlanda firmaisminin gözükmemesi satıcı firma tarafında belirsizlikler yaratabilir!"
                                       class="filled-in test firma_goster"  name="firma_adi_goster" value="0" data-validation-error-msg="Lütfen birini seçiniz!"><label>Gizle</label> </input>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Adı</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required" id="ilan_adi" name="ilan_adi" placeholder="İlan Adı" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Türü</label>
                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px" class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required"  name="ilan_turu" id="ilan_turu">
                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                    <option value="1">Mal</option>
                                    <option value="2">Hizmet</option>
                                    <option value="3">Yapım İşi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlan Sektör</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">

                                <select class="form-control selectpicker required" style=" font-size:12px;height:20px" data-live-search="true"  name="firma_sektor" id="firma_sektor"  >
                                    <option  style="color:#eee"  selected disabled>Seçiniz</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İlanın Tarih Aralığı</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <input type="text" name="ilan_tarihi_araligi"  id="ilan_tarihi_araligi"  readonly value="" class="form-control  filled-in"
                                       data-toggle="tooltip" data-placement="bottom" title="İlan Yayinlama - Kapanma Tarihleri"/>
                                <!--input class="form-control date" id="yayinlanma_tarihi"  readonly   name="yayinlanma_tarihi" value="" placeholder="Yayinlanma Tarihi" type="text" /-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İşin Süresi</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="isin_suresi" id="isin_suresi">
                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                    <option value="Tek Seferde">Tek Seferde</option>
                                    <option value="Zamana Yayılarak">Zamana Yayılarak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">İş Tarih Aralığı</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <input type="text" name="is_tarihi_araligi"  id="is_tarihi_araligi"  readonly value="" class="form-control filled-in"
                                       data-toggle="tooltip" data-placement="bottom" title="İş Başlama - Bitiş Tarihleri"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teknik Şartname</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <div class="control-group">
                                    <div class="controls">
                                        {!! Form::file('teknik',array(
                                           'data-toggle'=>'tooltip',
                                           'data-placement'=>'bottom',
                                           'title'=>'Yüklenebilir dosya türü:.pdf',
                                           'class'=>'test'))!!}
                                        <p class="errors">{!!$errors->first('image')!!}</p>
                                        @if(Session::has('error'))
                                            <p class="errors">{!! Session::get('error') !!}</p>
                                        @endif
                                    </div>
                                </div>
                                <div id="success">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Katılımcılar</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="katilimcilar" id="katilimcilar" data-validation="required"
                                        data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                    <option value="1">Onaylı Tedarikçiler</option>
                                    <option value="2">Belirli Firmalar</option>
                                    <option value="3">Tüm Firmalar</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"  id="onayli_tedarikciler">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Firma Seçiniz</label>
                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div style="width: 65%"  class="col-sm-9 ezgi">
                                <div   class="col-sm-2 "></div>
                                <div style="padding-right:3px;padding-left:1px"  class="col-sm-10 ">
                                    <select id='custom-headers' multiple='multiple' name="onayli_tedarikciler[]" id="onayli_tedarikciler[]" >
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"  id="belirli-istekliler">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Firma Seçiniz</label>
                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div style="width: 65%" class="col-sm-9 ezgi">
                                <div   class="col-sm-2 "></div>
                                <div style="padding-right:3px;padding-left:1px"  class="col-sm-10 ">
                                    <select id='belirliIstek' multiple='multiple' name="belirli_istekli[]" id="belirli_istekli[]" >
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Rekabet Şekli</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="rekabet_sekli" id="rekabet_sekli">
                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                    <option value="1">Tamrekabet</option>
                                    <option value="2">Sadece Başvuru</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Sözleşme Türü</label>
                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="sozlesme_turu" id="sozlesme_turu">
                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                    <option value="0">Birim Fiyatlı</option>
                                    <option value="1">Götürü Bedel</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group fiyatlandirma">
                            <label for="inputEmail3"   style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">FiyatlandırmaŞekli</label>
                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control  required" name="kismi_fiyat" id="kismi_fiyat" >
                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                    <option   value="1">Kısmi Fiyat Teklifine Açık</option>
                                    <option  value="0">Kısmi Fiyat Teklifine Kapalı</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Yaklaşık Maliyet</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="yaklasik_maliyet" id="yaklasik_maliyet" >
                                    <option selected disabled>Seçiniz</option>
                                    @foreach($maliyetler as $maliyet)
                                        <option name="{{$maliyet->aralik}}" value="{{$maliyet->miktar}}" >{{$maliyet->aralik}}</option>

                                    @endforeach
                                </select>
                                <input type="hidden" id="maliyet" name="maliyet" value=""></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Ödeme Türü</label>
                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="odeme_turu" id="odeme_turu" >
                                    <option selected disabled>Seçiniz</option>
                                    @foreach($odeme_turleri as $odeme_turu)
                                        <option  value="{{$odeme_turu->id}}" >{{$odeme_turu->adi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Para Birimi</label>
                            <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="para_birimi" id="para_birimi" >
                                    <option selected disabled>Seçiniz</option>
                                    @foreach($para_birimleri as $para_birimi)
                                        <option  value="{{$para_birimi->id}}" >{{$para_birimi->adi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Yeri</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="teslim_yeri" id="teslim_yeri" >
                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                    <option   value="Satıcı Firma">Satıcı Firma</option>
                                    <option  value="Adrese Teslim">Adrese Teslim</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group error teslim_il">
                            <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Ad. İli</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="il_id" id="il_id" >
                                    <option selected disabled>Seçiniz</option>
                                    <?php $iller_query= DB::select(DB::raw("SELECT *
                                                                        FROM  `iller`
                                                                        WHERE adi = 'İstanbul'
                                                                        OR adi =  'İzmir'
                                                                        OR adi =  'Ankara'
                                                                        UNION
                                                                        SELECT *
                                                                        FROM iller"));
                                    ?>
                                    @foreach($iller_query as $il)
                                        <option  value="{{$il->id}}" >{{$il->adi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group error teslim_ilce">
                            <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-sm-3 control-label">Teslim Ad. İlçesi</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-sm-1 control-label">:</label>
                            <div class="col-sm-8">
                                <select class="form-control required" name="ilce_id" id="ilce_id" >
                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-sm-1 control-label">Açıklama</label>
                            <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px" class=" col-sm-1 control-label">:</label>
                            <div class="col-sm-10">
                                <!--input type="text" class="form-control " id="aciklama" name="aciklama" placeholder="Açıklama" value=""-->
                                <textarea id="aciklama" name="aciklama" rows="5" class="form-control ckeditor" placeholder="Lütfen Açıklamayı buraya yazınız.." data-validation="required"
                                          data-validation-error-msg="Lütfen bu alanı doldurunuz!">{{$ilan->aciklama}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/ilanBilgileri/'.$firma->id.'/'.$ilan->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                {!! Form::close() !!}
            </div>
            <br>
            <br>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>