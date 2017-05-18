@extends('layouts.app')
 @section('content')
    <style>
           input[type=text] {
               width: 200px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
               font-size: 16px;
               background-color: white;
               background-image: url("{{asset('images/search.png')}}");
               background-position: 10px 10px;
               background-repeat: no-repeat;
               padding: 12px 20px 12px 40px;
               -webkit-transition: width 0.4s ease-in-out;
               transition: width 0.4s ease-in-out;
           }

           input[type=button] {
               background-color: #004f70;
               border: 2px solid #ccc;
               color: white;
               border-radius: 4px;
              padding: 12px 8px 12px 8px;
               text-decoration: none;
               margin: 4px 2px;

           }

           .search{
               width: 270px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 0px;
               font-size: 12px;
               background-color:#C0C0C0;
               padding: 12px 8px 12px 8px;

           }
           .soldivler{
                width: 270px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 0px;
               font-size: 12px;
               background-color: #ddd;
               padding: 12px 8px 12px 8px;

           }
            a {
              color: #000;
            }
            .dropdown dd,
            .dropdown dt {
              margin: 0px;
              padding: 0px;
            }

            .dropdown ul {
              margin: -1px 0 0 0;
            }

            .dropdown dd {
              position: relative;
            }


            .dropdown dt a {
              background-color: #FFF;
              display: block;

              min-height: 25px;
              line-height: 24px;
              overflow: hidden;
              border: 0;
              border-radius: 4px;
              width: 250px;
            }

            .dropdown dt a span,
            .multiSel span {
              cursor: pointer;
              display: inline-block;
              padding: 0 3px 2px 0;
            }

            .dropdown dd ul {
              background-color: #4F6877;
              border: 0;
              color: #fff;
              display: none;
              left: 0px;
              padding: 2px 15px 2px 5px;
              position: absolute;
              top: 2px;
              width: 250px;
              list-style: none;
              height: 170px;
              overflow: auto;
            }

            .dropdown span.value {
              display: none;
            }

            .dropdown dd ul li a {
              padding: 5px;
              display: block;
            }

            .dropdown dd ul li a:hover {
              background-color: #fff;
            }

            button {
              background-color: #fff;
              border-radius: 3px;
              border: 0;
              font: 13px/18px roboto;
              text-align: center;
              color: #003151;

            }
            .pclass {
                color:#003151;
               border-radius: 3px;
                display: inline-block;
                zoom: 1;
                font: 13px/18px ;
                background:#fff;
                padding: 2px;
            }
            .li {
                   position: relative;
                   display: inline;
                   margin: 20px;
            }
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
            .hr{
                    margin-top: 0px;
                    margin-bottom: 10px;
                    border: 0;
                    border-top: 1px solid #ddd;

            }


   </style>
<body style="overflow-x:hidden">
   <br>
   <br>
   <br>

        <div  class="container">
          @include('layouts.alt_menu')
            <div id="FilterSection" class="row content">
                <div class="col-sm-3">
                    <div class="search" id="radioDiv3">
                       <div>
                           <input type="text" name="search" id="search" placeholder="Anahtar Kelime"><input type="button" id="button"  value="ARA">
                       </div>
                       <div>
                          <input type="radio" name="searchBox" value="tum"> Firma Adı<br>
                          <input type="radio" name="searchBox" value="ilan_baslık"> Şehir<br>
                          <input type="radio" name="searchBox" value="firma"> Sadece Firma Adında Ara
                       </div>
                    </div>
                    <br>
                    <div class="soldivler">
                        <form>
                            <h4>İllerde Arama</h4>
                             <dl style="margin-bottom:0px" class="dropdown">
                               <dt>
                                   <a href="#" style="padding:2px"><span class="hida">Seçiniz<span class="caret"></span></span></a>
                               </dt>
                               <dd>
                                   <div class="mutliSelect">
                                       <ul>
                                           @foreach($iller as $il)
                                                <li><input type="checkbox" value="{{$il->id}}" name="{{$il->adi}}" />{{$il->adi}}</li>
                                           @endforeach
                                       </ul>
                                   </div>
                               </dd>
                           </dl>
                        </form>
                    </div>
                    <div class="soldivler">
                        <h4>İlan Sektörü</h4>
                        @foreach($sektorler as $sektor)
                            <input type="checkbox" class="checkboxClass" value="{{$sektor->id}}" name="{{$sektor->adi}}"> {{$sektor->adi}}<br>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-9 firmalar" id="auto_load_div">
                   @include('Firma.firmalar')

               </div>
                <div class="ajax-loader">
                    <img src="{{asset('images/200w.gif')}}" class="img-responsive" />
                </div>
            </div>
        </div>
</body>
@endsection
