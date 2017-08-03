<table style="width: 100%;">
    <tr>
      <th>FİRMA KAYIT TARİHİ</th>
      <th>FİRMALAR</th>
      <th>ONAY TÜRÜ</th>
      <th>ONAY DETAYLARI</th>
      <th>ONAY</th>
    </tr>
  @foreach($onay as $firma)
    {{-- buradaki hücreler, firma onaylama formuna dahil --}}

    <tr class="firmaSatir">

      <form method="POST" action="{{route('firmaOnaySubmit')}}" class="firmaOnayForm">

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
            <input class="col-md-4 uyelikBitisSuresi" type="number" name="uyelik_bitis_suresi" pattern="[0-9]*" min="1" max="12" title="1 ila 12 ay">
          </div>
          <div class="metot" style="display: none;">
            <div class="form-group">
              <label class="col-md-4">Miktar: </label>
              <input class="col-md-4 miktar" name="miktar" pattern="[0-9]*" title="Pozitif sayı"><br>
            </div>

            <div class="form-group">
              <label class="col-md-4">Üyelik süresi (ay): </label>
              <input class="col-md-4 sure" type="number" name="sure" pattern="[0-9]*" min="1" max="12" title="1 ila 12 ay"><br>
            </div>

            <div class="form-group">
              <label class="col-md-4">Teklif geçerlilik süresi (ay): </label>
              <input class="col-md-4 gecerlilikSure" type="number" name="gecerlilik_sure" pattern="[0-9]*" min="1" max="12" title="1 ila 12 ay"><br>
            </div>
          </div>
          <div class="metot" style="display: none;">
            
          </div>
        </td>
        <td><input style="float:left" id="{{$firma->id}}" type="submit" class="btn btn-primary onayButon" value="ONAYLA"></td>

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

    $('.onayButon').click(function(){
      $("input[type=submit]", $(this).parents(".firmaSatir")).removeAttr("clicked");
      $(this).attr("clicked", "true");
    });

    //ONAYLA tuşuna basıldığında formun geçerli olup olmadığına bak
    $(".firmaOnayForm").submit(function(event){

      //Tuhaflık: jQuery, form inputlarını <form>'un değil <tr class="firmaSatir">'ın çocuğu olarak görüyor

      var satir = $(this).parents(".firmaSatir");
      var onayTuru = $(satir).find('.onayTuruSecim').prop('selectedIndex');

      if (onayTuru == 1)//ödemesiz onaya gereken field doldurulmuş mu?
      {
        if ($(satir).find('.uyelikBitisSuresi').val().length == 0)
        {
          console.log("Hata: Ödemesiz onay alanı boş.");
          event.preventDefault();
          return false;
        }
        return true;
      }

      if (onayTuru == 2)//özel onaya gereken field'lar doldurulmuş mu?
      {
        if ($(satir).find('.miktar').val().length == 0
          || $(satir).find('.sure').val().length == 0
          || $(satir).find('.gecerlilikSure').val().length == 0)
        {
          console.log("Hata: Özel onay alanları boş.");
          event.preventDefault();
          return false;
        }
      }
    });
  </script>

 </table>
