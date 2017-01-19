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
              
              $ilanlarım = $firma->ilanlar()->orderBy('kapanma_tarihi','desc')->get();
              
              
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
                
                $rol=$querys[0]['rolAdi'];
                
              
              
              
              ?>
                                
           <h3>İlanlarım</h3>
             <hr>
             @foreach($ilanlarım as $ilan)
              <p>{{$ilan->adi}}</p>
              <p>{{$ilan->kapanma_tarihi}}</p>
              
                    @if ( $rol === 'Yönetici')
                    
                        <a href="{{ URL::to('firmaIlanOlustur', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Düzenle</button></a>
               
                         <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Teklif Gör</button></a>

                    @elseif ($rol ==='Satın Alma')
                    
                        <a href="{{ URL::to('firmaIlanOlustur', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Düzenle</button></a>

                        <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Teklif Gör</button></a>

                    @elseif ($rol ==='Satın Alma / Satış')
                    
                        <a href="{{ URL::to('firmaIlanOlustur', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Düzenle</button></a>

                        <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Teklif Gör</button></a>
                        
                    @else
                        
                    @endif
              
              
                <br>
               <hr>
               @endforeach
              
                                          
         </div>
             
    </div>
@endsection
