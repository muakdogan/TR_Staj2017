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
                     
                     <li class=""><a href="{{ URL::to('firmaProfili', array($firma->id), false)}}">Firma Profili</a></li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">İlan İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="{{ URL::to('ilanlarim', array($firma->id), false)}}">İlanlarım</a></li>
                             
                             <li><a href="{{ URL::to('ilanEkle', array($firma->id,'0'), false)}}">İlan Oluştur</a></li>
                         </ul>
                     </li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Başvuru İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="{{ URL::to('basvurularim', array($firma->id), false)}}">Başvurularım</a></li>
                             <li><a href="{{url('ilanAra/')}}">Başvur</a></li>
                             
                         </ul>
                     </li>
                     <li><a href="#">Mesajlar</a></li>
                     <li><a href="#">Kullanici İşlemleri</a></li>
                 </ul>
             </div>
</nav>
              
          <div class="col-sm-12">
              
              <?php
              
          
                 
                        $querys = DB::table('teklif_hareketler')
                        ->join('firma_kullanicilar', 'firma_kullanicilar.id', '=', 'teklif_hareketler.firma_kullanicilar_id')
                        ->join('users', 'users.kullanici_id', '=', 'firma_kullanicilar.kullanici_id')
                        ->join('teklifler', 'teklif_hareketler.teklif_id', '=', 'teklifler.id')
                        ->join('ilanlar', 'teklifler.ilan_id', '=', 'ilanlar.id')
                        ->join('firmalar', 'teklifler.firma_id', '=', 'firmalar.id')
                        ->where( 'firma_kullanicilar.firma_id', '=', $firma->id)      
                        ->select('firmalar.adi as firmaadi','ilanlar.adi as ilanadi','teklif_hareketler.*')        
                        ->orderBy('tarih','desc');
                      
                        $querys=$querys->get();
                        
                       
                  
                          
              ?>
            
                                
             <h3>Başvurularım</h3>
            
             @foreach($querys as $sonuc)
                  <hr>

                  <p><strong>Firma Adı:</strong>&nbsp;{{$sonuc->firmaadi}}</p>
                  <p><strong>İlan Adı:</strong>&nbsp;{{$sonuc->ilanadi}}</p>
                  <p><strong>Başvuru Tarihi:</strong>&nbsp;{{$sonuc->tarih}}</p>
                  <p><strong>Kaçıncı Sıradayım:</strong>&nbsp;{{$sonuc->teklif_id}}</p>

                   <button id="{{$sonuc->teklif_id}}" name="{{$sonuc->teklif_id}}" style="float:right" type="button" class="btn btn-info detay">Detayları Gör</button>
                   <button id="btn-add-düzenle" name="btn-add-düzenle" style="float:right" type="button" class="btn btn-info düzenle">Düzenle</button>

                  <br>
               
               @endforeach
                <div class="modal fade" id="myModal-detay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                         <h4 class="modal-title" id="myModalLabel">DETAYLAR</h4>
                                    </div>
                                    <div class="modal-body">
                                    @foreach($teklifler as $teklif)
                                    @endforeach
                                         @if($teklif->ilanlar->ilan_turu=='Hizmet')

                                                 <p id="sira"><strong>Sıra:</strong>&nbsp;</p>
                                                 <p id="adi"><strong>Adı:</strong>&nbsp;</p>
                                                 <p id="fiyat_standart"><strong>Fiyat Standartı:</strong>&nbsp;</p>
                                                 <p id="fiyat_standart_birim"><strong>Fiyat Standartı Birimi:</strong>&nbsp;</p>
                                                 <p id="miktar"><strong>Miktar:</strong>&nbsp;</p>
                                                 <p id="miktar_birimi"><strong>Miktar Birimi:</strong>&nbsp;</p>
                                                 <p id="ilan_adi"><strong>İlan Adı:</strong>&nbsp;</p>
                                               
                                        @elseif($teklif->ilanlar->ilan_turu=='Mal')  
                                                 <p id="sira"><strong>Sıra:</strong>&nbsp;</p>
                                                 <p id="marka"><strong>Marka:</strong>&nbsp;</p>
                                                 <p id="model"><strong>Model:</strong>&nbsp;</p>
                                                 <p id="adi"><strong>Adı:</strong>&nbsp;</p>
                                                 <p id="ambalaj"><strong>Ambalaj:</strong>&nbsp;</p>
                                                 <p id="miktar"><strong>Miktar:</strong>&nbsp;</p>
                                                 <p id="birim"><strong>Birim:</strong>&nbsp;</p>
                                                 <p id="ilan_adi"><strong>İlan Adı:</strong>&nbsp;</p>
                                        
                                        
                                                
                                        
                                        @elseif($teklif->ilanlar->ilan_turu=='Götürü Bedel')
                                                 <p id="sira"><strong>Sıra:</strong>&nbsp;</p>
                                                 <p id="isin_adi"><strong>İşin Adı:</strong>&nbsp;</p>
                                                 <p id="miktar_turu"><strong>Miktar Türü:</strong>&nbsp;</p>
                                                 <p id="ilan_adi"><strong>İlan Adı:</strong>&nbsp;</p>
                                              
                                        
                                        
                                        
                                        @elseif($teklif->ilanlar->ilan_turu=='Yapim İşi')
                                        
                                                 <p id="sira"><strong>Sıra:</strong>&nbsp;</p>
                                                 <p id="adi"><strong>Adı:</strong>&nbsp;</p>
                                                 <p id="miktar"><strong>Miktar :</strong>&nbsp;</p>
                                                 <p id="birim_id"><strong>Birim :</strong>&nbsp;</p>
                                                 <p id="ilan_adi"><strong>İlan Adı:</strong>&nbsp;</p>
                                        
                                        @endif
                                     

                                    <div class="modal-footer">                                                            
                                    </div>
                                </div>
                            </div>
                        </div>

          </div>
               <div class="modal fade" id="myModal-düzenle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">DÜZENLE</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaProfili/tanitim/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}
                                       
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">DENEME</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="tanıtım_yazısı" name="tanıtım_yazısı" placeholder="Tanıtım Yazısı" value="">
                                               
                                           </div>
                                       </div>

                                       {!! Form::submit('Kaydet', array('url'=>'firmaProfili/tanitim/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">                                                            
                                   </div>
                               </div>
                           </div>
                       </div>
             
    </div>
<script >
   
       var detay=0;
       var control='{{$teklif->ilanlar->ilan_turu}}';
         
       $(".btn-info").click(function(){

                 detay=$(this).attr("name");
                      
                        func();
       });
       
 
    function func(){
                    
            $.ajax({
            type:"GET",
            url:"../basvuruDetay",
            data:{teklif_id:detay
       
            },
            cache: false,
            success: function(data){
            console.log(data);
            
            
            if(control=='Hizmet'){
                  
                                                             
                    $("#sira").empty();
                    $("#adi").empty();
                    $("#fiyat_standart").empty();
                    $("#fiyat_standart_birim").empty();
                    $("#miktar").empty();
                    $("#miktar_birimi").empty();
                    $("#ilan_adi").empty();
                    
                }
                else if(control=='Mal'){
                    $("#sira").empty();
                    $("#marka").empty();
                    $("#model").empty();
                    $("#adi").empty();
                    $("#ambalaj").empty();
                    $("#miktar").empty();
                    $("#birim").empty();
                    $("#ilan_adi").empty();
                    
                }
                 else  if(control=='Gotürü Bedel'){
                     
                                                             
                    $("#sira").empty();
                    $("#isin_adi").empty();
                    $("#miktar_turu").empty();
                    $("#ilan_adi").empty();
                    
                    
                }
                else  if(control=='Yapim İşi'){
                     
                     $("#sira").empty;
                    $("#adi").empty();
                    $("#miktar").empty();
                    $("#birim_id").empty();
                    $("#ilan_adi").empty();
                }
            
            
            for(var key=0; key <Object.keys(data).length;key++)
             {
                 
                 
                if(control=='Hizmet'){
                  
                                                             
                    $("#sira").append(data[key].sira);
                    $("#adi").append(data[key].adi);
                    $("#fiyat_standart").append(data[key].fiyat_standardi);
                    $("#fiyat_standart_birim").append(data[key].adi);
                    $("#miktar").append(data[key].miktar);
                    $("#miktar_birimi").append(data[key].birimadi);
                    $("#ilan_adi").append(data[key].ilanadi);
                    
                }
                else if(control=='Mal'){
                    $("#sira").append(data[key].sira);
                    $("#marka").append(data[key].marka);
                    $("#model").append(data[key].model);
                    $("#adi").append(data[key].adi);
                    $("#ambalaj").append(data[key].ambalaj);
                    $("#miktar").append(data[key].miktar);
                    $("#birim").append(data[key].birimadi);
                    $("#ilan_adi").append(data[key].ilanadi);
                    
                }
                 else  if(control=='Gotürü Bedel'){
                     
                                                             
                    $("#sira").append(data[key].sira);
                    $("#isin_adi").append(data[key].isin_adi);
                    $("#miktar_turu").append(data[key].miktar_turu);
                    $("#ilan_adi").append(data[key].ilanadi);
                    
                    
                }
                else  if(control=='Yapim İşi'){
                     
                     $("#sira").append(data[key].sira);
                    $("#adi").append(data[key].adi);
                    $("#miktar").append(data[key].miktar);
                    $("#birim_id").append(data[key].birimadi);
                    $("#ilan_adi").append(data[key].ilanadi);
                }
               
             }
         }

        });
    }
    
 </script>
@endsection


               
