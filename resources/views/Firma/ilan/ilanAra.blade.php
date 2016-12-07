@extends('layouts.ilanApp')
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
               background-color: #63b8ff;
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
               border-radius: 4px;
               font-size: 12px;
               background-color:#C0C0C0;
               padding: 12px 8px 12px 8px;
               
           }
           .soldivler{
                width: 270px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
               font-size: 12px;
               background-color: #f5f5f5;
               padding: 12px 8px 12px 8px;
               
           }
          

            .dropdown {



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

            .dropdown a,
            .dropdown a:visited {
              color: #333;
              text-decoration: none;
              outline: none;
              font-size: 12px;
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
              background-color: #1e90ff;
              border-radius: 15px; 
              border: 0;
              margin: 5px 0;
              text-align: center;
              color: #fff;
              font-weight: bold;
            }
            .pclass {
                color: rgb(255, 255, 255);
                border-top-right-radius: 15px;
                border-bottom-right-radius: 15px;
                border-bottom-left-radius: 15px;
                border-top-left-radius: 15px;
                display: inline-block;
                zoom: 1;
                font: 13px/18px roboto;
                background:	#1E90FF;
                padding: 5px;
            }
              .li {
                     position: relative;
                     display: inline;
                     margin: 20px;
              }

       
           
   </style>
  
       <div  class="container-fuild">
           <div id ="header" class="row content ">
               <div class="container">
                   <div class="col-sm-3">
                        <?php $ilan = DB::table('ilanlar')->count();?>
                        <h4>Arama kriterlerinize uyan <img src="{{asset('images/sol.png')}}"> {{$ilan}} ilan </h4>
                   </div>
                    <div class="col-sm-6">
                        <ul style="list-style: none outside none;">
                            <?php $j=0; ?>
                            <li class="li" id="multiSel{{$j}}">
                              
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <div style="float:right">
                            <img  src="{{asset('images/sil1.png')}}">&nbsp;Temizle</img>
                        </div>
                    </div>
               </div>
           </div>
       </div>   
   
   <br>
   <br>
   <br>
      
        <div  class="container">
            <div id="FilterSection" class="row content">
                <div class="col-sm-3">
                    <div class="search" id="radioDiv3">
                       <div>
                           <input type="text" name="search" id="search" placeholder="Anahtar Kelime"><input type="button" id="button"  value="ARA">
                       </div>
                       <div>
                          <input type="radio" name="searchBox" value="tum"> Tüm İlanda<br>
                          <input type="radio" name="searchBox" value="ilan_baslık"> Sadece İlan Başlığında<br>
                          <input type="radio" name="searchBox" value="firma"> Sadece Firma Adında Ara
                       </div>
                    </div>
                    <br>
                    <div class="soldivler">
                        <form  >
                            <h4>İllerde Arama</h4>
                            <br>
                            <br>
                             <dl class="dropdown">
                               <dt>
                               <a href="#">
                                 <span class="hida">Seçiniz<span class="caret"></span></span>    

                               </a>
                               </dt>

                               <dd>
                                   <div class="mutliSelect">
                                       <ul>
                                           @foreach($iller as $il)
                                           <li>
                                               <input type="checkbox" value="{{$il->id}}" name="{{$il->adi}}" />{{$il->adi}}</li>
                                           @endforeach

                                       </ul>
                                   </div>
                               </dd>
                           </dl>
                        </form>
                    </div>
                    <div class="soldivler">
                        <h4>İlan Tarihi Aralığı</h4>
                        <p>Başlangıç Tarihi</p>
                        <input type="date" class="form-control datepicker" id="baslangic_tarihi" name="baslangic_tarihi" placeholder="" value="">
                        <br>
                        <p>Bitiş Tarihi</p>
                        <input type="date" class="form-control datepicker" id="bitis_tarihi" name="bitis_tarihi" placeholder="" value="">
                    </div>
                    <div class="soldivler">
                        <h4>İlan Sektörü</h4>
                        @foreach($sektorler as $sektor)
                         <input type="checkbox" class="checkboxClass" value="{{$sektor->id}}" name="{{$sektor->adi}}"> {{$sektor->adi}}<br>
                        @endforeach
                    </div>
                    <div class="soldivler" id="radioDiv">
                        <h4>İlan Türü</h4>
                        <input type="radio" name="ilanTuru[]" class="tur" value="Mal"><span class="lever"></span>Mal<br>
                        <input type="radio" name="ilanTuru[]" class="tur" value="Hizmet"><span class="lever"></span>Hizmet<br>
                        <input type="radio" name="ilanTuru[]" class="tur" value="Yapım İşi"><span class="lever"></span>Yapım İşi
                    </div>
                     <div class="soldivler" id="radioDiv4"> 
                        <h4>Sözleşme Türü</h4>
                        <input type="radio" name="sozlesmeTuru[]" class="sozlesme" value="Birim Fiyatlı"><span class="lever"></span>Birim Fiyatlı<br>
                        <input type="radio" name="sozlesmeTuru[]" class="sozlesme" value="Götürü Bedel"><span class="lever"></span>Götürü Bedel<br>
                     </div>
                     <div class="soldivler">
                        <h4>Ödeme Türleri</h4>
                        @foreach($odeme_turleri as $odeme)
                         <input type="checkbox" class="checkboxClass2" value="{{$odeme->id}}" name="{{$odeme->adi}}"> {{$odeme->adi}}<br>
                        @endforeach
                    </div>
                    <div class="soldivler" id="radioDiv2">
                        <h4>İlan Usulü</h4>
                        <input type="radio" name="gender[]" class="usul" value="Açık"> Açık<br>
                        <input type="radio" name="gender[]" class="usul" value="Belirli İstekler Arasında">Belirli İstekler Arasında<br>
                        <input type="radio" name="gender[]" class="usul" value="Başvuru">Başvuru
                    </div>
                </div>

                <div class="col-sm-9 ilanlar" id="auto_load_div">
                   @include('Firma.ilan.ilanlar')                                               
               </div>
            </div>
            
            <script type="text/javascript">
                $('.basvur').click(function(){
                    @if(Auth::guest())
                        alert("guest");
                        $('#modalLogin').modal('show');
                    @else
                        
                    @endif
                    alert($(this).attr('id'));
                });
                function silme(name){                        
                        alert('içerde');
                        $('li[name='+name+']').remove();
                        if(name == "tarım" || name == "hizmet"){
                            $('.checkboxClass[name='+name+']').prop("checked", false);
                            getIlanlar(1);
                        }
                        if(name == "Nakit" || name == "Kredi Kartı" || name == "Havale" || name == "Çek" || name == "Senet"){
                            $('.checkboxClass2[name='+name+']').prop("checked", false);
                            getIlanlar(1);
                        }
                        if(name == "Mal" || name == "Hizmet" || name == "Yapım İşi"){
                            
                            $("#radioDiv input[type='radio']").each(function(){
                                alert($(this).val());
                                $(this).prop('checked', false);
                            });
                            getIlanlar(1);
                        }
                        if(name == "Açık" || name == "Belirli İstekler Arasında" || name == "Başvuru"){
                            
                            $("#radioDiv2 input[type='radio']").each(function(){
                                alert($(this).val());
                                $(this).prop('checked', false);
                                
                            });
                            getIlanlar(1);
                        }
                        if(name == "Birim Fiyatlı" || name == "Götürü Bedel"){
                            
                            $("#radioDiv4 input[type='radio']").each(function(){
                                alert($(this).val());
                                $(this).prop('checked', false);
                                
                            });
                            getIlanlar(1);
                        }
                        if(name.indexOf("başlangıç") != -1){
                            alert("ozge");
                            $(' input[type=date]').each( function resetDate(){
                                if(name.indexOf(this.value) != -1){
                                    this.value = this.defaultValue;
                                }
                            } );
                            getIlanlar(1);
                                            
                        }
                        if($('#search').val() != null){
                            $("#radioDiv3 input[type='radio']").each(function(){
                                $(this).prop('checked', false);
                            });
                            $('#search').val(null);
                        }
                        if(name.indexOf("bitiş") != -1){
                            alert("ezgi");
                            $(' input[type=date]').each( function resetDate(){
                                if(name.indexOf(this.value) != -1){
                                    this.value = this.defaultValue;
                                }
                            } );
                            getIlanlar(1);
                                            
                        }
                        else{
                            $('.mutliSelect input[type="checkbox"]').each(function(){
                                var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').attr('name'),
                                title = $(this).attr('name');
                                if(name == title){
                                    $(this).prop('checked', false);
                                }
                            });
                             getIlanlar(1);
                        }
                    }
                function doldurma(name){
                        var key=0;
                         alert(name);           
                        $("#multisel"+key).empty();
                        var valName="'"+name+"'";
                        var html = '<li class="li" name="'+name+'"> <p class="pclass "><span title="' + name + '">' + name + '</span> <button onclick=silme("'+name+'")><img src="{{asset('images/kapat.png')}}"></button></p> </li>';
                        alert(name);
                        $("#multiSel"+key).append(html);                                     
                }
                $('#button').click(function(){
                    doldurma($('#search').val());
                    getIlanlar(1);
                });
                $('#il_id').change(function(){
                    var il = new Array();
                    var n = jQuery('.mutliSelect input[type="checkbox"]').length;
                    if (n > 0){
                        jQuery('.mutliSelect input[type="checkbox"]:checked').each(function(){
                        il.push($(this).val());
                        });
                    }
                    getIlanlar(1);
                    doldurma(il);
                });
                $('#baslangic_tarihi').change(function(){
                    var bas=$('#baslangic_tarihi').val()+"başlangıç";
                    getIlanlar(1);
                    doldurma(bas);
                    });
                $('#bitis_tarihi').change(function(){
                    var bit=$('#bitis_tarihi').val()+"bitiş";
                    getIlanlar(1);
                    doldurma(bit);
                });
                $('.tur').click(function(){
                    var tur=$("#radioDiv input[type='radio']:checked").val();
                    getIlanlar(1);
                    doldurma(tur);
                });
                $('.usul').click(function(){
                    var usul=$("#radioDiv2 input[type='radio']:checked").val();
                    getIlanlar(1);
                    doldurma(usul);
                });
                $('.sozlesme').click(function(){
                    var sozlesme=$("#radioDiv4 input[type='radio']:checked").val();
                    getIlanlar(1);
                    doldurma(sozlesme);
                });
                var odeme = new Array();
                $('.checkboxClass2').click(function(){
                    var sonSecilen;
                    var n = jQuery('.checkboxClass2:checked').length;
                    if (n > 0){
                        jQuery('.checkboxClass2:checked').each(function(){
                            sonSecilen = $(this).attr('name');
                            if(jQuery.inArray(sonSecilen, odeme) === -1){
                            console.log(sonSecilen);
                            odeme.push(sonSecilen);
                            return false;
                            }
                        });

                    }
                    getIlanlar(1);
                    doldurma(sonSecilen);
                });
                var sektor = new Array();
                $('.checkboxClass').click(function(){
                    var sonSecilen;
                    var n = jQuery('.checkboxClass:checked').length;
                        if (n > 0){
                            jQuery('.checkboxClass:checked').each(function(){
                            sonSecilen = $(this).attr('name');
                            if(jQuery.inArray(sonSecilen, sektor) === -1){
                                sektor.push(sonSecilen);
                                return false;
                            }
                            });
                        console.log(sonSecilen);
                    }
                    getIlanlar(1);
                    doldurma(sonSecilen);
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
                      getIlanlar(1);
                      doldurma(title);
                    } else {
                      $('span[title="' + title + '"]').remove();
                      var ret = $(".hida");
                      $('.dropdown dt a').append(ret);
                    }
                });
                
                $(document).ready(function(){
                    
                    $(document).on('click', '.pagination a', function (e){
                        getIlanlar($(this).attr('href').split('page=')[1]);
                        e.preventDefault();
                    });
                    var sehirId = "{{$ilId}}";
                    var keyword = "{{$keyword}}";
                    
                    if(sehirId != ""){
                        jQuery('.mutliSelect input[type="checkbox"]').each(function(){
                            if($(this).val() == sehirId ){
                                var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').attr('name'),
                                    title = $(this).attr('name');
                                var html = '<span title="' + title + '">' + title + '</span>';
                                $(".hida").append(title+",");
                                $(this).prop( "checked", true );
                                doldurma(title);
                            }
                        });
                    }
                    if(keyword != ""){
                        $("#search").val(keyword);
                        doldurma(keyword);
                        $("#radioDiv3 input[type='radio']").each(function(){
                            if($(this).val() == "tum"){
                                $(this).prop("checked",true);
                            }
                        });
                    }
                });
                
                function getIlanlar(page) {
                    var il_id=$('#il_id').val();
                    var basTar=$('#baslangic_tarihi').val();
                    var bitTar=$('#bitis_tarihi').val();
                    var selectedSektor = new Array();
                    var n = jQuery(".checkboxClass:checked").length;
                    if (n > 0){
                        jQuery(".checkboxClass:checked").each(function(){
                                selectedSektor.push($(this).val());
                                var html = '<span title="' + selectedSektor + '">' + selectedSektor + '</span>';
                            });
                    }
                    var selectedIl = new Array();
                    var n = jQuery('.mutliSelect input[type="checkbox"]').length;
                    if (n > 0){
                        jQuery('.mutliSelect input[type="checkbox"]:checked').each(function(){
                                selectedIl.push($(this).val());
                        });
                    }
                    var selectedOdeme = new Array();
                    var n = jQuery('.checkboxClass2:checked').length;
                    if (n > 0){
                        jQuery('.checkboxClass2:checked').each(function(){
                            selectedOdeme.push($(this).val());
                        });
                    }
                    var selectedTur = "";
                    var selected = $("#radioDiv input[type='radio']:checked");
                    if (selected.length > 0) {
                        selectedTur = selected.val();
                    }
                    var selectedUsul = "";
                    var selected2 = $("#radioDiv2 input[type='radio']:checked");
                    if (selected2.length > 0) {
                        selectedUsul = selected2.val();
                    }
                    var selectedSearch = "";
                    var inputSearch = "";
                    var selected3 = $("#radioDiv3 input[type='radio']:checked");
                    if (selected3.length > 0) {
                        selectedSearch = selected3.val();
                        inputSearch=$('#search').val();
                    }
                    var selectedSozlesme = "";
                    var selected4 = $("#radioDiv4 input[type='radio']:checked");
                    if (selected4.length > 0) {
                        selectedSozlesme = selected4.val();
                    }
                    $.ajax({
                        url : '?page='+page,
                        dataType: 'json',
                        data:{il:selectedIl,bas_tar:basTar,bit_tar:bitTar,sektor:selectedSektor,tur:selectedTur,
                                    usul:selectedUsul,radSearch:selectedSearch,input:inputSearch,odeme:selectedOdeme,
                                    sozles:selectedSozlesme
                        },
                    }).done(function(data){
                        $('.ilanlar').html(data);
                        location.hash = page;
                    }).fail(function(){ 
                        alert('İlanlar Yüklenemiyor !!!  ');
                    });
                }

            </script>
                  
        <hr>
    </div>
  
@endsection
