<div class="modal fade" id="myModal-mal_birimfiyat_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalemler Listesi</strong></h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('id'=>'mal_add_kayit','url'=>'kalemlerListesiMal/'.$ilan->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Marka</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="marka" name="marka" placeholder="Marka" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Model</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="model" name="model" placeholder="Model" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Adı</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="adi" name="adi" placeholder="Adı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Ambalaj</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ambalaj" name="ambalaj" placeholder="ambalaj" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Miktar</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="miktar" name="miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Birim</label>
                    <label for="inputTask" style="text-align: right"class="col-sm-1 control-label">:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="birim" id="birim" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                            <option selected disabled>Seçiniz</option>
                            @foreach($birimler as $birimleri)
                                <option  value="{{$birimleri->id}}" >{{$birimleri->adi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {!! Form::submit('Kaydet', array('url'=>'kalemlerListesiMal/'.$ilan->id,'style'=>'float:right','class'=>'btn btn-danger')) !!}
                {!! Form::close() !!}
            </div>
            <br>
            <br>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>