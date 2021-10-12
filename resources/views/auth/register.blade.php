@extends('layouts.auth')
@section('title') Sign Up @endsection
@section('content')

<div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>
    <img src="{{ asset('assets/dist/img/app.png') }}" class="img-responsive center-block" width="120">
    <h1></h1>
    @include('layouts.alert')
    <form action="{{ route('register') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="username" id="username" required="required" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" name="email" id="email" required="required" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password" id="password" required="required" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required="required" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-warning btn-block btn-flat">
                    <i class="fa fa-sign-in"></i>&nbsp;Register
                </button>
            </div><!-- /.col -->
        </div>
    </form>
    <br>
    <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
</div><!-- /.form-box -->


@endsection


