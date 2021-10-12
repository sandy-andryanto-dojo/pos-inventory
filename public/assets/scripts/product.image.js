$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'product_path',
            name: 'products_images.path',
            render: function(data, type, row, meta) {
                return "<img src='"+BASE_URL+"/"+data+"'  class='img-responsive img-thumbnail' >";
            }
        },
        {
            data: 'product_sku',
            name: 'products.sku'
        },
        {
            data: 'product_name',
            name: 'products.name'
        },
        {
            data: 'product_is_primary',
            name: 'products_images.is_primary',
            render: function(data, type, row, meta) {
                if (parseInt(data) === 1) {
                    return '<span class="label label-success">Yes</span></td>';
                } else {
                    return '<span class="label label-danger">No</span></td>';
                }
            }
        },
        {
            data: 'key_id',
            name: 'products_images.id',
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

    

});