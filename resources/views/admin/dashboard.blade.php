@extends('layouts.appAdmin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(Auth::guard('admin')->user())
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
                @else
                <div class="panel panel-default">

                    <div class="panel-heading">Giriş Yapınız</div>
                    @endif
                    <div class="panel-body"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection