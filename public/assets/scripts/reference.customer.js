$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'customer_name',
            name: 'customers.name'
        },
        {
            data: 'customer_email',
            name: 'customers.email'
        },
        {
            data: 'customer_phone',
            name: 'customers.phone'
        },
        {
            data: 'customer_address',
            name: 'customers.address'
        },
        {
            data: 'key_id',
            name: 'customers.id',
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