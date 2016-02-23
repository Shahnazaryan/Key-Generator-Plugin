<?php
function keygen_activation(){}
/**
 * Register a keygen menu page.
 */
function wpdocs_register_key_gen_menu_page(){
    add_menu_page(
        __( 'Key Generator', 'textdomain' ),
        'Key Generator',
        'manage_options',
        'genarator',
        'key_gen_menu_page',
        plugins_url('/key-generator/lib/img/SafeWalletLogo.png'),
        6
    );
}
add_action( 'admin_menu', 'wpdocs_register_key_gen_menu_page' );

/**
 * Display a custom menu page
 */
function key_gen_menu_page(){
    echo '  <SCRIPT LANGUAGE="JavaScript">
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
            </script>

            <table align="center" border="1">
            <tr>
            <td valign="middle" align="center">
            <center>Key Generator</center>
            <form name="passform">
                <input type="hidden" name="length" value="20">
            <p>
                Key: <input name="passbox" type="text" size="50" tabindex="1"></p>
            <p>
            <input type="button" value="Generate" onClick="javascript:formSubmit()" tabindex="2"><input type="reset" value="Clear" tabindex="3"></p>
            </form>
            </td>
            </tr>
            </table>';

	
}

function keygen_deactivation(){
	
	
}