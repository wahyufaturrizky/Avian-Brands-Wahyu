var lists = function () {
    var table_id = "#dataTable";
    var ajax_source = "/manager/product/products/list_all_data";
    var order_data = $("#order_data").val().split(",");
    var sorting = [
        [3, "asc"]
    ];
    var columns = [
        { "data": "id" },
        { "data": "name"},
        { "data": "category" },
        {
            "data": "ordering",
            "render":function(data, type, full) {
                var ord = '<td>' +
                    '<select class="form-control order_data" data-id="'+full.id+'">';
                        $.each (order_data , function (key , val_order) {
                    ord += '<option value="'+ val_order.trim() +'"';
                        if (parseInt(val_order) == parseInt(data)) {
                    ord += ' selected="selected"';
                        }
                    ord +='>'+ val_order.trim() +'</option>';
                        });

                    ord += '</select>' +
                '</td>';


                return ord;
            }
        },
        { "data": "is_show_name" },
        { "data": "show_in_name" },
        {
            "class": "center",
            "data": null,
            "sortable": false,
            "render": function(data, type, full) {
                var edit =  '<td>';
                    edit +=  ' <a href="/manager/product/products/edit/' + full.id + '" class="btn btn-primary btn-circle" rel="tooltip" title="Edit Product" data-placement="top" ><i class="fa fa-pencil"></i></a>';
                    edit +=  ' <a href="/manager/product/products/delete" data-id ="' + full.id + '" data-name ="' + full.name + '" class="btn btn-danger btn-circle delete-confirm" rel="tooltip" title="Delete Product" data-placement="top" ><i class="fa fa-trash-o"></i></a>';
                    edit +=  ' <a href="/manager/product/products/video/' + full.id + '" class="add-video btn btn-info btn-circle" title="add product video"><i class="fa fa-youtube"></i></a>'
                    edit +=  ' </td>';

                return edit;
            }
        },
    ];
    init_datatables (table_id, ajax_source, columns, [".filter-this"] , sorting);

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

    $(document).on("change", ".order_data", function(e) {
		e.stopPropagation();
		e.preventDefault();
		var url = "/manager/product/products/ordering";
		var data_id = $(this).attr("data-id");
		var data_value = $(this).val();

		$.ajax({
			type: "post",
			url: url,
			cache: false,
			data: {id: data_id, val:data_value},
			dataType:'json',
			success: function(data) {
				if (data.is_error == true) swal("Error!", data.error_msg, "error");
				$("#dataTable").dataTable().fnClearTable();
			},
			error: function() {
				swal("Error!", "Something Went wrong", "error");
			}
		});

		// console.log(data_id);
	});
});
