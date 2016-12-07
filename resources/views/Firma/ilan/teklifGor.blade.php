
@extends('layouts.app')
<br>
 <br>
 @section('content')
 <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
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
         <div class="panel-header">
             <h3><strong>{{$firma->adi}}</strong> firmasının <strong>{{$ilan->adi}}</strong> ilanının Teklifleri </h3>
         </div>
          @include('Firma.ilan.dataTable') 
         
    </div>

@endsection
