<!-- Default box -->
<div class="box {{ CommonHelper::getBoxTheme() }}">
    <div class="box-header with-border">
        <div class="clearfix">
            <div class="pull-left">
                <h3 class="box-title">
                    <i class="fa fa-cube"></i>&nbsp;Detail Product
                </h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-info btn-sm" href="javacsript:void(0);" id="btn-refresh" data-toggle='tooltip' data-placement='top'  data-original-title='Reset Filter'>
                    <i class="fa fa-refresh"></i>&nbsp;Reset Filter
                </a>
            </div>
        </div>
    </div>
    <div class="box-body">
       <form id="form-filter">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Filter By Category</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <option value="" disabled selected>-- Select Category ---</option>
                        {{ CommonHelper::getOptionCategories() }}
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Filter By Brand</label>
                    {!! Form::select('brand_id', $brands->pluck('name','id'), null, ['id'=>'brand_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Brand ---']) !!}
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-6">
                    <label for="">Filter By Group</label>
                    {!! Form::select('group_id', $groups->pluck('name','id'), null, ['id'=>'group_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Group ---']) !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="">Filter By Keyword</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="keyword" placeholder="Enter your keyword..">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
       </form>
       <h1></h1>
       <div id="product-detail-section"></div>
    </div>
    <div class="box-footer">
        <span id="loader"></span>
    </div>
</div><!-- /.box -->