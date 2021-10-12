var calculate = function(){
    let subtotal = parseFloat(0);
    $(".total").each(function(){
        subtotal = parseFloat(subtotal + parseFloat($(this).val()));
    });
    let disc = parseFloat($("#discount").val()) || 0;
    let tax = parseFloat($("#tax").val()) || 0;
    let grandtotal = (parseFloat(subtotal) + parseFloat(tax)) - parseFloat(disc);
    let cash = parseFloat($("#cash").val());
    let change = parseFloat(cash) - parseFloat(grandtotal);
    $("#subtotal").val(subtotal.toFixed(2));
    $("#grandtotal, .grandtotal").val(grandtotal.toFixed(2));
    $("#change").val(change >= 0 ? change.toFixed(2) : 0);
    let total_items = 0;
    $(".qty").each(function(){
        let _qty = $(this).val();
        total_items = parseInt(total_items) + parseInt(_qty);
    });
    $(".txt-total-items").text(total_items);
}

var calculateBill = function(elem){
    let rowId = $(elem).attr("data-id");
    let qty = parseFloat($(elem).val());
    let price = parseFloat($(".price[data-id='"+rowId+"']").val());
    let total = parseFloat(qty * price) || 0;
    $(".total[data-id='"+rowId+"']").val(total.toFixed(2));
    calculate();
}

var loadProduct = function(){
    headerRequest();
    $("#loader").html('<i class="fa fa-spinner fa-spin"></i>&nbsp; Load Data...');
    let data =  {
        "type" : 2,
        "category_id" : $("#category_id").val(),
        "brand_id" : $("#brand_id").val(),
        "group_id" : $("#group_id").val(),
        "keyword" : $("#keyword").val()
    };
    $.post(BASE_URL + "/api/product/get", data, function(result) {
        if(result){
            $("#loader").html('<i class="fa fa-check"></i>&nbsp; List product have been loaded.');
            $("#product-detail-section").html(result);
        }
    });
}

var createInvoice = function(){

    let transaction = {
        "invoice_date": $("#invoice_date").val(),
        "invoice_number": $("#invoice_number").val(),
        "model_id": $("#model_id").val(),
        "supplier_id": $("#supplier_id").val(),
        "subtotal": $("#subtotal").val(),
        "discount": $("#discount").val(),
        "tax": $("#tax").val(),
        "grandtotal": $("#grandtotal").val(),
        "cash": $("#cash").val() || 0,
        "change": $("#change").val() || 0,
        "bank_id": $("#bank_id").val() || null,
        "creditcard_number": $("#creditcard_number").val() || null,
        "notes": $(".notes").val() || null,
    }

    let details = new Array();
    $(".row-product").each(function(){
        let product_id = $(this).attr("data-id");
        let product_sku = $(".product_sku[data-id='"+product_id+"']").val()
        let product_name = $(".product_name[data-id='"+product_id+"']").val()
        let price = parseFloat($(".price[data-id='"+product_id+"']").val());
        let qty = parseFloat($(".qty[data-id='"+product_id+"']").val());
        let total = parseFloat($(".total[data-id='"+product_id+"']").val());
        details.push({
            "product_id":product_id,
            "product_sku":product_sku,
            "product_name":product_name,
            "price":price,
            "qty":qty,
            "total":total,
        });
    });

    let formData = {
        "transaction": transaction,
        "details": details
    };  

    return formData;
}

var addItem = function(product){
    let html  = `
        <div id="row`+product.id+`" class="row-product" data-id="`+product.id+`">
            <div class="row">
                <div class="col-md-5">
                    <input type="hidden" name="product_id[]" value="`+product.id+`" data-id="`+product.id+`"  />
                    <input type="hidden" class="product_sku" value="`+product.sku+`" data-id="`+product.id+`"  />
                    <input type="hidden" class="product_name" value="`+product.name+`" data-id="`+product.id+`"  />
                    <input type="text" class="form-control" readonly="readonly" value="`+product.sku+` - `+product.name+`" />
                </div>
                <div class="col-md-2">
                    <input type="text" name="price[]" class="form-control price" readonly="readonly" value="`+product.price_purchase+`" data-id="`+product.id+`"/>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <a href='javascript:void(0);' class="btn btn-warning btn-minus" data-id="`+product.id+`" data-toggle='tooltip' data-placement='bottom'  data-original-title='Decrease Qty'> 
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>
                        <input type="number" name="qty[]" value="0" class="form-control text-center qty" data-id="`+product.id+`">
                        <div class="input-group-btn">
                            <a href='javascript:void(0);' class="btn btn-success btn-plus" data-id="`+product.id+`" data-toggle='tooltip' data-placement='bottom'  data-original-title='Increase Qty'>
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="text" name='total[]' class="form-control total" readonly="readonly" data-id="`+product.id+`" value="0" />
                </div>
                <div class="col-md-1">
                    <a href="javacript:void(0);" class="btn btn-danger btn-sm btn-delete-item" data-id="`+product.id+`" data-toggle='tooltip' data-placement='bottom'  data-original-title='Remove'>
                        <i class="fa fa-trash"></i>&nbsp;
                    </a>
                </div>
            </div>
            <hr>
        </div>
    `;
    $("#bill-section-list").append(html);
    $("#empty-cart").removeClass("hidden");
    calculate();
}



$(function(){


    if($("#bill-section-list").length){
        loadProduct();
        $("body").css("overflow", "hidden");
    }   
    
    $("body").on("change", "#category_id", function(e){
        e.preventDefault();
        if($(this).val()){
            loadProduct();
        }
        return false;
    });

    $("body").on("change", "#brand_id", function(e){
        e.preventDefault();
        if($(this).val()){
            loadProduct();
        }
        return false;
    });

    $("body").on("change", "#group_id", function(e){
        e.preventDefault();
        if($(this).val()){
            loadProduct();
        }
        return false;
    });

    $("body").on("click", "#btn-refresh", function(e){
        e.preventDefault();
        $("#category_id").val("").trigger("change");
        $("#brand_id").val("").trigger("change");
        $("#group_id").val("").trigger("change");
        $("#keyword").val("");
        loadProduct();
        return false;
    });

    $('#form-filter').submit(function(e){
        e.preventDefault();
        loadProduct();
        return false;
    });

    $("body").on("click", ".product-item", function(e){
        e.preventDefault();
        let _product = $(this).attr("data-product");
        let __product = atob(_product);
        let product = JSON.parse(__product);
        if($("#row"+product.id).length > 0){
            toastShow({
                "title": "Warning",
                "message": "The product already exists !!",
                "mode": "warning"
            });
        }else{
            addItem(product);
        }
        return false;
    });

    $("body").on("click", ".btn-delete-item", function(e){
        e.preventDefault();
        let id = $(this).attr("data-id");
        $("#row"+id).remove();
        if($(".row-product").length == 0){
            $("#empty-cart").addClass("hidden");
        }
        calculate();
        return false;
    });

    $("body").on("click", "#empty-cart", function(e){
        e.preventDefault();
        $("#bill-section-list").empty();
        $(this).addClass("hidden");
        calculate();
        return false;
    });

    $("body").on("keyup",".qty", function(e){
        e.preventDefault();
        calculateBill(this);
        calculate();
        return false;
    });

    $("body").on("click", ".btn-minus", function(e){
        e.preventDefault();
        let id = $(this).attr("data-id");
        let current = $(".qty[data-id='"+id+"']").val() || 0;
        if(parseInt(current) > 0){
            let minus = parseInt(current) - 1;
            $(".qty[data-id='"+id+"']").val(minus);
        }
        calculateBill($(".qty[data-id='"+id+"']"));
        calculate();
        return false;
    });

    $("body").on("click", ".btn-plus", function(e){
        e.preventDefault();
        let id = $(this).attr("data-id");
        let current = $(".qty[data-id='"+id+"']").val() || 0;
        let add = parseInt(current) + 1;
        $(".qty[data-id='"+id+"']").val(add);
        calculateBill($(".qty[data-id='"+id+"']"));
        calculate();
        return false;
    });

    $("body").on("click", ".to-checkout", function(e){
        e.preventDefault();
        let supplier_id = $("#supplier_id").val();
        let grandtotal = parseFloat($("#grandtotal").val());
        let isZero = 0;
        $(".qty").each(function(){
            let qt = $(this).val();
            if(parseInt(qt) <= 0){
                isZero = isZero + 1;
            }
        });
        if(!supplier_id){
            toastShow({
                "title": "Warning",
                "message": "The supplier field is required !!",
                "mode": "warning"
            });
        }else if(isZero > 0){
            toastShow({
                "title": "Warning",
                "message": "The qty total cannot zerro !!",
                "mode": "warning"
            });
        }else if(grandtotal <= 0){
            toastShow({
                "title": "Warning",
                "message": "The grand total cannot <= 0 !!",
                "mode": "warning"
            });
        }else{
           let invoice = createInvoice(); 
           let invoiceURL = BASE_URL+"/transaction/invoice/"+invoice.transaction.model_id+"/"+(btoa(JSON.stringify(invoice)));
           $(".iframe-invoice").attr("src", invoiceURL);
           return true;
        }
        return false;
    });

    $("body").on("click", "#btn-refresh-preview", function(e){
        e.preventDefault();
        calculate();
        let invoice = createInvoice(); 
        let invoiceURL = BASE_URL+"/transaction/invoice/"+invoice.transaction.model_id+"/"+(btoa(JSON.stringify(invoice)));
        $(".iframe-invoice").attr("src", invoiceURL);
        return false;
    });

    $("body").on("keyup","#cash", function(e){
        e.preventDefault();
        calculate();
        return false;
    });

    $("body").on("keyup","#discount", function(e){
        e.preventDefault();
        calculate();
        return false;
    });

    $("body").on("keyup","#tax", function(e){
        e.preventDefault();
        calculate();
        return false;
    });

    $("body").on("click", "#btn-checkout-cash", function(e){
        e.preventDefault();
        let cash = $("#cash").val();
        let grandtotal = $("#grandtotal").val();
        if(parseFloat(cash) < parseFloat(grandtotal)){
            toastShow({
                "title": "Warning",
                "message": "The cash in hand must be >= "+grandtotal+" !!",
                "mode": "warning"
            });
        }else{
            swal({
                title: "Confirmation",
                text: "Are you sure you want to save this transaction ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f8b32d",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false
            }, function() {
                calculate();
                let invoice = createInvoice(); 
                $("#data-invoice").val(btoa(JSON.stringify(invoice)));
                if($("#data-invoice")){
                    $("#form-submit-invoice").submit();
                }
            });
        }
        return false;
    });

    $("body").on("click", "#btn-checkout-credit", function(e){
        e.preventDefault();
        let creditcard_number = $("#creditcard_number").val();
        let bank_id = $("#bank_id").val();
        if(!creditcard_number){
            toastShow({
                "title": "Warning",
                "message": "The credit card field is required.",
                "mode": "warning"
            });
        }else if(!bank_id){
            toastShow({
                "title": "Warning",
                "message": "The bank field is required.",
                "mode": "warning"
            });
        }else{
            swal({
                title: "Confirmation",
                text: "Are you sure you want to save this transaction ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f8b32d",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false
            }, function() {
                calculate();
                let invoice = createInvoice(); 
                $("#data-invoice").val(btoa(JSON.stringify(invoice)));
                if($("#data-invoice")){
                    $("#form-submit-invoice").submit();
                }
            });
        }
        return false;
    });

    $("body").on("click", "#btn-print-invoice", function(e){
        e.preventDefault();
        let url = $(this).attr("data-href");
        $("#iframe-invoice").attr("src", url);
        $("#myModal").modal("show");
    });

});

$(window).resize(function() {
    var window_height = $(window).height();
    var size1 = window_height - ((window_height / 100) * 50.8);   
    var size2 = window_height - ((window_height / 100) * 54); 
    $("#product-detail-section").slimscroll({
        height: size1+"px",
    });
    $("#bill-section-list").slimscroll({
        height: size2+"px",
    });
});

$(window).trigger('resize');