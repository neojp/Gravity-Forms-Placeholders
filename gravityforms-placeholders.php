<?php
/*
Plugin Name: Gravity Forms - Placeholders add-on
Plugin URI: http://github.com/neojp/gravity-forms-placeholders/
Description: Adds HTML5 placeholder support to Gravity Forms' fields with a javascript fallback. Javascript & jQuery are required.
Version: 1.3.0-alpha1
Author: Joan Piedra
Author URI: http://joanpiedra.com

Instructions:
Just add a "gplaceholder" CSS classname to the required fields or form

with modifications by WebAware http://webaware.com.au/
*/


/**
* register scripts
*/
function gf_placeholder_register_scripts() {
	$min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
	$ver = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? time() : '1.3.0-alpha1';

	wp_register_script('_gf_placeholders', plugins_url("js/gf.placeholders$min.js", __FILE__), array('jquery'), $ver, true);
	wp_localize_script('_gf_placeholders', 'gf_placeholders', array(
		'jquery_placeholder_url' => plugins_url("js/jquery.placeholder-1.0.1$min.js", __FILE__),
	));
}

add_action('wp_enqueue_scripts', 'gf_placeholder_register_scripts');


/**
* enqueue scripts when required by Gravity Forms
* @param array $form
* @param boolean $ajax
*/
function gf_placeholder_enqueue_scripts($form, $ajax) {
	// scan form fields looking for field with our class
	foreach ($form['fields'] as $field) {
		if (!empty($field['cssClass']) && strpos($field['cssClass'], 'gplaceholder') !== false) {
			// found one, enqueue script and stop searching
			wp_enqueue_script('_gf_placeholders');
			break;
		}
	}
}

add_action('gform_enqueue_scripts', 'gf_placeholder_enqueue_scripts', 20, 2);
