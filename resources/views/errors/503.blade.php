@extends('layouts.error')
@section('title') 503 This site is getting a tune-up @endsection

@section('content')
<div class="error">
    <h1></h1>
    <div class="error-code m-b-10 m-t-20">503 <i class="fa fa-warning"></i></div>
    <h3 class="font-bold">This site is getting a tune-up, Why don't you come back in a little while and see if our expert are finished tinkering....</h3>
    <div class="error-desc">
        Try refreshing the page or click the button below to go back to the Homepage.
        <div>
            <h1></h1>
            <a class="btn-sm btn-warning login-detail-panel-button btn" href="{{ url('') }}">
                <i class="fa fa-arrow-left"></i>
                Go back to Homepage                        
            </a>
        </div>
    </div>
</div>

@endsection