function create (){
    //init validate form
    var create_form = "#create-form";
    var create_rules = {
        judul: {
            required: true,
        },
        pretty_url: {
            required: true,
        },
        short_content: {
            required: true,
        },
    };

    init_validate_form (create_form,create_rules);
}

var set_pretty_url = function () {
    //to set pretty url same as judul
    $("#judul").change(function(){
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
    init_tinymce();
    create();
    set_pretty_url();
});
