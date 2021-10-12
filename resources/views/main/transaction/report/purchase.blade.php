@extends('layouts.app')
@section('title') {{ $title }} Purchase Order @endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $title }}
        <small>{{ $subtitle }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Report</a></li>
        <li class="active">Purchase</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('layouts.alert')
    <!-- Default box -->
    <div class="box {{ CommonHelper::getBoxTheme() }}">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-file-text-o"></i>&nbsp;Show report purchase order
           </h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{ route('reports.update', ['id'=> 2]) }}" target="_blank">
            {{ csrf_field() }}
            {!! method_field('patch') !!}
            <input type="hidden" name="report_type" value="2" />
            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Filter By</label>
                    <div class="col-sm-8">
                        <select name="filter" id="filter" class="form-control select2" required="required">
                            <option disabled selected>-- Choose Filter --</option>
                            <option value="1">Period</option>
                            <option value="2">Product</option>
                            <option value="3">Supplier</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Date Start</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-datepicker" id="date_start" name="date_start" value="{{ date('Y-m-d')  }}" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Date End</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-datepicker" id="date_end" name="date_end" value="{{ date('Y-m-d')  }}" required="required">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="clearfix">
                    <div class="pull-left">
                        <button type="submit" class="btn btn-info btn-sm" data-toggle='tooltip' data-placement='top'  data-original-title='Show Report'>
                            <i class="fa fa-search"></i>&nbsp;Show Report
                        </button>
                    </div>
                    <div class="pull-right">
                        <button type="reset" class="btn btn-warning btn-sm" data-toggle='tooltip' data-placement='top'  data-original-title='Reset'>
                            <i class="fa fa-refresh"></i>&nbsp;Reset Form
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div><!-- /.box -->
</section><!-- /.content -->

@endsection

