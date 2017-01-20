@extends('layouts.appAdmin')
@section('content')
<div class="container">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(Auth::guard('admin')->user())
             @include('layouts.admin_alt_menu') 
            
            <div class="panel panel-default">

                <div class="panel-heading">Hoşgeldiniz &nbsp;&nbsp; {{ Auth::guard('admin')->user()->name }}</div>
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