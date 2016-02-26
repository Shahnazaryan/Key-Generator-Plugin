function randomPassword(length)
{
    chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    pass = "";
    for(x=0;x<length;x++)
    {
        i = Math.floor(Math.random() * 62);
        pass += chars.charAt(i);
    }
    return pass;
}
function formSubmit()
{
    passform.passbox.value = randomPassword(passform.length.value);
    return false;
}


jQuery(document).ready(function($){
    function validateContact() {
        var valid = true;

        if(!jQuery("#passbox").val()) {
            jQuery("#passbox-info").html("(required)");
            jQuery("#passbox").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!jQuery("#key_email").val()) {
            jQuery("#key_email-info").html("(required)");
            jQuery("#key_email").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!jQuery("#key_email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            jQuery("#key_email-info").html("(invalid)");
            jQuery("#key_email").css('background-color','#FFFFDF');
            valid = false;
        }

        return valid;
    }

    jQuery('#key_form').submit(function() {
        var valid;
        valid = validateContact();
        if(valid) {
            jQuery.post(
                ajaxurl, {
                    action: 'key_generator_ajax',
                    key: jQuery("#passbox").val(),
                    key_email:jQuery("#key_email").val(),
                },
                function(data){
                    jQuery("#mail-status").html(data);
                    jQuery("#key_email").val('');
                    jQuery("#passbox").val('');
                }
            );
        }
        return false;
    });

});