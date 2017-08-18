@extends('layouts.app')
<br>
<br>
<br>
<br>
<br>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$butonString}}</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Adresi</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}"
                                data-validation="email" data-validation-error-msg="Lütfen bu alanı doldurunuz!">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Şifre</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation"
                                data-validation="length" data-validation-error-msg="Şifre en az 6 karakterden oluşmalıdır."
                                data-validation-length="min6">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Şifre Tekrar</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password"
                                data-validation="confirmation" data-validation-error-msg="Şifreyi doğru tekrar ettiğinizden emin olun.">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>{{$butonString}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //jquery form validator'ı başlat
        //layouts.app'in <head> içinde include ediliyor
        $.validate({
            modules: 'security'
        });
    })
</script>
@endsection
