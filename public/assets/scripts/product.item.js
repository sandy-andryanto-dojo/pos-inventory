$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'product_sku',
            name: 'products.sku'
        },
        {
            data: 'product_name',
            name: 'products.name'
        },
        {
            data: 'brand_name',
            name: 'brands.name'
        },
        {
            data: 'category_name',
            name: 'categories.name'
        },
        {
            data: 'group_name',
            name: 'groups.name'
        },
        {
            data: 'product_stock',
            name: 'products.stock'
        },
        {
            data: 'product_price_purchase',
            name: 'products.price_purchase',
            render: function(data, type, row, meta) {
                return (data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }
        },
         {
            data: 'product_price_sale',
            name: 'products.price_sale',
            render: function(data, type, row, meta) {
                return (data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }
        },
        {
            data: 'key_id',
            name: 'products.id',
            orderable: false,
            searchable: false,
            render: function(data, type, row, meta) {
                return dataTableRenderButton(row, route_crud, data_model, permissions);
            }
        }
    ];

    dataTableRender({
        "container": container,
        "route_crud": route_crud,
        "columns": dataTableColumns,
        "model": data_model
    });

    var calcPriceSale = function(){
        let purchase = parseFloat($("#price_purchase").val());
        let profit =   parseFloat($("#price_profit").val());
        let prc = parseFloat(profit / 100);
        let cost = purchase * prc;
        let priceSale = purchase + cost;
        $("#price_sale").val(priceSale || purchase);
    }

    $('#price_purchase').keyup(function() {
        calcPriceSale();
    });

    $('#price_profit').keyup(function() {
        calcPriceSale();  
    });

    let categorySelected = $("#category_id").attr("data-selected");
    if(categorySelected){
        $("#category_id option[value='" + categorySelected + "']").removeAttr("disabled");
        $("#category_id").val(categorySelected).change();
    }

});