@extends('layouts.app')
<br>
<br>
@section ('content')
  
<div class="col-lg-6">
    <div class="form-group">
        <h1>Firmalar</h1>
        <div>
            <table>
            <?php $i = 1; ?>
            @foreach($firmalar as $firma)
            <tr>
                <td>{{$i}}</td>&nbsp;&nbsp;
                <td>{{$firma->adi}}</td>&nbsp;&nbsp;
                <td><a href="{{ url('firmaProfili/'.$firma->id)}}">Firma Profili&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
                <td><a href="{{ url('firmaIlanOlustur/'.$firma->id)}}">İlan Oluştur&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
                <td><a href="{{ url('firmaIslemleri/'.$firma->id)}}">Firma İşlemleri&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
            </tr>
            <?php $i++; ?>
            @endforeach
            {{$firmalar->links()}}

            </table>
        </div>
        
        <br>
        <div class="form-group">
        </div>        
    </div>
</div>

@endsection
