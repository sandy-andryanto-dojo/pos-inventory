@extends('layouts.auth')
@section('title') Reset Password @endsection
@section('content')

<div class="login-box-body">
    <p class="login-box-msg">Please enter your email</p>
     @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('password.email') }}" method="post">
        <img src="{{ asset('assets/dist/img/app.png') }}" class="img-responsive center-block" width="120">
        <h1></h1>
        @include('layouts.alert')
        {{ csrf_field() }} 
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" placeholder="E-Mail Address" name="email" id="email" required autofocus>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-warning btn-block btn-flat">
                    <i class="fa fa-send"></i>&nbsp;Send Password Reset Link
                </button>
            </div>
        </div>
    </form>
    <br>
    <a href="{{ route('login') }}" class="text-center">Change your mind ? Sign In </a>

</div><!-- /.login-box-body -->

@endsection