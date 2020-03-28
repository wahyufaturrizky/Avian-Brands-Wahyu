var lists = function () {
    var table_id = "#dataTable";
    var ajax_source = "/manager/polling/list-all-data/";
    var sorting = [
        [0, "asc"]
    ];
    var columns = [
        { "data": "id_polling" },
        { "data": "question" },
        { "data": "start_date",
            "render":function(data, type, full) {
                if (data != null && data != "") {
                    return moment(data).format("DD MMMM YYYY");
                }

                return "";
            }
        },
        { "data": "end_date",
            "render":function(data, type, full) {
                if (data != null && data != "") {
                    return moment(data).format("DD MMMM YYYY");
                }

                return "";
            }
        },
        { "data": "is_show_name" },
        {
            "class": "center",
            "data": null,
            "sortable": false,
            "render": function(data, type, full) {
                var edit =  '<center><td>';

                edit += ' <a href="/manager/polling/edit/' + full.id_polling + '" class="btn btn-primary btn-circle" rel="tooltip" title="Edit Polling" data-placement="left" ><i class="fa fa-pencil"></i></a>';

                edit +=  ' <a href="/manager/polling/answers/' + full.id_polling + '" class="btn btn-info btn-circle" rel="tooltip" title="List Jawaban" data-placement="top" ><i class="fa fa-list"></i></a>';

                edit +=  '</td></center>';
                return edit;
            }
        },
    ];
    init_datatables (table_id, ajax_source, columns);
    setup_daterangepicker(".date-range-picker");

    $(document).on("popup-confirm:success", function (e, url, data_id){
        $("#dataTable").dataTable().fnClearTable();
    });
};

$(document).ready(function() {
    lists();
});
