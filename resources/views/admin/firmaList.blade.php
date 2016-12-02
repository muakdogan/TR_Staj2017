
@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <nav style="background-color:#f5f5f5;border-color:#f5f5f5"class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a style="padding:0px"class="navbar-brand" href="#"><img src='{{asset('images/anasayfa.png')}}'></a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class=""><a href="{{ url('/firmaList')}}">Firma Onayı</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">İlan İşlemleri <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="">İlanlarım</a></li>
                                <li><a href="">İlan Oluştur</a></li>
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
            <div class="panel panel-default">
                <div class="panel-heading">Hoşgeldiniz {{ Auth::guard('admin')->user()->name }}</div>
                    <?php
                            $onay = DB::table('firmalar')
                              ->where('onay', '')->orderBy('olusturmaTarihi', 'desc') ->get();           
                   ?>
                <div class="panel-body">
                    
                            <label for="" style="color: #000; font-size: 30px">ONAYLANMAMIŞ FİRMALAR</label><br>
                            <hr>
                            @foreach($onay as $firma)
                             <label for="" style="color: #666666; font-weight: bold;font-size: 15px">{{$firma->olusturmaTarihi}} // {{$firma->adi}}</label> <a href="{{ url('firmaOnay/'.$firma->id)}}" style="float:right" id="{{$firma->id}}" type="button" class="btn btn-primary" onclick="alert( ' FİRMA ONAYLANDI');">ONAYLA</a><br><br>
                            @endforeach
                       
                            <br>
                               
                </div>          
                </div>
            </div>
        </div>
    </div>
</div>

@endsection