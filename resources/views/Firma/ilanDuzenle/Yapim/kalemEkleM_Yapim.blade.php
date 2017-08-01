<div class="modal fade" id="myModal-yapim_isleri_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('id'=>'yapim_add_kayit','url'=>'kalemlerListesiYapim/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}


                <div class="form-group">
                    <label for="inputTask" class="col-sm-1 control-label"></label>
                    <label for="inputEmail3" class="col-sm-1 control-label">Adı</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTask" class="col-sm-1 control-label"></label>
                    <label for="inputEmail3" class="col-sm-1 control-label">Miktar</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTask" class="col-sm-1 control-label"></label>
                    <label for="inputEmail3" class="col-sm-1 control-label">Birim</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="birim" id="birim" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                            <option selected disabled>Seçiniz</option>
                            @foreach($birimler as $yapim_birim)
                                <option  value="{{$yapim_birim->id}}" >{{$yapim_birim->adi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiYapim/'.$ilan->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>