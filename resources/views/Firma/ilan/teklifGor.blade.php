
@extends('layouts.app2')
<br>
 <br>
 @section('content')
 <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
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
         <nav class="navbar navbar-inverse">
             <div class="container-fluid">
                 <div class="navbar-header">
                     <a class="navbar-brand" href="#"><img src='{{asset('images/anasayfa.png')}}'></a>
                 </div>
                 <ul class="nav navbar-nav">
                     <li class=""><a href="{{ url('firmaProfili/'.$firma->id)}}">Firma Profili</a></li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">İlan İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="{{ url('ilanlarim/'.$firma->id) }}">İlanlarım</a></li>
                             <li><a href="{{ url('firmaIlanOlustur/ilanEkle/'.$firma->id) }}">İlan Oluştur</a></li>
                         </ul>
                     </li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Başvuru İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="#">Başvurularım</a></li>
                             <li><a href="#">Başvur</a></li>
                         </ul>
                     </li>
                     <li><a href="#">Mesajlar</a></li>
                     <li><a href="#">Kullanici İşlemleri</a></li>
                 </ul>
             </div>
         </nav>
         <div class="panel-header">
             <h2>Teklif Gor</h2>
         </div>
         
         <div class="panel-body">
             <table class="table table-bordered" id="myTable">
                 <thead>
                    <th>Sıra</th>
                    <th>Firma Adı</th>
                    <th>Kalem</th>
                    <th>Toplam Fiyat</th>
                    <th>Para Birimi</th>
                 </thead>
                 <tbody>
                     <?php $i=1;
                     ?>
                     @foreach($ilan->ilan_mallar as $ilanmal)
                        <?php  $mal_teklifler = $ilanmal->mal_teklifler()->orderBy('fiyat','asc')->get();
                        ?>
                        @foreach($mal_teklifler as $malTeklif)
                            <?php  $kullanici = DB::table('firma_kullanicilar')
                                    ->where('firma_kullanicilar.id',$malTeklif->firma_kullanicilar_id)
                                    ->join('kullanicilar', 'firma_kullanicilar.kullanici_id', '=', 'kullanicilar.id')
                                    ->first();
                           ?>
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$kullanici->adi}}</td>
                                <td>{{$ilanmal->marka}} {{$ilanmal->model}}</td>
                                <td>{{$malTeklif->fiyat}}</td>
                                <td>{{$malTeklif->para_birimleri->adi}}</td>
                            </tr>
                        @endforeach
                     @endforeach
                 </tbody>
             </table>
         </div>
    </div>
@endsection
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>



<script>
$(document).ready(function(){
    
    var table =$('#myTable').dataTable({
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
    
});
</script>
<script src="http://cdn.datatables.net/plug-ins/1.10.12/sorting/turkish-string.js"></script>