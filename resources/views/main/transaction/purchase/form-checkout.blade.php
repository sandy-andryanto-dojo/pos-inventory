<div class="nav-tabs-custom nav-{{ CommonHelper::getTheme() }}">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1x" data-toggle="tab"><i class="fa fa-money"></i>&nbsp; Petty Cash</a></li>
        <li><a href="#tab_2x" data-toggle="tab"><i class="fa fa-credit-card"></i>&nbsp; Credit Card</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1x">
            <form>
               <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Total Paid</label>
                        <input type="text" class="grandtotal form-control" readonly="readonly" value="{{ $model->grandtotal }}" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Cash in hand</label>
                        <input type="number" class="form-control" id="cash" name="cash"  value="0" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Change</label>
                        <input type="text" id="change" name="change" class="grandtotal form-control" readonly="readonly" value="{{ $model->change }}" />
                    </div>
               </div>
               <div class="row">
                    <div class="form-group col-md-8">
                        <label for="">Notes</label>
                        <textarea class="form-control notes" name="notes" rows="4"></textarea>
                    </div>
                    <div class="form-group col-md-4 text-right">
                        <label for="" class="hidden">Actions</label>
                        <a class="btn btn-primary btn-sm" id="btn-refresh-preview" data-toggle='tooltip' data-placement='top'  data-original-title='Preview Invoice'>
                            <i class="fa fa-print"></i>&nbsp;Preview Invoice
                        </a>
                        <button type="submit" class="btn btn-success btn-sm" id="btn-checkout-cash" data-toggle='tooltip' data-placement='top'  data-original-title='Finish & Save'>
                            <i class="fa fa-check"></i>&nbsp;Finish & Save
                        </button>
                    </div>
                    <hr>
                    <div class="form-group col-md-12">
                        <label for="">Preview Invoice</label>
                        <div class="preview-invoice">
                            <iframe class="embed-responsive-item iframe-invoice"  style="width:100%; height:320px;"  src="{{ route('invoice.loader') }}"></iframe>
                        </div>
                    </div>
               </div>
            </form>
        </div>
        <div class="tab-pane" id="tab_2x">
            <form>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Total Paid</label>
                        <input type="text" class="grandtotal form-control" readonly="readonly" value="{{ $model->grandtotal }}" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Credit Card Number</label>
                        <input type="text" class="form-control" id="creditcard_number" name="creditcard_number" required="required" value="{{ $model->creditcard_number }}" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Bank</label>
                        {!! Form::select('bank_id', $banks->pluck('name','id'), null, ['id'=>'bank_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Bank ---']) !!}
                    </div>
               </div>
               <div class="row">
                    <div class="form-group col-md-8">
                        <label for="">Notes</label>
                        <textarea class="form-control" name="notes"  rows="4"></textarea>
                    </div>
                    <div class="form-group col-md-4 text-right">
                        <label for="" class="hidden">Actions</label>
                        <a class="btn btn-primary btn-sm" id="btn-refresh-preview" data-toggle='tooltip' data-placement='top'  data-original-title='Preview Invoice'>
                            <i class="fa fa-print"></i>&nbsp;Preview Invoice
                        </a>
                        <button type="submit" class="btn btn-success btn-sm" id="btn-checkout-credit" data-toggle='tooltip' data-placement='top'  data-original-title='Finish & Save'>
                            <i class="fa fa-check"></i>&nbsp;Finish & Save
                        </button>
                    </div>
                    <hr>
                    <div class="form-group col-md-12">
                        <label for="">Preview Invoice</label>
                        <div class="preview-invoice">
                            <iframe class="embed-responsive-item iframe-invoice"  style="width:100%; height:320px;"  src="{{ route('invoice.loader') }}"></iframe>
                        </div>
                    </div>
               </div>
            </form>
        </div>
    </div>
</div>