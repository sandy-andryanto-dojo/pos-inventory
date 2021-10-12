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
        <li class="active">Detail</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('layouts.alert')
    <div class="box {{ CommonHelper::getBoxTheme() }}">

        <div class="box-header with-border">
            <div class="clearfix">
                <div class="pull-left">
                    <h3 class="box-title">
                         <i class="fa fa-search"></i>&nbsp;Detail {{ $title }}   {!! $model->is_purchased == 1 ? '<span class="label label-success">Paid</span></td>' : '<span class="label label-danger">Unpaid</span></td>' !!}
                    </h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-sm" href="{{ route($route.'.index') }}" data-toggle='tooltip' data-placement='top'  data-original-title='Back to List'>
                        <i class="fa fa-arrow-left"></i>&nbsp;Back to List
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="container-fluid table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Invoice Date : {{ $model->created_at }}</th>
                            <th colspan="2">Invoice Number : {{ $model->invoice_number }}</th>
                        </tr>
                        <tr>
                            <th colspan="2">Supplier : {{ isset($model->Supplier->name) ? $model->Supplier->name : null }}</th>
                            <th colspan="2">Casheir : {{ CommonHelper::getFullNameUser($model->user_id) }}</th>
                        </tr>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($details) > 0)
                            @foreach($details as $detail)
                                <tr>
                                    <td>{{ $detail->Product->sku }} - {{ $detail->Product->name }}</td>
                                    <td>{{ $detail->price }}</td>
                                    <td>{{ $detail->qty }}</td>
                                    <td>{{ $detail->total }}</td>
                                </tr>
                            @endforeach
                        @else
                        <tr class='text-center'>
                            <td colspan='4'>
                                -- No Items --
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Discount : {{ $model->discount }}</th>
                            <th colspan="2">Tax : {{ $model->tax }}</th>
                        </tr>
                        <tr>
                            <th colspan="2">Subtotal : {{ $model->subtotal }}</th>
                            <th colspan="2">Grand Total : {{ $model->grandtotal }}</th>
                        </tr>
                        @if(is_null($model->bank_id))
                            <tr>
                                <th colspan="2">Petty Cash : {{ $model->cash }}</th>
                                <th colspan="2">Change : {{ $model->change }}</th>
                            </tr>
                        @else 
                            <tr>
                                <th colspan="2">Credit Card Number : {{ $model->creditcard_number }}</th>
                                <th colspan="2">Bank : {{ $model->Bank->name }}</th>
                            </tr>
                        @endif
                    </tfoot>
                </table>
            </div>
            @if(!is_null($model->notes))
                <p>Notes : &nbsp;{{ $model->notes }}</p>
            @endif
        </div>
        <div class="box-footer">
            <div class="clearfix">
                <div class="pull-left">
                    @can("add_".$route)
                    <a class="btn btn-success btn-sm" href="{{ route($route.'.create') }}" data-toggle='tooltip' data-placement='top'  data-original-title='Add New'>
                        <i class="fa fa-plus"></i>&nbsp;Add New
                    </a>
                    @endcan
                </div>
                <div class="pull-right">
                    @if((int) $model->is_purchased == 0)
                        @can("edit_".$route)
                        <a class="btn btn-warning btn-sm" href="{{ route($route.'.edit', ['id'=> $model->id]) }}" data-toggle='tooltip' data-placement='top'  data-original-title='Edit'>
                            <i class="fa fa-edit"></i>&nbsp;Edit
                        </a>
                        @endcan
                        @can("delete_".$route)
                        <a class="btn btn-danger btn-sm" href="javacsript:void(0);" id="btn-delete" data-toggle='tooltip' data-placement='top'  data-original-title='Delete'>
                            <i class="fa fa-trash"></i>&nbsp;Delete
                        </a>
                        <form id="delete-form" action="{{ route($route.'.destroy', ['id'=> $model->id]) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                        @endcan
                    @else
                        <a class="btn btn-info btn-sm" id="btn-print-invoice" data-href="{{ route('invoice.preview', ['id'=> $model->id, 'collections'=> $collections]) }}" href="javascript:void(0);" data-toggle='tooltip' data-placement='top'  data-original-title='Print Invoice'>
                            <i class="fa fa-print"></i>&nbsp;Print Invoice
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-print"></i>&nbsp;Print Invoice
                </h4>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="iframe-invoice" src="{{ route('invoice.loader') }}"></iframe>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('scripts')
<script src="{{ asset('assets/scripts/transaction.purchase.form.js') }}?{{ time() }}"></script>
@endsection