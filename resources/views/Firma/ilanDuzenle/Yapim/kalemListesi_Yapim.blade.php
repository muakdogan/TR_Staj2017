<div id="yapim"  class="panel panel-default ">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse7"><strong>Fiyat İstenen Kalemler Listesi</strong></a>
            <button style="float:right" id="btn-add-yapim_isleri" name="btn-add-yapim_isleri" class="btn btn-primary btn-xs" >Ekle</button>
        </h4>
    </div>
    <div id="collapse7" >
        <div class="panel-body">
            <table class="table" >
                <thead id="tasks-list" name="tasks-list">
                <tr id="firma{{$firma->id}}">
                <?php
                    $y=0;
                ?>
                <tr>
                    <th>Sıra:</th>
                    <th>Adı:</th>
                    <th>Miktar:</th>
                    <th>Birim:</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                @foreach($ilan->ilan_yapim_isleri as $ilan_yapim_isi)
                    <tr>
                        <td>
                            {{$y}}
                        </td>
                        {{$y++}}

                        <td>
                            {{$ilan_yapim_isi->adi}}
                        </td>
                        <td>
                            {{$ilan_yapim_isi->miktar}}
                        </td>
                        <td>
                            {{$ilan_yapim_isi->birimler->adi}}
                        </td>

                        <td> <button name="open-modal-yapim-isi"  value="{{$ilan_yapim_isi->id}}" class="btn btn-primary btn-xs open-modal-yapim-isi" >Düzenle</button></td>
                        <td>
                            {{ Form::open(array('url'=>'yapim/'.$ilan_yapim_isi->id,'method' => 'DELETE', 'files'=>true)) }}
                            <input type="hidden" name="firma_id"  id="firma_id" value="{{$firma->id}}">
                            {{ Form::submit('Sil', ['class' => 'btn btn-primary btn-xs']) }}
                            {{ Form::close() }}
                        </td>
                        <td>
                            <input type="hidden" name="ilan_yapim_isi_id"  id="ilan_yapim_isi_id" value="{{$ilan_yapim_isi->id}}">
                            @include('Firma.ilanDuzenle.Yapim.kalemGuncelleM_Yapim')
                        </td>
                    </tr>
                @endforeach
            </table>
            @include('Firma.ilanDuzenle.Yapim.kalemEkleM_Yapim')
        </div>
    </div>
</div>