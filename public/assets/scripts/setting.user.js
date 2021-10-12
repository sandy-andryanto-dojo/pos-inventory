$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'user_username',
            name: 'users.username'
        },
        {
            data: 'user_email',
            name: 'users.email'
        },
        {
            data: 'user_phone',
            name: 'users.phone'
        },
        {
            data: 'user_is_confirm',
            name: 'users.is_confirm',
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
            name: 'users.id',
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