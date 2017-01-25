<style>
.puanlama {
                
                background: #dddddd;
                width: 30px;
                border-radius: 4px;
                position: absolute;
                margin: auto;
                text-align: center;
                color: white;
            }
            a{
                padding: 35px;
            }
</style>
    <h3>İlanlar</h3> 
    <hr>
    <?php $count=$ilanlar->total();?>
    <input type="hidden" name="totalCount" value='{{$ilanlar->total()}}'>
    @foreach($ilanlar as $ilan)
    <?php $sektorAdi = App\Sektor::find($ilan->firma_sektor); ?>
    <div class="ilanDetayPop" name="{{$ilan->ilan_id}}">
        <div class="pop-up"  style="display: none;
                                        position: absolute;
                                        left: 200px;
                                        width: 280px;
                                        padding: 10px;
                                        background: #eeeeee;
                                        color: #000000;
                                        border: 1px solid #1a1a1a;
                                        font-size: 90%;
                                        z-index: 1000;">
                        <p id="popIlanAdi">İlan Adı : {{$ilan->adi}}</p>
                        <p id="popIlanTuru">İlan Türü: {{$ilan->ilan_turu}}</p>
                        <p id="popIlanUsulu">Usulü: {{$ilan->usulu}}</p>
                        <p id="popIlanSektoru">İlan Sektörü: {{$sektorAdi->adi}}</p>
                        <p id="popIlanAciklama">Açıklama: {{$ilan->aciklama}}</p>
                        <p id="popIlanIsinSuresi">İşin Süresi: {{$ilan->isin_suresi}}</p>
                        <p id="popIlanSözlesmeTuru">Sözleşme Türü: {{$ilan->sozlesme_turu}}</p>                                
        </div>
        <?php $puan = App\Puanlama::select( array(DB::raw("avg(kriter1+kriter2+kriter3+kriter4)/4 as ortalama")))
                        ->where('firma_id',$ilan->firmaid)
                        ->get();
               $puan = $puan->toArray();
              
            /*$i=0;
            $i=$i+1;
            $ortalama=0;
            foreach ($puanlar as $puan){
                //$i=$i+1;
                
                $ortalama += ($puan->kriter1+$puan->kriter2+$puan->kriter3+$puan->kriter4)/4;
                
            }
            $ortalama = $ortalama/$i;*/
        ?>
        <p><b>İlan Adı: {{$ilan->ilanadi}}</b></p>
        @if(number_format($puan[0]['ortalama'],1)> 0)
            <div class="puanlama">{{number_format($puan[0]['ortalama'],1)}}</div>
            <p><a href="{{url('firmaDetay/'.$ilan->firmaid)}}" >Firma: {{$ilan->adi}}</a></p>
        @else
            <p><a href="{{url('firmaDetay/'.$ilan->firmaid)}}" style="padding: 0px" >Firma: {{$ilan->adi}}</a></p>
        @endif
        
        <p>{{$ilan->iladi}}</p>
        <p>{{$ilan->yayin_tarihi}}</p>
        
        <?php
        if(Auth::guest()){
            
        }
        else{
            
              $kullanici_id = Auth::user()->kullanici_id;
              
              $firma=  App\FirmaKullanici::where( 'kullanici_id', '=', $kullanici_id )
                       ->select('firma_id')->get();
              $firma=$firma->toArray();
              
              $firma_id=$firma[0]['firma_id'];
              
              
              
                $rol_id  = App\FirmaKullanici::where( 'kullanici_id', '=', $kullanici_id)
                        ->where( 'firma_id', '=', $firma_id)
                        ->select('rol_id')->get();
                        $rol_id=$rol_id->toArray();
                                        
                                        
                $querys = App\Rol::join('firma_kullanicilar', 'firma_kullanicilar.rol_id', '=', 'roller.id')
                ->where( 'firma_kullanicilar.rol_id', '=', $rol_id[0]['rol_id'])
                ->select('roller.adi as rolAdi')->get();
                $querys=$querys->toArray();
                
                $rol=$querys[0]['rolAdi'];
                
                
                
                //Firmanın kendi ilanına basvurmasını engelleme.
                $ilan_firma_adi= App\Firma::join('ilanlar', 'firmalar.id', '=', 'ilanlar.firma_id')
                 ->select('firmalar.adi as firmaAdi')->get();
                $ilan_firma_adi=$ilan_firma_adi->toArray();
                
                $ilanFirmaAdi=$ilan_firma_adi[0]['firmaAdi'];
                $firma_adi = session()->get('firma_adi');  
         
        
        }
                
         ?>
             
        
       
                                @if(Auth::guest())


                                @else

                                    @if ( $rol === 'Yönetici')


                                      <a href="#"><button type="button" class="btn btn-primary" name="{{$ilan->ilan_id}}" id="{{$ilan->ilan_id}}" style='float:right'>Başvur</button></a><br><br>


                                    @elseif ($rol ==='Satış')

                                       <a href="#"><button type="button" class="btn btn-primary" name="{{$ilan->ilan_id}}" id="{{$ilan->ilan_id}}" style='float:right'>Başvur</button></a><br><br>

                                    @elseif ($rol ==='Satın Alma / Satış')

                                       <a href="#"><button type="button" class="btn btn-primary" name="{{$ilan->ilan_id}}" id="{{$ilan->ilan_id}}" style='float:right'>Başvur</button></a><br><br>

                                    @else

                                    @endif

                                @endif
            
        
        <hr>
    </div>
    @endforeach
    
{{$ilanlar->links()}}

<script>
    $('.ilanDetayPop').mouseenter(function(){
        $(this).children("div.pop-up").show();
    });
    $('.ilanDetayPop').mouseleave(function () {
        $('div.pop-up').hide();
    });
    
   var ilan_id;
   $(".btn-primary").click(function(){
       ilan_id=$(this).attr("name");
       funcIlanFirma();
       
    });
    
    function func(){          
           $.ajax({
            type:"GET",
            url:"basvuruControl",
            data:{ilan_id:ilan_id
            },
            cache: false,
            success: function(data){
                console.log(data);
                    if(data==0){ 
                        
                        window.location.href="ilanTeklifVer/"+ilan_id;    
                    }
                    else{

                        alert("Bu İlana Daha Önce Teklif Verdiniz.Teklif Veremezsiniz.Ancak Teklifi Düzenleye Bilirsiniz.");
                    }
            }
        });
    }
    
    function funcIlanFirma(){          
        $.ajax({
        type:"GET",
        url:"IlanFirmaControl",
        data:{ilan_id:ilan_id},
        cache: false,
        success: function(data){
            console.log(data);
                if(data==0){ 
                        
                    func();    
                }
                else{

                   alert("Kendi Firmanızın İlanına Başvuru Yapamazsınız!");
                }
            }
        });
    }
    
    $(".puanlama").each(function(){
        var puan = $(this).text();
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
    $('#ilanCount').children().html("Arama kriterlerinize uyan <img src='{{asset('images/sol.png')}}'> {{$count}} ilan");

</script>
