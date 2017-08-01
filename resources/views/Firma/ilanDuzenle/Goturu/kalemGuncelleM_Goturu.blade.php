<div class="modal fade" id="myModal-goturu_bedeller" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('id'=>'goturu_up_kayit','url'=>'kalemlerListesiGoturuUpdate/'.$ilan_goturu_bedel->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                <div class="form-group">
                    <label for="inputTask" class="col-sm-1 control-label"></label>
                    <label for="inputEmail3" class="col-sm-1 control-label">İşin Adı</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="isin_adi" name="isin_adi" placeholder=" İşin Adı" value="{{$ilan_goturu_bedel->isin_adi}}" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputTask" class="col-sm-1 control-label"></label>
                    <label for="inputEmail3" class="col-sm-1 control-label">Miktar Türü</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="miktar_turu" name="miktar_turu" placeholder="Miktar Türü" value="{{$ilan_goturu_bedel->miktar_turu}}" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>
                <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiGoturuUpdate/'.$ilan_goturu_bedel->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
            </div>
            <br>
            <br>
        </div>
    </div>
</div>