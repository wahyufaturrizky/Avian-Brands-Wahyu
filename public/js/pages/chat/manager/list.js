$(document).ready(function() {
    lists();
});

function lists () {
    var table_id = "#dataTable";
    var ajax_source = "/manager/chat/list-all-data/";
    var sorting = [
        [2, "asc"]
    ];
    var columns = [
        { "data": "id" },
        { "data": "name" },
        { "data": "updated_date" },
        {
            "data": "is_read",
            "render": function(data, type, full) {
                if (data == 1) {
                    return "Unread";
                }

                return "Read";
            }
        },
        {
            "class": "center",
            "data": null,
            "sortable": false,
            "render": function(data, type, full) {
                var edit =  '<center><td>';
                    edit +=  ' <a href="/manager/chat/reply/' + full.id + '" class="btn btn-primary btn-circle" rel="tooltip" title="View / Reply Chat" data-placement="top" ><i class="fa fa-reply"></i></a>';
                    edit +=  '</td></center>';
                return edit;
            }
        },
    ];
    init_datatables (table_id, ajax_source, columns, ['.filter-this'], sorting);
    // setup_daterangepicker(".date-range-picker");
    //
    // $(document).on("click", ".delete-confirm", function(e) {
    //     e.stopPropagation();
    //     e.preventDefault();
    //     var url = $(this).attr("href");
    //     var data_id = $(this).data("id");
    //
    //     title   = 'Delete Confirmation';
    //     content = 'Do you really want to delete this CSR ?';
    //
    //     popup_confirm (url, data_id, title, content);
    //
    // });
    //
    // $(document).on("popup-confirm:success", function (e, url, data_id){
    //     $("#dataTable").dataTable().fnClearTable();
    // });
};
