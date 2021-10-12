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
        <li><a href="javascript:void(0);">Setting</a></li>
        <li><a href="{{ route($route.'.index') }}">{{ $title }}</a></li>
        <li class="active">{{ isset($model->id) ? 'Edit' : 'Add New' }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('layouts.alert')
    <!-- Default box -->
    <div class="box {{ CommonHelper::getBoxTheme() }}">
        <div class="box-header with-border">
            <div class="clearfix">
                <div class="pull-left">
                    <h3 class="box-title">
                         <i class="fa fa-edit"></i>&nbsp;Form {{ isset($model->id) ? 'Edit' : 'Add New' }}
                    </h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-sm" href="{{ route($route.'.index') }}" data-toggle='tooltip' data-placement='top'  data-original-title='Back to List'>
                        <i class="fa fa-arrow-left"></i>&nbsp;Back to List
                    </a>
                </div>
            </div>
        </div>
        {!! Form::model($model, ['method' => isset($model->id) ? 'PATCH' : 'POST','class'=>'form-horizontal','id'=>'form-submit','route' => isset($model->id) ? [$route.'.update', $model->id] : $route.".store" ,'enctype'=>'multipart/form-data']) !!} 
        <div class="box-body">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="{{ CommonHelper::getVal($model, 'name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="8" id="description" name="description">{{ CommonHelper::getVal($model, 'description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('permissions') ? ' has-error' : '' }} permission-section">
                <label for="" class="col-sm-2 control-label">Permission</label>
                <div class="col-sm-8">
                    <div class="row">
                        @foreach($list_actions as $action)
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label class="">
                                    <input type="checkbox" value="{{ $action }}" class="checked_all" /> {{ strtoupper($action) }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                        @foreach($list_permissions as $perm)
                        @php 
                            $per_found = null;
                            $role = $model;
                            $perAction = explode("_", $perm->name);
                            if(isset($role->id)){
                                $per_found = $role->hasPermissionTo($perm->name);
                            }
                        @endphp
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                    {!! Form::checkbox("permissions[]", $perm->name, $per_found, ["class"=> $perAction[0]]) !!} {{ strtoupper($perm->name) }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if ($errors->has('permissions'))
                        <span class="help-block">
                            <strong>{{ $errors->first('permissions') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="clearfix">
                <div class="pull-left">
                    <button type="submit" class="btn btn-info btn-sm" data-toggle='tooltip' data-placement='top'  data-original-title='{{ isset($model->id) ? 'Update' : 'Save' }}'>
                        <i class="fa fa-save"></i>&nbsp;{{ isset($model->id) ? 'Update' : 'Save' }}
                    </button>
                </div>
                <div class="pull-right">
                    <button type="reset" class="btn btn-warning btn-sm" data-toggle='tooltip' data-placement='top'  data-original-title='Reset'>
                        <i class="fa fa-refresh"></i>&nbsp;Reset Form
                    </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div><!-- /.box -->
</section><!-- /.content -->

@endsection

@section('scripts')
<script src="{{ asset('assets/scripts/setting.role.js') }}?{{ time() }}"></script>
@endsection