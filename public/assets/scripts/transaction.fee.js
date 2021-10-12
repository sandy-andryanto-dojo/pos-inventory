$(document).ready(function(){
   
    let tp = 3;
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'created_at',
            name: 'transactions.created_at'
        },
        {
            data: 'invoice_number',
            name: 'transactions.invoice_number'
        },
        {
            data: 'username',
            name: 'users.username',
            render: function(data, type, row, meta) {
                let fullName = row.first_name+" "+row.last_name;
                let username = row.username;
                if(fullName.length > 0){
                    return fullName;
                }else{
                    return username;
                }
            }
        },
        {
            data: 'stakeholder_name',
            name: 'stakeholders.name',
            render: function(data, type, row, meta) {
                return data ? data : "Unknown";
            }
        },
        {
            data: 't_notes',
            name: 'transactions.notes'
        },
        {
            data: 't_description',
            name: 'transactions.description'
        },
        {
            data: 'grandtotal',
            name: 'transactions.grandtotal',
            render: function(data, type, row, meta) {
                return (data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }
        },
        {
            data: 'key_id',
            name: 'transactions.id',
            orderable: false,
            searchable: false,
            render: function(data, type, row, meta) {
                return dataTableRenderButton(row, route_crud, data_model, permissions);
            }
        }
    ];

    dataTableRender({
        "customUrl": BASE_URL+"/api/datatable/transaction/"+tp,
        "container": container,
        "route_crud": route_crud,
        "columns": dataTableColumns,
        "model": data_model
    });
});

