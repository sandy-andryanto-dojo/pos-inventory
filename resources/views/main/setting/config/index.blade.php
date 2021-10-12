@extends('layouts.app')
@section('title') {{ $title }} @endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $title }}
        <small>{{ $subtitle }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Setting</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('layouts.alert')
    @include('main.setting.config.form-company')
    @include('main.setting.config.form-email')
</section><!-- /.content -->

@endsection

@section('scripts')
<script src="{{ asset('assets/scripts/setting.config.js') }}?{{ time() }}"></script>
@endsection
