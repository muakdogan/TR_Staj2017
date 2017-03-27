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
              
                        $querys = DB::select(DB::raw("SELECT * 
                        FROM teklif_hareketler th1
                        JOIN (
                        SELECT teklif_id, t.ilan_id AS ilanId, MAX( tarih ) tarih
                        FROM teklifler t, teklif_hareketler th
                        WHERE t.id = th.teklif_id
                        AND t.firma_id ='$firma->id'
                        GROUP BY th.teklif_id
                        )th2 ON th1.teklif_id = th2.teklif_id
                        AND th1.tarih = th2.tarih ORDER BY th2.tarih DESC "));
                  
              ?>                   
             <h3>Başvurularım</h3>
            
             @foreach($querys as $sonuc)
                  <hr>
                  <?php  
                    $ilan= App\Ilan::find($sonuc->ilanId);
                    $kullanici_id= Auth::user()->kullanici_id;
                    $firma_id=$firma->id;
                    $rol_id  = App\FirmaKullanici::where( 'kullanici_id', '=', $kullanici_id)
                            ->where( 'firma_id', '=', $firma_id)
                            ->select('rol_id')->get();
                            $rol_id=$rol_id->toArray();              
                    $querys = App\Rol::join('firma_kullanicilar', 'firma_kullanicilar.rol_id', '=', 'roller.id')
                    ->where( 'firma_kullanicilar.rol_id', '=', $rol_id[0]['rol_id'])
                    ->select('roller.adi as rolAdi')->get();
                    $querys=$querys->toArray();
                    if($querys != null){
                        $rol=$querys[0]['rolAdi'];
                    }   
                  
                  
                   ?>
                  <p><strong>Firma Adı:</strong>&nbsp;{{$ilan->firmalar->adi}}</p>
                  <p><strong>İlan Adı:</strong>&nbsp;{{$ilan->adi}}</p>
                  <p><strong>Başvuru Tarihi:</strong>&nbsp;{{$sonuc->tarih}}</p>
                  <p><strong>Kaçıncı Sıradayım:</strong>&nbsp;</p>
                  
                  
                    @if ( $rol === 'Yönetici' || $rol ==='Satış' || $rol ==='Satın Alma / Satış')
                        <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->id), false) }}"><button   name="btn-add-düzenle" style="float:right" type="button" class="btn btn-info düzenle">Düzenle</button></a>
                    @endif
                  <br>
               @endforeach
                
           <!--div class="modal fade" id="myModal-düzenle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            </div-->
             
    </div>
@endsection


               
