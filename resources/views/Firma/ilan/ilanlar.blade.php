
    <h3>İlanlar</h3> 
    <hr>
    @foreach($ilanlar as $ilan)
        <p><b>İlan Adı: {{$ilan->ilanadi}}</b></p>
        <p>Firma: {{$ilan->adi}}</p>
        <p>{{$ilan->iladi}}</p>
        <p>{{$ilan->yayin_tarihi}}</p>
        <button type="button" class="btn btn-primary basvur" id="{{$ilan->ilan_id}}" style='float:right'>Başvur</button><br><br>
        <hr>
    @endforeach
{{$ilanlar->links()}}