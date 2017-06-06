@extends('layouts.app')
<br>
<br>
 @section('content')
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
</style>
     <div class="container">
          <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        @include('layouts.alt_menu') 
             <div class="row">
                 <div class="col-xs-12 col-sm-6 col-md-8">
                     <div class="panel-group">
                        @if(count($davetEdilIlanlar) != 0) 
                            <div class="panel panel-default">
                                <div class="panel-heading">Davet Edildiğim İlanlar</div>
                                <div class="panel-body">
                                    <table>
                                        <tr>
                                            <th>İlan İsmi</th>
                                            <th>Başvuru Sayısı</th>
                                            <th></th>
                                        </tr>
                                       @foreach($davetEdilIlanlar as $dvtIlan)
                                         <tr>
                                             <td>{{$dvtIlan->ilanlar->adi}}</td>
                                             <td>{{$dvtIlan->ilanlar->teklifler()->count()}}</td>
                                             <td><a href="{{ URL::to('teklifGor', array($firma->id,$dvtIlan->id), false) }}"><button type="button" class="btn btn-primary" name="{{$dvtIlan->ilan_id}}" id="{{$dvtIlan->ilan_id}}" style='float:right'>Başvur</button></a><br><br></td>
                                         </tr>
                                       @endforeach
                                    </table>
                                </div>
                            </div>
                        @endif
                        
                         <div class="panel panel-default">
                             <div class="panel-heading">Son İlanlarım</div>
                             <div class="panel-body">
                                 <table>
                                     <tr>
                                         <th>İlan İsmi</th>
                                         <th>Başvuru Sayısı</th>
                                         <th></th>
                                     </tr>
                                    @foreach($ilanlarFirma as $ilan)
                                     <tr>
                                         <td>{{$ilan->adi}}</td>
                                         <td>{{$ilan->teklifler()->count()}}</td>
                                         @if($ilan->yayinlanma_tarihi > time())
                                                <td><a href="{{ URL::to('firmaIlanOlustur', array($firma->id,$ilan->id), false) }}"><button class="button"> Düzenle</button></a></td>
                                         @endif
                                     </tr>
                                    @endforeach
                                 </table>

                             </div>
                         </div>

                         <div class="panel panel-default">
                             <div class="panel-heading">Son Başvurularım</div>
                             <div class="panel-body">
                                 
                                 <table>
                                     <tr>
                                         <th>Başvuru İlan İsmi</th>
                                         <th>Başvuru Sayısı</th>
                                         <th></th>
                                     </tr>
                                    @foreach($teklifler as $teklif)
                                     <tr>
                                         <td>{{$teklif->ilanlar->adi}}</td>
                                         <td>{{$teklif->getIlanTeklifSayisi()}}</td>
                                         <td><button class="button">Düzenle</button></td>
                                     </tr>
                                    @endforeach 
                                 </table>

                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="col-xs-6 col-md-4">
                     <div class="panel-group">

                         <div class="panel panel-default">
                             <div class="panel-heading"><img src="{{asset('images/istatistik.png')}}">&nbsp;İstatistik</div>
                             <div class="panel-body">
                                 <div>
                                     Toplam İlan Sayım: {{$firma->ilanlar()->count()}}
                                 </div>
                                 <div>
                                     Toplam Başvuru Sayım: {{$tekliflerCount}}
                                 </div>
                             </div>
                         </div>
                         <div class="panel panel-default">
                                 <div  style="background-color: #e5e5e5;" class="panel-heading"><img src="{{asset('images/doluluk.png')}}">&nbsp;Firma Profili Doluluk Oranı</div>
                                <div class="panel-body">
                                    <div class="bar_container">
                                        <div id="main_container">
                                            <div id="pbar" class="progress-pie-chart" data-percent="0">
                                                <div class="ppc-progress">
                                                    <div class="ppc-progress-fill"></div>
                                                </div>
                                                <div class="ppc-percents">
                                                    <div class="pcc-percents-wrapper">
                                                        <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <progress style="display: none" id="progress_bar" value="0" max="1" >
                                            </progress>
                                        </div>
                                    </div>
                                </div>
                         </div>
                     </div>
                 </div>
             </div>   
    </div>
<script>
 $(document ).ready(function() {
        /* Pie Chart */
        var progressbar = $('#progress_bar');
        max = {{$firma->doluluk_orani}};
        if(max > 1 && max <= 15)
        {
            $('.ppc-progress-fill').css("background","#e54100");
            $('.ppc-percents span').css("color","#e54100");
            
        }
        if(max > 15 && max <= 30)
        {
            $('.ppc-progress-fill').css("background","#f46f02");
            $('.ppc-percents span').css("color","#f46f02");
            
        }
        if(max > 30 && max <=45 )
        {
            $('.ppc-progress-fill').css("background","#ffba04");
            $('.ppc-percents span').css("color","#ffba04");
            
        }
        if(max > 45 && max <=60 )
        {
            $('.ppc-progress-fill').css("background","#d6d036");
            $('.ppc-percents span').css("color","#d6d036");
            
        }
        if(max > 60 && max <=75 )
        {
            $('.ppc-progress-fill').css("background","#a5c530");
            $('.ppc-percents span').css("color","#a5c530");
            
        }
        if(max > 75 && max <=100)
        {
            $('.ppc-progress-fill').css("background","#45c538");
            $('.ppc-percents span').css("color","#45c538");
            
        }
        time = (1000 / max) * 0.5;
        value = progressbar.val();

        var loading = function() {
        value += 1;
        addValue = progressbar.val(value);

        $('.progress-value').html(value + '%');
        var $ppc = $('.progress-pie-chart'),
        deg = 360 * value / 100;
        if (value > 50) {
        //$ppc.addClass('gt-50');
        }

        $('.ppc-progress-fill').css('transform', 'rotate(' + deg + 'deg)');
        $('.ppc-percents span').html(value + '%');

        if (value == max) {
            clearInterval(animate);
        }
        };

        var animate = setInterval(function() {
        loading();
        }, time);

    });
</script>
@endsection
