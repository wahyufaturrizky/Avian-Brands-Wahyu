var lists = function () {
    var table_id = "#dataTable";
    var ajax_source = "/manager/polling/list-all-data-answer/" + poll_id;
    var sorting = [
        [0, "asc"]
    ];
    var columns = [
        { "data": "id_polling_answer" },
        { "data": "answer" },
        { "data": "score" },
        {
            "class": "center",
            "data": null,
            "sortable": false,
            "render": function(data, type, full) {
                var edit =  '<center><td>';

                edit += ' <a href="/manager/polling/edit_answer/' + full.id_polling_answer + '" class="btn btn-primary btn-circle" rel="tooltip" title="Edit Answer" data-placement="left" ><i class="fa fa-pencil"></i></a>';

                edit +=  ' <a href="/manager/polling/delete_answer" data-id ="' + full.id_polling_answer + '" data-name ="' + full.answer + '" class="btn btn-danger btn-circle delete-confirm" rel="tooltip" title="Delete Answer" data-placement="top" ><i class="fa fa-trash-o"></i></a>';

                edit +=  '</td></center>';
                return edit;
            }
        },
    ];
    init_datatables (table_id, ajax_source, columns);

    $(document).on("click", ".delete-confirm", function(e) {
        e.stopPropagation();
        e.preventDefault();
        var url = $(this).attr("href");
        var data_id = $(this).data("id");
        var data_name = $(this).data("name");

        title = 'Delete Confirmation';
        content = 'Do you really want to delete ' + data_name + ' ?';

        popup_confirm (url, data_id, title, content);

    });

    $(document).on("popup-confirm:success", function (e, url, data_id){
        $("#dataTable").dataTable().fnClearTable();
    });
};

$(document).ready(function() {
    lists();
});
