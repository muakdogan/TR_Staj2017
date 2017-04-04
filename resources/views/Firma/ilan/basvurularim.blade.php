@extends('layouts.app')
<br>
<br>
 @section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css"></link>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
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

</style>
     <div class="container">
         
             @include('layouts.alt_menu')
              
              
              <?php
              
                        $basvurular = DB::select(DB::raw("SELECT * 
                        FROM teklif_hareketler th1
                        JOIN (
                        SELECT teklif_id, t.ilan_id AS ilanId, MAX( tarih ) tarih
                        FROM teklifler t, teklif_hareketler th
                        WHERE t.id = th.teklif_id
                        AND t.firma_id ='$firma->id'
                        GROUP BY th.teklif_id
                        )th2 ON th1.teklif_id = th2.teklif_id
                        AND th1.tarih = th2.tarih ORDER BY th2.tarih DESC "));
                        $i=1;
                        $basvurular_count = DB::select(DB::raw("SELECT count(th1.id) as count
                        FROM teklif_hareketler th1
                        JOIN (
                        SELECT teklif_id, t.ilan_id AS ilanId, MAX( tarih ) tarih
                        FROM teklifler t, teklif_hareketler th
                        WHERE t.id = th.teklif_id
                        AND t.firma_id ='$firma->id'
                        GROUP BY th.teklif_id
                        )th2 ON th1.teklif_id = th2.teklif_id
                        AND th1.tarih = th2.tarih ORDER BY th2.tarih DESC "));
                  
              ?>                   
             
        <div class="row">
            <div class="col-sm-9">
                <div class="panel panel-default">
                    @foreach($basvurular_count as $count)
                     <div class="panel-heading"><strong>Başvurularım &nbsp;({{$count->count}} İlan)</strong></div>
                    @endforeach 
                    <div class="panel-body">
            
                        <table  id="basvurularım" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead style=" font-size: 12px;">
                                <tr>
                                    <th>Sıra</th>
                                    <th>Firma Adı</th>
                                    <th>İlan Adı</th>
                                    <th>Başvuru Tarihi</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody style="font_size:12px">
                                @foreach($basvurular as $sonuc)
                                    <?php  
                                        $ilan= App\Ilan::find($sonuc->ilanId);
                                        $kullanici_id= Auth::user()->kullanici_id;
                                        $firma_id=$firma->id;
                                        $rol_id  = App\FirmaKullanici::where( 'kullanici_id', '=', $kullanici_id)
                                                ->where( 'firma_id', '=', $firma_id)
                                                ->select('rol_id')->get();
                                                $rol_id=$rol_id->toArray();              
                                        $querys = App\Rol::join('firma_kullanicilar', 'firma_kullanicilar.rol_id', '=', 'roller.id')
                                        ->where( 'firma_kullanicilar.rol_id', '=', $rol_id[0]['rol_id'])
                                        ->select('roller.adi as rolAdi')->get();
                                        $querys=$querys->toArray();
                                        if($querys != null){
                                            $rol=$querys[0]['rolAdi'];
                                        }   
                                    ?>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$ilan->firmalar->adi}}</td>
                                        <td>{{$ilan->adi}}</td>
                                        <td>{{date('d-m-Y', strtotime($sonuc->tarih))}}</td>
                                        <td>
                                            @if ( $rol === 'Yönetici' || $rol ==='Satış' || $rol ==='Satın Alma / Satış')
                                                <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->id), false) }}"><button   name="btn-add-düzenle" style="float:right" type="button" class="btn btn-info düzenle">Düzenle</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div> 
            <?php   $kazananKismi = App\KismiAcikKazanan::where('kazanan_firma_id',$firma->id)->get();
                    $kazananKismiCount= $kazananKismi->count();
                    
                    $kazananKapali = App\KismiKapaliKazanan::where('kazanan_firma_id',$firma->id)->get();
                    $kazananKismiCount = $kazananKismiCount +($kazananKapali->count());
                    $i=1;
            ?>    
            <div class="panel panel-default">
                     <div class="panel-heading"><strong>Kazandığım Başvurularım &nbsp;({{$kazananKismiCount}} İlan)</strong></div>
                  
                    <div class="panel-body">
            
                        <table  id="kazandıgımBasvuru" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead style=" font-size: 12px;">
                                <tr>
                                    <th>Sıra</th>
                                    <th>İlan Adı</th>
                                    <th>Sonuclanma Tarihi</th>
                                    <th>Kazanılan Fiyat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="font_size:12px">
                                @foreach($kazananKismi as $sonucAcik)
                                    <?php  
                                        $ilan= App\Ilan::find($sonucAcik->ilan_id);
                                        $kullanici_id= Auth::user()->kullanici_id;
                                        $firma_id=$firma->id;
                                        $rol_id  = App\FirmaKullanici::where( 'kullanici_id', '=', $kullanici_id)
                                                ->where( 'firma_id', '=', $firma_id)
                                                ->select('rol_id')->get();
                                                $rol_id=$rol_id->toArray();              
                                        $querys = App\Rol::join('firma_kullanicilar', 'firma_kullanicilar.rol_id', '=', 'roller.id')
                                        ->where( 'firma_kullanicilar.rol_id', '=', $rol_id[0]['rol_id'])
                                        ->select('roller.adi as rolAdi')->get();
                                        $querys=$querys->toArray();
                                        if($querys != null){
                                            $rol=$querys[0]['rolAdi'];
                                        }   
                                        if($ilan->ilan_turu == 1 && $ilan->sozlesme_turu == 0){
                                            $kalem = \App\IlanMal::find($sonucAcik->kalem_id);
                                        }elseif($ilan->ilan_turu == 2 && $ilan->sozlesme_turu == 0)  {
                                            $kalem = App\IlanHizmet::find($sonucAcik->kalem_id);
                                        }elseif($ilan->ilan_turu == 3){
                                            $kalem = App\IlanYapimIsi::find($sonucAcik->kalem_id);
                                        }else{
                                            $kalem = \App\IlanGoturuBedel::find($sonucAcik->kalem_id);
                                        }  
                                    ?>
                                
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$ilan->adi}} ilanının {{$kalem->marka}} kalemi</td>
                                        <td>{{date('d-m-Y', strtotime($sonucAcik->sonuclanma_tarihi))}}</td>
                                        <td><strong> {{number_format($sonucAcik->kazanan_fiyat,2,'.','')}}</strong> &#8378;</td>
                                        <td>
                                            @if ( $rol === 'Yönetici' || $rol ==='Satış' || $rol ==='Satın Alma / Satış')
                                                <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->id), false) }}"><button   name="btn-add-düzenle" style="float:right" type="button" class="btn btn-info düzenle">Detay Görüntele</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($kazananKapali as $sonucKapali)
                                    <?php  
                                        $ilan= App\Ilan::find($sonucKapali->ilan_id);
                                        $kullanici_id= Auth::user()->kullanici_id;
                                        $firma_id=$firma->id;
                                        $rol_id  = App\FirmaKullanici::where( 'kullanici_id', '=', $kullanici_id)
                                                ->where( 'firma_id', '=', $firma_id)
                                                ->select('rol_id')->get();
                                                $rol_id=$rol_id->toArray();              
                                        $querys = App\Rol::join('firma_kullanicilar', 'firma_kullanicilar.rol_id', '=', 'roller.id')
                                        ->where( 'firma_kullanicilar.rol_id', '=', $rol_id[0]['rol_id'])
                                        ->select('roller.adi as rolAdi')->get();
                                        $querys=$querys->toArray();
                                        if($querys != null){
                                            $rol=$querys[0]['rolAdi'];
                                        }   
                                    ?>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$ilan->adi}}</td>
                                        <td>{{$sonucKapali->sonuclanma_tarihi}}</td>
                                        <td><strong> {{number_format($sonucKapali->kazanan_fiyat,2,'.','')}}</strong> &#8378;</td>
                                        <td>
                                            @if ( $rol === 'Yönetici' || $rol ==='Satış' || $rol ==='Satın Alma / Satış')
                                                <a href="{{ URL::to('teklifGor', array($firma->id,$ilan->id), false) }}"><button   name="btn-add-düzenle" style="float:right" type="button" class="btn btn-info düzenle">Detay Görüntele</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div> 
        </div>
        <div class="col-sm-3">    
            <div class="panel panel-default">
                    <div class="panel-heading"><strong>İstatistik</strong></div>
                        <div  class="panel-body">
                            @foreach($basvurular_count as $count)
                                 <p><strong>Başvurulan İlan Sayısı:</strong>&nbsp;{{$count->count}}</p>
                            @endforeach 
                                <p><strong>Kazanılan İlan Sayısı:</strong>&nbsp;{{$kazananKismiCount}}</p>
                           
                        </div>
                </div>
            
        </div>    
     </div>
    </div>
<script>
$('#basvurularım').DataTable({  
        "language": {
	"sDecimal":        ",",
	"sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
	"sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
	"sInfoEmpty":      "Kayıt yok",
	"sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
	"sInfoPostFix":    "",
	"sInfoThousands":  ".",
	"sLengthMenu":     "Sayfada _MENU_ kayıt göster",
	"sLoadingRecords": "Yükleniyor...",
	"sProcessing":     "İşleniyor...",
	"sSearch":         "Ara:",
	"sZeroRecords":    "Eşleşen kayıt bulunamadı",
	"oPaginate": {
		"sFirst":    "İlk",
		"sLast":     "Son",
		"sNext":     "Sonraki",
		"sPrevious": "Önceki"
	},
	"oAria": {
		"sSortAscending":  ": artan sütun sıralamasını aktifleştir",
		"sSortDescending": ": azalan sütun soralamasını aktifleştir"
	}
    }
});
$('#kazandıgımBasvuru').DataTable({  
       "language": {
	"sDecimal":        ",",
	"sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
	"sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
	"sInfoEmpty":      "Kayıt yok",
	"sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
	"sInfoPostFix":    "",
	"sInfoThousands":  ".",
	"sLengthMenu":     "Sayfada _MENU_ kayıt göster",
	"sLoadingRecords": "Yükleniyor...",
	"sProcessing":     "İşleniyor...",
	"sSearch":         "Ara:",
	"sZeroRecords":    "Eşleşen kayıt bulunamadı",
	"oPaginate": {
		"sFirst":    "İlk",
		"sLast":     "Son",
		"sNext":     "Sonraki",
		"sPrevious": "Önceki"
	},
	"oAria": {
		"sSortAscending":  ": artan sütun sıralamasını aktifleştir",
		"sSortDescending": ": azalan sütun soralamasını aktifleştir"
	}
    }
});

</script>
@endsection


               
