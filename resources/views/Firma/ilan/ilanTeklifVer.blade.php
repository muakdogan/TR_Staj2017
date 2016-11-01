
@extends('layouts.app')
<br>
 <br>
 @section('content')
  
 <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #fff;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #fff;
}
.div5{
    float:right;
}
.div6{
    float:left;
}
.button {
    background-color: #ccc; /* Green */
    border: none;
    color: white;
    padding: 6px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
}

</style>
     <div class="container">
         <nav class="navbar navbar-inverse">
             <div class="container-fluid">
                 <div class="navbar-header">
                     <a class="navbar-brand" href="#"><img src='{{asset('images/anasayfa.png')}}'></a>
                 </div>
                 <ul class="nav navbar-nav">
                     <li class=""><a href="{{ url('firmaProfili/'.$firma->id)}}">Firma Profili</a></li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">İlan İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="{{ url('ilanlarim/'.$firma->id) }}">İlanlarım</a></li>
                             <li><a href="{{ URL::to('ilanEkle', array($firma->id,'0'), false) }}">İlan Oluştur</a></li>
                         </ul>
                     </li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Başvuru İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="#">Başvurularım</a></li>
                             <li><a href="#">Başvur</a></li>
                         </ul>
                     </li>
                     <li><a href="#">Mesajlar</a></li>
                     <li><a href="#">Kullanici İşlemleri</a></li>
                 </ul>
             </div>
         </nav>
         <div class="col-sm-12">                     
            <h3>{{$firma->adi}}'nın {{$firma->ilanlar->adi}} İlanına Teklif  Ver</h3>
              <hr>
              <div class="panel-group" id="accordion">
                  <div id="mal"   class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Fiyat İstenen Kalemler Listesi</a>
                          </h4>
                      </div>
                      <div id="collapse4" class="panel-collapse collapse">
                          <div class="panel-body">
                              <table class="table" >
                                  <thead id="tasks-list" name="tasks-list">
                                      <tr id="firma{{$firma->id}}">
                                          <?php
                                          if (!$firma->ilanlar)
                                              $firma->ilanlar = new App\Ilan();
                                          if (!$firma->ilanlar->ilan_mallar)
                                              $firma->ilanlar->ilan_mallar = new App\IlanMal();
                                          ?>
                                      <tr>
                                          <th>Sıra:</th>
                                          <th>Marka:</th>
                                          <th>Model:</th>
                                          <th>Adı:</th>
                                          <th>Ambalaj:</th>
                                          <th>Miktar:</th>
                                          <th>Birim:</th>
                                          <th>KDV Oranı:</th>
                                          <th>Fiyat:</th>
                                          <th>Para Birimi</th>
                                          <th>Toplam:</th>

                                      </tr>
                                       <?php $i=0;?>  
                                      @foreach($firma->ilanlar->ilan_mallar as $ilan_mal)
                                      <tr>
                                          <td>
                                              {{$ilan_mal->sira}}
                                          </td>
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
                                          
                                          <td>
                                              <select class="form-control select" name="kdv" id="kdv{{$i}}" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 <option  value="0" >%0</option>
                                                                 <option  value="1" >%1</option>
                                                                 <option  value="2" >%8</option>
                                                                 <option  value="3">%18</option>
                                                                
                                             </select>
                                          </td>
                                          <td>
                                            <input type="text" class="form-control fiyat" id="fiyat{{$i}}" name="{{$ilan_mal->id}}" placeholder="Fiyat" value="" required>
                                          </td>
                                          <td>
                                              {{$firma->ilanlar->para_birimleri->adi}}
                                          </td>
                                         
                                          <td>
                                               <label for="inputEmail3"  id="{{$ilan_mal->id}}"  name ="{{$ilan_mal->id}}" class="col-sm-3 control-label toplam"></label>
                                          </td>
                                           <?php $i++;?>
                                          
                                          <input type="hidden" name="ilan_mal_id"  id="ilan_mal_id" value="{{$ilan_mal->id}}"> 
                                      </tr>
                                      @endforeach
                                      </thead>
                              </table>
                          </div>
                      </div>
                  </div>
                  <div  id="hizmet"   class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Fiyat İstenen Kalemler Listesi</a>
                          </h4>
                      </div>
                      <div id="collapse5" class="panel-collapse collapse">
                          <div class="panel-body">
                              <table class="table" >
                                  <thead id="tasks-list" name="tasks-list">
                                      <tr id="firma{{$firma->id}}">
                                          <?php
                                          if (!$firma->ilanlar)
                                              $firma->ilanlar = new App\Ilan();
                                          if (!$firma->ilanlar->ilan_hizmetler)
                                              $firma->ilanlar->ilan_hizmetler = new App\IlanHizmet();
                                          ?>
                                      <tr>
                                          <th>Sıra:</th>
                                          <th>Adı:</th>
                                          <th>Fiyat Standartı:</th>
                                          <th>Fiyat Standartı Birimi:</th>
                                          <th>Miktar:</th>
                                          <th>Miktar Birimi:</th>
                                           <th>KDV Oranı:</th>
                                          <th>Fiyat:</th>
                                          <th>Para Birimi</th>
                                           <th>Toplam:</th>
                                      </tr>
                                      @foreach($firma->ilanlar->ilan_hizmetler as $ilan_hizmet)
                                      <tr>
                                          <td>
                                              {{$ilan_hizmet->sira}}
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
                                           <td>
                                              <select class="form-control select" name="kdv" id="kdv" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 <option  value="0" >%0</option>
                                                                 <option  value="1" >%1</option>
                                                                 <option  value="8" >%8</option>
                                                                 <option  value="18">%18</option>
                                                                
                                             </select>
                                          </td>
                                          <td>
                                            <input type="text" class="form-control fiyat" id="fiyat{{$i}}" name="{{$ilan_hizmet->id}}" placeholder="Fiyat" value="" required>
                                          </td>
                                          <td>
                                             <label for="inputEmail3"  name="{{$ilan_hizmet->id}}" id="{{$ilan_hizmet->id}}" class="col-sm-3 control-label toplam"></label>
                                          </td>
                                         <input type="hidden" name="ilan_hizmet_id"  id="ilan_hizmet_id" value="{{$ilan_hizmet->id}}"> 
                                      </tr>
                                      @endforeach
                                      </thead>
                              </table>                             
                          </div>
                      </div>
                  </div>
                  <div  id="goturu" class="panel panel-default ">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Fiyat İstenen Kalemler Listesi</a>
                          </h4>
                      </div>
                      <div id="collapse6" class="panel-collapse collapse">
                          <div class="panel-body">
                              <table class="table" >
                                  <thead id="tasks-list" name="tasks-list">
                                      <tr id="firma{{$firma->id}}">
                                          <?php
                                          if (!$firma->ilanlar)
                                              $firma->ilanlar = new App\Ilan();
                                          if (!$firma->ilanlar->ilan_goturu_bedeller)
                                              $firma->ilanlar->ilan_goturu_bedeller = new App\IlanGoturuBedel ();
                                          ?>
                                      <tr>
                                          <th>Sıra:</th>
                                          <th>İşin Adı:</th>
                                          <th>Miktar Türü:</th>
                                          <th>KDV Oranı:</th>
                                          <th>Fiyat:</th>
                                          <th>Para Birimi</th>
                                          <th>Toplam:</th>
                                      </tr>
                                      @foreach($firma->ilanlar->ilan_goturu_bedeller as $ilan_goturu_bedel)
                                      <tr>
                                          <td>
                                              {{$ilan_goturu_bedel->sira}}
                                          </td>

                                          <td>
                                              {{$ilan_goturu_bedel->isin_adi}}
                                          </td>
                                          <td>
                                              {{$ilan_goturu_bedel->miktar_turu}}
                                          </td>
                                           <td>
                                              <select class="form-control select" name="kdv" id="kdv" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 <option  value="0" >%0</option>
                                                                 <option  value="1" >%1</option>
                                                                 <option  value="8" >%8</option>
                                                                 <option  value="18">%18</option>
                                                                
                                             </select>
                                          </td>
                                          <td>
                                            <input type="text" class="form-control fiyat" id="fiyat{{$i}}" name="{{$ilan_goturu_bedel->id}}" placeholder="Fiyat" value="" required>
                                          </td>
                                          <td>
                                            <label for="inputEmail3" name="{{$ilan_goturu_bedel->id}}" id="{{$ilan_goturu_bedel->id}}" class="col-sm-3 control-label toplam"></label>
                                          </td>
                                        <input type="hidden" name="ilan_goturu_bedel_id"  id="ilan_goturu_bedel_id" value="{{$ilan_goturu_bedel->id}}"> 
                                      </tr>
                                      @endforeach 
                                      </thead>
                              </table>                            
                          </div>
                      </div>
                  </div>
                  <div id="yapim"  class="panel panel-default ">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Fiyat İstenen Kalemler Listesi</a>
                          </h4>
                      </div>
                      <div id="collapse7" class="panel-collapse collapse">
                          <div class="panel-body">
                              <table class="table" >
                                  <thead id="tasks-list" name="tasks-list">
                                      <tr id="firma{{$firma->id}}">
                                          <?php
                                          if (!$firma->ilanlar)
                                              $firma->ilanlar = new App\Ilan();
                                          if (!$firma->ilanlar->ilan_yapim_isleri)
                                              $firma->ilanlar->ilan_yapim_isleri = new App\IlanYapimIsi();
                                          ?>
                                      <tr>
                                          <th>Sıra:</th>
                                          <th>Adı:</th>
                                          <th>Miktar:</th>
                                          <th>Birim:</th>
                                          <th>KDV Oranı:</th>
                                          <th>Fiyat:</th>
                                          <th>Para Birimi</th>
                                          <th>Toplam:</th>
                                      </tr>
                                      @foreach($firma->ilanlar->ilan_yapim_isleri as $ilan_yapim_isi)
                                      <tr>
                                          <td>
                                              {{$ilan_yapim_isi->sira}}
                                          </td>

                                          <td>
                                              {{$ilan_yapim_isi->adi}}
                                          </td>
                                          <td>
                                              {{$ilan_yapim_isi->miktar}}
                                          </td>
                                          <td>
                                              {{$ilan_yapim_isi->birimler->adi}}
                                          </td>
                                           <td>
                                              <select class="form-control select " name="kdv" id="kdv" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 <option  value="0" >%0</option>
                                                                 <option  value="1" >%1</option>
                                                                 <option  value="8" >%8</option>
                                                                 <option  value="18">%18</option>                                                                
                                             </select>
                                          </td>
                                          <td>
                                            <input type="text" class="form-control fiyat" id="fiyat{{$i}}" name="{{$ilan_yapim_isi->id}}" placeholder="Fiyat" value="" required>
                                          </td>
                                          
                                          <td>
                                             <label for="inputEmail3" name="{{$ilan_yapim_isi->id}}" id="{{$ilan_yapim_isi->id}}" class="col-sm-3 control-label toplam"></label>
                                          </td>
                                          
                                          
                                          <input type="hidden" name="ilan_yapim_isi_id"  id="ilan_yapim_isi_id" value="{{$ilan_yapim_isi->id}}"> 
                                      </tr>
                                      @endforeach
                                      </thead>
                              </table>                              
                          </div>
                      </div>
                  </div>
              </div>
              
              
              <a href="#"><button style="float:right" type="button" class="btn btn-info">Teklif Gönder</button></a>
              
              
              <br>
              <br>                                     
             <hr>                               
        </div>    
    </div>
<script>
  for(var key=0; key < {{$i}};key++)
  {
 $('#kdv'+key).on('change', function() {
 
 var kdv=parseInt(this.value);
 var result;
 
  $('.fiyat').on('change', function() {
    var fiyat=parseInt(this.value);
   
    result=fiyat+(fiyat*kdv)/100;
    
    var name=$(this).attr('name');

    $("#"+name).text(result);
    //$()).text(result);
    
     
  });
  
});
}

 for(var key=0; key < {{$i}};key++)
  {
$('#fiyat'+key).on('change', function() {
    
   
    var fiyat=parseInt(this.value);
    var result;
    var name=$(this).attr('name');
    
  $('#kdv'+key).on('change', function() {
     
       
        var kdv2=parseInt(this.value);
        
        result=fiyat+(fiyat*kdv2)/100;
       
        $("#"+name).text(result);
    
  });
  
});
  }

var ilan_turu;
var sozlesme_turu;

$('#ilan_turu').on('change', function (e) {
        ilan_turu = e.target.value;
        
        if(ilan_turu=="Mal" && sozlesme_turu=="Birim Fiyatlı")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                  
                }
             else if(ilan_turu=="Hizmet" && sozlesme_turu=="Birim Fiyatlı")
                {
                   $('#mal').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                }
             else if(sozlesme_turu=="Götürü Bedel")
                {
                   $('#hizmet').hide()
                   $('#mal').hide()
                   $('#yapim').hide();
                }
            else if(ilan_turu=="Yapim İşi")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#mal').hide()
                }
 
});

$('#sozlesme_turu').on('change', function (e) {
             sozlesme_turu = e.target.value;
             if(ilan_turu=="Mal" && sozlesme_turu=="Birim Fiyatlı")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                  
                }
             else if(ilan_turu=="Hizmet" && sozlesme_turu=="Birim Fiyatlı")
                {
                   $('#mal').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                }
             else if(sozlesme_turu=="Götürü Bedel")
                {
                   $('#hizmet').hide()
                   $('#mal').hide()
                   $('#yapim').hide();
                }
            else if(ilan_turu=="Yapim İşi")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#mal').hide()
                }
 });

$( document ).ready(function() {

    var ilan_turu='{{$firma->ilanlar->ilan_turu}}';
    var sozlesme_turu='{{$firma->ilanlar->sozlesme_turu}}';
 
    
            if(ilan_turu=="") 
             {
                          $('#hizmet').hide()
                          $('#mal').hide()
                          $('#goturu').hide()
                          $('#yapim').hide()
             }
            else if(ilan_turu=="Mal" && sozlesme_turu=="Birim Fiyatlı")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                  
                }
             else if(ilan_turu=="Hizmet" && sozlesme_turu=="Birim Fiyatlı")
                {
                   $('#mal').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                }
             else if(sozlesme_turu=="Götürü Bedel")
                {
                   $('#hizmet').hide()
                   $('#mal').hide()
                   $('#yapim').hide();
                }
            else if(ilan_turu=="Yapim İşi")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#mal').hide()
                }
});
</script>
@endsection
