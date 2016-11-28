
    <h3>İlanlar</h3> 
    <hr>
    <?php $count=$ilanlar->total();?>
    <input type="hidden" name="totalCount" value='{{$ilanlar->total()}}'>
    @foreach($ilanlar as $ilan)
        <p><b>İlan Adı: {{$ilan->ilanadi}}</b></p>
        <p>Firma: {{$ilan->adi}}</p>
        <p>{{$ilan->iladi}}</p>
        <p>{{$ilan->yayin_tarihi}}</p>
        
        <a href="{{ URL::to('ilanTeklifVer', array($ilan->firmaid,$ilan->ilan_id), false) }}"><button type="button" class="btn btn-primary" id="{{$ilan->ilan_id}}" style='float:right'>Başvur</button></a><br><br>
        <hr>
    @endforeach
{{$ilanlar->links()}}
