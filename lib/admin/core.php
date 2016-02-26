<?php
function keygen_activation(){
    global $keygen_db_version;
    $keygen_db_version = "1.0";

    global $wpdb;
    global $keygen_db_version;

    $table_name = $wpdb->prefix . "keygen";
    $table_name_posts = $wpdb->prefix  . "keygen_products";
    if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
                          id mediumint(9) NOT NULL AUTO_INCREMENT,
                          time bigint(11) DEFAULT '0' NOT NULL,
                          email text NOT NULL,
                          keygen text NOT NULL,
                          UNIQUE KEY id (id)
                        );";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        $email = "example@gmail.com";
        $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'email' => $email ) );

        add_option("keygen_db_version", $keygen_db_version);
     }


}
/**
 * Register a keygen menu page.
 */



/**
 * Display a custom menu page
 */
function key_gen_menu_page(){
    require(KEYGEN_DIR . '/lib/admin/keygen-admin.php');
}

/**
 * Register a keygen submenu page.
 */



function keygen_register_custom_type() {
    $labels = array(
        'name'               => _x( 'Keygen Posts', 'post type general name', 'keygen' ),
        'singular_name'      => _x( 'Keygen Post', 'post type singular name', 'keygen' ),
        'menu_name'          => _x( 'Keygen Posts', 'admin menu', 'keygen' ),
        'name_admin_bar'     => _x( 'Keygen Posts', 'add new on admin bar', 'keygen' ),
        'add_new'            => _x( 'Add New', 'keygen', 'keygen' ),
        'add_new_item'       => __( 'Add New Keygen Post', 'keygen' ),
        'new_item'           => __( 'New Keygen Post', 'keygen' ),
        'edit_item'          => __( 'Edit Keygen Post', 'keygen' ),
        'view_item'          => __( 'View Keygen Post', 'keygen' ),
        'all_items'          => __( 'All Keygen Posts', 'keygen' ),
        'search_items'       => __( 'Search Keygen Posts', 'keygen' ),
        'parent_item_colon'  => __( 'Parent Keygen Posts:', 'keygen' ),
        'not_found'          => __( 'No Keygen Posts found.', 'keygen' ),
        'not_found_in_trash' => __( 'No Keygen Posts found in Trash.', 'keygen' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => false, //<--- HERE
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'keygen_posts' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt','custom-fields' )
    );

    register_post_type( 'keygen_posts', $args );
}
add_action( 'init', 'keygen_register_custom_type' );


function wpdocs_register_key_gen_menu_page(){
    add_menu_page( __( 'Key Generator', 'textdomain' ), 'Key Generator','manage_options','genarator','key_gen_menu_page', plugins_url('/key-generator/lib/img/SafeWalletLogo.png'),6);
    add_submenu_page( 'genarator', 'Keygen Posts', 'Keygen Posts','manage_options', 'edit.php?post_type=keygen_posts', NULL );
}
add_action( 'admin_menu', 'wpdocs_register_key_gen_menu_page' );


//add scripts and styles in admin page
function sender_my_plugin_scripts() {

    if (is_admin() && isset($_GET['page'])) {
        wp_enqueue_script('jquery');
        wp_enqueue_media();
        wp_register_style( 'custom_styles', plugins_url( '/key-generator/lib/styles/keygen-style.css' ,  false, false, 'all') );
        wp_enqueue_style( 'custom_styles' );
        wp_register_script('custom_scripts', plugins_url().'/key-generator/lib/js/custom.js', array('jquery', 'jquery-ui-core'));
        wp_enqueue_script('custom_scripts');
    }

}
add_action('admin_init', 'sender_my_plugin_scripts');
add_action('admin_menu', 'mail_menu');



/**
 * change WordPress default FROM email address
 **/
add_filter( 'wp_mail_content_type', 'set_content_type' );
function set_content_type( $message ) {
    return 'text/html';
}

add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
function new_mail_from($old) {
    $email = get_option( 'admin_email' );
    return $email;
}

function new_mail_from_name($old) {
    $site_name = get_option( 'blogname');
    return $site_name;
}

function generator_ajax(){
    require(KEYGEN_DIR.'/lib/admin/key_mail.php');
    die();
}
add_action('wp_ajax_key_generator_ajax','generator_ajax');

function keygen_deactivation(){
	
	
}
///update_post_meta(1759,'price',500);