<div  id="goturu" class="panel panel-default ">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6"><strong>Fiyat İstenen Kalemler Listesi</strong></a>
            <button  style="float:right" id="btn-add-goturu_bedeller" name="btn-add-goturu_bedeller" class="btn btn-primary btn-xs" >Ekle</button>
        </h4>
    </div>
    <div id="collapse6" >
        <div class="panel-body">
            <table class="table" >
                <thead id="tasks-list" name="tasks-list">
                <tr id="firma{{$firma->id}}">
                <?php
                    $k=0;
                ?>
                <tr>
                    <th>Sıra</th>
                    <th>İşin Adı</th>
                    <th>Miktar Türü</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($ilan->ilan_goturu_bedeller as $ilan_goturu_bedel)
                    <tr>
                        <td>
                            {{$k}}
                        </td>

                        {{$k++}}

                        <td>
                            {{$ilan_goturu_bedel->isin_adi}}
                        </td>
                        <td>
                            {{$ilan_goturu_bedel->miktar_turu}}
                        </td>

                        <td> <button name="open-modal-goturu-bedel"  value="{{$ilan_goturu_bedel->id}}" class="btn btn-primary btn-xs open-modal-goturu-bedel" >Düzenle</button></td>
                        <td>
                            {{ Form::open(array('url'=>'goturu/'.$ilan_goturu_bedel->id,'method' => 'DELETE', 'files'=>true)) }}
                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                            {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                            {{ Form::close() }}
                        </td>
                        <td>
                            <input type="hidden" name="ilan_goturu_bedel_id"  id="ilan_goturu_bedel_id" value="{{$ilan_goturu_bedel->id}}">
                            @include('Firma.ilanDuzenle.Goturu.kalemGuncelleM_Goturu')
                        </td>
                    </tr>
                @endforeach
                </thead>
            </table>
            @include('Firma.ilanDuzenle.Goturu.kalemEkleM_Goturu')
        </div>
    </div>
</div>