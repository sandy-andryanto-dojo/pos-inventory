@extends('layouts.app')
@section('title') Profile @endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        My Profile
        <small>edit my profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('layouts.alert')
    <!-- Default box -->
    <div class="box {{ CommonHelper::getBoxTheme() }}">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-edit"></i>&nbsp;Form Profile</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-2">
                    @include('main.profile.profile-image')
                </div>
                <div class="col-md-10">
                    @include('main.profile.profile-info')
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="clearfix">
                <a href="javascript:void(0);" class="btn btn-info btn-sm" id="btn-form-profile" data-toggle='tooltip' data-placement='top'  data-original-title='Save Change'> 
                    <i class="fa fa-save"></i>&nbsp;Save Change
                </a>
                <a href="javascript:void(0);" class="btn btn-warning pull-right btn-sm" data-toggle='tooltip' data-placement='top'  data-original-title='Reset Form'>
                    <i class="fa fa-refresh"></i>&nbsp;Reset Form
                </a>
            </div>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->


@endsection