<div id="goturu" >
    <table id="goturu_table" class="table" >
        <thead id="tasks-list" name="tasks-list">
        <tr style="text-align:center">
            <th>Sıra</th>
            <th>Kalem Ekle</th>
            <th>Açıklama</th>
            <th>Miktar</th>
            <th>Birim</th>
            <th></th>
        </tr>
        </thead>

        @if(isset($goturu_bedel[0]))
            <tr>
                <td>1</td>
                <td>
                    <input name="goturu_kalem" id="goturu_kalem0" type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px;" class="form-control goturu_show required inp_kalem_adi" placeholder="Kalem Ekle" value="{{$goturu_bedel[0]->kalem_adi}}" readonly />
                </td>
                <td>
                    <textarea name="goturu_aciklama" class="form-control required inp_aciklama" placeholder="Açıklama">{{$goturu_bedel[0]->aciklama}}</textarea>
                </td>
                <td>
                    <input name="goturu_miktar" type="number" class="form-control required inp_miktar" placeholder="Miktar" value="{{$goturu_bedel[0]->miktar}}"/>
                </td>
                <td>
                    <select name="goturu_birim_id" class="form-control required inp_miktar_birim_adi">
                        @foreach($birimler as $miktar_birim)
                            @if($goturu_bedel[0]->miktar_birim_id==$miktar_birim->id)
                                <option  value="{{$miktar_birim->id}}" selected>{{$miktar_birim->adi}}</option>
                            @else
                                <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <input name="kalem_id_goturu" type="hidden" value="{{$goturu_bedel[0]->id}}"/>
                    <input type="hidden" name="goturu_id"  id="goturu_id0" value="{{$goturu_bedel[0]->kalem_id}}"><!--agaçtan seçilen kalemin id -->
                </td>
            </tr>
        @else
            <tr>
                <td>1</td>
                <td><input type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px" class="form-control goturu_show required" id="goturu_kalem0" name="goturu_kalem" placeholder="Kalem Ekle" readonly  value=""  > </td>
                <td>
                    <textarea id="goturu_aciklama" name="goturu_aciklama" rows="2" class="form-control required" placeholder="Açıklama" ></textarea>
                </td>

                <td>
                    <input type="number" class="form-control required" id="goturu_miktar" name="goturu_miktar" placeholder="Miktar" value="" >
                </td>
                <td>
                    <select class="form-control selectpicker required"  data-live-search="true" name="goturu_birim_id" id="goturu_miktar_birim_id" >
                        <option selected disabled>Seçiniz</option>
                        @foreach($birimler as $miktar_birim)
                            <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input name="kalem_id_goturu" type="hidden" value="-1"/>
                    <input type="hidden" name="goturu_id"  id="goturu_id0" value=""></td>

            </tr>

        @endif

    </table>
</div>