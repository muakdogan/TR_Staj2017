@extends('layouts.app')
<br>
 <br>
 @section('content')
   <script src="{{asset('js/noUiSlider/nouislider.js')}}"></script>
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
  background: #4478a0;
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
  color: #fff;
  font-weight: bold;
  text-align: center;
  border: 1px solid #5189B5;
  border-width: 0px 0px 1px 0px;
  margin-left: 0;
  margin-right: 0;
  margin-bottom: 4px;
  margin-top: 8px;
  padding: 8px 16px;
  background: #5C9CCE;
  box-shadow: 0px 1px 4px rgba(68, 120, 160, 0.1);
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
select[name=type]
{
appearance:none;
	border-radius: 0;
}
textarea,input[type=text],input[type=datetime-local],input[type=time],select
{
  color: #fff;
  border: 0;
  outline: 0;
  resize: none;
  margin: 0;
  margin-top: 1em;
  padding: .5em;
  width:100%;
  border-bottom: 1px dotted rgba(250, 250, 250, 0.4);
  background:#5d92ba;
}
input[type=text]:focus,input[type=datetime-local]:focus,input[type=time]:focus {
  background-color: #4478a0;
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
	color: #FAFEFF;
}
input:-ms-input-placeholder, textarea:-ms-input-placeholder {
  color: #FAFEFF;
}
input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
  	color:#FAFEFF;
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
                        <?php $ilanlarım = $firma->ilanlar()->orderBy('kapanma_tarihi','desc')->get();?>
                        <hr>
                        @foreach($ilanlarım as $ilan)
                            <p>{{$ilan->adi}}</p>
                            <p>{{$ilan->kapanma_tarihi}}</p>
                           
                            
                                <ul>
                                <li>
                                   <a><button style="float:right" type="button" class="btn btn-info add">Puan Ver/Yorum Yap</button></a>
                                  <div class="dialog" style="display:none">
                                  <div class="title">Puanla/Yorum Yap</div>
                                  <form action="addevent.php" method="post">
                                    <div class="row col-lg-12">
                                      <div class="col-lg-3">
                                        <input name="kriter1" type="text" placeholder="Ürün/hizmet kalitesi"/>
                                        <div id="puanlama">
                                            <div class="sliders" id="k1"></div>
                                            <div class="value" ></div>
                                        </div>
                                      </div>  
                                      <div class="col-lg-3">
                                        <input name="kriter2" type="text" placeholder="Teslimat"/>
                                        <div id="puanlama">
                                            <div class="sliders" id="k2"></div>
                                            <div class="value" ></div>
                                        </div>
                                      </div> 
                                      <div class="col-lg-3">
                                        <input name="kriter3" type="text" placeholder="Teknik ve Yönetsel Yeterlilik"/>
                                        <div id="puanlama">
                                            <div class="sliders" id="k3"></div>
                                            <div class="value" ></div>
                                        </div>
                                      </div>
                                      <div class="col-lg-3">
                                        <input name="kriter4" type="text" placeholder="İletişim ve Esneklik"/>
                                        <div id="puanlama">
                                            <div class="sliders" id="k4"></div>
                                            <div class="value" ></div>
                                        </div>
                                      </div> 
                                    </div>
                                    <textarea name="yorum" placeholder="Yorum" cols="30" rows="10" wrap="soft"></textarea>
                                    <input type="submit" value="Ok"/>
                                  </form>
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
        $('.add').click(function(e){
          e.stopPropagation();
         if ($(this).hasClass('active')){
           $('.dialog').fadeOut(200);
           $(this).removeClass('active');
         } else {
           $('.dialog').delay(300).fadeIn(200);
           $(this).addClass('active');
         }
       });


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
        var value = document.getElementsByClassName('value');
        for ( var i = 0; i < sliders.length; i++ ) {

                noUiSlider.create(sliders[i], {
                        start: 1,
                        step:1,
                        connect: [true, false],
                        range: {
                                'min':[1],
                                'max':[10]
                        }

                });
                var deneme;
                value[i].innerHTML = sliders[i].noUiSlider.get();
                sliders[i].noUiSlider.on('change', function( values, handle ){
                   
                    deneme = values[handle];
                  
                    value[i].innerHTML = "0";
                 });
              
                
        }
});



</script>
@endsection
