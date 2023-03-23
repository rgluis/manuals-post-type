<?php
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', plugin_dir_path(__FILE__) . '/includes/acf/' );
define( 'MY_ACF_URL', plugin_dir_url(__FILE__) . '/includes/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', '__return_false');

// When including the PRO plugin, hide the ACF Updates menu
add_filter('acf/settings/show_updates', '__return_false', 100);

require_once('includes/acf_fields.php');

function manual_post_types() {
    register_post_type('manual', array(
        'rewrite'       => array(
            'slug' => 'manuales'
        ),
        'has_archive'   => true,
        'public'        => true,
        'show_in_rest'  => true,
        'labels'        => array(
            'name'          => 'Manuales',
            'add_new_item'  => 'Agregar Nuevo Manual',
            'edit_item'     => 'Editar Manual',
            'all_items'     => 'Todos los Manuales',
            'singular_name' => 'Manual'
        ),
        'menu_icon'     => 'dashicons-media-document',
        'supports'      => array('title'),
        'taxonomies'    => array( 'category' )
    ));
}

add_action('init', 'manual_post_types');