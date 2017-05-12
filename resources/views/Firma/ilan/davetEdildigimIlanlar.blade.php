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
                             <div class="panel-heading">Davet Edildiğim İlanlar</div>
                             <div class="panel-body">
                                 <table>
                                     <tr>
                                         <th>İlan İsmi</th>
                                         <th>Başvuru Sayısı</th>
                                         <th></th>
                                     </tr>
                                    @foreach(App\BelirlIstekli::where('firma_id',$firma->id)->get() as $dvtIlan)
                                     <tr>
                                         <td>{{$dvtIlan->dvtIlanAdi($dvtIlan->ilan_id)}}</td>
                                         <td>{{$dvtIlan->dIlanTeklifsayısı($dvtIlan->ilan_id)}}</td>
                                         <td><a href="{{ URL::to('teklifGor', array($firma->id,$dvtIlan->getdIlanId($dvtIlan->ilan_id)), false) }}"><button type="button" class="btn btn-primary" name="{{$dvtIlan->getdIlan($dvtIlan->ilan_id)}}" id="{{$dvtIlan->getdIlan($dvtIlan->ilan_id)}}" style='float:right'>Başvur</button></a><br><br></td>                                          
                                     </tr>
                                    @endforeach
                                 </table>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
     </div>