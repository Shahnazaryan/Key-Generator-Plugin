<?php
/*
*Plugin Name: Key Generator
*Plugin URI: http://shahumyanmedia.com
*Description: Key Generator.
*Version:  1.0
*Author: Gev
*Author URI: http://shahumyanmedia.com
*Text Domain: key-generator
*License: GPLv3
*License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

define('KEYGEN_DIR', plugin_dir_path(__FILE__));
define('KEYGEN_URL', plugin_dir_url(__FILE__));
define('KEYGEN_PLUGIN_FILE', __FILE__);

//require(KEYGEN_DIR . '/lib/admin/keygen-admin.php');
require(KEYGEN_DIR.'/lib/admin/core.php');

/* Load custom css */
function main_css(){
    echo '<link rel="stylesheet" href="'.plugins_url( '/key-generator/lib/styles/keygen-style.css',__FILE__).'" type="text/css" media="all" />';
   }
add_action('wp_head', 'main_css');
/* plugin activation  and deactivation actions
register_activation_hook(__FILE__, 'keygen_activation');
register_deactivation_hook(__FILE__, 'keygen_deactivation');*/
?>