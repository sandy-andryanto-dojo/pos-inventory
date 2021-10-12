@extends('layouts.app')
@section('title') Dashboard @endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Dashboard Summary</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

 <!-- Main content -->
 <section class="content">
    <div class="row">
        <div class="col-md-2">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 class="txt-purchase">
                        <i class="fa fa-refresh fa-spin"></i>
                    </h3>
                    <p>Today Purchase</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
                <a href="{{ route('transaction_purchases.index') }}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-md-2">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 class="txt-sale">
                        <i class="fa fa-refresh fa-spin"></i>
                    </h3>
                    <p>Today Sales</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="{{ route('transaction_sales.index') }}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-md-2">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3 class="txt-product">
                        <i class="fa fa-refresh fa-spin"></i>
                    </h3>
                    <p>Product</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes"></i>
                </div>
                <a href="{{ route('items.index') }}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-md-2">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 class="txt-customer">
                        <i class="fa fa-refresh fa-spin"></i>
                    </h3>
                    <p>Customer</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('customers.index') }}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-md-2">
            <!-- small box -->
            <div class="small-box bg-lime">
                <div class="inner">
                    <h3 class="txt-supplier">
                        <i class="fa fa-refresh fa-spin"></i>
                    </h3>
                    <p>Supplier</p>
                </div>
                <div class="icon">
                    <i class="fa fa-truck"></i>
                </div>
                <a href="{{ route('suppliers.index') }}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-md-2">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 class="txt-brand">
                        <i class="fa fa-refresh fa-spin"></i>
                    </h3>
                    <p>Brand</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('brands.index') }}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="box {{ CommonHelper::getBoxTheme() }}">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i>&nbsp;Sale By Product in {{ date('Y') }}
                   </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 chart">
                            <canvas id="sale-product" height="150"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div id="sale-product-legend"></div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box {{ CommonHelper::getBoxTheme() }}">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i>&nbsp;Purchase By Product in {{ date('Y') }}
                   </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 chart">
                            <canvas id="purchase-product" height="150"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div id="purchase-product-legend"></div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box {{ CommonHelper::getBoxTheme() }}">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i>&nbsp;User activity in {{ date('Y') }}
                   </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 chart">
                            <canvas id="user-activity" height="150"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div id="user-activity-legend"></div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box {{ CommonHelper::getBoxTheme() }}">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-line-chart"></i>&nbsp;Purchase vs Sale in {{ date('Y') }}
                   </h3>
                </div>
                <div class="box-body">
                   <div class="col-md-11">
                        <div class="chart">
                            <canvas id="line-chart" style="height:250px"></canvas>
                        </div>
                   </div>
                   <div class="col-md-1">
                       <ul class="chart-legend clearfix">
                            <li><i class="fa fa-circle-o" style="color:rgba(60,141,188,0.9);"></i> Sale</li>
                            <li><i class="fa fa-circle-o " style="color:rgba(210, 214, 222, 1);"></i> Purchase</li>
                       </ul>
                   </div>
                </div>
            </div>
        </div>
    </div>
 </section>


@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/scripts/dashboard.js') }}?{{ time() }}"></script>
@endsection