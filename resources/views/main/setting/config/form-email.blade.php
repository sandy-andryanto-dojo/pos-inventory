 <!-- Default box -->
 <div class="box {{ CommonHelper::getBoxTheme() }}">
    <div class="box-header with-border">
        <i class="fa fa-envelope"></i>&nbsp;Email
    </div>
    {!! Form::model($model, ['method' => isset($model->id) ? 'PATCH' : 'POST','class'=>'form-horizontal form-submit','id'=>'','route' => isset($model->id) ? [$route.'.update', $model->id] : $route.".store" ,'enctype'=>'multipart/form-data']) !!} 
    <div class="box-body">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Driver</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="mail-driver" name="mail-driver" value="{{ CommonHelper::getConfig("mail-driver") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Host</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="mail-host" name="mail-host" value="{{ CommonHelper::getConfig("mail-host") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Port</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="mail-port" name="mail-port" value="{{ CommonHelper::getConfig("mail-port") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="mail-username" name="mail-username" value="{{ CommonHelper::getConfig("mail-username") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="mail-password" name="mail-password" value="{{ CommonHelper::getConfig("mail-password") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Encryption</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="mail-encryption" name="mail-encryption" value="{{ CommonHelper::getConfig("mail-encryption") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">From Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="mail-address" name="mail-address" value="{{ CommonHelper::getConfig("mail-address") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">From Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="mail-name" name="mail-name" value="{{ CommonHelper::getConfig("mail-name") }}">
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