@extends('layouts.app')
<br>
 <br>
 @section('content')
    <script src="{{asset('js/noUiSlider/nouislider.js')}}"></script>
    <script src="{{asset('js/wNumb.js')}}"></script>
    <link href="{{asset('css/noUiSlider/nouislider.css')}}" rel="stylesheet"></link>
 <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #fff;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #fff;
}
.div5{
    float:right;
}
.div6{
    float:left;
}
.button {
    background-color: #ccc; /* Green */
    border: none;
    color: white;
    padding: 6px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
}
.add
{
  transition: box-shadow .2s linear, margin .3s linear .5s;
}
.add.active
{
  margin:0 98px;
  transition: box-shadow .2s linear, margin .3s linear;
}
.button:link
{
  color: #eee;
  text-decoration: none;
}
.button:visited
{
  color: #eee;
}
.button:hover
{
  box-shadow:none;
}
.button:active,
.button.active {
  color: #eee;
  border-color: #C24032;
  box-shadow: 0px 0px 4px #C24032 inset;
}
nav ul li a:active {
  color: #eee;
}
nav ul li a.active {
  color: #eee;
}
.dialog {
  position: relative;
  text-align: center;
  background: #fff;
  border-radius: 8px;
  margin: 13px 0 4px 4px;
  display: inline-block;
  width: 600px;
  box-shadow: 0px 0px 8px rgba(68, 140, 160, 0.5);
}
.dialog:after,
.dialog:before {
  bottom: 100%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}
.dialog:after {
  border-color: rgba(255, 255, 255, 0);
  border-bottom-color: #5C9CCE;
  border-width: 15px;
  left: 50%;
  margin-left: -15px;
}
.dialog:before {
  border-color: rgba(170, 170, 170, 0);
  border-width: 16px;
  left: 50%;
  margin-left: -16px;
}
.dialog .title {
  font-weight: bold;
  text-align: center;
  border: 1px solid #eeeeee;
  border-radius: 8px;
  border-width: 0px 0px 1px 0px;
  margin-left: 0;
  margin-right: 0;
  margin-bottom: 4px;
  margin-top: 8px;
  padding: 8px 16px;
  background: #fff;
  font-size: 16px;
  line-height:2em;
}
.dialog .title:first-child {
  margin-top: -4px;
}
form
{
  padding:16px;
  padding-top: 0;
}
label1{
    display: inline-block;
    font-size: 12px;
}
textarea,input[type=text],input[type=datetime-local],input[type=time],select,label1
{
  color: #000;
  border-width: 0px 0px 1px 0px;
  border-radius: 8px;
  border:0px solid #ccc;
  outline: 0;
  resize: none;
  margin: 0;
  margin-top: 1em;
  padding: .5em;
  width:100%;
  border-bottom: 1px dotted rgba(250, 250, 250, 0.4);
  background:#fff;
  box-shadow:inset 0 2px 2px rgb(119, 119, 119);
}
input[type=text]:focus,input[type=datetime-local]:focus,input[type=time]:focus {
  background-color: #ddd;
}
input[type=submit]
{
  border:none;
  background: #FAFEFF;
  padding: .5em 1em;
  margin-top: 1em;
  color:#4478a0;
}
input[type=submit]:active
{
  background: #E1E5E5;
}
input:-moz-placeholder, textarea:-moz-placeholder {
	color: #555;
}
input:-ms-input-placeholder, textarea:-ms-input-placeholder {
  color: #555;
}
input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
  	color:#555;
}


</style>
     <div class="container">
           @include('layouts.alt_menu') 
           
            <div class="panel-group">
                         <?php $ilanlarFirma = $firma->ilanlar()->
                                orderBy('yayin_tarihi','desc')->limit('5')->get();
                               ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Aktif İlanlarım</div>
                    <div class="panel-body">
                        <?php $ilanlarım = $firma->ilanlar()->orderBy('kapanma_tarihi','desc')->get();?>
                        <hr>
                        @foreach($ilanlarım as $ilan)
                            <p>{{$ilan->adi}}</p>
                            <p>{{$ilan->kapanma_tarihi}}</p>
                            
                            
                            @if($ilan->yayinlanma_tarihi > time())
                              <a href="{{ URL::to('firmaIlanOlustur', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Düzenle</button></a>
                              
                             @else
                             
                              <a href="{{ URL::to('firmaIlanOlustur', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Gör</button></a>
                             
                            @endif
                            
                           

                            <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->id), false) }}"><button style="float:right" type="button" class="btn btn-info">Teklif Gör</button></a>
                             <br>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Sonuçlanmış İlanlarım</div>
                    <div class="panel-body">
                        <?php $ilanlarım = $firma->ilanlar()->orderBy('kapanma_tarihi','desc')->get();
                            $i=0;
                            $kullanici_id=Auth::user()->kullanici_id;
                            $firma_id = session()->get('firma_id');
                        ?>
                        <hr>
                        @foreach($ilanlarım as $ilan)
                            <p>{{$ilan->adi}}</p>
                            <p>{{$ilan->kapanma_tarihi}}</p>
                                <ul>
                                <li>
                                  <a><button style="float:right" type="button" class="btn btn-info add" id="{{$i}}">Puan Ver/Yorum Yap</button></a>
                                  <div class="dialog" id="dialog{{$i++}}" style="display:none">
                                    <div class="title">Puanla/Yorum Yap</div>
                                    {!! Form::open(array('url'=>'yorumPuan/'.$firma_id.'/'.$ilan->id.'/'.$kullanici_id,'method'=>'POST', 'files'=>true)) !!}
                                      <div class="row col-lg-12">
                                        <div class="col-lg-3">
                                            <label1 name="kriter1" type="text" >Ürün/hizmet kalitesi</label1>
                                          <div id="puanlama">
                                              <div class="sliders" id="k{{$i}}"></div>
                                              <input type="hidden" id="puan1" name="puan1" value="5"/>
                                          </div>
                                        </div>  
                                        <div class="col-lg-3" style="border-color:#ddd">
                                            <label1 name="kriter2" type="text"><br>Teslimat</label1>
                                          <div id="puanlama">
                                              <div class="sliders" id="k{{$i+1}}"></div>
                                              <input type="hidden" id="puan2" name="puan2" value="5"/>
                                          </div>
                                        </div> 
                                        <div class="col-lg-3">
                                            <label1 name="kriter3" type="text">Teknik ve Yönetsel Yeterlilik</label1>
                                          <div id="puanlama">
                                              <div class="sliders" id="k{{$i+2}}"></div>
                                              <input type="hidden" id="puan3" name="puan3" value="5"/>
                                          </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label1 name="kriter4" type="text" >İletişim ve Esneklik</label1>
                                          <div id="puanlama">
                                              <div class="sliders" id="k{{$i+3}}"></div>
                                              <input type="hidden" id="puan4" name="puan4" value="5"/>
                                          </div>
                                        </div> 
                                      </div>
                                        <?php $i=$i+3; ?>
                                      <textarea name="yorum" placeholder="Yorum" cols="30" rows="5" wrap="soft"></textarea>
                                      <input type="submit" value="Ok"/>
                                    {{ Form::close()}}
                                </div>
                                </li>
                               </ul>
                            <br>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
<script>
$(document).ready( function() {
    var changeNumber="";
    var length={{$i}};
    for(var key=0; key<{{$i}}; key++){
        $('#'+key).click(function(e){
            var j = $(this).attr('id');
          e.stopPropagation();
         if ($(this).hasClass('active')){
            $('#dialog'+j).fadeOut(200);
            $(this).removeClass('active');
         } else {
            $('#dialog'+j).delay(300).fadeIn(200);
            $(this).addClass('active');
         }
       });
    }   
    function closeMenu(){
      $('.dialog').fadeOut(200);
      $('.add').removeClass('active');  
    }
    $(document.body).click( function(e) {
         closeMenu();
    });

    $(".dialog").click( function(e) {
        e.stopPropagation();
    });
    var sliders = document.getElementsByClassName('sliders');
    var connect = document.getElementsByClassName('noUi-connect');
    var tooltip = document.getElementsByClassName('noUi-tooltip');
    console.log(tooltip);
    var value = document.getElementsByClassName('value');
    for ( var i = 0; i < sliders.length; i++ ) {
        noUiSlider.create(sliders[i], {
                start: 5,
                step:1,
                connect: [true, false],
                range: {
                        'min':[1],
                        'max':[10]
                },
                format: wNumb({
                    decimals:0
                }),
                tooltips:true

        });
        var deneme;
        sliders[i].noUiSlider.on('slide', function( values, handle ,e){
            var idCount=$(this.target.id).selector;
            idCount=idCount.substring(1);
            console.log($(this));
            deneme = values[handle];
            deneme = parseInt(deneme);
            if(idCount % 5 === 1){
                $("#puan1").val(deneme);
            }
            else if(idCount % 5 === 2){
                $("#puan2").val(deneme);
            }
            else if(idCount % 5 === 3){
                $("#puan3").val(deneme);
            }
            else if(idCount % 5 === 4){
                $("#puan4").val(deneme);
            }
            idCount = parseInt(idCount)-1;
            if(deneme <= 4){
                connect[idCount].style.backgroundColor = "#e65100";
                tooltip[idCount].style.backgroundColor = "#e65100";
                tooltip[idCount].style.border = "1px solid #e65100";
            }
            else if(deneme === 5){
                connect[idCount].style.backgroundColor = "#e54100";
                tooltip[idCount].style.backgroundColor = "#e54100";
                tooltip[idCount].style.backgroundColor = "#e54100";
            }
            else if(deneme === 6){
                connect[idCount].style.backgroundColor = "#f46f02";
                tooltip[idCount].style.backgroundColor = "#f46f02";
                tooltip[idCount].style.border = "1px solid #f46f02";
            }
            else if(deneme === 7){
                connect[idCount].style.backgroundColor = "#ffba04";
                tooltip[idCount].style.backgroundColor = "#ffba04";
                tooltip[idCount].style.border = "1px solid #ffba04";
            }
            else if(deneme === 8){
                connect[idCount].style.backgroundColor = "#d6d036";
                tooltip[idCount].style.backgroundColor = "#d6d036";
                tooltip[idCount].style.border = "1px solid #d6d036";
            }
            else if(deneme === 9){
                connect[idCount].style.backgroundColor = "#a5c530";
                tooltip[idCount].style.backgroundColor = "#a5c530";
                tooltip[idCount].style.border = "1px solid #a5c530";
            }
            else if(deneme === 10){
                connect[idCount].style.backgroundColor = "#45c538";
                tooltip[idCount].style.backgroundColor = "#45c538";
                tooltip[idCount].style.border = "1px solid #45c538";
            }
            
            
        });
    }
        
});




</script>
@endsection
