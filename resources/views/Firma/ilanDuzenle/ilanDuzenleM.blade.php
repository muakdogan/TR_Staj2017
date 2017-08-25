<?php $i=0; ?>
<!--kalem agacı -->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js" xmlns="http://www.w3.org/1999/html"></script>
<script src="//cdn.jsdelivr.net/jquery.ui-contextmenu/1/jquery.ui-contextmenu.min.js"></script>
<link href="{{asset('css/skin-bootstrap/ui.fancytree.css')}}" rel="stylesheet" class="skinswitcher">
<script src="{{asset('js/jquery.fancytree.js')}}"></script>
<script src="{{asset('js/jquery.fancytree.glyph.js')}}"></script>
<script src="{{asset('js/jquery.fancytree.dnd.js')}}"></script>
<script src="{{asset('js/jquery.fancytree.edit.js')}}"></script>
<script src="{{asset('js/jquery.fancytree.filter.js')}}"></script>
<script src="{{asset('js/jquery.fancytree.table.js')}}"></script>

<script src="{{asset('js/jquery.multi-select.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('js/jquery.quicksearch.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('js/additional-methods.js')}}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/aciklama-tooltip.css')}}" />

<div class="container">
    <div style="overflow-y: scroll" class="modal fade" id="myModal-ilanBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="ajax-loader">
            <img src="{{asset('images/200w.gif')}}" class="img-responsive" />
        </div>
        <div style="width:1050px" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>İlan Bilgileri</strong></h4><br>
                    <ul id="progressbar">
                        <li class="active"><strong>İLAN BİLGİLERİ</strong></li>
                        <li><strong>KALEM BİLGİLERİ</strong></li>
                    </ul>
                </div>

                <div class="modal-body">
                    {!! Form::open(array('id'=>'msform','url'=>asset("ilanDuzenle").'/'.$firma->id.'/'.$ilan->id, 'files'=>true)) !!}
                    <fieldset  id="ilan" >
                        <input type="hidden" name="ilanID" value="{{$ilan->id}}"/>
                        <h2 style=" text-align: center;margin-top:0px;margin-bottom:10px" class="fs-title"><strong>İLAN BİLGİLERİ DÜZENLE</strong></h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">Firma Adı Göster</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <input type="radio" name="firma_adi_goster" class="filled-in firma_goster  required" id="firma_adi_goster"   value="1"  data-validation-error-msg="Lütfen birini seçiniz!" ><label> Göster</label> </input>
                                        <input type="radio" id="firma_adi_gizle" data-placement="bottom" class="filled-in test firma_goster"  name="firma_adi_goster" value="0" data-validation-error-msg="Lütfen birini seçiniz!"><label>Gizle</label> </input>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">İlan Adı*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control required" id="ilan_adi" name="ilan_adi" placeholder="İlan Adı" value="" >
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Satın almak istediğiniz mal veya hizmet için kısa ancak açıklayıcı bir ilan adı belirleyiniz.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">İlan Türü*</label>
                                    <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px" class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required"  name="ilan_turu" id="ilan_turu" disabled>
                                            <option selected disabled value="Seçiniz">Seçiniz</option>
                                            <option value="1">Mal</option>
                                            <option value="2">Hizmet</option>
                                            <option value="3">Yapım İşi</option>
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">İlan düzenlemede bu özellik değiştirilemez.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">İlan Sektör*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="firma_sektor_label" disabled />
                                        <input type="hidden" name="firma_sektor" id="firma_sektor" />
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">İlan düzenlemede bu özellik değiştirilemez.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">İlanın Tarih Aralığı*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <input type="text" name="ilan_tarihi_araligi"  id="ilan_tarihi_araligi"  readonly value="" class="form-control  filled-in" data-placement="bottom" />
                                        <!--input class="form-control date" id="yayinlanma_tarihi"  readonly   name="yayinlanma_tarihi" value="" placeholder="Yayinlanma Tarihi" type="text" /-->
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">İlanın ne kadar süre yayında kalmasını istiyorsanız o tarih aralığını seçiniz.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">İşin Süresi*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required" name="isin_suresi" id="isin_suresi">
                                            <option selected disabled value="Seçiniz">Seçiniz</option>
                                            <option value="Tek Seferde">Tek Seferde</option>
                                            <option value="Zamana Yayılarak">Zamana Yayılarak</option>
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Satın almak istediğiniz mal veya hizmet tek seferde gerçekleşecek ise Tek Seferde seçeneğini yoksa belirli bir zamanı kapsayacak şekilde tekrarlayarak belirli bir dönemde gerçekleşecek ise Zamana Yayılarak seçeneğini işaretleyiniz.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">İş Tarih Aralığı*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <input type="text" name="is_tarihi_araligi"  id="is_tarihi_araligi"  readonly value="" class="form-control filled-in" data-placement="bottom"/>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Satın almak istediğiniz mal veya hizmete ilişkin iş hangi tarihler arasında gerçekleşecekse o tarih aralığını seçiniz</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">Teknik Şartname</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div id="sartname" class="col-md-7" style="background-color: #fcf8e3; margin-top: 2px;margin-bottom:2px;padding: 2px">
                                        @if($ilan->teknik_sartname)
                                            <div id="eskiSartname" class="col-md-9"><strong>Dosya:</strong> <img width="20" height="20" src="{{asset("images/file/".$sartnameUzanti.".png")}}" /><a style="text-decoration: none;" href="{{asset("Teknik/".$ilan->teknik_sartname)}}" target="_blank"><span style="color: #27ae60;">Şartname</span></a></div>
                                            <div id="eskiSartnameButton" class="col-md-3"><a id="eskiSartnameSil" href="#"><span style="float: right; color: red">Sil</span></a> <a style="display: none;" id="eskiSartnameVazgec" href="#"><span style="float: right; color: red">Vazgec</span></a></div>
                                        @else
                                            <div id="eskiSartnameButton" class="col-md-12"><a style="display: none;" id="eskiSartnameVazgec" href="#"><span style="float: right; color: red">Vazgec</span></a></div>
                                        @endif
                                        <div id="yeniSartname" class="row">
                                            <div class="control-group col-md-12">
                                                <div class="controls">
                                                    {!! Form::file('teknik',array(
                                                    'accept'=>'application/msword, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                                    'id'=>'sartnameGozat'))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div id="success">
                                        </div>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Satın alım ilanınıza ilişkin bir teknik şartname dokümanınız var ise lütfen bu dokümanı yükleyiniz.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">Katılımcılar*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required" name="katilimcilar" id="katilimcilar" data-validation="required"
                                                data-validation-error-msg="Lütfen bu alanı doldurunuz!">
                                            <option selected disabled value="Seçiniz">Seçiniz</option>
                                            <option value="1">Onaylı Tedarikçiler</option>
                                            <option value="2">Belirli Firmalar</option>
                                            <option value="3">Tüm Firmalar</option>
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Satın alım ilanınıza katılmasını istediğiniz firmaları veya grupları seçiniz.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row"  id="onayli_tedarikciler">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div style="padding-right:3px;padding-left:1px"  class="col-md-9">
                                                <select id='custom-headers' multiple='multiple' name="onayli_tedarikciler[]" id="onayli_tedarikciler[]" data-rule-multiselectOnay="true">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group"  id="belirli-istekliler">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div style="padding-right:3px;padding-left:1px"  class="col-md-9">
                                                <select id='belirliIstek' multiple='multiple' name="belirli_istekli[]" id="belirli_istekli[]" data-rule-multiselectOnay="true">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">Rekabet Şekli*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required" name="rekabet_sekli" id="rekabet_sekli">
                                            <option selected disabled value="Seçiniz">Seçiniz</option>
                                            <option value="1">Tamrekabet</option>
                                            <option value="2">Sadece Başvuru</option>
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Satın alım ilanınıza fiyat verecek firmaların aktif şekilde rekabet etmelerini ve birbirlerinin firmalarını görmeden sadece fiyatlarını görerek fiyat eksiltmelerini istiyorsanız Tamrekabet seçeneğini, katılacak firmalardan rekabet etmeksizin sistem üzerinden kapalı zaf usulü fiyat teklifi toplamak istiyorsanız Sadece Başvuru seçeneğini işaretleyiniz.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">Sözleşme Türü*</label>
                                    <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required" name="sozlesme_turu" id="sozlesme_turu">
                                            <option selected disabled value="Seçiniz">Seçiniz</option>
                                            <option value="0">Birim Fiyatlı</option>
                                            <option value="1">Götürü Bedel</option>
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Satın alımı gerçekleştireceğiniz firmadan istediğiniz teklifte kalemleri fiyatlandırmadan işin tamamına dair bir teklif istiyorsanız Götürü Bedel seçeneğini, satın almak istediğiniz işe dair kalemlerin ayrı ayrı fiyatlandırılmasını istiyorsanız Birim Fiyatlı şeneğini işaretleyiniz.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row fiyatlandirma">
                                    <div class="col-md-12">

                                    <label for="inputEmail3"   style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">FiyatlandırmaŞekli*</label>
                                    <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control  required" name="kismi_fiyat" id="kismi_fiyat" >
                                            <option selected disabled value="Seçiniz">Seçiniz</option>
                                            <option   value="1">Kısmi Fiyat Teklifine Açık</option>
                                            <option  value="0">Kısmi Fiyat Teklifine Kapalı</option>
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Satın alım ilanına ilişkin mal veya hizmetlerinize teklif verecek firmaların alımını gerçekleştireceğiniz kalemlerin tümüne fiyat vermesini istiyorsanız Birim Fiyat Teklifine Kapalı seçeneğini, eğer kalemlerin belli bir kısmına da firmaların teklif verebilmesini istiyorsanız Birim Fiyat Teklifine Açık seçeneğini işaretleyiniz.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">Yaklaşık Maliyet*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required" name="yaklasik_maliyet" id="yaklasik_maliyet" >
                                            <option selected disabled>Seçiniz</option>
                                            @foreach($maliyetler as $maliyet)
                                                <option name="{{$maliyet->aralik}}" value="{{$maliyet->miktar}}" >{{$maliyet->aralik}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="maliyet" name="maliyet" value=""></input>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Alım ilanınıza ilişkin, satın alacağınız mal veya hizmetlerin yaklaşık toplam maliyet aralığını işaretleyiniz.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" class="col-md-3 control-label">Ödeme Türü*</label>
                                    <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required" name="odeme_turu" id="odeme_turu" >
                                            <option selected disabled>Seçiniz</option>
                                            @foreach($odeme_turleri as $odeme_turu)
                                                <option  value="{{$odeme_turu->id}}" >{{$odeme_turu->adi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" class="col-md-3 control-label">Para Birimi*</label>
                                    <label for="inputTask" style="text-align:right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required" name="para_birimi" id="para_birimi" >
                                            <option selected disabled>Seçiniz</option>
                                            @foreach($para_birimleri as $para_birimi)
                                                <option  value="{{$para_birimi->id}}" >{{$para_birimi->adi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">Teslim Yeri*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required" name="teslim_yeri" id="teslim_yeri" >
                                            <option selected disabled value="Seçiniz">Seçiniz</option>
                                            <option   value="Satıcı Firma">Satıcı Firma</option>
                                            <option  value="Adrese Teslim">Adrese Teslim</option>
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                            <img src="{{asset("images/soru-isareti.ico")}}" />
                                            <span class="tooltiptext">Alacağınız ürün ve hizmetler iş yapacağınız yere gelsin istiyorsanız Adrese Teslim seçeneğini, tedarikçinizin bulunduğu yerden almak istiyorsanız Satıcı Firma seçeneğini işaretleyiniz.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row error teslim_il">
                                    <div class="col-md-12">

                                    <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">Teslim Ad. İli*</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                    <div class="col-md-7">
                                        <select class="form-control required" name="il_id" id="il_id" >
                                            <option selected disabled>Seçiniz</option>
                                            @foreach($iller as $il)
                                                <option  value="{{$il->id}}" >{{$il->adi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row error teslim_ilce">
                                    <div class="col-md-12">

                                        <label for="inputTask" style="padding-right:3px;padding-left:12px" class="col-md-3 control-label">Teslim Ad. İlçesi*</label>
                                        <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px"class="col-md-1 control-label">:</label>
                                        <div class="col-md-7">
                                            <select class="form-control required" name="ilce_id" id="ilce_id" >
                                                <option selected disabled value="Seçiniz">Seçiniz</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 aciklama-tooltip">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail3" style="padding-right:3px;padding-left:12px" class="col-md-1 control-label">Açıklama</label>
                                    <label for="inputTask" style="text-align: right;padding-right:3px;padding-left:3px" class=" col-md-1 control-label">:</label>
                                    <div class="col-md-10" >
                                        <textarea id="aciklama" name="aciklama" rows="5"  class="form-control ckeditor" placeholder="Lütfen Açıklamayı buraya yazınız.." ></textarea>
                                    </div>
                                </div>
                        </div>
                        <input  style="float:right"  type="button" name="next" class="next action-button" value="İleri" />
                    </fieldset>
                    <fieldset id="kalem">
                        <h2 style=" text-align:center;margin-top:0px;margin-bottom:10px" class="fs-title"><strong>KALEM BİLGİLERİ DÜZENLE</strong></h2>

                        @if($ilan->ilan_turu==1)
                            @include('Firma.ilanDuzenle.KalemMal')
                        @elseif($ilan->ilan_turu==2)
                            @include('Firma.ilanDuzenle.KalemHizmet')
                        @else
                            @include('Firma.ilanDuzenle.KalemYapim')
                        @endif

                        @include('Firma.ilanDuzenle.KalemGoturu')

                        {!! Form::button('Gönder', array('id'=>'onayButton','style'=>'width:140px;float:right;font-size: 14px','class'=>'action-button')) !!}
                        <input style="float:right" type="button" name="previous" class="previous action-button" value="Geri" />
                        <input style="float:left" type="button" class="action-button" id="kalem_ekle" value="Kalem Ekle" />
                    </fieldset>
                    {!! Form::close() !!}
                </div>

                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!--kalemler tree modalı -->
    @include('Firma.ilan.kalemAgaci')
</div>

<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

<script charset="utf-8">
    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    // updated ve deleted arrayleri include edilen kalem sayfalarinda push edilir!
    var updated_array = []; var deleted_array = [];

    var sektor = {{$ilan->ilan_sektor}};
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";

    $( ".box" ).click(function() {
        $('#cke_1_contents').each(function(){
            $('#cke_1_contents').css('height', '100px');
        });
    });

    var sartnameSilindiMi="0";

    $(document).ready(function(){
        $('#onayli_tedarikciler').hide();
        $('#belirli-istekliler').hide();
        $('#il_id').on('change', function (e) {
            var il_id = e.target.value;
            GetIlce(il_id);
        });

        $(".next").click(function(){
            if(ilan_turu=="1" && sozlesme_turu=="0") {
                $('#mal').show();
                $('#hizmet').hide();
                $('#goturu').hide();
                $('#yapim').hide();
            }
            else if(ilan_turu=="2" && sozlesme_turu=="0") {
                $('#hizmet').show();
                $('#mal').hide();
                $('#goturu').hide();
                $('#yapim').hide();
            }
            else if(sozlesme_turu=="1") {
                $('#goturu').show();
                $('#hizmet').hide();
                $('#mal').hide();
                $('#yapim').hide();
                $('.fiyatlandirma').hide();
            }
            else if(ilan_turu=="3") {
                $('#yapim').show();
                $('#hizmet').hide();
                $('#goturu').hide();
                $('#mal').hide();
            }
            else if(sozlesme_turu=="0") {
                $('.fiyatlandirma').show();
            }
            if (form.valid() === true){
                if ($('#ilan').is(":visible")){
                    current_fs = $('#ilan');
                    next_fs = $('#kalem');
                }else if($('#kalem').is(":visible")){
                    current_fs = $('#kalem');
                    next_fs = $('#onay');
                }
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                next_fs.show();
                current_fs.hide();
            }


        });


        var form = $("#msform");
        form.validate({
           errorElement: 'span',
            errorClass: 'help-block',
            highlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').addClass("has-error");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').removeClass("has-error");
            },
        });

        $('.previous').click(function(){
            if($('#kalem').is(":visible")){
                current_fs = $('#kalem');
                next_fs = $('#ilan');
            }else if ($('#onay').is(":visible")){
                current_fs = $('#onay');
                next_fs = $('#kalem');
            }
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            next_fs.show();
            current_fs.hide();
        });

        jQuery.validator.methods["date"] = function (value, element) { return true; } ;

        jQuery.validator.addMethod("multiselectOnay", function(value, element) {
            return $($('#'+$(element).attr('id')+' :selected')).length>0;
        }, 'En az bir tane firma seçmelisiniz!!');

        //FORM SUBMIT
        //Ilan guncelle buton
        $("#onayButton").click(function(e){
            if (form.valid() === true){
            for ( instance in CKEDITOR.instances )
                CKEDITOR.instances[instance].updateElement();
            var postData = new FormData($("#msform")[0]);
            /*alert(formData);
            var postData = $("#msform").serialize();*/
            //postData= postData+ '&' + $.param({ 'updatedArray': JSON.stringify(updated_array),'deletedArray': JSON.stringify(deleted_array), 'sartnameSilindiMi': sartnameSilindiMi});

            postData.append('updatedArray',JSON.stringify(updated_array));
            postData.append('deletedArray',JSON.stringify(deleted_array));
            postData.append('sartnameSilindiMi',sartnameSilindiMi);

            var formURL = $("#msform").attr('action');
            $.ajax(
                {
                    beforeSend: function(){
                        $('.ajax-loader').css("visibility", "visible");
                    },
                    url : formURL,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data : postData,
                    success:function(data, textStatus, jqXHR)
                    {

                        setTimeout(function(){
                            window.location = "{{asset('teklifGor')}}/{{$firma->id}}/{{$ilan->id}}";
                        }, 5);
                        e.preventDefault();
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        alert(textStatus + "," + errorThrown);
                        $('.ajax-loader').css("visibility", "hidden");
                    }
                });
            e.preventDefault(); //STOP default action
        }
        });
    });

    $("#eskiSartnameSil").click(function(){
        sartnameSilindiMi="1";
        $(this).hide();
        $("#eskiSartnameVazgec").show();
        $("#eskiSartname").html('<strong>Dosya:</strong> <img width="20" height="20" src="{{asset("images/file/".$sartnameUzanti.".png")}}" /><a style="text-decoration: none;" href="{{asset("Teknik/".$ilan->teknik_sartname)}}" target="_blank"><span style="color: red; text-decoration: line-through;">Şartname</span></a>');
    });

    $("#eskiSartnameVazgec").click(function(){
        sartnameSilindiMi="0";
        $(this).hide();
        $("#eskiSartnameSil").show();
        $("#eskiSartname").html('<strong>Dosya:</strong> <img width="20" height="20" src="{{asset("images/file/".$sartnameUzanti.".png")}}" /><a style="text-decoration: none;" href="{{asset("Teknik/".$ilan->teknik_sartname)}}" target="_blank"><span style="color: #27ae60;">Şartname</a>');
        $("#sartnameGozat").val('');
    });

    $("#sartnameGozat").change(function (){
        sartnameSilindiMi="1";
        $("#eskiSartnameSil").hide();
        $("#eskiSartnameVazgec").show();
        $("#eskiSartname").html('<strong>Dosya:</strong> <img width="20" height="20" src="{{asset("images/file/".$sartnameUzanti.".png")}}" /><a style="text-decoration: none;" href="{{asset("Teknik/".$ilan->teknik_sartname)}}" target="_blank"><span style="color: red; text-decoration: line-through;">Şartname</span></a>');
    });

    var ilan_turu = "{{$ilan->ilan_turu}}";
    var sozlesme_turu = "{{$ilan->sozlesme_turu}}";

    $('#sozlesme_turu').on('change', function (e) {
        sozlesme_turu = e.target.value;
        if(sozlesme_turu=="1"){
            $("#kismi_fiyat").val('');
            $('.fiyatlandirma').hide();
        }
        else if(sozlesme_turu=="0"){
            $('.fiyatlandirma').show();
        }
    });

    function GetIlce(il_id) {
        if (il_id > 0) {
            $("#ilce_id").get(0).options.length = 0;
            $("#ilce_id").get(0).options[0] = new Option("Yükleniyor", "-1");

            $.ajax({
                type: "GET",
                url: "{{asset('ajax-subcat')}}",
                data:{il_id:il_id},
                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    $("#ilce_id").get(0).options.length = 0;
                    $("#ilce_id").get(0).options[0] = new Option("Seçiniz", "-1");

                    $.each(msg, function(index, ilce) {
                        $("#ilce_id").get(0).options[$("#ilce_id").get(0).options.length] = new Option(ilce.adi, ilce.id);
                    });
                },
                async: false,
                error: function() {
                    $("#ilce_id").get(0).options.length = 0;
                    alert("İlçeler yükelenemedi!!!");
                }
            });
        }
        else {
            $("#ilce_id").get(0).options.length = 0;
        }
    }

    $("#yaklasik_maliyet").change(function(){
        var option = $('option:selected', this).attr('name');
        $('#maliyet').val(option);
    });

    $('#custom-headers').multiSelect({
        selectableHeader: "<p style='font-size:12px;color:red'>Tüm firmalar</p><input style='width:100px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
        selectionHeader: "<p style='font-size:12px;color:red'>Onaylı Tedarikciler</p><input  style='width:100px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
        afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function(e){
                    if (e.which === 40){
                        that.$selectableUl.focus();
                        return false;
                    }
                });
            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function(e){
                    if (e.which == 40){
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function(values){
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
        }
    });

    $('#belirliIstek').multiSelect({
        selectableHeader: "<input style='width:100px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
        selectionHeader: "<input  style='width:100px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
        afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function(e){
                    if (e.which === 40){
                        that.$selectableUl.focus();
                        return false;
                    }
                });
            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function(e){
                    if (e.which == 40){
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function(values){
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
        }
    });

    var option;

    function editOnayliTedarikciler(){
        $("#belirliIstek option").remove();
        $('#belirliIstek').multiSelect('refresh');
        $("#custom-headers option").remove();
        $('#custom-headers').multiSelect('refresh');
        $.ajax({
            type:"GET",
            url: "{{asset('onayli')}}",
            data:{
                sektorOnayli:sektor,
                ilanID:{{$ilan->id}},
                mod:'duzenle'},
            cache: false,
            success: function(data){

                for(var key=0; key <Object.keys(data.tumFirmalar).length;key++) {
                    $('#custom-headers').multiSelect('addOption', { value: data.tumFirmalar[key].id, text: data.tumFirmalar[key].adi, index:key});
                }
                for(var key=0; key <Object.keys(data.secilmisFirmalar).length;key++){
                    $('#custom-headers').multiSelect('select', (data.secilmisFirmalar[key].id));
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    }

    function getOnayliTedarikciler(){
        $.ajax({
            type:"GET",
            url: "{{asset('onayli')}}",
            data:{
                sektorOnayli:sektor
            },
            cache: false,
            success: function(data){
                $("#belirliIstek option").remove();
                $('#belirliIstek').multiSelect('refresh');
                $("#custom-headers option").remove();
                $('#custom-headers').multiSelect('refresh');

                for(var key=0; key <Object.keys(data.tumFirmalar).length;key++) {
                    $('#custom-headers').multiSelect('addOption', { value: data.tumFirmalar[key].id, text: data.tumFirmalar[key].adi, index:key});
                }
                for(var key=0; key <Object.keys(data.onayliTedarikciler).length;key++){
                    $('#custom-headers').multiSelect('select', (data.onayliTedarikciler[key].id));
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    }

    function editBelirliIstekliler(){
        $.ajax({
            type:"GET",
            url: "{{asset('belirli')}}",
            data:{
                sektorOnayli:sektor,
                ilanID:{{$ilan->id}},
                mod:'duzenle'
                },
            cache: false,
            success: function(data){
                $("#custom-headers option").remove();
                $('#custom-headers').multiSelect('refresh');
                $("#belirliIstek option").remove();
                $('#belirliIstek').multiSelect('refresh');

                for(var key=0; key <Object.keys(data.tumFirmalar).length;key++) {
                    $('#belirliIstek').multiSelect('addOption', { value: data.tumFirmalar[key].id, text: data.tumFirmalar[key].adi, index:key});
                }
                for(var key=0; key <Object.keys(data.secilmisFirmalar).length;key++){
                    $('#belirliIstek').multiSelect('select', (data.secilmisFirmalar[key].id));
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus+" Error: " + errorThrown);
            }
        });
    }

    function getBelirliIstekliler(){
        $.ajax({
            type:"GET",
            url: "{{asset('belirli')}}",
            data:{
                sektorOnayli:sektor
            },
            cache: false,
            success: function(data){
                $("#custom-headers option").remove();
                $('#custom-headers').multiSelect('refresh');
                $("#belirliIstek option").remove();
                $('#belirliIstek').multiSelect('refresh');

                for(var key=0; key <Object.keys(data).length;key++) {
                    $('#belirliIstek').multiSelect('addOption', { value: data[key].id, text: data[key].adi, index:key});
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus+" Error: " + errorThrown);
            }
        });
    }

    $("#katilimcilar").change(function(){
        option = $('option:selected', this).attr('value');
        if(option==="1"){
            $('#custom-headers').multiSelect('deselect_all');
            getOnayliTedarikciler();
            $('#onayli_tedarikciler').show();
            $('#belirli-istekliler').hide();
        }
        else if (option==="2"){
            $('#belirliIstek').multiSelect('deselect_all');
            getBelirliIstekliler();
            $('#belirli-istekliler').show();
            $('#onayli_tedarikciler').hide();
        }
        else {
            $('#onayli_tedarikciler').hide();
            $('#belirli-istekliler').hide();
        }
    });

    $( "#teslim_yeri" ).change(function() {
        var teslim_yeri= $('#teslim_yeri').val();
        if(teslim_yeri=="Satıcı Firma"){
            $('.teslim_il').hide();
            $('.teslim_ilce').hide();
        }
        else if(teslim_yeri=="Adrese Teslim"){
            $('.teslim_il').show();
            $('.teslim_ilce').show();
        }
        else{}
    });
    $('.firma_goster').click(function() {
        $(this).siblings('input:checkbox').prop('checked', false);
    });
    $(function() {
        $('.selectpicker').selectpicker();
    });
    $('.selectpicker').selectpicker({
        noneResultsText: 'Sonuç Bulunamadı'
    });

    //birden fazla kalem ekleme modal form içerisinde.
    var kalem_num;
    var i="{{$i}}";

    $("#kalem_ekle").click(function(){


        if(sozlesme_turu=="1" && $("#goturu_kalem0").length==0){
            $("#goturu_table").append(['<tr>','<td>1</td>',
                '<td><input type="text" style="background:url({{asset("images/ekle.png")}}) no-repeat scroll ;padding-left:25px" class="form-control goturu_show required" id="goturu_kalem0" name="goturu_kalem" placeholder="Kalem Ekle" readonly  value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"> </td>',
                '<td><textarea  rows="2" id="goturu_aciklama" name="goturu_aciklama" class="form-control required " placeholder="Açıklama" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea></td>',
                '<td><input type="text" class="form-control required" id="goturu_miktar" name="goturu_miktar" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
                '<td><select class="form-control required" name="goturu_miktar_birim_id" id="goturu_miktar_birim_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $miktar_birim) <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>@endforeach</select></td>',
                '<td><a href="#"  class="btn_kalem_sil"> <img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="goturu_id"  id="goturu_id0" value=""><input class="inp_kalem_id_goturu" name="kalem_id_goturu" type="hidden" value="-1"/></td>','</tr>'].join(''));
        }
        else if(ilan_turu=="1" &&sozlesme_turu=="0") {
            $("#mal_table").append(['<tr>','<td>'+(parseInt(kalem_num)+1)+'</td>','<td> <input type="text"  style="background:url({{asset("images/ekle.png")}}) no-repeat scroll ;padding-left:25px"class="form-control mal_show  required" id="mal_kalem'+kalem_num+'" name="mal_kalem[]" placeholder="Kalem Ekle" readonly value="" > </td>',
                '<td><input type="text" class="form-control required " id="mal_marka" name="mal_marka[]" placeholder="Marka" value="" ></td>',
                ' <td><input type="text" class="form-control required " id="mal_model" name="mal_model[]" placeholder="Model" value="" ></td>',
                '<td><textarea id="mal_aciklama" name="mal_aciklama[]" rows="2" class="form-control required" placeholder="Açıklama" ></textarea></td>',
                ' <td> <input type="text" class="form-control required" id="mal_ambalaj" name="mal_ambalaj[]" placeholder="ambalaj" value="" ></td>',
                '<td><input type="text" class="form-control required " id="mal_miktar" name="mal_miktar[]" placeholder="Miktar" value="" ></td>',
                '<td><select class="form-control required " name="mal_birim[]" id="mal_birim"><option selected disabled>Seçiniz</option>@foreach($birimler as $birimleri) <option  value="{{$birimleri->id}}" >{{$birimleri->adi}}</option> @endforeach </select></td>',
                '<td><a href="#" class="btn_kalem_sil" ><img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="mal_id[]"  id="mal_id'+kalem_num+'" value=""><input class="inp_kalem_id" name="kalem_id[]" type="hidden" value="-1"/></td>','</tr>'].join(''));
        }
        else if(ilan_turu=="2" && sozlesme_turu=="0"){
            $("#hizmet_table").append(['<tr>','<td>'+(parseInt(kalem_num)+1)+'</td>',
                '<td><input type="text" style="background:url({{asset("images/ekle.png")}}) no-repeat scroll ;padding-left:25px" class="form-control hizmet_show required" id="hizmet_kalem'+kalem_num+'" name="hizmet_kalem[]" placeholder="Kalem Ekle" readonly  value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"> </td>',
                '<td><textarea  rows="2" id="hizmet_aciklama" name="hizmet_aciklama[]" class="form-control required" placeholder="Açıklama" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea></td>',
                '<td><input type="text" class="form-control required" id="hizmet_fiyat_standardi" name="hizmet_fiyat_standardi[]" placeholder="Fiyat Standartı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
                '<td><select class="form-control required" name="hizmet_fiyat_standardi_birimi[]" id="hizmet_fiyat_standardi_birimi" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $fiyat_birimi)<option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>@endforeach</select></td>',
                '<td><input type="text" class="form-control  required" id="hizmet_miktar" name="hizmet_miktar[]" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
                '<td><select class="form-control required" name="hizmet_miktar_birim_id[]" id="hizmet_miktar_birim_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $miktar_birim) <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>@endforeach</select></td>',
                '<td><a href="#" class="btn_kalem_sil"> <img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="hizmet_id[]"  id="hizmet_id'+kalem_num+'" value=""><input class="inp_kalem_id" name="kalem_id[]" type="hidden" value="-1"/></td>','</tr>'].join(''));
        }
        else if(ilan_turu=="3" && sozlesme_turu=="0"){
            $("#yapim_table").append(['<tr>','<td>'+(parseInt(kalem_num)+1)+'</td>',
                '<td><input type="text" style="background:url({{asset("images/ekle.png")}}) no-repeat scroll ;padding-left:25px" class="form-control yapim_show required" id="yapim_kalem'+kalem_num+'" name="yapim_kalem[]" placeholder="Kalem Ekle" readonly  value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"> </td>',
                '<td><textarea  rows="2" id="yapim_aciklama" name="yapim_aciklama[]" class="form-control required" placeholder="Açıklama" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></textarea></td>',
                '<td><input type="text" class="form-control required" id="yapim_fiyat_standardi" name="yapim_fiyat_standardi[]" placeholder="Fiyat Standartı" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
                '<td><select class="form-control required" name="yapim_fiyat_standardi_birimi[]" id="yapim_fiyat_standardi_birimi" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $fiyat_birimi)<option  value="{{$fiyat_birimi->id}}" >{{$fiyat_birimi->adi}}</option>@endforeach</select></td>',
                '<td><input type="text" class="form-control required" id="yapim_miktar" name="yapim_miktar[]" placeholder="Miktar" value="" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"></td>',
                '<td><select class="form-control required" name="yapim_miktar_birim_id[]" id="yapim_miktar_birim_id" data-validation="required" data-validation-error-msg="Lütfen bu alanı doldurunuz!"><option selected disabled>Seçiniz</option>@foreach($birimler as $miktar_birim) <option  value="{{$miktar_birim->id}}" >{{$miktar_birim->adi}}</option>@endforeach</select></td>',
                '<td><a href="#" class="btn_kalem_sil" > <img src="{{asset("images/sil1.png")}}"></a><input type="hidden" name="yapim_id[]"  id="yapim_id'+kalem_num+'" value=""><input class="inp_kalem_id" name="kalem_id[]" type="hidden" value="-1"/></td>','</tr>'].join(''));
        }
        kalem_num++;
    });

   //mal kalem silme
    $('#mal_table').on('click', '.btn_kalem_sil', function(e) {
        e.preventDefault();
        if($(".mal_show").length>1){
            var index=$(this).index(".btn_kalem_sil");
            var kalem_id = $('.inp_kalem_id').eq(index).val();
            if(kalem_id!=-1){
                deleted_array.push(kalem_id);
            }
            $(this).parents('tr').first().remove();
        }

    });

    //hizmet kalem silme
    $('#hizmet_table').on('click', '.btn_kalem_sil', function(e) {
        e.preventDefault();
        if($(".hizmet_show").length>1) {
            var index = $(this).index(".btn_kalem_sil");
            var kalem_id = $('.inp_kalem_id').eq(index).val();
            if (kalem_id != -1) {
                deleted_array.push(kalem_id);
            }
            $(this).parents('tr').first().remove();
        }
    });

    //yapim kalem silme
    $('#yapim_table').on('click', '.btn_kalem_sil', function(e) {
        e.preventDefault();
        if($(".yapim_show").length>1) {
            var index = $(this).index(".btn_kalem_sil");
            var kalem_id = $('.inp_kalem_id').eq(index).val();
            if (kalem_id != -1) {
                deleted_array.push(kalem_id);
            }
            $(this).parents('tr').first().remove();
        }
    });

    //kalem tree modalını açma
    $('#mal_table').on('click', '.mal_show', function(event) {
        kalemAgaci();
        var input_id=event.target.id;
        $(".m_kalemAgaci #input_mal_id").val(input_id);
        $('.m_kalemAgaci').modal('show');
    });

    $('#hizmet_table').on('click', '.hizmet_show', function(event) {
        kalemAgaci();
        var input_id=event.target.id;
        $(".m_kalemAgaci #input_hizmet_id").val(input_id);
        $('.m_kalemAgaci').modal('show');
    });

    $('#goturu_table').on('click', '.goturu_show', function(event) {
        kalemAgaci();
        var input_id=event.target.id;
        $(".m_kalemAgaci #input_goturu_id").val(input_id);
        $('.m_kalemAgaci').modal('show');
    });
    $('#yapim_table').on('click', '.yapim_show', function(event) {
        kalemAgaci();
        var input_id=event.target.id;
        $(".m_kalemAgaci #input_yapim_id").val(input_id);
        $('.m_kalemAgaci').modal('show');
    });

    function getSektor(mal_turu) {
        if (mal_turu > 0) {
            $("#firma_sektor").get(0).options.length = 0;
            $("#firma_sektor").get(0).options[0] = new Option("Yükleniyor", "-1");

            $.ajax({
                type: "GET",
                url: "{{asset('getSektorler')}}",
                data:{mal_turu:mal_turu},
                contentType: "application/json; charset=utf-8",

                success: function(msg) {
                    $("#firma_sektor").get(0).options.length = 0;
                    $("#firma_sektor").get(0).options[0] = new Option("Seçiniz", "-1");

                    $.each(msg, function(index, sektor) {
                        $("#firma_sektor").get(0).options[$("#firma_sektor").get(0).options.length] = new Option(sektor.adi, sektor.id);
                    });

                    $('.selectpicker').selectpicker('refresh');

                },
                async: false,
                error: function() {
                    $("#firma_sektor").get(0).options.length = 0;
                    alert("Sektörler  yükelenemedi!!!");
                }
            });
        }
        else {
            $("#firma_sektor").get(0).options.length = 0;
        }
    }
</script>
<script type="text/javascript"> //kalemAgacı scriptleri
    glyph_opts = {
        map: {
            checkbox: "glyphicon glyphicon-unchecked",
            checkboxSelected: "glyphicon glyphicon-check",
            checkboxUnknown: "glyphicon glyphicon-share",
            dragHelper: "glyphicon glyphicon-play",
            dropMarker: "glyphicon glyphicon-arrow-right",
            error: "glyphicon glyphicon-warning-sign",
            expanderClosed: "glyphicon glyphicon-plus",
            expanderLazy: "glyphicon glyphicon-plus",  // glyphicon-plus-sign
            expanderOpen: "glyphicon glyphicon-minus",  // glyphicon-collapse-down
            //folder: "glyphicon glyphicon-plus",
            //folderOpen: "glyphicon glyphicon-minus",
            loading: "glyphicon glyphicon-refresh glyphicon-spin"
        }
    };
    function kalemAgaci(){
        $("#tree").remove();
        $(".ftree").append('<div id="tree"></div>');
        // Initialize Fancytree
        $("#tree").fancytree({
            extensions: ["filter", "glyph"],
            quicksearch: true,
            checkbox: true,
            glyph: glyph_opts,
            selectMode: 1,
            source: {
                data:{id:0},
                url: "{{asset('findChildrenTree')}}"+"/"+sektor,
                dataType:'json', debugDelay: 1000
            },
            filter: {
                autoApply: true,   // Re-apply last filter if lazy data is loaded
                autoExpand: true, // Expand all branches that contain matches while filtered
                counter: false,     // Show a badge with number of matching child nodes near parent icons
                fuzzy: false,      // Match single characters in order, e.g. 'fb' will match 'FooBar'
                hideExpandedCounter: true,  // Hide counter badge if parent is expanded
                hideExpanders: false,       // Hide expanders if all child nodes are hidden by filter
                highlight: true,   // Highlight matches by wrapping inside <mark> tags
                leavesOnly: false, // Match end nodes only
                nodata: true,      // Display a 'no data' status node if result is empty
                mode: "hide"       // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
            },
            toggleEffect: { effect: "drop", options: {direction: "left"}, duration: 200 },

            activate: function(event, data) {
                // alert("activate " + data.node);
            },
            lazyLoad: function(event, data){
                var node = data.node;

                data.result = {
                    url: "{{asset('findChildrenTree')}}"+"/"+sektor,
                    debugDelay: 1000,
                    data: {id: node.key},
                    dataType:'json',
                    cache: false
                }
            }
        });
        $(".fancytree-container").toggleClass("fancytree-connectors");
        $("input[name=search]").keyup(function(e){
            var n,
                tree = $.ui.fancytree.getTree(),
                args = "autoApply autoExpand fuzzy hideExpanders highlight leavesOnly nodata".split(" "),
                opts = {},
                filterFunc = $("#branchMode").is(":checked") ? tree.filterBranches : tree.filterNodes,
                match = $(this).val();

            $.each(args, function(i, o) {
                opts[o] = $("#" + o).is(":checked");
            });
            opts.mode = $("#hideMode").is(":checked") ? "hide" : "dimm";

            if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
                $("button#btnResetSearch").click();
                return;
            }
            if($("#regex").is(":checked")) {
                // Pass function to perform match
                n = filterFunc.call(tree, function(node) {
                    return new RegExp(match, "i").test(node.title);
                }, opts);
            } else {
                // Pass a string to perform case insensitive matching
                n = filterFunc.call(tree, match, opts);
            }
            $("button#btnResetSearch").attr("disabled", false);
            $("span#matches").text("(" + n + " matches)");
        }).focus();
        $("button#btnResetSearch").click(function(e){
            $("input[name=search]").val("");
            $("span#matches").text("");
            tree.clearFilter();
        }).attr("disabled", true);
        $("fieldset input:checkbox").change(function(e){
            var id = $(this).attr("id"),
                flag = $(this).is(":checked");

            // Some options can only be set with general filter options (not method args):
            switch( id ){
                case "counter":
                case "hideExpandedCounter":
                    tree.options.filter[id] = flag;
                    break;
            }
            tree.clearFilter();
            $("input[name=search]").keyup();
        });
    }

    $("#tamamBtn").click(function(){
        if(ilan_turu==1 &&sozlesme_turu==0)
        {
            var tree = $("#tree").fancytree("getTree");
            var kalem_id=tree.getSelectedNodes();
            var sel_key= $.map(kalem_id,function(node){
                var mal_kalem_id=$("#input_mal_id").val();
                $("#"+mal_kalem_id).val(node.title);
                var id = mal_kalem_id.substring(9,mal_kalem_id.lenght);
                $("#mal_id"+id).val(node.key);
            });
            $('.m_kalemAgaci').modal('hide');
            $("#tree").fancytree("getTree").visit(function(node){
                node.setSelected(false);
            });
        }
        else if(ilan_turu==2 && sozlesme_turu==0){
            var tree = $("#tree").fancytree("getTree");
            var kalem_id=tree.getSelectedNodes();
            var sel_key= $.map(kalem_id,function(node){
                var hizmet_kalem_id=$("#input_hizmet_id").val();
                $("#"+hizmet_kalem_id).val(node.title);
                var id = hizmet_kalem_id.substring(12,hizmet_kalem_id.lenght);
                $("#hizmet_id"+id).val(node.key);
            });
            $('.m_kalemAgaci').modal('hide');
            $("#tree").fancytree("getTree").visit(function(node){
                node.setSelected(false);
            });
        }
        else if(sozlesme_turu==1){
            var tree = $("#tree").fancytree("getTree");
            var kalem_id=tree.getSelectedNodes();
            var sel_key= $.map(kalem_id,function(node){
                var goturu_kalem_id=$("#input_goturu_id").val();
                $("#"+goturu_kalem_id).val(node.title);
                var id = goturu_kalem_id.substring(12,goturu_kalem_id.lenght);
                $("#goturu_id"+id).val(node.key);
            });
            $('.m_kalemAgaci').modal('hide');
            $("#tree").fancytree("getTree").visit(function(node){
                node.setSelected(false);
            });
        }
        else if(ilan_turu==3){
            var tree = $("#tree").fancytree("getTree");
            var kalem_id=tree.getSelectedNodes();
            var sel_key= $.map(kalem_id,function(node){
                var yapim_kalem_id=$("#input_yapim_id").val();
                $("#"+yapim_kalem_id).val(node.title);
                var id = yapim_kalem_id.substring(11,yapim_kalem_id.lenght);
                $("#yapim_id"+id).val(node.key);
            });
            $('.m_kalemAgaci').modal('hide');
            $("#tree").fancytree("getTree").visit(function(node){
                node.setSelected(false);
            });
        }
    });

    $(function() {
        var kapanma_tarihi  = new Date("{{$ilan->kapanma_tarihi}}");
        var yayin_tarihi= new Date("{{$ilan->yayin_tarihi}}");
        $('input[name="ilan_tarihi_araligi"]').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
                "applyLabel": "Uygula",
                "cancelLabel": "Vazgeç",
                "fromLabel": "Dan",
                "toLabel": "a",
                "customRangeLabel": "Seç",
                "daysOfWeek": [
                    "Pt",
                    "Sl",
                    "Çr",
                    "Pr",
                    "Cm",
                    "Ct",
                    "Pz"
                ],
                "monthNames": [
                    "Ocak",
                    "Şubat",
                    "Mart",
                    "Nisan",
                    "Mayıs",
                    "Haziran",
                    "Temmuz",
                    "Ağustos",
                    "Eylül",
                    "Ekim",
                    "Kasım",
                    "Aralık"
                ],
                "firstDay": 1

            },
            startDate: yayin_tarihi,
            endDate: kapanma_tarihi
        });

        var is_baslama_tarihi  = new Date("{{$ilan->is_baslama_tarihi}}");
        var is_bitis_tarihi= new Date("{{$ilan->is_bitis_tarihi}}");
        $('input[name="is_tarihi_araligi"]').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
                "applyLabel": "Uygula",
                "cancelLabel": "Vazgeç",
                "fromLabel": "Dan",
                "toLabel": "a",
                "customRangeLabel": "Seç",
                "daysOfWeek": [
                    "Pt",
                    "Sl",
                    "Çr",
                    "Pr",
                    "Cm",
                    "Ct",
                    "Pz"
                ],
                "monthNames": [
                    "Ocak",
                    "Şubat",
                    "Mart",
                    "Nisan",
                    "Mayıs",
                    "Haziran",
                    "Temmuz",
                    "Ağustos",
                    "Eylül",
                    "Ekim",
                    "Kasım",
                    "Aralık"
                ],
                "firstDay": 1
            },
            startDate: is_baslama_tarihi,
            endDate: is_bitis_tarihi
        });
        //$('#btn-save-ilanBilgileri').val("add");
        $('#myModal-ilanBilgileri').modal('show');
        populateDD();


    });
    function populateDD() {
        var teslim_yeri = '{{$ilan->teslim_yeri_satici_firma}}';
        if (teslim_yeri == 'Satıcı Firma') {
            $(".teslim_il").hide();
            $(".teslim_ilce").hide();
        }
        else {
            GetIlce({{$ilan->teslim_yeri_il_id}});
            $("#il_id").val({{$ilan->teslim_yeri_il_id}});
            if ("{{$ilan->teslim_yeri_ilce_id}}" !== "") {
                $("#ilce_id").val({{$ilan->teslim_yeri_ilce_id}});
            }
        }



        $("#ilan_adi").val("{{$ilan->adi}}");
        $("#odeme_turu").val({{$ilan->odeme_turu_id}});
        $("#para_birimi").val({{$ilan->para_birimi_id}});

        //katılımcılar doldurulur
        $("#katilimcilar").val({{$ilan->katilimcilar}});
        option = $('option:selected', $("#katilimcilar")).attr('value');
        if(option==="1"){
            editOnayliTedarikciler();
            $('#onayli_tedarikciler').show();
            $('#belirli-istekliler').hide();
        }
        else if (option==="2"){
            editBelirliIstekliler();
            $('#belirli-istekliler').show();
            $('#onayli_tedarikciler').hide();
        }
        else {
            $('#onayli_tedarikciler').hide();
            $('#belirli-istekliler').hide();
        }

        $("#sozlesme_turu").val({{$ilan->sozlesme_turu}});
        if($("#sozlesme_turu").val()==0){
            $("#kismi_fiyat").val({{$ilan->kismi_fiyat}});
        }
        else{
            $(".fiyatlandirma").hide();
        }

        $("#firma_sektor").val({{$ilan->ilan_sektor}});
        $("#firma_sektor_label").val("{{$ilan_sektor->adi}}");
        if({{$ilan->goster}}){
            $("#firma_adi_goster").attr('checked', true);
        }
        else{
            $("#firma_adi_gizle").attr('checked', true);
        }
        $("#ilan_turu").val({{$ilan->ilan_turu}});
        $("#rekabet_sekli").val({{$ilan->rekabet_sekli}});
        $("#yaklasik_maliyet").val({{$ilan->komisyon_miktari}});
        if ("{{$ilan->teslim_yeri_satici_firma}}" !== "") {
            $("#teslim_yeri").val("{{$ilan->teslim_yeri_satici_firma}}");
        }
        if ("{{$ilan->isin_suresi}}" !== "") {
            $("#isin_suresi").val("{{$ilan->isin_suresi}}");
        }

        CKEDITOR.on( 'instanceReady', function( evt ) {
            CKEDITOR.config.autoParagraph = false;
            CKEDITOR.instances.aciklama.setData("{{$ilan->aciklama}}");
        });
    }
</script>
