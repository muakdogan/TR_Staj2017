
    <h3>İlanlar</h3> 
    <hr>
    @foreach($ilanlar as $ilan)
        <p>{{$ilan->ilanadi}}</p>
        <p >{{$ilan->adi}}</p>
        <a onclick='showModal()' ><button  style='float:right' type='button' class='btn btn-info'>Teklif Ver</button></a><br><br>
    @endforeach
{{$ilanlar->links()}}