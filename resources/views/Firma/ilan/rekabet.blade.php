@if($ilan->sozlesme_turu == 0 && $ilan->kismi_fiyat == 0)
                            <div class="tab-pane demo" id="3">
                                <table class="table" id="table"> 
                                    <thead>

                                        <tr>
                                            <th  class="anim:update anim:number"  width="10%">Sıra</th>
                                            <th  class="anim:id" width="20%">Firma Adı</th>
                                            <th  class="anim:update anim:sort anim:number" width="20%">Verilen Fiyat({{$ilan->para_birimleri->adi}})</th>
                                            <th  width="50%"></th>
                                        </tr>
                                    </thead>
                                    <br>

                                    <tbody>
                                        @foreach($teklifler as $teklif)
                                            <?php $firmaAdi = App\Firma::find($teklif->firma_id);?>
                                            <?php $j++; 
                                            ?>
                                            <tr>
                                                <?php $verilenFiyat = $teklif->teklif_hareketler()->orderBy('id','desc')->limit(1)->get();?>

                                                @if(count($verilenFiyat) != 0)
                                                    @if(session()->get('firma_id') == $firmaAdi->id)
                                                        <td class="highlight">{{$j}}</td>
                                                        <td class="highlight" style="text-align: right"><strong>{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,',','.')}}</strong> &#8378;</td>
                                                        <td class="highlight">{{$firmaAdi->adi}}:</td>
                                                        <td class="highlight"><span class="up">&uarr;</span> <span class="down">&darr;</span></td>
                                                    <?php $sessionF= session()->get('firma_id'); $sahibF=$ilan->firmalar->id; ?>
                                                    @elseif(session()->get('firma_id') == $ilan->firmalar->id)
                                                        <?php $ilanSahibi= 1;?>
                                                        <td>{{$j}}</td>
                                                        <td  style="text-align: right"><strong>{{$verilenFiyat[0]['kdv_dahil_fiyat']}}</strong></td>
                                                        <td>{{$firmaAdi->adi}}:</td>
                                                        @if($ilan->kapanma_tarihi > $dt)
                                                            <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                                        @else
                                                            <td><button name="kazanan" style="float:right" type="button" class="btn btn-info">Kazanan</button></td>
                                                        @endif
                                                    @else
                                                        <?php $i++; ?>
                                                        <td>{{$j}}</td>
                                                        <td style="text-align: right"><strong>{{$verilenFiyat[0]['kdv_dahil_fiyat']}}</strong></td>
                                                        <td>X Firması :</td>
                                                        <td></td>
                                                    @endif
                                                @endif    
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @elseif($ilan->sozlesme_turu == 0 && $ilan->kismi_fiyat == 1)
                            <div class="tab-pane demo" id="3">
                                <table class="table" id="table"> 
                                    <thead>

                                        <tr>
                                            <th  class="anim:update anim:number"  width="10%">Sıra</th>
                                            <th  class="anim:update anim:sort anim:number" width="20%">Verilen Fiyat({{$ilan->para_birimleri->adi}})</th>
                                            <th  class="anim:id" width="20%">Firma Adı</th>
                                            <th  class="anim:constant" width="50%"></th>
                                        </tr>
                                    </thead>
                                    <br>

                                    <tbody>
                                        @foreach($teklifler as $teklif)
                                            <?php $firmaAdi = App\Firma::find($teklif->firma_id);?>
                                            <?php 
                                            ?>
                                            <tr>
                                                <?php $ilanMalCount = $ilan->ilan_mallar()->count();
                                                      $teklifMalCount = $teklif->mal_teklifler()->groupBy('ilan_mal_id')->count();
                                                ?>
                                                @if($ilanMalCount == $teklifMalCount)
                                                    <?php $verilenFiyat = $teklif->teklif_hareketler()->orderBy('id','desc')->limit(1)->get();
                                                        $j++; 
                                                    ?>
                                                    @if(count($verilenFiyat) != 0)
                                                        @if(session()->get('firma_id') == $firmaAdi->id)
                                                            <td class="highlight">{{$j}}</td>
                                                            <td class="highlight" style="text-align: right"><strong>{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}</strong></td>
                                                            <td class="highlight">{{$firmaAdi->adi}}:</td>
                                                            <td class="highlight"><span class="up">&uarr;</span> <span class="down">&darr;</span></td>
                                                        <?php $sessionF= session()->get('firma_id'); $sahibF=$ilan->firmalar->id; ?>
                                                        @elseif(session()->get('firma_id') == $ilan->firmalar->id)
                                                            <?php $ilanSahibi= 1;?>
                                                            <td>{{$j}}</td>
                                                            <td  style="text-align: right"><strong>{{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}</strong></td>
                                                            <td>{{$firmaAdi->adi}}:</td>
                                                            @if($ilan->kapanma_tarihi > $dt)
                                                                <td><button name="kazanan" style="float:right" type="button" class="btn btn-info disabled" >Kazanan</button></td>
                                                            @else
                                                                <td><button name="kazanan" style="float:right" type="button" class="btn btn-info">Kazanan</button></td>
                                                            @endif
                                                        @else
                                                            <?php $i++; ?>
                                                            <td>{{$j}}</td>
                                                            <td style="text-align: right"><strong> {{number_format($verilenFiyat[0]['kdv_dahil_fiyat'],2,'.','')}}</strong> &#8378;</td>
                                                            <td>X Firması :</td>
                                                            <td><span class="up">&uarr;</span> <span class="down">&darr;</span></td>
                                                        @endif
                                                    @endif
                                                @endif   
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <?php $minFiyat = DB::select(DB::raw("SELECT SUM(ozge) as deneme
                                                FROM (SELECT MIN(i.miktar*m.kdv_haric_fiyat*(1+m.kdv_orani/100)) as ozge
                                                FROM teklifler t, mal_teklifler m, ilan_mallar i
                                                WHERE i.id = m.ilan_mal_id and t.id = m.teklif_id and t.ilan_id=11
                                                GROUP BY (m.ilan_mal_id)) yahu"));
                                            ?>
                                            <td class="minFiyat">{{$j=$j+1}}</td>
                                            <td class="minFiyat" style="text-align: right"><strong><?php foreach ($minFiyat as $fyt) { echo number_format($fyt->deneme, 2, '.', ''); } ?></strong></td>
                                            <td class="minFiyat">Minumum Fiyat:</td>
                                            <td class="minFiyat"><span class="up">&uarr;</span> <span class="down">&darr;</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif