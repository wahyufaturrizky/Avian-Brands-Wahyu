var create = function (){
    //init validate form
    var create_form = "#create-form";
    var create_rules = {
        name: {
            required: true,
        },
        sub_title: {
            required: true,
        },
        description : {
            required: true
        }
    };

    init_validate_form (create_form,create_rules);
};


var set_pretty_url = function () {
    //to set pretty url same as name
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

$(document).ready(function() {
    create();
    set_pretty_url();


    $("#addimagelarge").click(function (){
        var image_size = $(this).data("maxsize");
        var words_max_upload = $(this).data("maxwords");
        imageCropper ({
            target_form_selector : "#create-form",
            file_input_name : "image-file-large",
            data_crop_name : "data-image",
            image_ratio : 850/300,
            button_trigger_selector : "#addimagelarge",
            image_preview_selector : "#preview-image-large",
            placeholder_path : "/img/placeholder/850x300.png",
            max_file_size : image_size,
            words_max_file_size : words_max_upload,
        } );
    });

    $("#addimageurl").click(function (){
        var image_size = $(this).data("maxsize");
        var words_max_upload = $(this).data("maxwords");
        imageCropper ({
            target_form_selector : "#create-form",
            file_input_name : "image-file",
            data_crop_name : "data-image-url",
            image_ratio : 274/274,
            button_trigger_selector : "#addimageurl",
            image_preview_selector : "#preview-image-url",
            placeholder_path : "/img/placeholder/274x274.png",
            max_file_size : image_size,
            words_max_file_size : words_max_upload,
        } );
    });

});
