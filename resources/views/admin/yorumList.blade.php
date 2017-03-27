@extends('layouts.appAdmin')
@section('content')
<div class="container">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <div class="row">
            @include('layouts.admin_alt_menu')
                  <div class="panel panel-default">
                    <div class="panel-heading">KULLANICI YORUM İŞLEMLERİ</div>
                       <?php
                                $onay = DB::table('yorumlar')
                                ->where('onay', ' ')->orderBy('tarih', 'desc') ->get();
                                
                                 $onayli = DB::table('yorumlar')
                                ->where('onay', 'onay')->orderBy('tarih', 'desc') ->get(); 
                       ?>
                    <div class="panel-body">
                        <div  id="exTab2"  >
                             <ul class="nav nav-tabs">
                                <li class="active"><a  href="#1" data-toggle="tab">Onaylanmayı Bekleyen Yorumlar</a>
                                </li>
                                <li><a href="#2" data-toggle="tab">Onaylanmış Yorumlar</a>
                                </li>
                             </ul>
                            <div class="tab-content ">
                                <div class="tab-pane active" id="1">
                                    <br>
                                      <table  style="width: 100%;">
                                        <tr>
                                          <th >YORUM YAPILAN TARİH</th>
                                          <th >YAPILAN YORUMLAR</th>
                                           <th >ONAY</th>
                                        </tr>
                                      @foreach($onay as $yorumlar)
                                        <tr>
                                          <td>{{$yorumlar->tarih}} </td>
                                          <td>{{$yorumlar->yorum}}</td>
                                          <td><a href="{{ URL::to('yorumOnay', array($yorumlar->id,$yorumlar->yorum_yapan_kullanici_id), false)}}"  id="{{$yorumlar->id}}" type="button" class="btn btn-primary" onclick="alert('YORUM ONAYLANDI');">ONAYLA</a></td>
                                        </tr>
                                      @endforeach
                                   </table>
                                </div>
                                <div class="tab-pane" id="2">
                                    <br>
                                    <table style="width: 100%;">
                                        <tr>
                                          <th >YORUM YAPILAN TARİH</th>
                                          <th >YAPILAN YORUMLAR</th>
                                        </tr>
                                      @foreach($onayli as $onayli_yorumlar)
                                        <tr>
                                          <td>{{$onayli_yorumlar->tarih}}</td>
                                          <td>{{$onayli_yorumlar->yorum}}</td>
                                          <td><img src="{{asset('images/check.png')}}"></td>
                                        </tr>
                                      @endforeach
                                   </table>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>          
                </div>
     </div>
</div>
@endsection
