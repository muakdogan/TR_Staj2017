@extends('layouts.app')
@section ('content')
<div class="col-lg-6">
    {!! Form::open(array('url'=>'firma' ,'method' => 'POST','files'=>true))!!}
    <div class="form-group">
        <h1>Firma Profili</h1>
        <div class="form-group">
            {!! Form::label('Firma Adı:') !!}
            {!! Form::text('firmaAdi', null, array( 'class'=>'form-control', 'placeholder'=>'Firma Adı')) !!}
        </div>
        <div>
            <label for="">Sektör</label>
            @foreach($sektorler as $sektor)
                <input type="checkbox" name="sektor[]" value="{{$sektor->id}}">{{$sektor->adi}}
            @endforeach
        </div>
        
        <br>
        <div class="form-group">
            {!! Form::submit('Kaydet!', array('class'=>'btn btn-primary')) !!}
        </div>        
    </div>
    {!!Form::close()!!}
</div>

@endsection
