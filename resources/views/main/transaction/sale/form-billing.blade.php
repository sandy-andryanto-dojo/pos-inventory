<div class="nav-tabs-custom nav-{{ CommonHelper::getTheme() }}">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_1" data-toggle="tab">
                <i class="fa fa-edit"></i>&nbsp; Detail Invoice
            </a>
        </li>
        <li><a href="#tab_2" class="to-checkout" data-toggle="tab"><i class="fa fa-money"></i>&nbsp; Checkout</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            @include('main.transaction.sale.form-detail-invoice')
        </div>
        <div class="tab-pane" id="tab_2">
            @include('main.transaction.sale.form-checkout')
        </div>
    </div>
</div>