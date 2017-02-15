@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
    <head>
        <style>
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
            .puanlama {
                background: #dddddd;
                width: 140px;
                height:65px;
                border-radius: 3px;
                position: relative;
                margin: auto;
                margin-left:8px;
                text-align: center;
                color: white;
            }
            point { 
                display: block;
                font-size: 1.49em;
                margin-top: 0.1em;
                margin-bottom: 1em;
                margin-left: 0;
                margin-right: 0;
                font-weight: bold;
            }
        </style>
   </head>
   <body>
   <div class="container">
       <br>
       <br>
       <div class="col-lg-2">
           <div class="form-group">
               <br>
               <div class="row">
                   <div class="col-sm-4" ><img src="../../public/uploads/{{$firma->logo}}" alt="HTML5 Icon" style="width:128px;height:128px;"></div>
                  
               </div>
               
               <br>
            </div>
            
       </div>
        <div class="col-lg-10"> <h3><strong>{{$firma->adi}}</strong> firmasının profili</h3></div>
        <div class="panel panel-warning col-lg-8">
            <div class="panel-heading">Firmanın Puanları</div>
            <div class="panel-body" style="height:95px">
            <?php $puanlar = App\Puanlama::where('firma_id','=',$firma->id)
                        ->select(array(DB::raw("avg(kriter1)as ortalama1, avg(kriter2) as ortalama2,avg(kriter3) as ortalama3,avg(kriter4) as ortalama4")))
                        ->get();
            $puanlar = $puanlar->toArray();
            ?>    
                <div class="row">
                    <div class="puanlama col-sm-3">
                        <span>Ürün/hizmet kalitesi</span><point class="point">{{number_format($puanlar[0]['ortalama1'],1)}}</point>
                    </div>&nbsp;
                    <div class="puanlama col-sm-3">
                        <span><br>Teslimat<br></span><point class="point">{{number_format($puanlar[0]['ortalama2'],1)}}</point>
                    </div>&nbsp;
                    <div class="puanlama col-sm-3">
                        <span>Teknik ve yönetsel yeterlilik</span><point class="point">{{number_format($puanlar[0]['ortalama3'],1)}}</point>
                    </div>
                    <div class="puanlama col-sm-3">
                        <span>İletişim ve esneklik</span><point class="point">{{number_format($puanlar[0]['ortalama4'],1)}}</point>
                    </div>
                </div>
            </div>
        </div>

        <div id="exTab2" class="col-lg-12">	
            <ul class="nav nav-tabs">
                <li class="active"><a  href="#1" data-toggle="tab">XXX</a>
                </li>
                <li><a href="#2" data-toggle="tab">XXX</a>
                </li>
                <li><a href="#3" data-toggle="tab">Yorumlar</a>
                </li>
            </ul>
            <div class="tab-content ">
                <div class="tab-pane active" id="1">
                    <h3>Standard tab panel created on bootstrap using nav-tabs</h3>
                </div>
                <div class="tab-pane" id="2">
                    <h3>Notice the gap between the content and tab after applying a background color</h3>
                </div>
                <div class="tab-pane" id="3">
                     <?php $yorumlar = App\Yorum::where('firma_id','=',$firma->id)->orderBy('tarih','DESC')->get();?>
                    @foreach($yorumlar as $yorum)
                    <?php $yorumYapanFirma = App\Firma::find($yorum->yorum_yapan_firma_id); ?>
                    <hr>
                    <h4><strong>{{$yorumYapanFirma->adi}}</strong>'sının Yorumu</h4>
                    <h5>{{$yorum->yorum}}</h5>
                    @endforeach
                </div>
            </div>
          </div>

<hr></hr>

   </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  
</body>
</html>
<script>                  

    $(".puanlama").each(function(){
        
        var puan = $(this).children().next().text();
        if(puan > 0 && puan < 3){
            $(this).css("background", "#e65100");
        }
        else if (puan >= 3 && puan <= 5){
            $(this).css("background", "#e54100");
        }
        else if (puan > 5 && puan <= 6){
            $(this).css("background", "#f46f02");
        }
        else if (puan > 5 && puan <= 6){
            $(this).css("background", "#f46f02");
        }
        else if (puan > 6 && puan <= 7){
            $(this).css("background", "#ffba04");
        }
        else if (puan > 7 && puan <= 8){
            $(this).css("background", "#d6d036");
        }
        else if (puan > 8 && puan <= 9){
            $(this).css("background", "#a5c530");
        }
        else if (puan > 9 && puan <= 10){
            $(this).css("background", "#45c538");
        }
    });
</script>
@endsection


