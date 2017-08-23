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
              z-index: 1;
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
   <link href="{{asset('css/multiple-select.css')}}" rel="stylesheet"/>

<body style="overflow-x:hidden">
   <br>
   <br>
   <br>
        <div  class="container">
            @include('layouts.alt_menu')

            <div class="col-sm-12">
                <ul style="list-style: none outside none;">
                    <?php $j=0; ?>
                    <li class="li" id="multiSel{{$j}}"> 
                    </li>                            
                </ul>
            </div>
            <div id="FilterSection" class="row content">
                <div class="col-sm-3">
                    <div class="search" id="radioDiv3">
                        <form action="javascript:runCheck()">
                            <div>
                                <input type="text" name="search" id="search" placeholder="Anahtar Kelime"><input type="button" id="button" value="ARA">
                            </div>
                            <div>
                               <input type="radio" name="searchBox" value="sektor"> Sektör <br>
                               <input type="radio" name="searchBox" value="sehir" > Şehir<br>
                               <input type="radio" name="searchBox" value="firma" > Sadece Firma Adında Ara
                            </div>
                        </form>
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
                        <select id="sektorler"   name="sektorler[]" multiple="multiple">
                            @foreach($sektorler as $sektor)
                                <option data-toggle="tooltip" data-placement="bottom" title="{{$sektor->adi}}" value="{{$sektor->id}}">{{$sektor->adi}}</option>
                            @endforeach
                        </select>
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
    <script src="{{asset('js/multiple-select.js')}}"></script>
<script>
    var sektor = new Array();
    $("#sektorler").multipleSelect({
            width: 260,
            multiple: true,
            multipleWidth: 200,
            placeholder: "Seçiniz",
            filter: true,
            onClick: function() {
                var sonSecilen="";
                var id=0;
                $('#sektorler option:selected').each(function() {
                    sonSecilen = $(this).text();
                    id=$(this).val();
                    if(jQuery.inArray(sonSecilen, sektor) === -1){
                        sektor.push(sonSecilen);
                        return false;
                    }
                });
                console.log(sonSecilen);
                if(sonSecilen !== ""){
                    doldurma(sonSecilen,"s"+id);
                }
                getFirmalar(1);
            }
    });
    $("#temizleButton").click(function(){ //////////// Bütün filtreler kalkması için ///////
       $(".silmeButton").each(function(){
           $(this).click();
       });
       return false;
    });
    function silme(name){
            console.log($('li[name='+name+']').find('span').text());
            $('li[name='+name+']').remove();    
            
            if($('#search').val() !== null){
                $("#radioDiv3 input[type='radio']").each(function(){
                    $(this).prop('checked', false);
                });
                $('#search').val(null);
            }
            
            if(name.substring(0,1) === "s"){
                var id = name.substring(1,name.length);
                
                $('#sektorler option:selected').each(function() {
                    if($(this).val()=== id){
                        console.log($('input:checkbox[data-name="selectItemsektorler[]"][value="' + id + '"]'));
                       $('input:checkbox[data-name="selectItemsektorler[]"][value="' + id + '"]').trigger("click");
                       
                    }
                });
            }else{
                $('.mutliSelect input[type="checkbox"]').each(function(){
                    var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').attr('name'),
                    title = $(this).attr('name');
                    if(name == title){
                        $(this).prop('checked', false);
                    }
                });
                 getFirmalar(1);
            }
        }
    function doldurma(name,code){
            var key=0;
            var birlesmisName;
            $("#multisel"+key).empty();
            if(code.length === 0){
               
            }
            var name1 = code.split(" "); /// Birden fazla kelime kontrolü
            if(name1.length === 1){
                birlesmisName = name1[0];
            }
            else if(name1.length === 2){
                birlesmisName=name1[0]+name1[1];
            }
            else if(name1.length === 3){
                birlesmisName=name1[0]+name1[1]+name1[2];
            }
            var html = '<li class="li" name="'+birlesmisName+'"> <p class="pclass "><span title="' + name + '">' + name + '</span> <button class="silmeButton" onclick=silme("'+birlesmisName+'")><img src="{{asset('images/kapat.png')}}"></button></p> </li>';
            $("#multiSel"+key).append(html);                                     
    }
    $('#button').click(function(){
        doldurma("Anahtar kelime:"+$('#search').val(),$('#search').val());
        getFirmalar(1);
    });
    $('#il_id').change(function(){
        var il = new Array();
        var n = jQuery('.mutliSelect input[type="checkbox"]').length;
        if (n > 0){
            jQuery('.mutliSelect input[type="checkbox"]:checked').each(function(){
            il.push($(this).val());
            });
        }
        getFirmalar(1);
        doldurma(il,il);
    });
    $(".dropdown dt a").on('click', function() {
        $(".dropdown dd ul").slideToggle('fast');
    });

    $(".dropdown dd ul li a").on('click', function() {
        $(".dropdown dd ul").hide();
    });
    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }
    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
    });
    $('.mutliSelect input[type="checkbox"]').on('click', function() {
        var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').attr('name'),
          title = $(this).attr('name');
        if ($(this).is(':checked')) {
          var html = '<span title="' + title + '">' + title + '</span>';
          $('.multiSel').append(html);
          $(".hida").hide();
          getFirmalar(1);
          doldurma(title,title);
        } else {
          $('span[title="' + title + '"]').remove();
          var ret = $(".hida");
          $('.dropdown dt a').append(ret);
        }
    });    
    function getFirmalar(page) {
        var selectedSektor = new Array();
        var n = $('#sektorler option:selected').length;  ///////////sektor /////////////
        if (n > 0){
            $('#sektorler option:selected').each(function() {
                 selectedSektor.push($(this).val());
            });
        }
        var selectedIl = new Array(); /////////// iller //////////////
        var n = jQuery('.mutliSelect input[type="checkbox"]').length;
        if (n > 0){
            jQuery('.mutliSelect input[type="checkbox"]:checked').each(function(){
                    selectedIl.push($(this).val());
            });
        }
        var selectedSearch = "";    /////////////////////////// search button /////////////////////
        var inputSearch = "";
        var selected3 = $("#radioDiv3 input[type='radio']:checked");
        if (selected3.length > 0) {
            selectedSearch = selected3.val();
        }
        inputSearch=$('#search').val();
        $.ajax({
            beforeSend: function(){
                $('.ajax-loader').css("visibility", "visible");
            },
            url : '?page='+page,
            dataType: 'json',
            data:{il:selectedIl,sektor:selectedSektor,radSearch:selectedSearch,input:inputSearch
            },
        }).done(function(data){
            $('.firmalar').html(data);
            location.hash = page;
            window.scrollTo(0, 0);

            $('.ajax-loader').css("visibility", "hidden");
        }).fail(function(){ 
            alert('Firmalar Yüklenemiyor !!!  ');
            $('.ajax-loader').css("visibility", "hidden");
        });
    }
</script>

@endsection