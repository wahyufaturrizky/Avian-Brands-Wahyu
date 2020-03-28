$(document).ready(function() {
    lists();
});

function lists () {
    var table_id = "#dataTable";
    var ajax_source = "/manager/csr/csr-artikel/list-all-data/";
    var sorting = [
        [0, "desc"]
    ];
    var columns = [
        { "data": "id" },
        { "data": "judul" },
        { "data": "short_content" },
        { "data": "is_show_name" },
        {
            "class": "center",
            "data": null,
            "sortable": false,
            "render": function(data, type, full) {
                var edit =  '<center><td>';
                    edit +=  ' <a href="/manager/csr/csr-artikel/edit/' + full.id + '" class="btn btn-primary btn-circle" rel="tooltip" title="Edit CSR Artikel" data-placement="top" ><i class="fa fa-pencil"></i></a>';
                    edit +=  '</td></center>';
                return edit;
            }
        },
    ];
    init_datatables (table_id, ajax_source, columns, ['.filter-this'], sorting);
    setup_daterangepicker(".date-range-picker");
};
