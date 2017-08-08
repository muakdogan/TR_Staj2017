<div  id="mal"  >
    <table  id="mal_table" class="table" >
        <thead id="tasks-list" name="tasks-list">
        <tr style="text-align:center">
            <th>Sıra</th>
            <th>Kalem Ekle</th>
            <th>Marka</th>
            <th>Model</th>
            <th>Açıklama</th>
            <th>Ambalaj</th>
            <th>Miktar</th>
            <th>Birim</th>
            <th></th>
        </tr>
        </thead>

        @foreach($ilan->ilan_mallar as $mal_kalem)
            <tr>
                <td>{{$i+1}}</td>
                <td>
                    <label class="lbl_kalem_adi">{{$mal_kalem->kalem_adi}}</label>
                    <input name="mal_kalem[]" id="mal_kalem{{$i}}" type="text" style="background:url({{asset('images/ekle.png')}}) no-repeat scroll ;padding-left:25px;display:none;" class="form-control mal_show required inp_kalem_adi" placeholder="Kalem Ekle" value="{{$mal_kalem->kalem_adi}}" readonly />
                </td>
                <td>
                    <label class="lbl_marka">{{$mal_kalem->marka}}</label>
                    <input type="text" name="mal_marka[]" style="display:none;" class="form-control required inp_marka" placeholder="Marka" value="{{$mal_kalem->marka}}">
                </td>
                <td>
                    <label class="lbl_model">{{$mal_kalem->model}}</label>
                    <input name="mal_model[]" type="text" style="display:none;" class="form-control required inp_model" value="{{$mal_kalem->model}}"/>
                </td>
                <td>
                    <label class="lbl_aciklama">{{$mal_kalem->aciklama}}</label>
                    <textarea name="mal_aciklama[]" style="display:none;" class="form-control required inp_aciklama" placeholder="Açıklama">{{$mal_kalem->aciklama}}</textarea>
                </td>
                <td>
                    <label class="lbl_ambalaj">{{$mal_kalem->ambalaj}}</label>
                    <input name="mal_ambalaj[]" type="text" style="display:none;" class="form-control required inp_ambalaj" value="{{$mal_kalem->ambalaj}}"/>
                </td>
                <td>
                    <label class="lbl_miktar">{{$mal_kalem->miktar}}</label>
                    <input name="mal_miktar[]" type="number" style="display:none;" class="form-control required inp_miktar" value="{{$mal_kalem->miktar}}"/>
                </td>
                <td>
                    <label class="lbl_birim">{{$mal_kalem->birimler->adi}}</label>
                    <select name="mal_birim[]" class="form-control required inp_birim" style="display:none;">
                        @foreach($birimler as $birim)
                            @if($mal_kalem->birimler->adi==$birim->adi)
                                <option  value="{{$birim->id}}" selected>{{$birim->adi}}</option>
                            @else
                                <option  value="{{$birim->id}}" >{{$birim->adi}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <a class="btn_mal_duzenle" href="#">Düzenle</a>
                    <a class="btn_kalem_sil"><img src="{{asset("images/sil1.png")}}" href="#"></a>
                    <input class="inp_kalem_id" name="kalem_id[]" type="hidden" value="{{$mal_kalem->id}}"/>
                    <input type="hidden" name="mal_id[]"  id="mal_id{{$i}}" value="{{$mal_kalem->kalem_id}}"><!--agaçtan seçilen kalemin id -->
                    <?php $i++; ?>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<script>
    kalem_num="{{$i}}";
    $(".btn_mal_duzenle").click(function(){
        //kacinci satirda islem yapilacigina karar verir
        var index=$(this).index(".btn_mal_duzenle");

        //labelleri gizle
        $( ".lbl_kalem_adi").eq(index).hide();
        $( ".lbl_aciklama").eq(index).hide();
        $( ".lbl_marka").eq(index).hide();
        $( ".lbl_model").eq(index).hide();
        $( ".lbl_miktar").eq(index).hide();
        $( ".lbl_birim").eq(index).hide();
        $( ".lbl_ambalaj").eq(index).hide();

        //inputlari goster
        $( ".inp_kalem_adi").eq(index).show();
        $( ".inp_aciklama").eq(index).show();
        $( ".inp_marka").eq(index).show();
        $( ".inp_model").eq(index).show();
        $( ".inp_miktar").eq(index).show();
        $( ".inp_birim").eq(index).show();
        $( ".inp_ambalaj").eq(index).show();

        //Duzenleme butonunu gizle
        $( ".btn_mal_duzenle").eq(index).hide();

        //updated arrayina duzenlenecek kalemin id'si atilir
        var kalem_id=$( ".inp_kalem_id").eq(index).val();
        updated_array.push(kalem_id);
    });
</script>