<?php
$toEmail = $_POST["key_email"];
$key =  $_POST["key"];
$admin_email = get_option('admin_email');

$subject = "Activation Key";
$header = "From: ".$admin_email."\r\n" ;
$header .= "MIME-Version: 1.0\r\n";
$message = '';
$message.= '<div style="background-color:; border-color: ;padding: 15px;border-width: 2px;border-style: solid;width:800px;margin:auto">';
$message .=     '<div style="margin-bottom: 20px;display: table;width: 100%">';
$message .=         '<h1 style="text-align:center;margin:0;margin-top: 8px;">'.$subject.'</h1>';
$message .=     '</div>';
$message .=     '<div style="padding: 8px 15px;">';
$message .=         'Your Email : ' . $_POST["key_email"];
$message .=     '</div>';
$message .=     '<div style="padding:8px 15px;">';
$message .=         'Your Key : ' . $_POST["key"];
$message .=     '</div>';
$message.= '</div>';

if(wp_mail($toEmail,$subject, $message,$header)) {
    global $wpdb;
    $table_name = $wpdb->prefix . "keygen";
    $wpdb->insert( $table_name, array('time' => current_time('mysql'),'email' => $toEmail, 'keygen' => $key, ) );

    print "<p class='success'>Mail Sent.</p>";
} else {
    print "<p class='Error'>Problem in Sending Mail.</p>";
}

?>