 <!-- Default box -->
 <div class="box {{ CommonHelper::getBoxTheme() }}">
    <div class="box-header with-border">
        <i class="fa fa-building"></i>&nbsp;Company
    </div>
    {!! Form::model($model, ['method' => isset($model->id) ? 'PATCH' : 'POST','class'=>'form-horizontal form-submit','id'=>'','route' => isset($model->id) ? [$route.'.update', $model->id] : $route.".store" ,'enctype'=>'multipart/form-data']) !!} 
    <div class="box-body">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Company Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="company-name" name="company-name" value="{{ CommonHelper::getConfig("company-name") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Company Phone</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="company-phone" name="company-phone" value="{{ CommonHelper::getConfig("company-phone") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Company Email</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="company-email" name="company-email" value="{{ CommonHelper::getConfig("company-email") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Company Website</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="company-website" name="company-website" value="{{ CommonHelper::getConfig("company-website") }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Company Address</label>
            <div class="col-sm-8">
               <textarea class="form-control" id="company-address" name="company-address" rows="5">{{ CommonHelper::getConfig("company-address") }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Company Logo</label>
            <div class="col-sm-8">
                <input type="hidden" class="file-input-image-preview" value="{{ CommonHelper::getCompanyLogo() }}" />
                <input type="file" class="file-input-image" id="file" name="company-logo">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Currency Code</label>
            <div class="col-sm-8">
                <select name="currency-code" id="currency-code" class="select2">
                    <option selected disabled>-- Select Currency Code --</option>
                    @foreach($currencies as $key => $row)
                        @php $selected = $key == CommonHelper::getConfig("currency-code") ? 'selected' : null; @endphp
                        <option value="{{ $key }}" {{ $selected }}>{{ $row }} / {{ $key }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Time Zone</label>
            <div class="col-sm-8">
                <select name="timezone" id="timezone" class="select2">
                    <option selected disabled>-- Select Timezone --</option>
                    @foreach($timezones as $key => $row)
                        @php $selected = $key == CommonHelper::getConfig("timezone") ? 'selected' : null; @endphp
                        <option value="{{ $key }}" {{ $selected }}>{{ $key }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Default Sale Discount (%)</label>
            <div class="col-sm-8">
                <input type="number" min="0" step="any" max="100" class="form-control" id="default-discount" name="default-discount" value="{{ is_numeric(CommonHelper::getConfig("default-discount")) ? CommonHelper::getConfig("default-discount") : 0 }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Default Discount Tax (%)</label>
            <div class="col-sm-8">
                <input type="number" min="0" step="any" max="100" class="form-control" id="default-tax" name="default-tax" value="{{ is_numeric(CommonHelper::getConfig("default-tax")) ? CommonHelper::getConfig("default-tax") : 0 }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Header Invoice</label>
            <div class="col-sm-8">
                <textarea name="header-invoice">{!! CommonHelper::getConfig("header-invoice") !!}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Footer Invoice</label>
            <div class="col-sm-8">
                <textarea name="footer-invoice">{!! CommonHelper::getConfig("footer-invoice") !!}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Theme</label>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12" id="theme-section" data-selected="{{ CommonHelper::getTheme() }}"></div>
                </div>
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