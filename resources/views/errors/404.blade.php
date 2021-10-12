@extends('layouts.error')
@section('title') 404 Page Not Found @endsection

@section('content')
<div class="error">
    <h1></h1>
    <div class="error-code m-b-10 m-t-20">404 <i class="fa fa-warning"></i></div>
    <h3 class="font-bold">We couldn't find the page..</h3>
    <div class="error-desc">
        Sorry, but the page you are looking for was either not found or does not exist. <br/>
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