$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'stakeholder_name',
            name: 'stakeholders.name'
        },
        {
            data: 'stakeholder_email',
            name: 'stakeholders.email'
        },
        {
            data: 'stakeholder_phone',
            name: 'stakeholders.phone'
        },
        {
            data: 'stakeholder_address',
            name: 'stakeholders.address'
        },
        {
            data: 'key_id',
            name: 'stakeholders.id',
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