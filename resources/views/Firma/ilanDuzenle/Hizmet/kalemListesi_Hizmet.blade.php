<div  id="hizmet" class="panel panel-default ">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><strong>Fiyat İstenen Kalemler Listesi</strong></a>
            <button style="float:right" id="btn-add-hizmet" name="btn-add-hizmet" class="btn btn-primary btn-xs" >Ekle</button>
        </h4>
    </div>
    <div id="collapse5" >
        <div class="panel-body">
            <table class="table" >
                <thead id="tasks-list" name="tasks-list">
                <tr id="firma{{$firma->id}}">
                <?php
                $j=0;
                ?>
                <tr>
                    <th>Sıra</th>
                    <th>Adı</th>
                    <th>Fiyat Standartı</th>
                    <th>Fiyat Standartı Birimi</th>
                    <th>Miktar</th>
                    <th>Miktar Birimi</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                @foreach($ilan->ilan_hizmetler as $ilan_hizmet)
                    <tr>
                        <td>
                            {{$j++}}
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

                        <td> <button name="open-modal-hizmet"  value="{{$ilan_hizmet->id}}" class="btn btn-primary btn-xs open-modal-hizmet" >Düzenle</button></td>
                        <td>
                            {{ Form::open(array('url'=>'hizmet/'.$ilan_hizmet->id,'method' => 'DELETE', 'files'=>true)) }}
                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                            {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                            {{ Form::close() }}
                        </td>
                        <td>
                            <input type="hidden" name="ilan_hizmet_id"  id="ilan_hizmet_id" value="{{$ilan_hizmet->id}}">
                            @include('Firma.ilanDuzenle.Hizmet.kalemGuncelleM_Hizmet')
                        </td>
                    </tr>
                @endforeach
            </table>
            @include('Firma.ilanDuzenle.Hizmet.kalemEkleM_Hizmet')
        </div>
    </div>
</div>