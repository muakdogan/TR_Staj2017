@extends('layouts.app')



{{--Teklif yoksa ilan düzenlenebilir!--}}
@if(!$teklifVarMi || 1)

@section('head')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="{{asset('js/ilan/ajax-crud-firmabilgilerim.js')}}"></script>
<script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
<link href="{{asset('css/multi-select.css')}}" media="screen" rel="stylesheet" type="text/css"></link>
<link rel="stylesheet" type="text/css" href="{{asset('css/firmaProfil.css')}}"/>
<style>
    .popup, .popup2, .bMulti {
        background-color: #fff;
        border-radius: 10px 10px 10px 10px;
        box-shadow: 0 0 25px 5px #999;
        color: #111;
        display: none;
        min-width: 450px;
        padding: 25px;
        text-align: center;
    }
    .popup, .bMulti {
        min-height: 150px;
    }
    .button.b-close, .button.bClose {
        border-radius: 7px 7px 7px 7px;
        box-shadow: none;
        font: bold 131% sans-serif;
        padding: 0 6px 2px;
        position: absolute;
        right: -7px;
        top: -7px;
    }
    .button {
        background-color: #2b91af;
        border-radius: 10px;
        box-shadow: 0 2px 3px rgba(0,0,0,0.3);
        color: #fff;
        cursor: pointer;
        display: inline-block;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
    }

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
    .test + .tooltip > .tooltip-inner {
        background-color: #73AD21;
        color: #FFFFFF;
        border: 1px solid green;
        padding: 10px;
        font-size: 12px;
    }
    .test + .tooltip.bottom > .tooltip-arrow {
        border-bottom: 5px solid green;
    }
</style>
@endsection

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<div class="container">
    <br>
    <br>
    @include('layouts.alt_menu')
    @if(count($ilan) == 0)
    <h2>İlan Oluştur</h2>
    @else
    <h2>İlan Düzenle</h2>
    @endif
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-9" >
            <div class="panel-group" id="accordion">

                @include('Firma.ilanDuzenle.ilanDetaylari')

                @include('Firma.ilanDuzenle.Mal.kalemListesi_Mal')
                @include('Firma.ilanDuzenle.Hizmet.kalemListesi_Hizmet')
                @include('Firma.ilanDuzenle.Goturu.kalemListesi_Goturu')
                @include('Firma.ilanDuzenle.Yapim.kalemListesi_Yapim')
            </div>
        </div>
        <div class="col-sm-3">
            Yan column Sidebar
        </div>
    </div>
    <div id="mesaj" class="popup">
        <span class="button b-close"><span>X</span></span>
        <h2 style="color:red;font-size:14px"> Dikkat!!</h2>
        <h3 style="font-size:12px">Lütfen Rekabet Şeklini Seçmeden Önce İlan Sektörü Seçimi Yapınız.</h3>
    </div>
    <div id="mesaj_sistem" class="popup">
        <span class="button b-close"><span>X</span></span>
        <h2 style="color:red"> Üzgünüz.. !!!</h2>
        <h3>Sistemsel bir hata oluştu.Lütfen daha sonra tekrar deneyin</h3>
    </div>
</div>

<script src="{{asset('js/jquery.bpopup-0.11.0.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<!--script src="{{asset('js/selectDD.js')}}"></script-->

<script charset="utf-8">
    var firmaCount = 0;
    var multiselectCount=0;
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

        $.fn.datepicker.dates['tr'] = {
            days: ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi", "Pazar"],
            daysShort: ["Pz", "Pzt", "Sal", "Çrş", "Prş", "Cu", "Cts", "Pz"],
            daysMin: ["Pz", "Pzt", "Sa", "Çr", "Pr", "Cu", "Ct", "Pz"],
            months: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
            monthsShort: ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"],
            today: "Bugün"
        };
        var date_input=$('input[class="form-control date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd-mm-yyyy',
            language:"tr",
            container: container,
            weekStart:1,
            todayHighlight: true,
            autoclose: true
        }).on('change', function() {
            $(this).validate();  // triggers the validation test
            // '$(this)' refers to '$("#datepicker")'
        });

        $('#il_id').on('change', function (e) {
            var il_id = e.target.value;
            GetIlce(il_id);
            //popDropDown('ilce_id', 'ajax-subcat?il_id=', il_id);
            //$("#semt_id")[0].selectedIndex=0;
        });
    });

    $.validate({
        modules : 'location, date, security, file',
        onModulesLoaded : function() {
            $('#country').suggestCountry();
        }
    });
    $('#presentation').restrictLength( $('#pres-max-length') );

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

    function populateDD(){
        var teslim_yeri = '{{$ilan->teslim_yeri_satici_firma}}';
        if( teslim_yeri == 'Satıcı Firma' ){
            $(".teslim_il").hide();
            $(".teslim_ilce").hide();
        }
        else{
            GetIlce({{$ilan->teslim_yeri_il_id}});
            $("#il_id").val({{$ilan->teslim_yeri_il_id}});
            if("{{$ilan->teslim_yeri_ilce_id}}" !== "" ){
                $("#ilce_id").val({{$ilan->teslim_yeri_ilce_id}});
            }
        }
        $("#odeme_turu").val({{$ilan->odeme_turu_id}});
        $("#para_birimi").val({{$ilan->para_birimi_id}});
        $("#katilimcilar").val({{$ilan->katilimcilar}});
        $("#kismi_fiyat").val({{$ilan->kismi_fiyat}});
        $("#firma_sektor").val({{$ilan->ilan_sektor}});
        $("#ilan_turu").val({{$ilan->ilan_turu}});
        $("#rekabet_sekli").val({{$ilan->rekabet_sekli}});
        $("#sozlesme_turu").val({{$ilan->sozlesme_turu}});
        $("#yaklasik_maliyet").val({{$ilan->komisyon_miktari}});
        if("{{$ilan->teslim_yeri_satici_firma}}" !== "" ){
            $("#teslim_yeri").val("{{$ilan->teslim_yeri_satici_firma}}");
        }
        if("{{$ilan->isin_suresi}}" !== "" ){
            $("#isin_suresi").val("{{$ilan->isin_suresi}}");
        }
    }

    var sektor=0;

    $(function() {
        $("#yaklasik_maliyet").change(function(){
            var option = $('option:selected', this).attr('name');
            $('#maliyet').val(option);
        });
    });

    var select_count=0;
    var multiselectCount=0;
    $(function() {
        $("#firma_sektor").change(function(){
            sektor = $('option:selected', this).attr('value');
            select_count++;

            if(select_count>1){

            }
            $('#custom-headers').multiSelect('deselect_all');
            //$('#custom-headers').multiSelect().remove();

            funcBelirliIstekler();

        });
    });

    function funcBelirliIstekler(){
        $.ajax({
            type:"GET",
            url: "{{asset('belirli')}}",
            data:{sektorBelirli:sektor},
            cache: false,
            success: function(data){
                console.log(data);
                $("#custom-headers option").remove();
                for(var c=0; c<multiselectCount; c++){
                    $("#"+(c+48)+"-selectable").remove();
                }

                for(var key=0; key <Object.keys(data).length;key++)
                {
                    multiselectCount++;
                    $('#custom-headers').multiSelect('addOption', { value: key, text: data[key].adi, index:key });

                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    }

    $(function() {
        $("#rekabet_sekli").change(function(){
            var option = $('option:selected', this).attr('value');
            if(sektor!==0){

                if(option==="2"){
                    $('#belirli-istekliler').show();
                }
                else
                {
                    $('#belirli-istekliler').hide();
                }
            }
            else
            {
                $('#mesaj').bPopup({
                    speed: 650,
                    transition: 'slideIn',
                    transitionClose: 'slideBack',
                    autoClose: 5000
                });
            }
        });
    });

    $('#custom-headers').multiSelect({
        selectableHeader: "<input style='width:115px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
        selectionHeader: "<input  style='width:115px' type='text' class='search-input' autocomplete='off' placeholder='Firma Seçiniz'>",
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
            firmaCount++;
            if( firmaCount>2){
                $('#custom-headers').multiSelect('deselect', values);
            }
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function(){
            firmaCount--;
            this.qs1.cache();
            this.qs2.cache();
        }
    });

    var ilan_turu;
    var sozlesme_turu;

    $('#ilan_turu').on('change', function (e) {
        ilan_turu = e.target.value;
        if(ilan_turu=="1" && sozlesme_turu=="0")//mal
        {
            $('#hizmet').hide()
            $('#goturu').hide()
            $('#yapim').hide()

        }
        else if(ilan_turu=="2" && sozlesme_turu=="0")//hizmet
        {
            $('#mal').hide()
            $('#goturu').hide()
            $('#yapim').hide()
        }
        else if(sozlesme_turu=="1")//goturu
        {
            $('#hizmet').hide()
            $('#mal').hide()
            $('#yapim').hide();
        }
        else if(ilan_turu=="3")//yapim isi
        {
            $('#hizmet').hide()
            $('#goturu').hide()
            $('#mal').hide()
        }
    });

    $('#sozlesme_turu').on('change', function (e) {
        sozlesme_turu = e.target.value;
        if(ilan_turu=="1" && sozlesme_turu=="0")
        {
            $('#hizmet').hide()
            $('#goturu').hide()
            $('#yapim').hide()

        }
        else if(ilan_turu=="2" && sozlesme_turu=="0")
        {
            $('#mal').hide()
            $('#goturu').hide()
            $('#yapim').hide()
        }
        else if(sozlesme_turu=="1")
        {
            $('#hizmet').hide()
            $('#mal').hide()
            $('#yapim').hide();
        }
        else if(ilan_turu=="3")
        {
            $('#hizmet').hide()
            $('#goturu').hide()
            $('#mal').hide()
        }
    });

    $( document ).ready(function() {
        $('#belirli-istekliler').hide();
        var ilan_turu='{{$ilan->ilan_turu}}';
        var sozlesme_turu='{{$ilan->sozlesme_turu}}';
        if(ilan_turu=="")
        {
            $('#hizmet').hide()
            $('#mal').hide()
            $('#goturu').hide()
            $('#yapim').hide()
        }
        else if(ilan_turu=="1" && sozlesme_turu=="0")
        {
            $('#hizmet').hide()
            $('#goturu').hide()
            $('#yapim').hide()

        }
        else if(ilan_turu=="2" && sozlesme_turu=="0")
        {
            $('#mal').hide()
            $('#goturu').hide()
            $('#yapim').hide()
        }
        else if(sozlesme_turu=="1")
        {
            $('#hizmet').hide()
            $('#mal').hide()
            $('#yapim').hide();
        }
        else if(ilan_turu=="3")
        {
            $('#hizmet').hide()
            $('#goturu').hide()
            $('#mal').hide()
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

    ////transection controllerinde çıkan sistemsel hatanın ekrana bastırılması.
    var firma_id='{{$firma->id}}';
    var ilanId='{{$ilan->id}}';

    $("#fiyatlandirma_kayit").submit(function(e)
    {
        var postData = $(this).serialize();
        var formURL = $(this).attr('action');

        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        $('#mesaj_sistem').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id+"/"+ilanId}, 5000);
                    }
                    else{

                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id +"/"+ilanId}, 1000);
                    }
                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
        e.preventDefault();
    });

    $("#mal_add_kayit").submit(function(e)
    {
        var postData = $(this).serialize();
        var formURL = $(this).attr('action');

        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        $('#mesaj_sistem').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id+"/"+ilanId}, 5000);
                    }
                    else{

                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id +"/"+ilanId}, 1000);
                    }
                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
        e.preventDefault();
    });

    $("#mal_up_kayit").submit(function(e)
    {
        var postData = $(this).serialize();
        var formURL = $(this).attr('action');

        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        $('#mesaj_sistem').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id+"/"+ilanId}, 5000);
                    }
                    else{

                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id +"/"+ilanId}, 1000);
                    }
                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
        e.preventDefault();
    });

    $("#hizmet_up_kayit").submit(function(e)
    {
        var postData = $(this).serialize();
        var formURL = $(this).attr('action');

        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        $('#mesaj_sistem').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id+"/"+ilanId}, 5000);
                    }
                    else{

                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id +"/"+ilanId}, 1000);
                    }
                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
        e.preventDefault();
    });

    $("#hizmet_add_kayit").submit(function(e)
    {
        var postData = $(this).serialize();
        var formURL = $(this).attr('action');

        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        $('#mesaj_sistem').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id+"/"+ilanId}, 5000);
                    }
                    else{

                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id +"/"+ilanId}, 1000);
                    }
                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
        e.preventDefault();
    });

    $("#goturu_add_kayit").submit(function(e)
    {
        var postData = $(this).serialize();
        var formURL = $(this).attr('action');

        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        $('#mesaj_sistem').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id+"/"+ilanId}, 5000);
                    }
                    else{

                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id +"/"+ilanId}, 1000);
                    }
                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
        e.preventDefault();
    });

    $("#goturu_up_kayit").submit(function(e)
    {
        var postData = $(this).serialize();
        var formURL = $(this).attr('action');

        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        $('#mesaj_sistem').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id+"/"+ilanId}, 5000);
                    }
                    else{

                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id +"/"+ilanId}, 1000);
                    }
                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
        e.preventDefault();
    });

    $("#yapim_add_kayit").submit(function(e)
    {
        var postData = $(this).serialize();
        var formURL = $(this).attr('action');
        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        $('#mesaj_sistem').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id+"/"+ilanId}, 5000);
                    }
                    else{

                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id +"/"+ilanId}, 1000);
                    }
                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
        e.preventDefault();
    });

    $("#yapim_up_kayit").submit(function(e)
    {
        var postData = $(this).serialize();
        var formURL = $(this).attr('action');


        $.ajax(
            {
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    console.log(data);
                    $('.ajax-loader').css("visibility", "hidden");
                    if(data=="error"){
                        $('#mesaj_sistem').bPopup({
                            speed: 650,
                            transition: 'slideIn',
                            transitionClose: 'slideBack',
                            autoClose: 5000
                        });
                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id+"/"+ilanId}, 5000);
                    }
                    else{

                        setTimeout(function(){ location.href="{{asset('ilanEkle')}}"+"/"+firma_id +"/"+ilanId}, 1000);
                    }
                    e.preventDefault();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus + "," + errorThrown);
                }
            });
        e.preventDefault();
    });
</script>
@endsection
@else
    {{--Teklif varsa ilan düzenleneMEZ!--}}
@section('head')
    <style>
        .popup, .popup2, .bMulti {
            background-color: #fff;
            border-radius: 10px 10px 10px 10px;
            box-shadow: 0 0 25px 5px #999;
            color: #111;
            display: none;
            min-width: 450px;
            padding: 25px;
            text-align: center;
        }
        .popup, .bMulti {
            min-height: 150px;
        }
        .button.b-close, .button.bClose {
            border-radius: 7px 7px 7px 7px;
            box-shadow: none;
            font: bold 131% sans-serif;
            padding: 0 6px 2px;
            position: absolute;
            right: -7px;
            top: -7px;
        }
        .button {
            background-color: #2b91af;
            border-radius: 10px;
            box-shadow: 0 2px 3px rgba(0,0,0,0.3);
            color: #fff;
            cursor: pointer;
            display: inline-block;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {

            text-align: center;
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
        .test + .tooltip > .tooltip-inner {
            background-color: #73AD21;
            color: #FFFFFF;
            border: 1px solid green;
            padding: 10px;
            font-size: 12px;
        }
        .test + .tooltip.bottom > .tooltip-arrow {
            border-bottom: 5px solid green;
        }

        /*custom font*/


        #msform {
            width: 100%;


            position: relative;
        }
        #msform fieldset {

        }
        /*Hide all except first fieldset*/
        #msform fieldset:not(:first-of-type) {
            display: none;
        }

        /*buttons*/
        .action-button {
            width: 100px;
            background: #27AE60;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }
        .action-button:hover, #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
        }
        /*headings*/
        .fs-title {
            font-size: 15px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
        }
        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }
        /*progressbar*/
        #progressbar {

            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }
        #progressbar li {
            list-style-type: none;
            color: #27ae60;
            text-transform: uppercase;
            font-size: 9px;
            width: 33.33%;
            float: left;
            position: relative;
            text-align: center;
            z-index: 0;
        }
        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 20px;
            line-height: 20px;
            display: block;
            font-size: 10px;
            color: #333;
            background: white;
            border-radius: 3px;
            margin: 0 auto 5px auto;
        }
        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 95%;
            height: 3px;
            background: white;
            position: absolute;
            left: -46.60%;
            top: 9px;
            z-index: -1; /*put it behind the numbers*/
        }
        #progressbar li:first-child:after {
            content: none;
        }
        #progressbar li.active:before,  #progressbar li.active:after{
            background: #27AE60;
            color: white;
        }
        .eula-container {
            padding: 15px 20px;
            height: 250px;
            overflow: auto;
            border: 2px solid #ebebeb;
            color: #7B7B7B;
            font-size: 12pt;
            font-weight: 700;
            background-color: #fff;
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
            background-image: -webkit-linear-gradient(top, rgba(231,231,231,0.55) 0%, rgba(255,255,255,0.63) 17%, #feffff 100%);
            background-image: linear-gradient(to bottom, rgba(231,231,231,0.55) 0%, rgba(255,255,255,0.63) 17%, #feffff 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8ce7e7e7', endColorstr='#feffff',GradientType=0 );
            background-clip: border-box;
            border-radius: 4px;
        }
        .info-box {
            margin: 0 0 15px;
        }
        .box h3{
            text-align:center;
            position:relative;
            top:80px;
        }
        .box {
            width:100%;
            height:200px;
            background:#FFF;
            margin:40px auto;
        }
        .effect8
        {
            position:relative;
            -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        }
        .effect8:before, .effect8:after
        {
            content:"";
            position:absolute;
            z-index:-1;
            -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
            -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
            box-shadow:0 0 20px rgba(0,0,0,0.8);
            top:10px;
            bottom:10px;
            left:0;
            right:0;
            -moz-border-radius:100px / 10px;
            border-radius:100px / 10px;
        }
        .effect8:after
        {
            right:10px;
            left:auto;
            -webkit-transform:skew(8deg) rotate(3deg);
            -moz-transform:skew(8deg) rotate(3deg);
            -ms-transform:skew(8deg) rotate(3deg);
            -o-transform:skew(8deg) rotate(3deg);
            transform:skew(8deg) rotate(3deg);
        }

    </style>

@endsection
@section('content')

    <div class="container">
        <br>
        <br>
        @include('layouts.alt_menu')
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12" >
                <div class="box effect8">
                    <h3>Teklif verilmiş ilanda düzenleme yapılamaz!</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
@endif