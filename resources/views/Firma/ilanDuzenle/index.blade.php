@extends('layouts.app')
<?php use Barryvdh\Debugbar\Facade as Debugbar;
Debugbar::info($ilan);
?>

@section('head')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('css/multi-select.css')}}" media="screen" rel="stylesheet" type="text/css"></link>
    <link rel="stylesheet" type="text/css" href="{{asset('css/firmaProfil.css')}}"/>
    <style>
        .popup, .popup2, .bMulti {
            background-color: #fff;
            border-radius: 10px 10px 10px 10px;
            box-shadow: 0 0 25px 5px #999;
            color: #111;
            display: none;
            min-width: 450px;
            padding: 25px;
            text-align: center;
        }
        .popup, .bMulti {
            min-height: 150px;
        }
        .button.b-close, .button.bClose {
            border-radius: 7px 7px 7px 7px;
            box-shadow: none;
            font: bold 131% sans-serif;
            padding: 0 6px 2px;
            position: absolute;
            right: -7px;
            top: -7px;
        }
        .button {
            background-color: #2b91af;
            border-radius: 10px;
            box-shadow: 0 2px 3px rgba(0,0,0,0.3);
            color: #fff;
            cursor: pointer;
            display: inline-block;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {

            text-align: left;
            padding: 5px;
        }
        .button {
            background-color: #555555; /* Green */
            border: none;
            color: white;
            padding: 10px 22px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            margin: 4px 2px;
            cursor: pointer;
            float:right;
        }

        .test + .tooltip > .tooltip-inner {
            background-color: #73AD21;
            color: #FFFFFF;
            border: 1px solid green;
            padding: 10px;
            font-size: 12px;
        }
        .test + .tooltip.bottom > .tooltip-arrow {
            border-bottom: 5px solid green;
        }
        /*custom font*/

        #msform {
            width: 100%;
            position: relative;
        }

        /*Hide all except first fieldset*/
        #msform fieldset:not(:first-of-type) {
            display: none;
        }

        /*buttons*/
        .action-button {
            width: 100px;
            background: #27AE60;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }
        .action-button:hover, #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
        }
        /*headings*/
        .fs-title {
            font-size: 15px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
        }
        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }
        /*progressbar*/
        #progressbar {

            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }
        #progressbar li {
            list-style-type: none;
            color: #27ae60;
            text-transform: uppercase;
            font-size: 9px;
            width: 50%;
            float: left;
            position: relative;
            text-align: center;
            z-index: 0;
        }
        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 20px;
            line-height: 20px;
            display: block;
            font-size: 10px;
            color: #333;
            background: white;
            border-radius: 3px;
            margin: 0 auto 5px auto;
        }
        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 95%;
            height: 3px;
            background: white;
            position: absolute;
            left: -46.60%;
            top: 9px;
            z-index: -1; /*put it behind the numbers*/
        }
        #progressbar li:first-child:after {
            content: none;
        }
        #progressbar li.active:before,  #progressbar li.active:after{
            background: #27AE60;
            color: white;
        }
        .eula-container {
            padding: 15px 20px;
            height: 250px;
            overflow: auto;
            border: 2px solid #ebebeb;
            color: #7B7B7B;
            font-size: 12pt;
            font-weight: 700;
            background-color: #fff;
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
            background-image: -webkit-linear-gradient(top, rgba(231,231,231,0.55) 0%, rgba(255,255,255,0.63) 17%, #feffff 100%);
            background-image: linear-gradient(to bottom, rgba(231,231,231,0.55) 0%, rgba(255,255,255,0.63) 17%, #feffff 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8ce7e7e7', endColorstr='#feffff',GradientType=0 );
            background-clip: border-box;
            border-radius: 4px;
        }
        .info-box {
            margin: 0 0 15px;
        }
        .box h3{
            text-align:center;
            position:relative;
            top:80px;
        }
        .box {
            width:100%;
            height:200px;
            background:#FFF;
            margin:40px auto;
        }
        .effect8
        {
            position:relative;
            -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        }
        .effect8:before, .effect8:after
        {
            content:"";
            position:absolute;
            z-index:-1;
            -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
            -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
            box-shadow:0 0 20px rgba(0,0,0,0.8);
            top:10px;
            bottom:10px;
            left:0;
            right:0;
            -moz-border-radius:100px / 10px;
            border-radius:100px / 10px;
        }
        .effect8:after
        {
            right:10px;
            left:auto;
            -webkit-transform:skew(8deg) rotate(3deg);
            -moz-transform:skew(8deg) rotate(3deg);
            -ms-transform:skew(8deg) rotate(3deg);
            -o-transform:skew(8deg) rotate(3deg);
            transform:skew(8deg) rotate(3deg);
        }

    </style>

@endsection

{{--Teklif yoksa ilan düzenlenebilir!--}}
@if(!$teklifVarMi)

@section('content')
    <style>
    .ajax-loader {
    visibility: hidden;
    background-color: rgba(255,255,255,0.7);
    position: absolute;
    z-index: +100 !important;
    width: 100%;
    height:100%;
    }

    .ajax-loader img {
    position: relative;
    top:50%;
    left:32%;
    }
    </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<div class="container">
    <br /> <br />
    @include('layouts.alt_menu')

    <h2>İlan Düzenle</h2>
    <div class="box effect8">
        <h3><button style="font-size:30px;color: #337ab7;background-color: #ffffff;border-color: #ffffff;"  id="btn-add-ilanBilgileri" name="btn-add-ilanBilgileri" class="btn btn-primary btn-xs" onclick="populateDD()">İlanı Düzenlemeye Başlayın</button></h3>
    </div>

    @include('Firma.ilanDuzenle.ilanDuzenleM')

    <div id="mesaj" class="popup">
        <span class="button b-close"><span>X</span></span>
        <h2 style="color:red;font-size:14px"> Dikkat!!</h2>
        <h3 style="font-size:12px">Lütfen Rekabet Şeklini Seçmeden Önce İlan Sektörü Seçimi Yapınız.</h3>
    </div>
    <div id="mesaj_sistem" class="popup">
        <span class="button b-close"><span>X</span></span>
        <h2 style="color:red"> Üzgünüz.. !!!</h2>
        <h3>Sistemsel bir hata oluştu.Lütfen daha sonra tekrar deneyin</h3>
    </div>
</div>

<script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script charset="utf-8">

    $('#btn-add-ilanBilgileri').click(function () {
        $('#btn-save-ilanBilgileri').val("add");
        $('#myModal-ilanBilgileri').modal('show');
    });


</script>
    <script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
@endsection
@else
    {{--Teklif varsa ilan düzenleneMEZ!--}}

@section('content')

    <div class="container">
        <br>
        <br>
        @include('layouts.alt_menu')
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12" >
                <div class="box effect8">
                    <h3>Teklif verilmiş ilanda düzenleme yapılamaz!</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
@endif