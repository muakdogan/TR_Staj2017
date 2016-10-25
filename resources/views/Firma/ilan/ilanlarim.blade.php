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
                             <li><a href="{{ URL::to('ilanEkle', array($firma->id,'0'), false)}}">İlan Oluştur</a></li>
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
              <?php $ilanlarım = $firma->ilanlar()->orderBy('kapanma_tarihi','desc')->get();?>
                                
           <h3>İlanlarım</h3>
             <hr>
             @foreach($ilanlarım as $ilan)
              <p>{{$ilan->adi}}</p>
              <p>{{$ilan->kapanma_tarihi}}</p>
               <a href="{{ URL::to('firmaIlanOlustur', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Düzenle</button></a>
               
               <button style="float:right" type="button" class="btn btn-info">Teklif Gör</button>
                <br>
               <hr>
               @endforeach
              
                                          
         </div>
             
    </div>
@endsection
