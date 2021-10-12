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
            <div class="form-group {{ $errors->has('sku') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">SKU</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="sku" name="sku" value="{{ CommonHelper::getVal($model, 'sku') }}">
                    @if ($errors->has('sku'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sku') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
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
            <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-8">
                    <select name="category_id" data-selected="{{ CommonHelper::getVal($model, 'category_id') }}" id="category_id" class="form-control select2">
                        <option disabled selected>-- Select Category ---</option>
                        {{ CommonHelper::getOptionCategories(isset($model->Category) ? $model->Category : null) }}
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('brand_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Brand</label>
                <div class="col-sm-8">
                    {!! Form::select('brand_id', $brands->pluck('name','id'), null, ['id'=>'brand_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Brand ---']) !!}
                    @if ($errors->has('brand_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('brand_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('group_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Group</label>
                <div class="col-sm-8">
                    {!! Form::select('group_id', $groups->pluck('name','id'), null, ['id'=>'group_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Group ---']) !!}
                    @if ($errors->has('group_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('group_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('price_purchase') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Price Purchase</label>
                <div class="col-sm-8">
                    <input type="number" min="0"  class="form-control" id="price_purchase" name="price_purchase" value="{{ CommonHelper::getVal($model, 'price_purchase') ? CommonHelper::getVal($model, 'price_purchase') : 0 }}">
                    @if ($errors->has('price_purchase'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price_purchase') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('price_profit') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Price Profit (%)</label>
                <div class="col-sm-8">
                    <input type="number" min="0" max="100" step="any" class="form-control" id="price_profit" name="price_profit" value="{{ CommonHelper::getVal($model, 'price_profit') ? CommonHelper::getVal($model, 'price_profit') : 0 }}">
                    @if ($errors->has('price_profit'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price_profit') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('price_sale') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Price Sale</label>
                <div class="col-sm-8">
                    <input type="number" min="0" readonly="readonly" class="form-control" id="price_sale" name="price_sale" value="{{ CommonHelper::getVal($model, 'price_sale') ? CommonHelper::getVal($model, 'price_sale') : 0 }}">
                    @if ($errors->has('price_sale'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price_sale') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('stock') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Stock</label>
                <div class="col-sm-8">
                    <input type="number" min="0" readonly="readonly"  class="form-control" id="stock" name="stock" value="{{ CommonHelper::getVal($model, 'stock') ? CommonHelper::getVal($model, 'stock') : 0 }}">
                    @if ($errors->has('stock'))
                        <span class="help-block">
                            <strong>{{ $errors->first('stock') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('date_expired') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Date Expired</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control input-datepicker" id="date_expired" name="date_expired" value="{{ CommonHelper::getVal($model, 'date_expired') ? CommonHelper::getVal($model, 'date_expired') : date('Y-m-d') }}">
                    @if ($errors->has('date_expired'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_expired') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('notes') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Notes</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="8" id="notes" name="notes">{{ CommonHelper::getVal($model, 'notes') }}</textarea>
                    @if ($errors->has('notes'))
                        <span class="help-block">
                            <strong>{{ $errors->first('notes') }}</strong>
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
<script src="{{ asset('assets/scripts/product.item.js') }}?{{ time() }}"></script>
@endsection
