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
        <li><a href="javascript:void(0);">Product</a></li>
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
            <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Product</label>
                <div class="col-sm-8">
                    {!! Form::select('product_id', $products->pluck('name','id'), null, ['id'=>'product_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Product ---']) !!}
                    @if ($errors->has('product_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('product_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('path') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-8">
                    @if(strlen(CommonHelper::getVal($model, 'path')) > 0)
                        <input type="hidden" class="file-input-image-preview" value="{{ url(CommonHelper::getVal($model, 'path'))  }}" />
                    @endif
                    <input type="file" class="file-input-image" id="file" name="image">
                    @if ($errors->has('path'))
                        <span class="help-block">
                            <strong>{{ $errors->first('path') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('is_primary') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Is Primary</label>
                <div class="col-sm-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="is_primary" value="1" {{ CommonHelper::getVal($model, 'is_primary') == '1' ? 'checked' : '' }}>&nbsp;Yes
                        </label>
                    </div>
                    @if ($errors->has('is_primary'))
                        <span class="help-block">
                            <strong>{{ $errors->first('is_primary') }}</strong>
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
