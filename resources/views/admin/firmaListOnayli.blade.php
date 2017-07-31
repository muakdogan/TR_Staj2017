<table style="width: 100%;">
    <tr>
      <th >YORUM YAPILAN TARİH</th>
      <th >YAPILAN YORUMLAR</th>
    </tr>
  @foreach($onayli as $onayli_firmalar)
    <tr>
      <td>{{$onayli_firmalar->olusturmaTarihi}}</td>
      <td>{{$onayli_firmalar->adi}}</td>
      <td><img src="{{asset('images/check.png')}}"></td>
    </tr>
  @endforeach
 {{$onayli->links()}}

</table>
