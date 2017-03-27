<table  style="width: 100%;">
    <tr>
      <th >FİRMA KAYIT TARİHİ</th>
      <th >FİRMALAR</th>
       <th >ONAY</th>
    </tr>
  @foreach($onay as $firma)
    <tr>
      <td>{{$firma->olusturmaTarihi}} </td>
      <td>{{$firma->adi}}</td>
      <td><a href="{{ url('firmaOnay/'.$firma->id)}}" style="float:right" id="{{$firma->id}}" type="button" class="btn btn-primary" onclick="alert( ' FİRMA ONAYLANDI');">ONAYLA</a></td>
    </tr>
  @endforeach
  {{$onay->links()}}
                                      
 </table>