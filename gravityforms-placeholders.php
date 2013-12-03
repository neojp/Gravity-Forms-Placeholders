<?php
/*
Plugin Name: Gravity Forms - Placeholders add-on
Plugin URI: http://github.com/neojp/gravity-forms-placeholders/
Description: Adds HTML5 placeholder support to Gravity Forms' fields with a javascript fallback. Javascript & jQuery are required.
Version: 1.2.3
Author: Joan Piedra
Author URI: http://joanpiedra.com

Instructions:
Just add a "gplaceholder" CSS classname to the required fields or form

*/

if ( isset( $GLOBALS['pagenow'] ) && $GLOBALS['pagenow'] == 'wp-login.php' )
    return;

// look into using wp_localize_script instead
function gf_placeholder_print_scripts() {
    $plugin_dir = plugin_dir_url( __FILE__ );
    echo "<script>var jquery_placeholder_url = '" . $plugin_dir . "jquery.placeholder-1.0.1.js';</script>";
}

add_action( 'wp_print_scripts', 'gf_placeholder_print_scripts' );


function gf_placeholder_enqueue_scripts() {
    wp_enqueue_script( 'gf_placeholders', plugins_url( 'gf.placeholders.js', __FILE__ ), array( 'jquery' ), '1.0.1', true );
}

add_action( 'wp_enqueue_scripts', 'gf_placeholder_enqueue_scripts' );
