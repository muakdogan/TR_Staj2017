<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>İlan Bilgileri</strong></a>
            <button style="float:right" id="btn-add-ilanBilgileri" name="btn-add-ilanBilgileri" class="btn btn-primary btn-xs" onclick="populateDD()">Ekle / Düzenle</button>
        </h4>
    </div>
    <div id="collapse2" >
        <div class="panel-body">
            <table class="table" >
                <thead id="tasks-list" name="tasks-list">
                <tr id="firma{{$firma->id}}">
                <tr>
                    <td width="25%"><strong>Firma Adı</strong></td>
                    <td width="75%"><strong>:</strong> {{$ilan->getFirmaAdi()}}</td>
                </tr>
                <tr>
                    <td><strong>İlan Adı</strong></td>

                    <td><strong>:</strong> {{$ilan->adi}}</td>
                </tr>
                <tr>
                    <td><strong>İlan Sektor</strong></td>

                    <td><strong>:</strong>
                        @if ($ilan->sektorler != null)
                            {{$ilan->sektorler->adi}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><strong>İlan Yayınlama Tarihi</strong></td>
                    <td><strong>:</strong>@if($ilan->yayin_tarihi != null) {{date('d-m-Y', strtotime($ilan->yayin_tarihi))}} @endif</td>
                </tr>
                <tr>
                    <td><strong>İlan Kapanma </strong></td>
                    <td><strong>:</strong>@if($ilan->kapanma_tarihi != null) {{date('d-m-Y', strtotime($ilan->kapanma_tarihi))}} @endif</td>
                </tr>
                <tr>
                    <td><strong>İlan Açıklaması</strong></td>
                    <td><strong>:</strong> <?php echo $ilan->aciklama; ?></td>
                </tr>
                <tr>
                    <td><strong>İlan Türü</strong></td>
                    <td><strong>:</strong> {{$ilan->getIlanTuru()}}</td>
                </tr>
                <tr>
                    <td><strong>Katılımcılar</strong></td>
                    <td><strong>:</strong> {{$ilan->getKatilimciTur()}}</td>
                </tr>
                <tr>
                    <td><strong>İlan Usulü</strong></td>
                    <td><strong>:</strong> {{$ilan->getRekabet()}}</td>
                </tr>
                <tr>
                    <td><strong>Sözleşme Türü</strong></td>
                    <td><strong>:</strong> {{$ilan->getSozlesmeTuru()}}</td>
                </tr>
                <tr>
                    <td><strong>Fiyatlandırma Şekli</strong></td>
                    <td><strong>:</strong>
                        @if($ilan->kismi_fiyat != null)
                            {{$ilan->getFytSekli()}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="25%"><strong>Ödeme Türü</strong></td>
                    <td width="75%"><strong>:</strong>
                        @if ($ilan->odeme_turu_id != NULL)
                            {{$ilan->odeme_turleri->adi}}
                        @endif
                    </td>

                </tr>
                <tr>
                    <td><strong>Para Birimi</strong></td>

                    <td><strong>:</strong>
                        @if($ilan->para_birimi_id != NULL)
                            {{$ilan->para_birimleri->adi}}
                        @endif
                    </td>

                </tr>
                <tr>
                    <td><strong>Teknik Şartname</strong></td>
                    <td><strong>:</strong>  {{$ilan->teknik_sartname}}</td>
                </tr>
                <tr>
                    <td><strong>Yaklaşık Maliyet</strong></td>
                    <td><strong>:</strong>  {{$ilan->yaklasik_maliyet}}</td>
                </tr>

                <tr>
                    <td><strong>Teslim Yeri</strong></td>
                    <td><strong>:</strong>  {{$ilan->teslim_yeri_satici_firma}}</td>
                </tr>
                <tr>
                    <td><strong>İşin Süresi</strong></td>
                    <td><strong>:</strong> {{$ilan->isin_suresi}}</td>
                </tr>
                <tr>
                    <td><strong>İş Başlama Tarihi</strong></td>
                    <td><strong>:</strong>@if($ilan->is_baslama_tarihi != null) {{date('d-m-Y', strtotime($ilan->is_baslama_tarihi))}} @endif</td>
                </tr>
                <tr>
                    <td><strong>İş Bitiş Tarihi</strong></td>

                    <td><strong>:</strong>@if($ilan->is_bitis_tarihi != null) {{date('d-m-Y', strtotime($ilan->is_bitis_tarihi))}} @endif</td>
                </tr>
                </tr>
                </thead>
            </table>
            @include('Firma.ilanDuzenle.ilanDuzenleM')
        </div>
    </div>
</div>