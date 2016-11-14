@extends('admin.layouts')
@section('content')
  <body class="login-img3-body">
    <div class="container">

      <form class="login-form" action="{{!! url('/login')!!}}" method="POST">  
          {!! csrf_field() !!}
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
        
            <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="email"  name="email" class="form-control" placeholder="Email" autofocus>
                   @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                  @endif
            </div>
            <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" name ="password"class="form-control" placeholder="Password">
                     @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            <button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>
        </div>
      </form>

    </div>
  </body>

@endsection()
