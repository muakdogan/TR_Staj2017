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
              <?php $ilanlarım = $firma->ilanlar()->orderBy('kapanma_tarihi','desc')->get();?>
                                
           <h3>İlanlarım</h3>
             <hr>
             @foreach($ilanlarım as $ilan)
              <p>{{$ilan->adi}}</p>
              <p>{{$ilan->kapanma_tarihi}}</p>
               <a href="{{ URL::to('firmaIlanOlustur', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Düzenle</button></a>
               
               <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Teklif Gör</button></a>
                <br>
               <hr>
               @endforeach
              
                                          
         </div>
             
    </div>
@endsection
