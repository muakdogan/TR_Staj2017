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
             <div class="row">
                 <div class="col-xs-12 col-sm-6 col-md-8">

                     <div class="panel-group">

                         <div class="panel panel-default">
                             <div class="panel-heading">Son İlanlarım</div>
                             <div class="panel-body">
                                 <table>
                                     <tr>
                                         <th>İlan İsmi</th>
                                         <th>Başvuru Sayısı</th>
                                         <th></th>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td></td>
                                         <td><button class="button"> Düzenle</button></td>
                                     </tr>

                                 </table>

                             </div>
                         </div>

                         <div class="panel panel-default">
                             <div class="panel-heading">Son Başvurularım</div>
                             <div class="panel-body">
                                 <table>
                                     <tr>
                                         <th>Başvuru İlan İsmi</th>
                                         <th>Başvuru Sayısı</th>
                                         <th></th>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td></td>
                                         <td><button class="button">Düzenle</button></td>
                                     </tr>
                                 </table>

                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="col-xs-6 col-md-4">
                     <div class="panel-group">

                         <div class="panel panel-default">
                             <div class="panel-heading"><img src="{{asset('images/istatistik.png')}}">&nbsp;İstatistik</div>
                             <div class="panel-body"></div>
                         </div>
                         <div class="panel panel-default">
                             <div class="panel-heading"><img src="{{asset('images/doluluk.png')}}">&nbsp;Firma Profili Doluluk Oranı</div>
                             <div class="panel-body"></div>
                         </div>

                     </div>
                 
                 </div>
             </div>   
    </div>
@endsection
