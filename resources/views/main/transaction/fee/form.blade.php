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
        <li><a href="javascript:void(0);">Transaction</a></li>
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
            <input type="hidden" name="type" value="3" />
            <input type="hidden" name="is_purchased" value="1" />
            <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}" />
            <div class="form-group {{ $errors->has('stakeholder_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Stakeholder</label>
                <div class="col-sm-8">
                    {!! Form::select('stakeholder_id', $stakeholders->pluck('name','id'), null, ['id'=>'stakeholder_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Stakeholder ---']) !!}
                    @if ($errors->has('stakeholder_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('stakeholder_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('invoice_number') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Invoice Number</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" readonly="readonly" id="invoice_number" name="invoice_number" value="{{ CommonHelper::getVal($model, 'invoice_number') }}">
                    @if ($errors->has('invoice_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('invoice_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('invoice_date') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Invoice Date</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control input-datepicker" id="invoice_date" name="invoice_date" value="{{ CommonHelper::getVal($model, 'invoice_date') ? CommonHelper::getVal($model, 'invoice_date') : date('Y-m-d') }}">
                    @if ($errors->has('invoice_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('invoice_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('grandtotal') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Total paid</label>
                <div class="col-sm-8">
                    <input type="number" min="0"  class="form-control" id="grandtotal" name="grandtotal" value="{{ CommonHelper::getVal($model, 'grandtotal') ? CommonHelper::getVal($model, 'grandtotal') : 0 }}">
                    @if ($errors->has('grandtotal'))
                        <span class="help-block">
                            <strong>{{ $errors->first('grandtotal') }}</strong>
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
