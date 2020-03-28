var create = function (){
    //init validate form
    var create_form = "#create-form";
    var create_rules = {
        question: {
            required: true
        },
        start_date: {
            required: true
        },
        end_date: {
            required: true
        }
    };

    init_validate_form (create_form,create_rules);
}

$(document).ready(function() {
    $("#start_date").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 2,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        onClose: function (selectedDate) {
            $("#end_date").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#end_date").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 2,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        onClose: function (selectedDate) {
            // $("#available_to_date").datepicker("option", "minDate", selectedDate);
        }
    });

    create();
});
