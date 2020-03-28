var create = function (){
    //init validate form
    var create_form = "#create-form";
    var create_rules = {
        name: {
            required: true,
        },
        pretty_url : {
            required: true
        },
        description : {
            required : true,
        },
        product_category_id : {
            required : true,
        },
        show_in_filter : {
            required : true,
        }
    };

    init_validate_form (create_form,create_rules);
};

var set_pretty_url = function () {
    //to set pretty url same as title
    $("#name").change(function(){
        var myStr = $(this).val();
        myStr=myStr.toLowerCase();
        myStr=myStr.replace(/[^a-z\d]+/gi, "-");
        $("#pretty_url").val(myStr);
    });

    //replace all space to - in pretty_url
    $("#pretty_url").change(function(){
        var myStr = $(this).val();
        myStr=myStr.toLowerCase();
        myStr=myStr.replace(/[^a-z\d]+/gi, "-");
        $("#pretty_url").val(myStr);
    });
}

// Untuk reset rating menjadi 0
function reset_rating () {
    $("#reset-kualitas").click(function () {
        $('.kualitas').removeAttr("checked");
    });

    $("#reset-harga").click(function () {
        $('.harga').removeAttr("checked");
    });
}

$(document).ready(function() {
    $("#addimage").click(function (){
        var image_size = $(this).data("maxsize");
        var words_max_upload = $(this).data("maxwords");
        imageCropper ({
            target_form_selector : "#create-form",
            file_input_name : "image-url",
            data_crop_name : "data-image",
            image_ratio : 325/400,
            button_trigger_selector : "#addimage",
            image_preview_selector : "#preview-image",
            placeholder_path : "/img/placeholder/325x400.png",
            max_file_size : image_size,
            words_max_file_size : words_max_upload,
        } );
    });

    create();
    set_pretty_url();
    init_tinymce();
    reset_rating();
    
    $(".select2_tags").select2({
        tags: true,
        tokenSeparators: [',']
    })
});

$('.select2_tags').on("change.select2", function(e) {
   $("#tags").val($(".select2_tags").val());
});


$(document).on("click", "#delete_msds", function(e) {
    e.stopPropagation();
    e.preventDefault();
    var url = '/manager/product/products/delete_file';
    var data_id = $(this).attr("data-id");
    
    title = 'Delete Confirmation';
    content = 'Do You Really Want to Delete This TDS FILE ?';
    
    swal({
        title: title,
        text: content,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "NO",
        confirmButtonText: "YES",
    }).then(function (text) {

        //show loading.
        $('.loading').css("display", "block");

        //ajax post.
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            dataType: 'json',
            data : {
                id:data_id, type:2
            },
            success: function(data) {
                if (data.is_error == true) swal("Error!", data.error_msg, "error");
                $(".file_tech_div").remove();
            },
            error: function() {
                swal("Error!", "Something Went wrong", "error");
            }
        });
    }).catch(swal.noop);
});

$(document).on("click", "#delete_tech", function(e) {
    e.stopPropagation();
    e.preventDefault();
    var url = '/manager/product/products/delete_file';
    var data_id = $(this).attr("data-id");
    
    title = 'Delete Confirmation';
    content = 'Do You Really Want to Delete This TDS FILE ?';
    
    swal({
        title: title,
        text: content,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "NO",
        confirmButtonText: "YES",
    }).then(function (text) {

        //show loading.
        $('.loading').css("display", "block");

        //ajax post.
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            dataType: 'json',
            data : {
                id:data_id, type:1
            },
            success: function(data) {
                if (data.is_error == true) swal("Error!", data.error_msg, "error");
                $(".file_tech_div").remove();
            },
            error: function() {
                swal("Error!", "Something Went wrong", "error");
            }
        });
    }).catch(swal.noop);
});
