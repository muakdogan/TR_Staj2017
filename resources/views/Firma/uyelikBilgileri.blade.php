@extends('layouts.app')
@section('head')
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="{{asset('js/ajax-crud.js')}}"></script>
        <script src="{{asset('js/ajax-crud-image.js')}}"></script>
        <script src="{{asset('js/ajax-crud-firmaTanitim.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
        <script src="{{asset('js/ajax-crud-malibilgiler.js')}}"></script>
        <script src="{{asset('js/ajax-crud-ticaribilgiler.js')}}"></script>
        <script src="{{asset('js/ajax-crud-bilgilendirmetercihi.js')}}"></script>
        <script src="{{asset('js/ajax-crud-referanslar.js')}}"></script>
        <script src="{{asset('js/ajax-crud-referanslarGecmis.js')}}"></script>
        <script src="{{asset('js/ajax-crud-kalite.js')}}"></script>
        <script src="{{asset('js/ajax-crud-firmacalisanlari.js')}}"></script>
        <script src="{{asset('js/ajax-crud-firmabrosur.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/firmaProfil.css')}}"/>
        <link href="{{asset('css/multi-select.css')}}" media="screen" rel="stylesheet" type="text/css"></link>
        <link href="{{asset('css/multiple-select.css')}}" rel="stylesheet"/>
        <style>
            .search_icon {   
                background-color: white;
                background-image: url("{{asset('images/src.png')}}");
                background-repeat: no-repeat;
                padding: 0px 0px 0px 20px;

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
            .button1 {
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
            float:left;
            }
            .wrapper {
                padding: 25px;
              }

              .image-wrapper {
                padding: 5px;
             
               
              }

              .image-wrapper img {
                  max-width:200px;
                  height:200px;
               
              }
              .bilgiEkle{
                  text-align: center;
                  height:67px;
                  border-width:2px;
                  border-style:dotted;
                  border-color:#ddd
                  
              }
              /* Pie Chart */
                .progress-pie-chart {
                width:200px;
                height: 200px;
                border-radius: 50%;
                background-color: #E5E5E5;
                position: relative;
                }
                .progress-pie-chart.gt-50 {
                background-color: #81CE97;
                }

                .ppc-progress {
                content: "";
                position: absolute;
                border-radius: 50%;
                left: calc(50% - 100px);
                top: calc(50% - 100px);
                width: 200px;
                height: 200px;
                clip: rect(0, 200px, 200px, 100px);
                }
                .ppc-progress .ppc-progress-fill {
                content: "";
                position: absolute;
                border-radius: 50%;
                left: calc(50% - 100px);
                top: calc(50% - 100px);
                width: 200px;
                height: 200px;
                clip: rect(0, 100px, 200px, 0);
                background: #81CE97;
                transform: rotate(60deg);
                }
                .gt-50 .ppc-progress {
                clip: rect(0, 100px, 200px, 0);
                }
                .gt-50 .ppc-progress .ppc-progress-fill {
                clip: rect(0, 200px, 200px, 100px);
                background: #E5E5E5;
                }

                .ppc-percents {
                content: "";
                position: absolute;
                border-radius: 50%;
                left: calc(50% - 173.91304px/2);
                top: calc(50% - 173.91304px/2);
                width: 173.91304px;
                height: 173.91304px;
                background: #fff;
                text-align: center;
                display: table;
                }
                .ppc-percents span {
                display: block;
                font-size: 2.6em;
                font-weight: bold;
                color: #81CE97;
                }

                .pcc-percents-wrapper {
                display: table-cell;
                vertical-align: middle;
                }

                .progress-pie-chart {
                margin: 50px auto 0;
                }
                .switch {
                position: relative;
                display: inline-block;
                width: 40px;
                height: 18px;
                margin-top: 8px;
              }

              .switch input {display:none;}

              .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
              }

              .slider:before {
                position: absolute;
                content: "";
                height: 16px;
                width: 20px;
                left: 0px;
                bottom: 2px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
              }

              input:checked + .slider {
                background-color: #2196F3;
              }

              input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
              }

              input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
              }

              /* Rounded sliders */
              .slider.round {
                border-radius: 34px;
              }

              .slider.round:before {
                border-radius: 50%;
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
               form .error {
                  color: #000;
                 }
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
        </style>
@endsection

@section('content')
   <div class="container">
       <br>
       <br>
        @include('layouts.alt_menu') 


        <h2>Üyelik Bilgileri</h2>

        <div>
            <ul>
                <li>Üyelik başlangıç tarihi: {{$firma->uyelik_baslangic_tarihi}}</li>
                <li>Üyelik bitiş tarihi: {{$firma->uyelik_bitis_tarihi}}</li>
                <li>Ödemeler:
                    <ul>
                        @foreach($firma->odemeler as $odeme)
                            <li>Miktar: {{$odeme->miktar}}</li>
                            <li>Üyelik süresi: {{$odeme->sure}} ay</li>
                            <li>Teklif geçerlilik süresi: {{$odeme->gecerlilik_sure}} ay</li>
                            <li>Ödeme durumu: {{$odeme->odeme_durumu}}</li>
                            
                            <?php if ($odeme->odeme_tarihi)
                            {echo "<li>Ödeme tarihi: {{$odeme->odeme_tarihi}}</li>";}
                            ?>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    
                        
        <div id="mesaj" class="popup">
                <span class="button b-close"><span>X</span></span>
                <h2 style="color:red"> Üzgünüz.. !!!</h2>
                <h3>Sistemsel bir hata oluştu.Lütfen daha sonra tekrar deneyin</h3>
        </div>
     
   </div>  
   <script src="{{asset('js/selectDD.js')}}"></script>  
   <script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
<script> </script>
@endsection
