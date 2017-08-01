<div class="modal fade" id="myModal-goturu_bedeller_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('id'=>'goturu_add_kayit','url'=>'kalemlerListesiGoturu/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}


                <div class="form-group">
                    <label for="inputTask" class="col-sm-1 control-label"></label>
                    <label for="inputEmail3" class="col-sm-1 control-label">İşin Adı</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="isin_adi" name="isin_adi" placeholder=" İşin Adı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputTask" class="col-sm-1 control-label"></label>
                    <label for="inputEmail3" class="col-sm-1 control-label">Miktar Türü</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="miktar_turu" name="miktar_turu" placeholder="Miktar Türü" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>

                {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiGoturu/'.$ilan->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>