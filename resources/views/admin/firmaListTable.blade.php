<table class="table table-responsive" style="width: 100%;">
  <tr>
    <th>FİRMA KAYIT TARİHİ</th>
    <th>FİRMALAR</th>
    <th>FİRMA DETAYLARI</th>
    <th>ONAY TÜRÜ</th>
    <th>ONAY DETAYLARI</th>
    <th>ONAY</th>
  </tr>
  @foreach($onayBekleyen as $firma)

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
      
  @endforeach

</table>
@foreach($onayBekleyen as $firma)

  {{-- detay modal'ı --}}
  <div class="modal detayModal fade in out" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">

        {{-- başlık için div --}}
        <div class="modal-header">
          {{-- modal'ı kapatma tuşu (&times; çarpı sembolü) --}}
          <button type="button" class="detayModalKapatButon close" data-dismiss="modal">&times;</button>

          {{-- modal başlığı --}}
          <h3 class="modal-title">{{$firma->adi}} <small>(#{{$firma->id}})</small></h3>

            <hr/>

            <h4>Sektörler</h4>
            <ul>
              @foreach($firma->sektorler as $sektor)
                <li>{{$sektor->adi}}</li>
              @endforeach
            </ul>

            <hr/>

            <h4>İletişim Bilgileri</h4>

            <label>Telefon: </label>{{$firma->iletisim_bilgileri->telefon}}<br>
            <label>Faks: </label>{{$firma->iletisim_bilgileri->fax}}<br>
            <label>Email: </label>{{$firma->iletisim_bilgileri->email}}<br>
            <label>Web: </label>{{$firma->iletisim_bilgileri->web_sayfasi}}<br>

            <hr/>

            <h4>Adresler</h4>
            <ul>
              @foreach($firma->adresler as $adres)
                <li>
                  <label>Türü: </label>{{$adres->adres_turleri->adi}}<br>
                  <label>İl: </label>{{$adres->iller->adi}}<br>
                  <label>İlçe: </label>{{$adres->ilceler->adi}}<br>
                  <label>Semt: </label>{{$adres->semtler->adi}}<br>
                  <label>Adres: </label>{{$adres->adres}}<br>
                </li>
              @endforeach
            </ul>

            <hr/>

            <h4>Kullanıcı</h4>

            <label>ID: </label>{{$firma->kullanicilar[0]->id}}<br>
            <label>Adı: </label>{{$firma->kullanicilar[0]->adi}}<br>
            <label>Soyadı: </label>{{$firma->kullanicilar[0]->soyadi}}<br>
            <label>Email: </label>{{$firma->kullanicilar[0]->email}}<br>
            <label>Telefon: </label>{{$firma->kullanicilar[0]->telefon}}<br>

            <hr/>

        </div>
      </div>
    </div>
  </div>
@endforeach

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
    //submit önle
    event.preventDefault();
    
    //detay satırı
    //$(this).parents(".onaySatir").next(".detaySatir:first").toggle();

    //detay modal
    var firmaIndex = $(".onaySatir").index($(this).parents(".onaySatir"));
    $(".detayModal").eq(firmaIndex).modal("show");
  });

  //firma detaylarını kapatma tuşu
  $(".detayModalKapatButon").click(function(event){
    //submit önle
    event.preventDefault();

    $(this).parents(".detayModal").modal("hide");
  });

  //onay türünü değişitirnce görünür field'ların değişmesi
  $('.onayTuruSecim').change(function(){
    metotGoster($(this).parents('.onaySatir'), $(this).prop('selectedIndex'));
  });

  //ONAYLA tuşuna basıldığında formun geçerli olup olmadığına bak
  $(".firmaOnayForm").submit(function(event){

    //Tuhaflık: jQuery, form inputlarını <form>'un değil <tr class="onaySatir">'ın çocuğu olarak görüyor.
    //table içinde form'a izin olmayabilir

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
