// Export
var goExport = function (){
    //init validate form org
    var create_form = "#form";

    init_validate_form (create_form);
};

var lists = function () {
    var table_id = "#dataTable";
    var ajax_source = "/manager/country/list_all_data";
    var columns = [
        { "data": "id" },
        { "data": "name" },
        { "data": "is_show_name" },
        {
            "class": "center",
            "data": null,
            "sortable": false,
            "render": function(data, type, full) {
                var edit =  '<td>';
                    if (full.is_show == "1") {
                    edit +=  ' <a href="/manager/country/edit/' + full.id + '" class="btn btn-primary btn-circle" rel="tooltip" title="Edit Country" data-placement="top" ><i class="fa fa-pencil"></i></a>' +
                             ' <a href="/manager/country/delete" data-id ="' + full.id + '" data-name ="' + full.name + '" class="btn btn-danger btn-circle delete-confirm" rel="tooltip" title="Delete Country" data-placement="top" ><i class="fa fa-trash-o"></i></a>';
                            } else {
                    edit +=  ' <a href="/manager/country/reactivate" data-id ="' + full.id + '" data-name ="' + full.name + '" class="btn btn-danger btn-circle reactivate-confirm" rel="tooltip" title="Reactivate Country" data-placement="top" ><i class="fa fa-power-off"></i></a>';
                            }
                    edit +=  '</td>';

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

    $(document).on("click", ".reactivate-confirm", function(e) {
        e.stopPropagation();
        e.preventDefault();
        var url = $(this).attr("href");
        var data_id = $(this).data("id");
        var data_name = $(this).data("name");

        title = 'Re-activate Confirmation';
        content = 'Do you really want to re-activate ' + data_name + ' ?';

        popup_confirm (url, data_id, title, content);

    });

    $(document).on("popup-confirm:success", function (e, url, data_id){
        $("#dataTable").dataTable().fnClearTable();
    });
};

$(document).ready(function() {
    lists();
    goExport();

    $(document).ready(function() {
        var $a = $("<a>");

        // goExport();

        $(document).on("form-submit:success", function(e, form , data) {
            $a.attr("href",data.file_data);
            $("body").append($a);
            $a.attr("download",data.filename + ".xlsx");
            $a[0].click();
            $a.remove();
        } );

    });
});
