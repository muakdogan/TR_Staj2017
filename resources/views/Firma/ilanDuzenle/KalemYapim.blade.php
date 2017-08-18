<div id="yapim" >
    <table id="yapim_table" class="table" >
        <thead id="tasks-list" name="tasks-list"
            <tr style="text-align:center">
                <th>Sıra</th>
                <th>Kalem Ekle</th>
                <th>Açıklama</th>
                <th>Fiyat Standartı</th>
                <th>Fiyat Standartı Birimi</th>
                <th>Miktar</th>
                <th>Birim</th>
                <th></th>
            </tr>
        </thead>

        @foreach($ilan->ilan_yapim_isleri as $yapim_kalem)
            <tr>
                <td>{{$i+1}}</td>
                <td>
                    <label class="lbl_kalem_adi">{{$yapim_kalem->kalem_adi}}</label>
                    <input name="yapim_kalem[]" id="yapim_kalem{{$i}}" type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px;display:none;" class="form-control yapim_show required inp_kalem_adi" placeholder="Kalem Ekle" value="{{$yapim_kalem->kalem_adi}}" readonly />
                </td>
                <td>
                    <label class="lbl_aciklama">{{$yapim_kalem->aciklama}}</label>
                    <textarea name="yapim_aciklama[]" style="display:none;" class="form-control required inp_aciklama" placeholder="Açıklama">{{$yapim_kalem->aciklama}}</textarea>
                </td>
                <td>
                    <label class="lbl_fiyat_standardi">{{$yapim_kalem->fiyat_standardi}}</label>
                    <input name="yapim_fiyat_standardi[]" type="text" style="display:none;" class="form-control required inp_fiyat_standardi" value="{{$yapim_kalem->fiyat_standardi}}"/>
                </td>
                <td>
                    <label class="lbl_fiyat_birim_adi">{{$yapim_kalem->fiyat_birimler->adi}}</label>
                    <select name="yapim_fiyat_standardi_birimi[]" class="form-control required inp_fiyat_birim_adi" style="display:none;">
                        @foreach($birimler as $fiyat_birimi)
                            @if($yapim_kalem->fiyat_standardi_birimi_id==$fiyat_birimi->id)
                                <option  value="{{$fiyat_birimi->id}}" selected>{{$fiyat_birimi->adi}}</option>
                            @else
                                <option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <label class="lbl_miktar">{{$yapim_kalem->miktar}}</label>
                    <input name="yapim_miktar[]" type="number" class="form-control required inp_miktar" style="display:none;" placeholder="Miktar" value="{{$yapim_kalem->miktar}}"/>
                </td>
                <td>
                    <label class="lbl_miktar_birim_adi">{{$yapim_kalem->birimler->adi}}</label>
                    <select name="yapim_miktar_birim_id[]" class="form-control required inp_miktar_birim_adi" style="display:none;">
                        @foreach($birimler as $miktar_birim)
                            @if($yapim_kalem->birim_id==$miktar_birim->id)
                                <option  value="{{$miktar_birim->id}}" selected>{{$miktar_birim->adi}}</option>
                            @else
                                <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <a class="btn_yapim_duzenle" href="#">Düzenle</a>
                    <a class="btn_kalem_sil"><img src="{{asset("images/sil1.png")}}" href="#"></a>
                    <input class="inp_kalem_id" name="kalem_id[]" type="hidden" value="{{$yapim_kalem->id}}"/>
                    <input type="hidden" name="yapim_id[]"  id="yapim_id{{$i}}" value="{{$yapim_kalem->kalem_id}}"><!--agaçtan seçilen kalemin id -->
                    <?php $i++; ?>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<script>
    kalem_num="{{$i}}";
    $(".btn_yapim_duzenle").click(function(){
        //kacinci satirda islem yapilacigina karar verir
        var index=$(this).index(".btn_yapim_duzenle");

        //labelleri gizle
        $( ".lbl_kalem_adi").eq(index).hide();
        $( ".lbl_aciklama").eq(index).hide();
        $( ".lbl_fiyat_standardi").eq(index).hide();
        $( ".lbl_fiyat_birim_adi").eq(index).hide();
        $( ".lbl_miktar").eq(index).hide();
        $( ".lbl_miktar_birim_adi").eq(index).hide();

        //inputlari goster
        $( ".inp_kalem_adi").eq(index).show();
        $( ".inp_aciklama").eq(index).show();
        $( ".inp_fiyat_standardi").eq(index).show();
        $( ".inp_fiyat_birim_adi").eq(index).show();
        $( ".inp_miktar").eq(index).show();
        $( ".inp_miktar_birim_adi").eq(index).show();

        //Duzenleme butonunu gizle
        $( ".btn_yapim_duzenle").eq(index).hide();

        //updated arrayina duzenlenecek kalemin id'si atilir
        var kalem_id=$( ".inp_kalem_id").eq(index).val();
        updated_array.push(kalem_id);
    });


</script>