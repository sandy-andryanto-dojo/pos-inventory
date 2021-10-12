$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'created_at',
            name: 'audits.created_at'
        },
        {
            data: 'username',
            name: 'users.username'
        },
        {
            data: 'event',
            name: 'audits.event'
        },
        {
            data: 'url',
            name: 'audits.url'
        },
        {
            data: 'ip_address',
            name: 'audits.ip_address'
        },
        {
            data: 'user_agent',
            name: 'audits.user_agent'
        },
    ];

    dataTableRender({
        "container": container,
        "route_crud": route_crud,
        "columns": dataTableColumns,
        "model": data_model
    });

});