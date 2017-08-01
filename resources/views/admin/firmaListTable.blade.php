<table style="width: 100%;">
    <tr>
      <th>FİRMA KAYIT TARİHİ</th>
      <th>FİRMALAR</th>
      <th>ONAY TÜRÜ</th>
      <th>ONAY DETAYLARI</th>
      <th>ONAY</th>
    </tr>
  @foreach($onay as $firma)
    <tr class="firmaSatir">
      {{-- buradaki hücreler, firma onaylama formuna dahil --}}

      <form method="POST" action="{{route('firmaOnaySubmit')}}">

      <input type="hidden" name="firma_id" value="{{$firma->id}}">

      <td>{{$firma->olusturmaTarihi}} </td>
      <td>{{$firma->adi}}</td>
      <td>
        <select class="onayTuruSecim" name="onay_turu">
          <option value="0">Standart</option>
          <option value="1">Ödemesiz</option>
          <option value="2">Özel</option>
          <option value="3">Ret</option>
        </select>
      </td>
      <td>
        <div class="metot">
          
        </div>
        <div class="metot" style="display: none;">
          <label class="col-md-4">Üyelik süresi (ay): </label>
          <input class="col-md-4" type="number" name="uyelik_bitis_suresi">
        </div>
        <div class="metot" style="display: none;">
          <div class="form-group">
            <label class="col-md-4">Miktar: </label>
            <input class="col-md-4" type="number" name="miktar"><br>
          </div>

          <div class="form-group">
            <label class="col-md-4">Üyelik süresi (ay): </label>
            <input class="col-md-4" type="number" name="sure"><br>
          </div>

          <div class="form-group">
            <label class="col-md-4">Teklif geçerlilik süresi (ay): </label>
            <input class="col-md-4" type="number" name="gecerlilik_sure"><br>
          </div>
        </div>
        <div class="metot" style="display: none;">
          
        </div>
      </td>
      <td><input style="float:left" id="{{$firma->id}}" type="submit" class="btn btn-primary" value="ONAYLA" onclick="alert('FİRMA ONAYLANDI');"></td>

      </form>
    </tr>
  @endforeach
  {{$onay->links()}}

  <script src="{{asset('js/jquery.js')}}"></script>
  <script>

    function metotGoster(satir, metotIndex)
    {
      //istenen satırdaki tüm metotları seç
      var metotlar = satir.find('.metot');

      metotlar.not(':eq('+metotIndex+')').hide();//istenmeyen metotları sakla
      metotlar.eq(metotIndex).show();//istenen metodu göster
    }

    //başta her satırda 0 metodunu göster
    $(document).ready(function(){
      $('.firmaSatir').each(function(){
        metotGoster($(this), 0);
      });
    });

    $('.onayTuruSecim').change(function(){
      metotGoster($(this).parents('.firmaSatir'), $(this).prop('selectedIndex'));
    });
  </script>

 </table>
