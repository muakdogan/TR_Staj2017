
    <h3>İlanlar</h3> 
    <hr>
    <?php $count=$ilanlar->total();?>
    <input type="hidden" name="totalCount" value='{{$ilanlar->total()}}'>
    @foreach($ilanlar as $ilan)
        <p>{{$ilanlar->total()}}</p>
        <p>{{$ilan->ilanadi}}</p>
        <p >{{$ilan->adi}}</p>
        <a onclick='showModal()' ><button  style='float:right' type='button' class='btn btn-info'>Teklif Ver</button></a><br><br>
    @endforeach
{{$ilanlar->links()}}
<script>
    alert($('#totalCount').attr('value'));
</script>