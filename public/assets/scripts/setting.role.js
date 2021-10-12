$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'role_name',
            name: 'roles.name'
        },
        {
            data: 'role_description',
            name: 'roles.description'
        },
        {
            data: 'key_id',
            name: 'roles.id',
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

    if($(".permission-section").length){
        $(".checked_all").change(function(e) {
            e.preventDefault();
            let checkedVal = $(this).val();
            $('input:checkbox.'+checkedVal).not(this).prop('checked', this.checked).change();
            return false;
        });
    }

    if($(".detail-permission").length){
        $(".detail-permission input:checkbox:checked").replaceWith("<i class='fa fa-check'></i>&nbsp;");
        $(".detail-permission input:checkbox(:checked)").replaceWith("<i class='fa fa-close'></i>&nbsp;");
        $(".detail-permission").removeClass("hidden");
    }

});