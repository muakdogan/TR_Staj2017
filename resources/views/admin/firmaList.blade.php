
@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
             @include('layouts.admin_alt_menu')
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