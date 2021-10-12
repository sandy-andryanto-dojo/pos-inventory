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
    <!-- Default box -->
    <div class="box {{ CommonHelper::getBoxTheme() }}">
        <div class="box-header with-border">
            <i class="fa fa-list"></i>&nbsp;List {{ $title }}
        </div>
        <div class="box-body">
        <table class="table table-striped table-responsive" data-permissions="{{ base64_encode(json_encode($permissions)) }}"  data-route-crud="{{ route($route.'.index') }}" data-model="{{ $dataTableModel }}"  id="data-table">
                <thead>
                    <tr>
                        <th>Created At</th>
                        <th>Username</th>
                        <th>Event</th>
                        <th>URL</th>
                        <th>Ip Address</th>
                        <th>User Agent</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div><!-- /.box -->
</section><!-- /.content -->

@endsection

@section('scripts')
<script src="{{ asset('assets/scripts/setting.audit.js') }}?{{ time() }}"></script>
@endsection