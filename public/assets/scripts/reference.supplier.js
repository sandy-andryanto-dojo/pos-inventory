$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'supplier_name',
            name: 'suppliers.name'
        },
        {
            data: 'supplier_email',
            name: 'suppliers.email'
        },
        {
            data: 'supplier_phone',
            name: 'suppliers.phone'
        },
        {
            data: 'supplier_address',
            name: 'suppliers.address'
        },
        {
            data: 'key_id',
            name: 'suppliers.id',
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