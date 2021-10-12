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
        <li><a href="javascript:void(0);">Reference</a></li>
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
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" value="{{ CommonHelper::getVal($model, 'email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ CommonHelper::getVal($model, 'phone') }}">
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Mobile</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ CommonHelper::getVal($model, 'mobile') }}">
                    @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('postal_code') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Postal Code</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ CommonHelper::getVal($model, 'postal_code') }}">
                    @if ($errors->has('postal_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('postal_code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('fax_number') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Fax Number</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="fax_number" name="fax_number" value="{{ CommonHelper::getVal($model, 'fax_number') }}">
                    @if ($errors->has('fax_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fax_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="8" id="address" name="address">{{ CommonHelper::getVal($model, 'address') }}</textarea>
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
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
