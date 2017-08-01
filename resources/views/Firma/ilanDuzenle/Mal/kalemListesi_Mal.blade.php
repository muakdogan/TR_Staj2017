<div id="mal" class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><strong>Fiyat İstenen Kalemler Listesi</strong></a>
            <button  style="float:right" id="btn-add-mal" name="btn-add-mal" class="btn btn-primary btn-xs" >Ekle</button>
        </h4>
    </div>
    <div id="collapse4" >
        <div class="panel-body">
            <table class="table" >
                <thead id="tasks-list" name="tasks-list">
                <tr id="firma{{$firma->id}}">
                <?php
                $i=1;
                ?>
                <tr>
                    <th>Sıra</th>
                    <th>Marka</th>
                    <th>Model</th>
                    <th>Adı</th>
                    <th>Ambalaj</th>
                    <th>Miktar</th>
                    <th>Birim</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                @foreach($ilan->ilan_mallar as $ilan_mal)
                    <tr>
                        <td>
                            {{$i}}
                        </td>

                        <?php $i++?>

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

                        <td> <button name="open-modal-mal"  value="{{$ilan_mal->id}}" class="btn btn-primary btn-xs open-modal-mal" >Düzenle</button></td>
                        <td>
                            {{ Form::open(array('url'=>'mal/'.$ilan_mal->id,'method' => 'DELETE', 'files'=>true)) }}
                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                            {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                            {{ Form::close() }}
                        </td>
                        <td>
                            <input type="hidden" name="ilan_mal_id"  id="ilan_mal_id" value="{{$ilan_mal->id}}">
                            @include('Firma.ilanDuzenle.Mal.kalemGuncelleM_Mal')
                        </td>
                    </tr>
                @endforeach
            </table>
            @include('Firma.ilanDuzenle.Mal.kalemEkleM_Mal')
        </div>
    </div>
</div>