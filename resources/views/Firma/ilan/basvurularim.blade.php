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
         
              @include('layouts.alt_menu') 
              
          <div class="col-sm-12">
              
              <?php
              
          
                 
                        $querys = DB::table('teklif_hareketler')
                        ->join('firma_kullanicilar', 'firma_kullanicilar.id', '=', 'teklif_hareketler.firma_kullanicilar_id')
                        ->join('users', 'users.kullanici_id', '=', 'firma_kullanicilar.kullanici_id')
                        ->join('teklifler', 'teklif_hareketler.teklif_id', '=', 'teklifler.id')
                        ->join('ilanlar', 'teklifler.ilan_id', '=', 'ilanlar.id')
                        ->join('firmalar', 'teklifler.firma_id', '=', 'firmalar.id')
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
               <p><strong>Kaçıncı Sıradayım:</strong>&nbsp;</p>
           
               <button id="btn-add-detay" name="{{$sonuc->teklif_id}}" style="float:right" type="button" class="btn btn-info">Detayları Gör</button>
               <button id="btn-add-düzenle" name="btn-add-düzenle" style="float:right" type="button" class="btn btn-info">Düzenle</button>
                 
               <br>
              
               @endforeach
               <div class="modal fade" id="myModal-detay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel"></h4>
                                   </div>
                                   <div class="modal-body">
                                    {!! Form::open(array('url'=>'firmaProfili/tanitim/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Tanıtım Yazısı</label>
                                           <div class="col-sm-9">
                                               
                                               hdjafjhafhj
                                                <?php $i=0;?>
                                               @foreach($detaylar  as $detay)
                                               <p id="deneme3{{$i}}"> </p>
                                                <?php $i++;?>
                                               @endforeach
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
               <div class="modal fade" id="myModal-düzenle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Firma Tanıtım Yazısı</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaProfili/tanitim/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}
                                       
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Tanıtım Yazısı</label>
                                           <div class="col-sm-9">
                                               <!--input type="text" class="form-control" id="tanıtım_yazısı" name="tanıtım_yazısı" placeholder="Tanıtım Yazısı" value=""-->
                                               <textarea id="tanitim_yazisi" name="tanitim_yazisi" rows="7" class="form-control ckeditor" placeholder="Lütfen tanıtım yazısını buraya yazınız.." required></textarea>
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
@endsection

 <script>
                           function func(){
                                    var teklif;

                                        $.ajax({
                                          type:"GET",
                                          url: "basvuruDetay",
                                          data:{teklif_id:teklif},
                                          cache: false,
                                          success: function(data){
                                             console.log(data);
                                               for(var key=0; key <Object.keys(data).length;key++)
                                            {
                                                 $("#deneme3"+key).append(data[key].ilan_mal_id);


                                            }
                                         }


                                       });
                            }
                       </script>
               
