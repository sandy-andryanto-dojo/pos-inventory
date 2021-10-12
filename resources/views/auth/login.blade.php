@extends('layouts.auth')
@section('title') Sign In @endsection
@section('content')

<div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <img src="{{ asset('assets/dist/img/app.png') }}" class="img-responsive center-block" width="120">
    <h1></h1>
    @include('layouts.alert')
    <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }} 
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="text" class="form-control" placeholder="Username or Email" name="email" id="email" required autofocus>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
             @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-warning btn-block btn-flat">
                    <i class="fa fa-sign-in"></i>&nbsp;Sign In
                </button>
            </div><!-- /.col -->
        </div>
    </form>

    <a href="{{ route('password.request') }}">I forgot my password</a><br>
    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

</div><!-- /.login-box-body -->

@endsection