function do_edit(id){
        $.ajax({
            url: '<?= base_url() ?>AIC/get_detail/'+id,
            type: 'POST',
            dataType: 'json',
            success:function(data){ 

                list_to_form();
                $("#id").val(data.id);
                $("#i_header").val(data.header);
                $("#i_desc").val(data.description);
                $("#img_preview").attr('src' , '<?= base_url() ?>assets/picture/pic_aic/'+data.picture);

                $("#btn-submit").hide();
                $("#btn-edit").show();

        }
});


$(document).ready(function() {
        
       	do_edit(1);
        $(".head").attr('readonly' , true);
 
});