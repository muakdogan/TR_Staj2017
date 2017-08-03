<table class="table table-responsive" style="width: 100%;">
    <tr>
      <th>FİRMA KAYIT TARİHİ</th>
      <th>FİRMALAR</th>
      <th>FİRMA DETAYLARI</th>
      <th>ONAY TÜRÜ</th>
      <th>ONAY DETAYLARI</th>
      <th>ONAY</th>
    </tr>
  @foreach($onay as $firma)
    {{-- buradaki hücreler, firma onaylama formuna dahil --}}

    <tr class="onaySatir">

      <form method="POST" action="{{route('firmaOnaySubmit')}}" class="firmaOnayForm">

        <input type="hidden" name="firma_id" value="{{$firma->id}}">

        <td>{{$firma->olusturmaTarihi}} </td>
        <td>{{$firma->adi}}</td>
        <td>
          <button class="btn detayButon">DETAYLAR</button>
        </td>
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
        <td>

          <input id="{{$firma->id}}" type="submit" class="btn btn-primary onayButon" value="ONAYLA">
        </td>

      </form>

    </tr>

    <tr class="detaySatir bg-info" style="display: none;">
      <td colspan="6">
        <table style="width: 100%;">
          <tr>
            <th>ID</th>
            <th>Tanıtım</th>
            <th>Kuruluş yılı</th>
            <th>Şirket türü</th>
            <th>Kayıt tarihi</th>
            <th>Doluluk oranı</th>
          </tr>

          <tr>
            <td>{{$firma->id}}</td>
            <td>{{$firma->tanitim_yazisi}}</td>
            <td>{{$firma->kurulus_tarihi}}</td>
            <td>{{$firma->sirket_turu}}</td>
            <td>{{$firma->olusturmaTarihi}}</td>
            <td>{{$firma->doluluk_orani}}</td>
          </tr>
        </table>
      </td>
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
      $('.onaySatir').each(function(){
        metotGoster($(this), $(this).find(".onayTuruSecim").prop("selectedIndex"));
      });
    });

    //firma detaylarını gösterme tuşu
    $(".detayButon").click(function(event){
      event.preventDefault();
      $(this).parents(".onaySatir").next(".detaySatir:first").toggle();
    });

    //onay türünü değişitirnce görünür field'ların değişmesi
    $('.onayTuruSecim').change(function(){
      metotGoster($(this).parents('.onaySatir'), $(this).prop('selectedIndex'));
    });

    //ONAYLA tuşuna basıldığında formun geçerli olup olmadığına bak
    $(".firmaOnayForm").submit(function(event){

      //Tuhaflık: jQuery, form inputlarını <form>'un değil <tr class="onaySatir">'ın çocuğu olarak görüyor

      var satir = $(this).parents(".onaySatir");
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
