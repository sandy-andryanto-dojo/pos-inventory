$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'category_name',
            name: 'categories.name'
        },
        {
            data: 'category_description',
            name: 'categories.description'
        },
        {
            data: 'key_id',
            name: 'categories.id',
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